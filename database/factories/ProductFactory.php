<?php

namespace Database\Factories;

use App\Models\Merchant;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'        => $this->faker->name(),
            'description' => $this->faker->sentence,
            'price'       => $this->faker->unique()->numberBetween($min = 500, $max = 6000),
            'merchant_id' => Merchant::factory()
        ];
    }
}