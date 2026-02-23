<?php

namespace Database\Seeders;

use App\Classes\Constant;
use App\EntityClasses\EntityField;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            EntityField::NAME => 'ONGAGNA EKAKA',
            EntityField::FIRSTNAME => 'Harold Juxielle',
            EntityField::EMAIL => 'juxielle@gmail.com',
            EntityField::TELEPHONE => '077654399',
            EntityField::PASSWORD => bcrypt('1234'),
            EntityField::ROLE_ID => Role::where(EntityField::CODE, Constant::SUPER_ADMIN)->first()->id,
        ]);
        User::create([
            EntityField::NAME => 'NKOUKA',
            EntityField::FIRSTNAME => 'Servais',
            EntityField::EMAIL => 'servais@gmail.com',
            EntityField::TELEPHONE => '065786543',
            EntityField::PASSWORD => bcrypt('1234'),
            EntityField::ROLE_ID => Role::where(EntityField::CODE, Constant::ADMIN)->first()->id,
        ]);
        User::create([
            EntityField::NAME => 'KALANGANGOU',
            EntityField::FIRSTNAME => 'Chancel',
            EntityField::EMAIL => 'chancel@gmail.com',
            EntityField::TELEPHONE => '074569865',
            EntityField::PASSWORD => bcrypt('1234'),
            EntityField::ROLE_ID => Role::where(EntityField::CODE, Constant::SUPER_ADMIN)->first()->id,
        ]);
    }
}
