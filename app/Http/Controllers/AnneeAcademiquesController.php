<?php

namespace App\Http\Controllers;

use App\Models\AnneeAcademiques;
use Illuminate\Http\Request;

class AnneeAcademiquesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json(AnneeAcademiques::all());
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
         $request->validate(['libelle' => 'required|string|unique:annee_academiques']);
        $annee = AnneeAcademiques::create(['libelle' => $request->libelle]);
        return response()->json(['message' => 'Année créée', 'annee' => $annee]);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(AnneeAcademiques $anneeAcademiques)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AnneeAcademiques $anneeAcademiques)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AnneeAcademiques $anneeAcademiques)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        AnneeAcademiques::findOrFail($id)->delete();
        return response()->json(['message' => 'Année supprimée']);
    }
    
}
