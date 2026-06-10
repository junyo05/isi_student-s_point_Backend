<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AffectationsProf extends Model
{
    //
    protected $fillable = [
    'enseignant_id', 'matieres_id', 'classes_id'
    ];

    public function enseignants() {
        return $this->belongsTo(Utilisateur::class, 'enseignant_id');
    }

    public function matieres() {
        return $this->belongsTo(Matieres::class, 'matieres_id');
    }

    public function classes() {
        return $this->belongsTo(Classes::class, 'classes_id');
    }

}
