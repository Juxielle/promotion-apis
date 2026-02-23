<?php

namespace Database\Seeders;

use App\Classes\Constant;
use App\EntityClasses\EntityField;
use App\Enums\PermissionEnum;
use App\Models\Role;
use App\Models\Permission;
use App\Models\RolePermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RolePermission::create([
            EntityField::ROLE_ID => Role::where(
                EntityField::CODE,
                Constant::ADMIN
            )->first()->id,
            EntityField::PERMISSION_ID => Permission::where(
                EntityField::CODE,
                PermissionEnum::CREATE_USER
            )->first()->id,
        ]);
        RolePermission::create([
            EntityField::ROLE_ID => Role::where(
                EntityField::CODE,
                Constant::ADMIN
            )->first()->id,
            EntityField::PERMISSION_ID => Permission::where(
                EntityField::CODE,
                PermissionEnum::UPDATE_USER
            )->first()->id,
        ]);
        RolePermission::create([
            EntityField::ROLE_ID => Role::where(
                EntityField::CODE,
                Constant::ADMIN
            )->first()->id,
            EntityField::PERMISSION_ID => Permission::where(
                EntityField::CODE,
                PermissionEnum::DELETE_USER
            )->first()->id,
        ]);
    }
}
