<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\House;
use App\Models\User;
use App\Models\Payment;

class AdminDashboardController extends Controller
{
    public function index() {
        $totalHouse = House::all()->count();
        $totalUser = User::where('user_role_id', 3)->count();

        return view('dashboard.admin_dashboard', ['totalHouse' => $totalHouse, 'totalUser' => $totalUser]);
    }
}
