<?php

namespace Database\Seeders;

use App\Classes\Constant;
use App\EntityClasses\EntityField;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            EntityField::LABEL => Constant::ROOT_LABEL,
            EntityField::CODE => Constant::ROOT_CODE,
        ]);
        Role::create([
            EntityField::LABEL => Constant::SUPER_ADMIN_LABEL,
            EntityField::CODE => Constant::SUPER_ADMIN_CODE,
        ]);
        Role::create([
            EntityField::LABEL => Constant::ADMIN_LABEL,
            EntityField::CODE => Constant::ADMIN_CODE,
        ]);
        Role::create([
            EntityField::LABEL => Constant::CUSTOMER_LABEL,
            EntityField::CODE => Constant::CUSTOMER_CODE,
        ]);
        Role::create([
            EntityField::LABEL => Constant::SELLER_LABEL,
            EntityField::CODE => Constant::SELLER_CODE,
        ]);
        Role::create([
            EntityField::LABEL => Constant::PROVIDER_LABEL,
            EntityField::CODE => Constant::PROVIDER_CODE,
        ]);
    }
}
