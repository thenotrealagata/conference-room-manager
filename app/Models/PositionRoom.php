<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PositionRoom extends Model
{
    /** @use HasFactory<\Database\Factories\PositionRoomFactory> */
    use HasFactory, Notifiable;
}
