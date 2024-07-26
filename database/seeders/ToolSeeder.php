<?php

namespace Database\Seeders;

use App\Models\Tool;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ToolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tool::create([
        //     'name' => 'Screwdriver',
        //     'type' => 'Hand Tool',
        //     'serial_number' => '123456',
        //     'purchase_date' => '2021-07-16',
        // ]);

        Tool::factory(4)->create();
    }
}
