<?php

namespace App\Http\Controllers;

use App\Models\Notifications;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    // Lister les notifications d'un utilisateur
    public function mesNotifications(Request $request) {
        return response()->json(
            Notifications::where('utilisateur_id', $request->user()->id)
                ->orWhere(function($q) use ($request) {
                    $q->where('type', 'role')
                      ->where('role', $request->user()->role);
                })
                ->orderBy('created_at', 'desc')
                ->get()
        );
    }

    // Marquer comme lu
    public function marquerLu($id) {
        $notif = Notifications::findOrFail($id);
        $notif->update(['est_lu' => true]);
        return response()->json(['message' => 'Notification marquée comme lue']);
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
            'titre'          => 'required|string',
            'contenu'        => 'required|string',
            'type'           => 'required|in:role,classe,individuel',
            'role'           => 'nullable|string',
            'classes_id'     => 'nullable|exists:classes,id',
            'utilisateur_id' => 'nullable|exists:utilisateurs,id',
            'cible_id'       => 'nullable|integer',
            'cible_type'     => 'nullable|string',
        ]);

        $notif = Notifications::create([
            ...$request->all(),
            'est_lu' => false,
        ]);

        // Récupérer les tokens Firebase selon le type
        $query = Devices::query();

        match($request->type) {
            'role'       => $query->whereHas('utilisateur', fn($q) => $q->where('role', $request->role)),
            'classe'     => $query->whereHas('utilisateur', fn($q) => $q->where('classes_id', $request->classes_id)),
            'individuel' => $query->where('utilisateur_id', $request->utilisateur_id),
        };

        $tokens = $query->pluck('token')->toArray();

        // Envoyer via Firebase FCM
        if (!empty($tokens)) {
            Http::withHeaders([
                'Authorization' => 'key=' . env('FIREBASE_SERVER_KEY'),
                'Content-Type'  => 'application/json',
            ])->post('https://fcm.googleapis.com/fcm/send', [
                'registration_ids' => $tokens,
                'notification' => [
                    'title' => $request->titre,
                    'body'  => $request->contenu,
                ],
            ]);
        }

        return response()->json(['message' => 'Notification envoyée', 'notification' => $notif]);
    }


    /**
     * Display the specified resource.
     */
    public function show(Notifications $notifications)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notifications $notifications)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notifications $notifications)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notifications $notifications)
    {
        //
    }
}
