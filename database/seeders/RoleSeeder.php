<?php

namespace Database\Seeders;

use App\EntityClasses\EntityField;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            EntityField::LABEL => 'Utilisateur racine',
            EntityField::CODE => 'root',
        ]);
        Role::create([
            EntityField::LABEL => 'Super administrateur',
            EntityField::CODE => 'super-admin',
        ]);
        Role::create([
            EntityField::LABEL => 'Administrateur',
            EntityField::CODE => 'admin',
        ]);
        Role::create([
            EntityField::LABEL => 'Client',
            EntityField::CODE => 'customer',
        ]);
        Role::create([
            EntityField::LABEL => 'Vendeur',
            EntityField::CODE => 'seller',
        ]);
        Role::create([
            EntityField::LABEL => 'Fournisseur',
            EntityField::CODE => 'provider',
        ]);
    }
}
