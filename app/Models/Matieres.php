<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matieres extends Model
{
    //
     protected $fillable = [
        'nom'
    ];

    public function notes() {
        return $this->hasMany(Notes::class, 'matieres_id');
    }

    public function affectations() {
        return $this->hasMany(AffectationsProf::class, 'matieres_id');
    }
   
}
