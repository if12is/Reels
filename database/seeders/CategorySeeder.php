<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'city' => 'Cairo',
        ]);
        Category::create([
            'city' => 'Giza',
        ]);
        Category::create([
            'city' => 'Alexandria',
        ]);
        Category::create([
            'city' => 'Dakahlia',
        ]);
        Category::create([
            'city' => 'Red Sea',
        ]);
        Category::create([
            'city' => 'Beheira',
        ]);
        Category::create([
            'city' => 'Fayoum',
        ]);
        Category::create([
            'city' => 'Gharbiya',
        ]);
        Category::create([
            'city' => 'Ismailia',
        ]);
        Category::create([
            'city' => 'Menofia',
        ]);
        Category::create([
            'city' => 'Minya',
        ]);
        Category::create([
            'city' => 'Qaliubiya',
        ]);
        Category::create([
            'city' => 'New Valley',
        ]);
        Category::create([
            'city' => 'Suez',
        ]);
        Category::create([
            'city' => 'Aswan',
        ]);
        Category::create([
            'city' => 'Assiut',
        ]);
        Category::create([
            'city' => 'Beni Suef',
        ]);
        Category::create([
            'city' => 'Port Said',
        ]);
        Category::create([
            'city' => 'Damietta',
        ]);
        Category::create([
            'city' => 'Sharkia',
        ]);
        Category::create([
            'city' => 'South Sinai',
        ]);
        Category::create([
            'city' => 'North Sinai',
        ]);
        Category::create([
            'city' => 'Kafr Al sheikh',
        ]);
        Category::create([
            'city' => 'Matrouh',
        ]);
        Category::create([
            'city' => 'Luxor',
        ]);
        Category::create([
            'city' => 'Qena',
        ]);
        Category::create([
            'city' => 'Sohag',
        ]);
    }
}
