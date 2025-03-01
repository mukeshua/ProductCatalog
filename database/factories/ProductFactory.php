<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'sku' => $this->faker->unique()->numerify('SKU-####'),
            'price' => $this->faker->randomFloat(2, 5, 1000), // Random price between 5 and 1000
            'category_id' => Category::inRandomOrder()->first()->id, // Assign a random category
        ];
    }
}