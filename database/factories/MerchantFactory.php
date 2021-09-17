<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Merchant;
use Illuminate\Database\Eloquent\Factories\Factory;

class MerchantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Merchant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'    => $this->faker->name(5).' Merchant',
            'phone'   => $this->faker->phoneNumber,
            'user_id' => User::factory()
        ];
    }
}
