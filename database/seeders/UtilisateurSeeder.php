<?php
namespace Database\Seeders;

use App\Models\Utilisateur;
use Illuminate\Database\Seeder;

class UtilisateurSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        Utilisateur::create([
            'nom'          => 'Admin',
            'prenom'       => 'ISI',
            'matricule'    => 'ADMIN001',
            'mot_de_passe' => bcrypt('password123'),
            'mail'         => 'admin@isi.sn',
            'role'         => 'admin',
            'tel'          => '771234567',
            'adresse'      => 'Dakar',
            'sexe'           => 'Masculin',
            'date_naissance' => '1990-01-01',
            'lieu_naissance' => 'Dakar',
        ]);

        // Enseignant
        Utilisateur::create([
            'nom'          => 'Diallo',
            'prenom'       => 'Mamadou',
            'matricule'    => 'ENS001',
            'mot_de_passe' => bcrypt('password123'),
            'mail'         => 'diallo@isi.sn',
            'role'         => 'enseignant',
            'tel'          => '772345678',
            'adresse'      => 'Dakar',
            'sexe'           => 'Masculin',
            'date_naissance' => '1990-01-01',
            'lieu_naissance' => 'Dakar',
        ]);

        // Etudiant
        Utilisateur::create([
            'nom'          => 'Ndiaye',
            'prenom'       => 'Fatou',
            'matricule'    => 'ETU001',
            'mot_de_passe' => bcrypt('password123'),
            'mail'         => 'fatou@isi.sn',
            'role'         => 'etudiant',
            'tel'          => '773456789',
            'adresse'      => 'Dakar',
            'sexe'           => 'Feminin',
            'date_naissance' => '1990-01-01',
            'lieu_naissance' => 'Dakar',
        ]);
    }
}