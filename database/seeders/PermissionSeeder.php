<?php

namespace Database\Seeders;

use App\EntityClasses\EntityField;
use App\Enums\PermissionEnum;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create([
            EntityField::LABEL => 'Créer un utilisateur',
            EntityField::CODE => PermissionEnum::CREATE_USER,
        ]);
        Permission::create([
            EntityField::LABEL => 'Modifier un utilisateur',
            EntityField::CODE => PermissionEnum::UPDATE_USER,
        ]);
        Permission::create([
            EntityField::LABEL => 'Supprimer un utilisateur',
            EntityField::CODE => PermissionEnum::DELETE_USER,
        ]);
        Permission::create([
            EntityField::LABEL => 'Afficher un utilisateur',
            EntityField::CODE => PermissionEnum::SHOW_USER,
        ]);
        Permission::create([
            EntityField::LABEL => 'Afficher les utilisateurs',
            EntityField::CODE => PermissionEnum::SHOW_USERS,
        ]);
        Permission::create([
            EntityField::LABEL => 'Changer le statut d\'un utilisateur',
            EntityField::CODE => PermissionEnum::SET_USER_STATUS,
        ]);
    }
}
