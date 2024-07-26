<?php

namespace Database\Seeders;

use App\Models\Calibrate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CalibrateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Calibrate::create([
            'tool_id' => 1,
            'calibration_date' => '2023-07-24 14:00:00',
            'calibration_due_date' => '2024-07-24 14:00:00',
            'calibration_status' => 'Calibrated',
        ]);

        Calibrate::create([
            'tool_id' => 2,
            'calibration_date' => '2023-08-08 14:00:00',
            'calibration_due_date' => '2024-08-08 14:00:00',
            'calibration_status' => 'Calibrated',
        ]);

        Calibrate::create([
            'tool_id' => 3,
            'calibration_date' => '2024-07-08 14:00:00',
            'calibration_due_date' => '2025-07-08 14:00:00',
            'calibration_status' => 'Calibrated',
        ]);
    }
}
