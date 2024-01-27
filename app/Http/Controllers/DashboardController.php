<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\House;
use App\Models\User;
use App\Models\Payment;

class DashboardController extends Controller
{
    public function indexAdmin() {
        $totalHouse = House::where('is_deleted', 0)
            ->count();

        $totalUser = User::join('user_roles', 'user_roles.user_role_id', '=', 'users.user_role_id')
            ->where('role', 'Admin')
            ->where('is_delete', 0)
            ->count();

        return view('dashboard.admin', compact('totalHouse', 'totalUser'));
    }

    public function indexClient() {
        $payments = Payment::join('client_houses', 'client_houses.client_house_id', '=', 'payments.client_house_id')
            ->join('users', 'users.user_id', '=', 'client_houses.user_id')
            ->join('houses', 'houses.house_id', '=', 'client_houses.house_id')
            ->join('categories', 'categories.category_id', '=', 'houses.category_id')
            ->join('payment_methods', 'payment_methods.payment_method_id', '=', 'payments.payment_method_id')
            ->join('downpayments', 'downpayments.downpayment_id', '=', 'payments.downpayment_id')
            ->select('houses.house_no', 'categories.category', DB::raw('FORMAT(houses.price, 2) as price'),
                DB::raw('FORMAT(downpayments.downpayment, 2) as downpayment'),
                DB::raw('FORMAT(payments.monthly_paid, 2) as monthly_paid'), 'payments.created_at')
            ->where('users.user_id', auth()->user()->user_id)
            ->get();

        // $totalPaymentMade = Payment::join('client_houses', 'client_houses.client_house_id', '=', 'payments.client_house_id')
        //     ->join('users', 'users.user_id', '=', 'client_houses.user_id')
        //     ->join('houses', 'houses.house_id', '=', 'client_houses.house_id')
        //     ->join('categories', 'categories.category_id', '=', 'houses.category_id')
        //     ->join('payment_methods', 'payment_methods.payment_method_id', '=', 'payments.payment_method_id')
        //     ->join('downpayments', 'downpayments.downpayment_id', '=', 'payments.downpayment_id')
        //     ->where('users.user_id', auth()->user()->user_id)
        //     ->sum('monthly_paid');

        return view('dashboard.client', compact('payments'));
    }
}