<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\House;
use App\Models\User;
use App\Models\Payment;
use App\Models\ClientHouse;

class DashboardController extends Controller
{
    public function indexAdmin() {
        $totalHouse = House::where('is_deleted', false)
            ->count();

        $totalUser = User::join('user_roles', 'user_roles.user_role_id', '=', 'users.user_role_id')
            ->where('role', 'Client')
            ->where('is_delete', false)
            ->count();

        return view('dashboard.admin', compact('totalHouse', 'totalUser'));
    }

    public function indexClient() {
        $userId = auth()->user()->user_id;

        $houses = User::join('genders', 'genders.gender_id', '=', 'users.gender_id')
            ->join('user_roles', 'user_roles.user_role_id', '=', 'users.user_role_id')
            ->join('client_houses', 'client_houses.user_id', '=', 'users.user_id')
            ->join('houses', 'houses.house_id', '=', 'client_houses.house_id')
            ->join('categories', 'categories.category_id', '=', 'houses.category_id')
            ->select(
                'client_houses.client_house_id',
                'houses.house_no',
                'categories.category',
                DB::raw('FORMAT(houses.price, 2) as price')
            )
            ->where('users.user_id', $userId)
            ->where('client_houses.is_deleted', false)
            ->orderBy('categories.category', 'asc');

        // $payments = Payment::join('client_houses', 'client_houses.client_house_id', '=', 'payments.client_house_id')
        //     ->join('users', 'users.user_id', '=', 'client_houses.user_id')
        //     ->join('houses', 'houses.house_id', '=', 'client_houses.house_id')
        //     ->join('categories', 'categories.category_id', '=', 'houses.category_id')
        //     ->join('payment_methods', 'payment_methods.payment_method_id', '=', 'payments.payment_method_id')
        //     ->join('downpayments', 'downpayments.downpayment_id', '=', 'payments.downpayment_id')
        //     ->select(
        //         'client_houses.client_house_id',
        //         'houses.house_no',
        //         'categories.category',
        //         DB::raw('FORMAT(houses.price, 2) as price'),
        //         DB::raw('FORMAT(downpayments.downpayment, 2) as downpayment')
        //     )
        //     ->where('client_houses.user_id', $userId)
        //     ->where('client_houses.is_deleted', false)
        //     ->orderBy('price', 'desc');

        $houses = $houses->simplePaginate(8);

        return view('dashboard.client', compact('houses'));
    }

    public function viewMonthlyPayment($id) {
        $house = ClientHouse::join('houses', 'houses.house_id', '=', 'client_houses.house_id')
            ->join('payments', 'payments.client_house_id', '=', 'client_houses.client_house_id')
            ->find($id);

        $monthlyPayments = Payment::join('client_houses', 'client_houses.client_house_id', '=', 'payments.client_house_id')
            ->join('houses', 'houses.house_id', '=', 'client_houses.house_id')
            ->select('payments.invoices', DB::raw('FORMAT(payments.monthly_paid, 2) as monthly_paid'), 'payments.created_at')
            ->where('payments.client_house_id', $id)
            ->get();

        $downpayment = Payment::join('client_houses', 'client_houses.client_house_id', '=', 'payments.client_house_id')
            ->join('houses', 'houses.house_id', '=', 'client_houses.house_id')
            ->join('downpayments', 'downpayments.downpayment_id', '=', 'payments.downpayment_id')
            ->select('downpayments.downpayment as downpayment_value', DB::raw('FORMAT(price, 2) as price'),
                DB::raw('FORMAT(downpayment, 2) as downpayment'))
            ->where('payments.client_house_id', $id)
            ->get();

        $totalMonthlyPaidMade = Payment::join('client_houses', 'client_houses.client_house_id', '=', 'payments.client_house_id')
            ->join('houses', 'houses.house_id', '=', 'client_houses.house_id')
            ->join('downpayments', 'downpayments.downpayment_id', '=', 'payments.downpayment_id')
            ->where('payments.client_house_id', $id)
            ->sum('monthly_paid');

        $downpaymentValue = doubleval($downpayment->first()->downpayment_value);
        $totalMonthlyPaidMadeValue = doubleval($totalMonthlyPaidMade);

        // dd($totalMonthlyPaidMade);
        $totalPaymentMade = $downpaymentValue + $totalMonthlyPaidMadeValue;
        $totalPaymentMade = number_format($totalPaymentMade, 2, '.', ',');
        
        return view('monthly_payment.index', compact('house', 'monthlyPayments', 'downpayment', 'totalPaymentMade'));
    }
}
