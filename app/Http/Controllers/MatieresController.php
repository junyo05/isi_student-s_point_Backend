<?php

namespace App\Http\Controllers;

use App\Models\Matieres;
use Illuminate\Http\Request;

class MatieresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json(Matieres::all());
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
        $request->validate(['nom' => 'required|string|unique:matieres']);
        $matiere = Matieres::create(['nom' => $request->nom]);
        return response()->json(['message' => 'Matière créée', 'matiere' => $matiere]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Matieres $matieres)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Matieres $matieres)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $matiere = Matieres::findOrFail($id);
        $request->validate(['nom' => 'required|string|unique:matieres,nom,'.$id]);
        $matiere->update(['nom' => $request->nom]);
        return response()->json(['message' => 'Matière modifiée', 'matiere' => $matiere]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Matieres::findOrFail($id)->delete();
        return response()->json(['message' => 'Matière supprimée']);
    }
}
