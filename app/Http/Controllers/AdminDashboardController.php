<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\House;
use App\Models\User;
use App\Models\Payment;

class AdminDashboardController extends Controller
{
    public function index() {
        $totalHouse = House::where('is_deleted', 0)
            ->count();

        $totalUser = User::join('user_roles', 'user_roles.user_role_id', '=', 'users.user_role_id')
            ->where('role', 'Admin')
            ->where('is_delete', 0)
            ->count();

        return view('dashboard.admin_dashboard', compact('totalHouse', 'totalUser'));
    }
}
