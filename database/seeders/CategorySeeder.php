<?php

namespace Database\Seeders;

use App\Models\Categories\CategoryModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategoryModel::insert([
            ['name' => 'Remessa Parcial'],
            ['name' => 'Remessa']
        ]);
    }
}
