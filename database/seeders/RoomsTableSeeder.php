<?php

namespace Database\Seeders;

use App\Models\Room;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Room::create([
            'number' => '101',
            'status' => 'available',
            'type' => 'single',
            'price' => 100.00,
            'description' => 'Standard single room',
        ]);

        Room::create([
            'number' => '201',
            'status' => 'available',
            'type' => 'double',
            'price' => 150.00,
            'description' => 'Deluxe double room',
        ]);

        Room::create([
            'number' => '301',
            'status' => 'available',
            'type' => 'suite',
            'price' => 250.00,
            'description' => 'Luxury suite',
        ]);

    }
}
