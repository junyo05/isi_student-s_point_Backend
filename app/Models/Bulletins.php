<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bulletins extends Model
{
    //
     protected $fillable = [
        'semestre', 'moyenne', 'chemin_pdf', 'status',
        'creer_par'
    ];

    public function inscription() {
        return $this->belongsTo(Inscription::class, 'inscriptions_id');
    }

    

}
