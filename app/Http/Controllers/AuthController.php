<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Utilisateur;
use OpenApi\Attributes as OA;


class AuthController extends Controller
{
    // methode login
    #[OA\Post(
    path: "/api/login",
    summary: "Connexion utilisateur",
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: "matricule", type: "string", example: "ADMIN001"),
                new OA\Property(property: "mot_de_passe", type: "string", example: "password123")
            ]
        )
    ),
    responses: [
        new OA\Response(response: 200, description: "Connexion réussie"),
        new OA\Response(response: 401, description: "Identifiants incorrects")
    ]
)]
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
