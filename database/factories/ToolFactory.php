<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tool>
 */
class ToolFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['Screwdriver', 'Hammer', 'Drill', 'Saw']),
            'type' => $this->faker->randomElement(['Hand Tool', 'Power Tool', 'Garden Tool']),
            'serial_number' => $this->faker->unique()->randomNumber(6),
            'purchase_date' => $this->faker->date(),
            // price per day dengan nominal indonesia
            'price_per_day' => $this->faker->randomElement([50000, 100000, 150000]),
            // 'status' => $this->faker->randomElement(['Available']),
        ];
    }
}
