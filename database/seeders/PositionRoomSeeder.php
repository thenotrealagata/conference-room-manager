<?php

namespace Database\Seeders;

use App\Models\Position;
use App\Models\PositionRoom;
use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = Position::all();
        $rooms = Room::all();

        foreach($positions as $position) {
            foreach($rooms as $room) {
                if (fake()->boolean()) {
                    PositionRoom::factory()->create([
                        'position_id' => $position->id,
                        'room_id' => $room->id
                    ]);
                }
            }
        }
    }
}
