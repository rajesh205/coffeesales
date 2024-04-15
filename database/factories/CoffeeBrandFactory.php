<?php

namespace Database\Factories;

use App\Models\CoffeeBrand;
use Illuminate\Database\Eloquent\Factories\Factory;

class CoffeeBrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'brand_name' => $this->faker->word,
            'profit_margin' => '0.25'
            // Define other fields and their fake data
        ];
    }
}
