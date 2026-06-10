<?php

namespace App\Http\Controllers;

use App\Models\Filieres;
use Illuminate\Http\Request;

class FilieresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json(Filieres::all());
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
        $request->validate(['nom' => 'required|string|unique:filieres']);
        $filiere = Filieres::create(['nom' => $request->nom]);
        return response()->json(['message' => 'Filière créée', 'filiere' => $filiere]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Filieres $filieres)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Filieres $filieres)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $filiere = Filieres::findOrFail($id);
        $request->validate(['nom' => 'required|string|unique:filieres,nom,'.$id]);
        $filiere->update(['nom' => $request->nom]);
        return response()->json(['message' => 'Filière modifiée', 'filiere' => $filiere]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
         Filieres::findOrFail($id)->delete();
        return response()->json(['message' => 'Filière supprimée']);
    }
}
