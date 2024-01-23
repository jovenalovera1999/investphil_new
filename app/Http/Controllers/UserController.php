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
            ->orderBy('first_name', 'asc')->simplePaginate(12);
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
            'password' => ['required', 'confirmed'],
            'password_confirmation' => ['required']
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $validated['user_role_id'] = 3;

        // dd($validated);
        User::create($validated);

        return redirect('/clients')->with('message_success', 'Client successfully created!');
    }

    public function login() {
        return view('login.login');
    }

    public function processLogin(Request $request) {
        $validated = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        // if(auth()->attempt($validated)) {
        //     $request->session()->regenerate();
        //     return redirect('/dashboard');
        // }

        $user = User::where('username', $validated['username'])->first();
        
        if($user && $user->username == $validated['username']) {
            if(auth()->attempt($validated)) {
                auth()->login($user);
                $request->session()->regenerate();
                return redirect('/dashboard');
            }
        }
    }

    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message_success', 'Logout successfully');
    }
}
