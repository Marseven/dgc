<?php

namespace Database\Seeders;

use App\Models\Privilege;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrivilegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        //VOIR privilege

        Privilege::create([
            'name' => 'VOIR_UTILISATEUR',
            'description' => "Voir un utilisateur",
            'user_type_id' => 1,
        ]);

        Privilege::create([
            'name' => 'VOIR_PERMISSION',
            'description' => "Voir une privilège",
            'user_type_id' => 1,
        ]);

        Privilege::create([
            'name' => 'VOIR_ROLE',
            'description' => "Voir un rôle",
            'user_type_id' => 1,
        ]);

        Privilege::create([
            'name' => 'VOIR_UTILISATEUR_TYPE',
            'description' => "Voir un utilisateur type",
            'user_type_id' => 1,
        ]);

        Privilege::create([
            'name' => 'VOIR_IMPORTATION',
            'description' => "Voir une importation",
            'user_type_id' => 1,
        ]);

        Privilege::create([
            'name' => 'VOIR_STOCK',
            'description' => "Voir un stock",
            'user_type_id' => 1,
        ]);

        Privilege::create([
            'name' => 'VOIR_ENTREPRISE',
            'description' => "Voir une entreprise",
            'user_type_id' => 1,
        ]);

        Privilege::create([
            'name' => 'VOIR_PARAMETRE',
            'description' => "Voir les paramètres",
            'user_type_id' => 1,
        ]);


        //create privilege

        Privilege::create([
            'name' => 'CREER_UTILISATEUR',
            'description' => "Créer un utilisateur",
            'user_type_id' => 1,
        ]);

        Privilege::create([
            'name' => 'CREER_ROLE',
            'description' => "Créer un rôle",
            'user_type_id' => 1,
        ]);

        Privilege::create([
            'name' => 'CREER_IMPORTATION',
            'description' => "Créer une importation",
            'user_type_id' => 1,
        ]);

        Privilege::create([
            'name' => 'CREER_PARAMETRE',
            'description' => "Créer un paramètre",
            'user_type_id' => 1,
        ]);

        Privilege::create([
            'name' => 'CREER_STOCK',
            'description' => "Créer un palier",
            'user_type_id' => 1,
        ]);

        //MODIFIER privilege

        Privilege::create([
            'name' => 'MODIFIER_UTILISATEUR',
            'description' => "Mettre à jour un utilisateur",
            'user_type_id' => 1,
        ]);

        Privilege::create([
            'name' => 'MODIFIER_ROLE',
            'description' => "Mettre à jour un rôle",
            'user_type_id' => 1,
        ]);

        Privilege::create([
            'name' => 'MODIFIER_IMPORTATION',
            'description' => "Mettre à jour une importation",
            'user_type_id' => 1,
        ]);

        Privilege::create([
            'name' => 'MODIFIER_PARAMETRE',
            'description' => "Mettre à jour un paramètre",
            'user_type_id' => 1,
        ]);

        Privilege::create([
            'name' => 'MODIFIER_STOCK',
            'description' => "Mettre à jour un palier",
            'user_type_id' => 1,
        ]);

        //SUPPRIMER privilege

        Privilege::create([
            'name' => 'SUPPRIMER_UTILISATEUR',
            'description' => "Supprimer un utilisateur",
            'user_type_id' => 1,
        ]);

        Privilege::create([
            'name' => 'SUPPRIMER_ROLE',
            'description' => "Supprimer un rôle",
            'user_type_id' => 1,
        ]);

        Privilege::create([
            'name' => 'SUPPRIMER_IMPORTATION',
            'description' => "Supprimer une importation",
            'user_type_id' => 1,
        ]);

        Privilege::create([
            'name' => 'SUPPRIMER_STOCK',
            'description' => "Supprimer un stock",
            'user_type_id' => 1,
        ]);

        Privilege::create([
            'name' => 'SUPPRIMER_PARAMETRE',
            'description' => "Supprimer un paramètre",
            'user_type_id' => 1,
        ]);

        Privilege::create([
            'name' => 'VOIR_LOG',
            'description' => "Voir les logs",
            'user_type_id' => 1,
        ]);

        Privilege::create([
            'name' => 'VALIDER_STOCK',
            'description' => "Valider une stock",
            'user_type_id' => 1,
        ]);

        Privilege::create([
            'name' => 'VALIDER_IMPORTATION',
            'description' => "Valider une importation",
            'user_type_id' => 1,
        ]);
    }
}
