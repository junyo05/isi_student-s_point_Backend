<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Utilisateur;

class AuthController extends Controller
{
    // methode login
    public function login (Request $request) {
        $request->validate([
            'matricule' => 'required|string',
            'mot_de_passe' => 'required|string',
        ]);

        $utilisateur = Utilisateur::where('matricule', $request->matricule)->first();

        if (!$utilisateur || !Hash::check($request->mot_de_passe, $utilisateur->mot_de_passe)) {
            return response()->json([
                'message' => 'Identifiants incorrects'
            ], 401);
        }

        $token = $utilisateur->createToken('auth_token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'role'  => $utilisateur->role,
            'utilisateur' => $utilisateur
        ]);
    }

    //metode logout
    public function logout (Request $request) {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Déconnecté avec succès'
        ]);
    }
}
