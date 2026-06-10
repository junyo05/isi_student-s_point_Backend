<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;

class UtilisateurController extends Controller
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
            'nom' => 'required',
            'prenom' => 'required',
            'mot_de_passe' => 'required',
            'matricule' => 'required|unique:utilisateurs',
            'adresse' => 'required',
            'mail' => 'required|email|unique:utilisateurs',
            'role' => 'required|in:etudiant,enseignant,admin',
            'tel' => 'required',
            'sexe' => 'required',
            'date_naissance' => 'required',
            'lieu_naissance' => 'required'
        ]);

        $utilisateur = Utilisateur::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'matricule' => $request->matricule,
            'adresse' => $request->adresse,
            'mail' => $request->mail,
            'mot_de_passe' => bcrypt('passer12'),
            'role' => $request->role,
            'tel' => $request->tel,
            'sexe' => $request->sexe,
            'date_naissance' => $request->date_naissance,
            'lieu_naissance' => $request->lieu_naissance,
        ]);

        return response()->json([
            'message' => 'Utilisateur créé avec mot de passe temporaire : passer12',
            'utilisateur' => $utilisateur
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Utilisateur $utilisateur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Utilisateur $utilisateur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Utilisateur $utilisateur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Utilisateur $utilisateur)
    {
        //
    }
}
