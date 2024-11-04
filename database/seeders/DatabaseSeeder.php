<?php

namespace Database\Seeders;

use App\Models\Position;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PositionSeeder::class,
            RoomSeeder::class,
        ]);

        $positions = Position::all();
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'test@example.com',
            'admin' => true,
            'position_id' => $positions->random()->id
        ]);

        foreach($positions as $position) {
            $n = random_int(2, 4);
            User::factory($n)->create(['position_id' => $position->id]);
        }

        $this->call([
            PositionRoomSeeder::class,
            UserRoomEntrySeeder::class,
        ]);
    }
}
