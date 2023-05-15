<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name"=> $this->faker->name,
            "price"=> random_int(100,1000),
            "thumbnail"=>"/img/product/product-".random_int(1,12).".jpg",
            "qty"=>random_int(5,100),
            "description"=>$this->faker->text(1000),
            "category_id"=>random_int(1,100)
        ];
    }
}
