<?php

namespace Database\Seeders;

use App\Models\Rent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // buat data palsu
        // Rent::create([
        //     'tool_id' => 1,
        //     'renter_name' => fake('id_ID')->name(),
        //     'renter_email' => fake('id_ID')->email(),
        //     'rental_date' => '2024-07-17 14:00:00',
        //     'due_date' => '2024-07-23 14:00:00',
        //     'rental_status' => 'Rented',
        // ]);

        // Rent::create([
        //     'tool_id' => 2,
        //     'renter_name' => fake('id_ID')->name(),
        //     'renter_email' => fake('id_ID')->email(),
        //     'rental_date' => '2024-07-19 14:00:00',
        //     'due_date' => '2024-07-29 14:00:00',
        //     'rental_status' => 'Rented',
        // ]);

        // Rent::create([
        //     'tool_id' => 3,
        //     'renter_name' => fake('id_ID')->name(),
        //     'renter_email' => fake('id_ID')->email(),
        //     'rental_date' => '2024-07-20 14:00:00',
        //     'due_date' => '2024-08-20 14:00:00',
        //     'rental_status' => 'Rented',
        // ]);
    }
}
