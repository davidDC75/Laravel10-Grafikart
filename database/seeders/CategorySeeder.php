<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tblCategories=['Technologie','Santé','Science','Sport','Politique','Lecture','Animaux','Nature'];
        foreach ($tblCategories as $categoryName) {
            $category=new Category();
            $category->name=$categoryName;
            $category->save();
        }
    }
}
