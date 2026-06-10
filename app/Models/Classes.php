<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Classes extends Model
{
    //
     protected $fillable = [
        'nom' 
    ];

    public function filiere(){
        return $this->belongsTo(Filieres::class, 'filieres_id');
    }

    public function annee(){
        return $this->belongsTo(AnneeAcademiques::class, 'annee_id');
    }

    public function notifications() {
        return $this->hasMany(Notifications::class, 'classes_id');
    }

    public function affectations() {
        return $this->hasMany(AffectationsProfs::class, 'classes_id');
    }

    public function inscriptions() {
        return $this->hasMany(Inscriptions::class, 'classes_id');
    }


}
