<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Gender;

class UserController extends Controller
{
    public function indexClient() {
        $clients = User::join('genders', 'genders.gender_id', '=', 'users.gender_id')
            ->join('user_roles', 'user_roles.user_role_id', '=', 'users.user_role_id')
            ->where('role', 'Client')
            ->orderBy('first_name', 'asc');

        if(request()->has('search')) {
            $searchTerm = request()->get('search');

            if($searchTerm) {
                $clients = $clients->where(function($query) use ($searchTerm) {
                    $query->where('first_name', 'like', "%$searchTerm%")
                        ->orWhere('middle_name', 'like', "%$searchTerm%")
                        ->orWhere('last_name', 'like', "%$searchTerm%")
                        ->where('role', 'Client')
                        ->orderBy('first_name', 'asc');

                        session(['searchTerm' => $searchTerm]);
                });
            } else {
                session()->forget('searchTerm');
            }
        }

        $clients = $clients->simplePaginate(5);

        return view('client.index', compact('clients'));
    }

    public function createClient() {
        $genders = Gender::all();
        return view('client.create', compact('genders'));
    }

    public function storeClient(Request $request) {
        $validated = $request->validate([
            'first_name' => ['required'],
            'middle_name' => ['nullable'],
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

        User::create($validated);

        return redirect('/clients')->with('message_success', 'Client successfully created!');
    }

    public function showClient($id) {
        $client = User::join('genders', 'genders.gender_id', '=', 'users.gender_id')
            ->join('user_roles', 'user_roles.user_role_id', '=', 'users.user_role_id')
            ->find($id);

        return view('client.show', compact('client'));
    }

    public function editClient($id) {
        $genders = Gender::all();

        $client = User::join('genders', 'genders.gender_id', '=', 'users.gender_id')
            ->join('user_roles', 'user_roles.user_role_id', '=', 'users.user_role_id')
            ->find($id);

        return view('client.edit', compact('genders', 'client'));
    }

    public function updateClient(Request $request, User $user) {
        $validated = $request->validate([
            'first_name' => ['required'],
            'middle_name' => ['nullable'],
            'last_name' => ['required'],
            'age' => ['required', 'numeric'],
            'gender_id' => ['required'],
            'email' => ['required', 'email'],
            'contact_number' => ['required'],
            'username' => ['required', Rule::unique('users')->ignore($user)]
        ]);

        $user->update($validated);

        return back()->with('message_success', 'Client successfully updated!');
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

        $user = User::join('genders', 'genders.gender_id', '=', 'users.gender_id')
            ->join('user_roles', 'user_roles.user_role_id', '=', 'users.user_role_id')
            ->where('username', $validated['username'])->first();
        
        if($user && $user->username == $validated['username']) {
            if(auth()->attempt($validated)) {
                auth()->login($user);
                session(['gender' => $user->gender, 'role' => $user->role]);
                $request->session()->regenerate();

                if(session('role') == 'Admin') {
                    return redirect('/admin_dashboard');
                } else {
                    return redirect('/clients');
                }
            }
        }
    }

    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message_success', 'Your account has been successfully logged out!');
    }
}
