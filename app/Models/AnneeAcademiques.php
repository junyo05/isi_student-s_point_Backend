<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnneeAcademiques extends Model
{
    //
     protected $fillable = [
        'libelle'
    ];

    public function classes() {
        return $this->hasMany(Classes::class, 'annee_id');
    }

    public function inscriptions() {
        return $this->hasMany(Inscriptions::class, 'annee_id');
    }

}
