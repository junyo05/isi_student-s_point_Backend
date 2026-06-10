<?php

namespace App\Models;

use Database\Factories\UserFactory;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Utilisateur extends Authenticatable
{
    //
    use HasFactory, Notifiable, HasApiTokens;

    
    protected $fillable = [
        'nom', 'prenom', 'matricule','date_naissance', 'lieu_naissance', 'sexe', 'mot_de_passe',
        'mail', 'adresse', 'tel', 'role'
    ];

    public function inscriptions() {
        return $this->hasMany(Inscription::class, 'etudiant_id');
    }

    public function devices() {
        return $this->hasMany(Device::class, 'utilisateur_id');
    }

    public function paiements() {
        return $this->hasMany(Paiement::class, 'etudiant_id');
    }

    public function reclamations() {
        return $this->hasMany(Reclamation::class, 'etudiant_id');
    }

    public function notifications() {
        return $this->hasMany(Notification::class, 'utilisateur_id');
    }

    // Si c'est un enseignant
    public function affectations() {
        return $this->hasMany(AffectationProf::class, 'enseignant_id');
    }
}
