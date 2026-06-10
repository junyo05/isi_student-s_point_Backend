<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json(Classes::with('filiere', 'annee')->get());
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
            'nom'         => 'required|string',
            'filieres_id' => 'required|exists:filieres,id',
            'annee_id'    => 'required|exists:annee_academiques,id',
        ]);
        $classe = Classes::create($request->all());
        return response()->json(['message' => 'Classe créée', 'classe' => $classe]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Classes $classes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classes $classes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $classe = Classes::findOrFail($id);
        $classe->update($request->all());
        return response()->json(['message' => 'Classe modifiée', 'classe' => $classe]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Classes::findOrFail($id)->delete();
        return response()->json(['message' => 'Classe supprimée']);
    }
}
