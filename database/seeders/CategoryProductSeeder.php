<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class CategoryProductSeeder extends Seeder
{
    public function run()
    {
        Category::factory(50)->create();

        Product::factory(10000)->create();
    }
}
