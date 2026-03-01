<?php
namespace Database\Seeders;

use App\Classes\Constant;
use App\EntityClasses\EntityField;
use App\Models\Seller;
use Illuminate\Database\Seeder;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Seller::create([
            EntityField::NAME => 'MOKOKO IKOKA',
            EntityField::FIRSTNAME => 'Jupsie',
            EntityField::SEX => Constant::SEX_F,
            EntityField::EMAIL => "j.mokoko@gmail.com",
        ]);
    }
}
