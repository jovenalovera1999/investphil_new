<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index() {
        $clients = User::join('genders', 'genders.gender_id', '=', 'users.gender_id')
            ->where('user_role_id', 3)
            ->orderBy('first_name', 'asc')->simplePaginate(8);
        return view('client.index', ['clients' => $clients]);
    }
}
