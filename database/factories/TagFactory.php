<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    public function definition(): array
    {
        $name = $this->faker->unique()->word();
        
        return [
            'name' => $name,
            'slug' => \Str::slug($name),
            'description' => $this->faker->optional()->sentence(),
        ];
    }
}