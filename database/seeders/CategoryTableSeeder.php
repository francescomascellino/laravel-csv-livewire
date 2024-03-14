<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // IMPORTS categories.csv

        // GETS THE DB PATH
        $csvPath = database_path('csv/categories.csv');

        // READS THE FILE INTO A STRING
        $categoriesCsv = file_get_contents($csvPath);

        // CONVERTS $categoriesCsv TO ARRAY AND THEN  SPLIT BY LINES AND THEN str_getcsv CONVERTS EACH LINE IN AN ASSOCIATIVE ARRAY
        $categoriesArray = array_map('str_getcsv', explode("\n", $categoriesCsv));

        // REMOVES THE FIRST ENTRY OF THE ARRAY (COLUMN NAMES)
        array_shift($categoriesArray);

        // CREATES THE CATEGORIES
        foreach ($categoriesArray as $categoryData) {
            $category = new Category();
            $category->label = $categoryData[0];
            $category->color = $categoryData[1];
            $category->save();
        }
    }
}
