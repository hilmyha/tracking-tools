<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Calibrate>
 */
class CalibrateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'calibration_date' => '2021-07-17',
            'calibration_due_date' => '2021-07-17',
            'calibration_status' => $this->faker->randomElement(['Calibrated', 'Not Calibrated', 'Calibration Due']),
        ];
    }
}
