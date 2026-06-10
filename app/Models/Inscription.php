<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    //
    protected $fillable = [
        'etudiant_id', 'classes_id', 'annee_id'
    ];
    
    public function etudiant(){
        return $this->belongsTo(Utilisateurs::class, 'etudiant_id');
    }

    public function classe () {
        return $this->belongsTo(Classes::class, 'classes_id');
    }

    public function annee(){
        return $this->belongsTo(AnneeAcademiques::class, 'annee_id');
    }

    public function bulletins() {
        return $this->hasMany(Bulletins::class, 'inscriptions_id');
    }

}
