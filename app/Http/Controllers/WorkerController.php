<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class WorkerController extends Controller
{
    public function index() {
        return view('workers', [
            "workers" => User::all(),
        ]);
    }

    public function edit(Request $request, string $id): View {
        $worker = User::findOrFail($id);
        if(!Auth::user()->admin) {
            abort(401);
        }
        return view('worker.edit', [
            "worker" => $worker
        ]);
    }

    public function destroy (Request $request, string $id): RedirectResponse {
        $user = User::findOrFail($id);
        if(!Auth::user()->admin) {
            abort(401);
        }

        $user->delete();

        return Redirect::route('workers');
    }

    public function update(Request $request, string $id) {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'phone_number' => 'required|string',
            'card_number' => 'required|string|size:16|regex:/[a-zA-Z0-9]+/'
        ]);
        $worker = User::findOrFail($id);
        $worker->update($validated);

        return redirect()->route('workers');
    }
}
