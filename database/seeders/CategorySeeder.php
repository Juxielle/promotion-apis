<?php

namespace Database\Seeders;

use App\EntityClasses\EntityField;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            EntityField::CODE => 'ELECTRONIC',
            EntityField::LABEL => 'Electronique',
        ]);
        Category::create([
            EntityField::CODE => 'ELECTROMENAGER',
            EntityField::LABEL => 'Electromenager',
        ]);
    }
}
