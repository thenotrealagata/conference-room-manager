<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class WorkerController extends Controller
{
    public function index() {
        return view('worker.list', [
            "workers" => User::all(),
        ]);
    }

    public function edit(Request $request, string $id): View {
        if(!Auth::user()->admin) {
            abort(401);
        }
        $worker = User::findOrFail($id);
        return view('worker.edit', [
            "worker" => $worker,
            "positions" => Position::all('id', 'name')
        ]);
    }

    public function create(Request $request): View {
        if(!Auth::user()->admin) {
            abort(401);
        }
        return view('worker.edit', [
            "positions" => Position::all('id', 'name')
        ]);
    }

    public function store(Request $request): RedirectResponse {
        if(!Auth::user()->admin) {
            abort(401);
        }

        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|unique:App\Models\User,email|string|email',
            'phone_number' => 'required|unique:App\Models\User,phone_number|string',
            'card_number' => 'required|unique:App\Models\User,card_number|string|size:16|regex:/[a-zA-Z0-9]+/',
            'password' => 'required|string',
            'position_id' => 'required|integer|exists:App\Models\Position,id'
        ]);
        $worker = User::create($validated);

        return Redirect::route('workers');
    }

    public function destroy (Request $request, string $id): RedirectResponse {
        if(!Auth::user()->admin) {
            abort(401);
        }
        $user = User::findOrFail($id);

        $user->delete();

        return Redirect::route('workers');
    }

    public function update(Request $request, string $id) {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => ['required', 'string', Rule::unique('users')->ignore($id)],
            'phone_number' => ['required', 'string', Rule::unique('users')->ignore($id)],
            'card_number' => ['required', 'string', 'size:16', 'regex:/[a-zA-Z0-9]+/', Rule::unique('users')->ignore($id)],
            'position_id' => 'required|integer|exists:App\Models\Position,id'
        ]);
        $worker = User::findOrFail($id);
        $worker->update($validated);

        return redirect()->route('workers');
    }

    public function entries(Request $request, string $id): View {
        if(!Auth::user()->admin) {
            abort(401);
        }
        $worker = User::findOrFail($id);
        $entries = $worker->userRoomEntries()->orderBy('created_at')->paginate(5);

        return view('worker.entries', [
            "worker" => $worker,
            "entries" => $entries
        ]);
    }
}
