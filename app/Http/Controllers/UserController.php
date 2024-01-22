<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Gender;

class UserController extends Controller
{
    public function index() {
        $clients = User::join('genders', 'genders.gender_id', '=', 'users.gender_id')
            ->where('user_role_id', 3)
            ->orderBy('first_name', 'asc')->simplePaginate(8);
        return view('client.index', ['clients' => $clients]);
    }

    public function create() {
        $genders = Gender::all();
        return view('client.create', ['genders' => $genders]);
    }

    public function storeClient(Request $request) {
        $validated = $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'age' => ['required', 'numeric'],
            'gender_id' => ['required'],
            'email' => ['required', 'email'],
            'contact_number' => ['required', 'numeric'],
            'username' => ['required', Rule::unique('users', 'username')],
            'password' => ['required', 'same:confirm_password'],
            'confirm_password' => ['required', 'same:password']
        ]);

        $validated['password'] = bcrypt($validated['password']);

        dd($validated);
        // User::create($validated);

        // return redirect('/clients')->with('message_success', 'Client successfully created!');
    }
}
