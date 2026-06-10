<?php

namespace App\Http\Controllers;

use App\Models\AffectationsProf;
use Illuminate\Http\Request;

class AffectationsProfController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json(
            AffectationsProf::with('enseignants', 'matieres', 'classes')->get()
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
            'enseignant_id' => 'required|exists:utilisateurs,id',
            'matieres_id'   => 'required|exists:matieres,id',
            'classes_id'    => 'required|exists:classes,id',
        ]);

        // Vérifier si l'affectation existe déjà
        $existe = AffectationsProf::where('enseignant_id', $request->enseignant_id)
            ->where('matieres_id', $request->matieres_id)
            ->where('classes_id', $request->classes_id)
            ->exists();

        if ($existe) {
            return response()->json(['message' => 'Affectation déjà existante'], 409);
        }

        $affectation = AffectationsProf::create($request->all());
        return response()->json(['message' => 'Affectation créée', 'affectation' => $affectation]);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(AffectationsProf $affectationsProf)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AffectationsProf $affectationsProf)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AffectationsProf $affectationsProf)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        AffectationsProf::findOrFail($id)->delete();
        return response()->json(['message' => 'Affectation supprimée']);
    }
}
