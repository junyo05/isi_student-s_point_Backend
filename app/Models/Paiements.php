<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiements extends Model
{
    //
     protected $fillable = [
        'montant', 'type', 'status', 'date_paiement',
        'reference'
    ];

    public function etudiant() {
    return $this->belongsTo(Utilisateur::class, 'etudiant_id');
    }
}
