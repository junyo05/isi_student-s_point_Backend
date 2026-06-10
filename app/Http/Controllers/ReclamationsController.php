<?php

namespace App\Http\Controllers;

use App\Models\Reclamations;
use Illuminate\Http\Request;

class ReclamationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json(
            Reclamations::with('etudiant')->get()
        );
    }

     // Lister les réclamations d'un étudiant
    public function parEtudiant($etudiant_id) {
        return response()->json(
            Reclamations::where('etudiant_id', $etudiant_id)->get()
        );
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
            'type'    => 'required|in:Notes,Bulletins,Presence,Comptabilite,Autres',
            'message' => 'required|string',
            'cible_id' => 'nullable|integer',
        ]);

        $reclamation = Reclamations::create([
            'etudiant_id' => $request->user()->id,
            'type'        => $request->type,
            'message'     => $request->message,
            'cible_id'    => $request->cible_id,
            'status'      => 'En cours',
            'reponse'     => null,
        ]);

        return response()->json(['message' => 'Réclamation envoyée', 'reclamation' => $reclamation]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Reclamations $reclamations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reclamations $reclamations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reclamations $reclamations)
    {
        //
    }

    public function repondre(Request $request, $id) {
        $reclamation = Reclamations::findOrFail($id);
        $request->validate([
            'reponse' => 'required|string',
            'status'  => 'required|in:En cours,Corriger,Rejetter',
        ]);
        $reclamation->update([
            'reponse' => $request->reponse,
            'status'  => $request->status,
        ]);
        return response()->json(['message' => 'Réponse envoyée', 'reclamation' => $reclamation]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Reclamations::findOrFail($id)->delete();
        return response()->json(['message' => 'Réclamation supprimée']);
    }
}
