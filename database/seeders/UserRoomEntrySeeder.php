<?php

namespace Database\Seeders;

use App\Models\Position;
use App\Models\PositionRoom;
use App\Models\Room;
use App\Models\User;
use App\Models\UserRoomEntry;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoomEntrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = Room::all();
        $positions = Position::all();
        $users = User::all();
        $permissions = PositionRoom::all();
        foreach($rooms as $room) {
            foreach($positions as $position) {
                $user = $users->where('position_id', '=', $position->id)->random(1)->first();
                if ($user) {
                    UserRoomEntry::factory()->create([
                        'room_id' => $room->id,
                        'user_id' => $user->id,
                        'successful' => $permissions->has([
                            'room_id' => $room->id,
                            'position_id' => $position->id
                        ])
                    ]);
                }
            }
        }
    }
}
