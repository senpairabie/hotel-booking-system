<?php

namespace Database\Seeders;

use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reservation::create([
            'user_id' => User::where('email', 'john@example.com')->first()->id,
            'room_id' => Room::where('number', '101')->first()->id,
            'status' => 'pending',
            'check_in' => now()->addDays(1),
            'check_out' => now()->addDays(3),
            'total_price' => 200.00,
        ]);

        Reservation::create([
            'user_id' => User::where('email', 'jane@example.com')->first()->id,
            'room_id' => Room::where('number', '201')->first()->id,
            'status' => 'approved',
            'check_in' => now()->addDays(2),
            'check_out' => now()->addDays(5),
            'total_price' => 450.00,
        ]);


        Reservation::create([
            'user_id' => User::where('email', 'john@example.com')->first()->id,
            'room_id' => Room::where('number', '301')->first()->id,
            'status' => 'pending',
            'check_in' => now()->addDays(4),
            'check_out' => now()->addDays(7),
            'total_price' => 750.00,
        ]);



    }
}
