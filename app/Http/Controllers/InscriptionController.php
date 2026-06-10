<?php

namespace App\Http\Controllers;

use App\Models\Inscription;
use Illuminate\Http\Request;

class InscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json(
            Inscription::with('etudiant', 'classe', 'annee')->get()
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
            'etudiant_id' => 'required|exists:utilisateurs,id',
            'classes_id'  => 'required|exists:classes,id',
            'annee_id'    => 'required|exists:annee_academiques,id',
        ]);

        // Vérifier qu'il n'est pas déjà inscrit pour cette année
        $existe = Inscription::where('etudiant_id', $request->etudiant_id)
            ->where('annee_id', $request->annee_id)
            ->exists();

        if ($existe) {
            return response()->json(['message' => 'Étudiant déjà inscrit pour cette année'], 409);
        }

        $inscription = Inscription::create($request->all());
        return response()->json(['message' => 'Inscription créée', 'inscription' => $inscription]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Inscription $inscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inscription $inscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inscription $inscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Inscription::findOrFail($id)->delete();
        return response()->json(['message' => 'Inscription supprimée']);
    }
}
