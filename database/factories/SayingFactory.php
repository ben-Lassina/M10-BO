<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SayingFactory extends Factory
{
    public function definition()
    {
        return [
            'gezegde' => $this->faker->sentence(3),
            'betekenis' => $this->faker->paragraph(),
            'image_url' => null,
        ];
    }
}
