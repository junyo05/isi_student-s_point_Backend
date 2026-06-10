<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reclamations extends Model
{
    //
    protected $fillable = [
        'message', 'type', 'status', 'reponse',
        'cible_id'
    ];

    public function etudiant() {
    return $this->belongsTo(Utilisateur::class, 'etudiant_id');
    }

   
}
