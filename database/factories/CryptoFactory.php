<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CryptoFactory extends Factory{
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'growth' => $this->faker->growth(),
            'price' => $this->faker->price(),
        ];
    }
}