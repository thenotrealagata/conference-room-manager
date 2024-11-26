<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Position;
use App\Models\User;
use App\Models\UserRoomEntry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('room.list', [
            "rooms" => Room::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!Auth::user()->admin) {
            abort(401);
        }
        return view('room.edit', [
            "positions" => Position::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomRequest $request)
    {
        Room::create($request->validated());
        return Redirect::route('rooms.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        if(!Auth::user()->admin) {
            abort(401);
        }
        return view('room.edit', [
            "room" => $room,
            "positions" => Position::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {
        $room->update($request->validated());
        $room->positions()->sync($request->input('position_id'));

        if($request->hasFile('file')) {
            $filename = $request->file('file')->storePublicly();
            $room->update([
                'filename' => $request->file('file')->getClientOriginalName(),
                'filename_hash' => $filename,
            ]);
        }

        return Redirect::route('rooms.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        if(!Auth::user()->admin) {
            abort(401);
        }
        $room->delete();
        return Redirect::route('rooms.index');
    }

    public function entries(Room $room) {
        if(!Auth::user()->admin) {
            abort(401);
        }
        return view('room.entries', [
            "room" => $room,
            "entries" => $room->userRoomEntries()->orderByDesc('created_at')->paginate(5)
        ]);
    }

    public function simulation() {
        return view('room.simulation', [
            'workers' => User::all()->whereNotNull('card_number'),
            'rooms' => Room::all()
        ]);
    }

    public function attemptEntry(Request $request) {
        $validated = $request->validate([
            'worker' => 'required|integer|exists:App\Models\User,id',
            'room' => 'required|integer|exists:App\Models\Room,id'
        ]);
    }
}
