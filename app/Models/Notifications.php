<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    //
     protected $fillable = [
        'role', 'type', 'titre', 'contenu', 'est_lu','cible_id', 'cible_type'
    ];

    public function classe() {
    return $this->belongsTo(Classes::class, 'classes_id');
    }

    public function utilisateur() {
    return $this->belongsTo(Utilisateur::class, 'utilisateur_id');
    }
}
