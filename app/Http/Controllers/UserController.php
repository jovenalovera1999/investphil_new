<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Gender;
use App\Models\House;
use App\Models\ClientHouse;
use App\Models\Downpayment;
use App\Models\Payment;
use App\Models\PaymentMethod;

class UserController extends Controller
{
    public function indexClient() {
        $clients = User::join('genders', 'genders.gender_id', '=', 'users.gender_id')
            ->join('user_roles', 'user_roles.user_role_id', '=', 'users.user_role_id')
            ->where('role', 'Client')
            ->where('is_delete', false)
            ->orderBy('first_name', 'asc');

        if(request()->has('search')) {
            $searchTerm = request()->get('search');

            if($searchTerm) {
                $clients = $clients->where(function($query) use ($searchTerm) {
                    $query->where('first_name', 'like', "%$searchTerm%")
                        ->orWhere('middle_name', 'like', "%$searchTerm%")
                        ->orWhere('last_name', 'like', "%$searchTerm%")
                        ->where('role', 'Client')
                        ->where('is_delete', false)
                        ->orderBy('first_name', 'asc');

                        session(['searchTermClient' => $searchTerm]);
                });
            } else {
                session()->forget('searchTermClient');
            }
        }

        $clients = $clients->simplePaginate(5);

        return view('client.index', compact('clients'));
    }

    public function createClient() {
        $genders = Gender::all();

        $paymentMethods = PaymentMethod::all();

        $houses = House::join('categories', 'categories.category_id', '=', 'houses.category_id')
            ->orderBy('categories.category', 'asc')
            ->orderBy('houses.house_no', 'asc')
            ->get();

        return view('client.create', compact('genders', 'paymentMethods', 'houses'));
    }

    public function storeClient(Request $request) {
        $validated = $request->validate([
            'first_name' => ['required'],
            'middle_name' => ['nullable'],
            'last_name' => ['required'],
            'age' => ['required', 'numeric'],
            'gender_id' => ['required', 'exists:genders,gender_id'],
            'email' => ['required', 'email'],
            'contact_number' => ['required', 'numeric'],
            'username' => ['required', Rule::unique('users', 'username')],
            'password' => ['required', 'confirmed'],
            'password_confirmation' => ['required']
        ], [
            'gender_id.required' => 'The gender field is required.',
            'gender_id.exists' => 'The gender is invalid.'
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $validated['user_role_id'] = 3;

        $user = User::create($validated);
        $userId = $user->user_id;

        $houses = $request->input('houses') ?? [];

        if(!empty($houses)) {
            foreach($houses as $house) {
                ClientHouse::create([
                    'user_id' => $userId,
                    'house_id' => $house['house_id']
                ]);
            }
        }

        return redirect('/clients')->with('message_success', 'Client successfully added!');
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
            'gender_id' => ['required', 'exists:genders,gender_id'],
            'email' => ['required', 'email'],
            'contact_number' => ['required'],
            'username' => ['required', Rule::unique('users')->ignore($user)]
        ], [
            'gender_id.required' => 'The gender field is required.',
            'gender_id.exists' => 'The gender is invalid.'
        ]);

        $user->update($validated);

        return back()->with('message_success', 'Client successfully updated!');
    }

    public function destroyClient(User $user) {
        $user->update(['is_delete' => 1]);
        return back()->with('message_success', 'User successfully deleted.');
    }

    public function login() {
        return view('login.login');
    }

    public function processLogin(Request $request) {
        $validated = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        $user = User::join('genders', 'genders.gender_id', '=', 'users.gender_id')
            ->join('user_roles', 'user_roles.user_role_id', '=', 'users.user_role_id')
            ->where('username', $validated['username'])
            ->first();

        if($user && auth()->attempt($validated)) {
            auth()->login($user);

            session(['gender' => $user->gender, 'role' => $user->role]);
            $request->session()->regenerate();

            $firstName = auth()->user()->first_name;
            $middleName = auth()->user()->middle_name;
            $lastName = auth()->user()->last_name;

            $fullName = '';

            if(empty($middleName)) {
                $fullName = $firstName . ' ' . $lastName;
            } else {
                $fullName = $firstName . ' ' . $middleName[0] . '. ' . $lastName;
            }

            if(session('role') == 'Admin') {
                return redirect('/dashboard/admin')->with('message_success_login', 'Logged in as ' . $fullName);
            } else {
                return redirect('/dashboard/client')->with('message_success_login', 'Logged in as ' . $fullName);
            }
        } else {
            return back()->with('message_failed', 'Incorrect username or password.');
        }
    }

    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message_success', 'Your account has been successfully logged out.');
    }
}
