<?php
namespace App\Http\Controllers;

use App\Models\Bulletins;
use App\Models\Notes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class BulletinsController extends Controller
{
    // Lister tous les bulletins (admin)
    public function index() {
        return response()->json(
            Bulletins::with('inscription.etudiant', 'inscription.classe')->get()
        );
    }

    // Lister les bulletins d'un étudiant
    public function parEtudiant($etudiant_id) {
        return response()->json(
            Bulletins::whereHas('inscription', fn($q) => $q->where('etudiant_id', $etudiant_id))
                ->get()
        );
    }

    // Générer un bulletin (admin)
    public function generer(Request $request) {
        $request->validate([
            'inscriptions_id' => 'required|exists:inscriptions,id',
            'semestre'        => 'required|string',
        ]);

        // Récupérer les notes de l'étudiant pour ce semestre
        $inscription = \App\Models\Inscription::with('etudiant', 'classe')->findOrFail($request->inscriptions_id);

        $notes = Notes::where('etudiant_id', $inscription->etudiant_id)
            ->where('semestre', $request->semestre)
            ->with('matieres')
            ->get();

        // Calculer la moyenne
        $moyenne = $notes->avg('valeur');

        // Générer le PDF
        $pdf = Pdf::loadView('bulletins.template', [
            'inscription' => $inscription,
            'notes'       => $notes,
            'moyenne'     => round($moyenne, 2),
            'semestre'    => $request->semestre,
        ]);

        // Sauvegarder le PDF
        $chemin = 'bulletins/' . $inscription->etudiant_id . '_' . $request->semestre . '.pdf';
        Storage::put($chemin, $pdf->output());

        // Créer ou mettre à jour le bulletin
        $bulletin = Bulletins::updateOrCreate(
            [
                'inscriptions_id' => $request->inscriptions_id,
                'semestre'        => $request->semestre,
            ],
            [
                'moyenne'    => $moyenne,
                'chemin_pdf' => $chemin,
                'status'     => 'brouillon',
                'creer_par'  => $request->user()->id,
            ]
        );

        return response()->json(['message' => 'Bulletin généré', 'bulletin' => $bulletin]);
    }

    // Publier un bulletin (admin)
    public function publier($id) {
        $bulletin = Bulletins::findOrFail($id);
        $bulletin->update(['status' => 'publie']);
        return response()->json(['message' => 'Bulletin publié', 'bulletin' => $bulletin]);
    }

    // Télécharger le PDF
    public function telecharger($id) {
        $bulletin = Bulletins::findOrFail($id);

        if (!Storage::exists($bulletin->chemin_pdf)) {
            return response()->json(['message' => 'Fichier introuvable'], 404);
        }

        return Storage::download($bulletin->chemin_pdf);
    }

    public function destroy($id) {
        $bulletin = Bulletins::findOrFail($id);
        Storage::delete($bulletin->chemin_pdf);
        $bulletin->delete();
        return response()->json(['message' => 'Bulletin supprimé']);
    }
}