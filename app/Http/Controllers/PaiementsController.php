<?php

namespace App\Http\Controllers;

use App\Models\Paiements;
use Illuminate\Http\Request;

class PaiementsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
         return response()->json(
            Paiements::with('etudiant')->get()
        );
    }

     // Lister les paiements d'un étudiant
    public function parEtudiant($etudiant_id) {
        return response()->json(
            Paiements::where('etudiant_id', $etudiant_id)->get()
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
            'etudiant_id'   => 'required|exists:utilisateurs,id',
            'montant'       => 'required|numeric',
            'type'          => 'required|in:mensualite,frais annexes,inscription',
            'status'        => 'required|in:a venir,payer,impayer',
            'date_paiement' => 'required|date',
            'reference'     => 'required|string|unique:paiements',
        ]);

        $paiement = Paiements::create($request->all());
        return response()->json(['message' => 'Paiement ajouté', 'paiement' => $paiement]);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Paiements $paiements)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paiements $paiements)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $paiement = Paiements::findOrFail($id);
        $request->validate([
            'status' => 'required|in:a venir,payer,impayer',
        ]);
        $paiement->update(['status' => $request->status]);
        return response()->json(['message' => 'Status mis à jour', 'paiement' => $paiement]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Paiements::findOrFail($id)->delete();
        return response()->json(['message' => 'Paiement supprimé']);
    }
}
