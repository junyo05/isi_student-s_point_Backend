<?php

namespace App\Http\Controllers;

use App\Models\Devices;
use Illuminate\Http\Request;

class DevicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function store(Request $request) {
        $request->validate([
            'token'      => 'required|string',
            'nom_device' => 'required|string',
        ]);

        // Mettre à jour si existe déjà, sinon créer
        $device = Devices::updateOrCreate(
            ['token' => $request->token],
            [
                'utilisateur_id' => $request->user()->id,
                'role'           => $request->user()->role,
                'nom_device'     => $request->nom_device,
                'date_creation'  => now(),
            ]
        );

        return response()->json(['message' => 'Device enregistré', 'device' => $device]);
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
  

    /**
     * Display the specified resource.
     */
    public function show(Devices $devices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Devices $devices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Devices $devices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Request $request) {
        Devices::where('utilisateur_id', $request->user()->id)->delete();
        return response()->json(['message' => 'Device supprimé']);
    }
}
