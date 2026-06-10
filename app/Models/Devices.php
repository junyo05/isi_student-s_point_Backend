<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Devices extends Model
{
    //
     protected $fillable = [
        'role', 'token', 'nom_device', 'date_creation'
    ];

    public function utilisateur() {
    return $this->belongsTo(Utilisateur::class, 'utilisateur_id');
    }
}
