<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\User;
use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\UpdatePositionRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\RedirectResponse;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('position.list', [
            "positions" => Position::all(),
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
        return view('position.edit');
    }

    public function workers(string $id) {
        $position = Position::findOrFail($id);
        return view('position.workers', [
            "position" => $position
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UpdatePositionRequest $request): RedirectResponse
    {
        Position::create($request->validated());
        return Redirect::route('positions');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        if(!Auth::user()->admin) {
            abort(401);
        }
        $position = Position::findOrFail($id);

        return view('position.edit', [
            "position" => $position
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePositionRequest $request, Position $position)
    {
        $position->update($request->validated());
        return Redirect::route('positions');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $user = Position::findOrFail($id);
        if(!Auth::user()->admin) {
            abort(401);
        }

        $user->delete();

        return Redirect::route('positions');
    }
}
