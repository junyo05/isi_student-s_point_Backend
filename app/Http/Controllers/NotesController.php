<?php

namespace App\Http\Controllers;

use App\Models\Notes;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'etudiant_id' => 'required|exists:utilisateurs,id',
            'matieres_id' => 'required|exists:matieres,id',
            'semestre'    => 'required|string',
            'valeur'      => 'required|numeric|min:0|max:20',
        ]);

        // Vérifier que l'enseignant est bien affecté à cette matière
        $affectation = \App\Models\AffectationsProf::where('enseignant_id', $request->user()->id)
        ->where('matieres_id', $request->matieres_id)
        ->exists();

        if (!$affectation) {
            return response()->json(['message' => 'Vous n\'êtes pas affecté à cette matière'], 403);
        }

        // Vérification au cas ou la note existe déjà
        $existe = Notes::where('etudiant_id', $request->etudiant_id)
            ->where('matieres_id', $request->matieres_id)
            ->where('semestre', $request->semestre)
            ->exists();

        if ($existe) {
            return response()->json(['message' => 'Note déjà existante pour ce semestre'], 409);
        }

        $note = Notes::create($request->all());
        return response()->json(['message' => 'Note ajoutée', 'note' => $note]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Notes $notes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notes $notes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $note = Notes::findOrFail($id);
        
        // Vérifier que l'enseignant est affecté à la matière de cette note
        $affectation = \App\Models\AffectationsProf::where('enseignant_id', $request->user()->id)
        ->where('matieres_id', $note->matieres_id)
        ->exists();

        if (!$affectation) {
            return response()->json(['message' => 'Non autorisé'], 403);
        }

        $request->validate([
            'valeur' => 'required|numeric|min:0|max:20',
        ]);
        $note->update(['valeur' => $request->valeur]);
        return response()->json(['message' => 'Note modifiée', 'note' => $note]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Notes::findOrFail($id)->delete();
        return response()->json(['message' => 'Note supprimée']);
    }

    // Lister les notes d'un étudiant
    public function parEtudiant($etudiant_id) {
        return response()->json(
            Notes::with('matieres')
                ->where('etudiant_id', $etudiant_id)
                ->get()
        );
    }

    // Lister les notes par matière (pour un enseignant)
    public function parMatiere($matieres_id) {
        return response()->json(
            Notes::with('etudiant')
                ->where('matieres_id', $matieres_id)
                ->get()
        );
    }

   

    

  
}
