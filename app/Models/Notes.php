<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    //
     protected $fillable = [
        'semestre', 'valeur'
    ];

    public function etudiant() {
    return $this->belongsTo(Utilisateur::class, 'etudiant_id');
    }

    public function matieres(){
        return $this->belongsTo(Matieres::class, 'matieres_id');
    }
}
