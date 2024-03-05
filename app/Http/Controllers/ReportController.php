<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\ClientHouse;
use App\Models\Payment;

class ReportController extends Controller
{
    public function indexPaymentReport() {
        // Select all clients along with their houses and payments of each house
        $clients = User::join(
                'user_roles',
                'user_roles.user_role_id', '=', 'users.user_role_id'
            )
            ->join(
                'client_houses',
                'client_houses.user_id', '=', 'users.user_id'
            )
            ->join(
                'houses',
                'houses.house_id', '=', 'client_houses.house_id'
            )
            ->join(
                'categories',
                'categories.category_id', '=', 'houses.category_id'
            )
            ->orderBy('users.last_name', 'asc')
            ->where('user_roles.role', 'Client')
            ->where('users.is_delete', false);

        if (request()->has('search')) {
            $searchTerm = request()->get('search');

            if ($searchTerm) {
                $clients = $clients->where(function ($query) use ($searchTerm) {
                    $query->where('users.first_name', 'like', "%$searchTerm%")
                        ->orWhere('users.middle_name', 'like', "%$searchTerm%")
                        ->orWhere('users.last_name', 'like', "%$searchTerm%")
                        ->where('user_roles.role', 'Client')
                        ->where('users.is_delete', false)
                        ->orderBy('users.first_name', 'asc');
                });
            }
        }

        $clients = $clients->paginate(25);

        return view('report.index', compact('clients'));
    }

    public function showPaymentReport($id) {
        $client = ClientHouse::join(
                'users',
                'users.user_id', '=', 'client_houses.user_id'
            )
            ->join(
                'houses',
                'houses.house_id', '=', 'client_houses.house_id'
            )
            ->join(
                'genders',
                'genders.gender_id', '=', 'users.gender_id'
            )
            ->find($id);
        
            $monthlyPayments = Payment::join(
                'client_houses',
                'client_houses.client_house_id', '=', 'payments.client_house_id'
            )
            ->join(
                'houses',
                'houses.house_id', '=', 'client_houses.house_id'
            )
            ->select(
                'payments.invoices',
                DB::raw('FORMAT(payments.monthly_paid, 2) as monthly_paid'),
                'payments.created_at'
            )
            ->where('payments.client_house_id', $id)
            ->get();
    
        $downpayment = Payment::join(
                'client_houses',
                'client_houses.client_house_id', '=', 'payments.client_house_id'
            )
            ->join(
                'houses',
                'houses.house_id', '=', 'client_houses.house_id'
            )
            ->join(
                'downpayments',
                'downpayments.downpayment_id', '=', 'payments.downpayment_id'
            )
            ->select(
                'downpayments.downpayment as downpayment_value',
                DB::raw('FORMAT(price, 2) as price'),
                DB::raw('FORMAT(downpayment, 2) as downpayment')
            )
            ->where('payments.client_house_id', $id)
            ->get();
    
        $totalMonthlyPaidMade = Payment::join(
                'client_houses', 'client_houses.client_house_id', '=', 'payments.client_house_id'
            )
            ->join(
                'houses',
                'houses.house_id', '=', 'client_houses.house_id'
            )
            ->join(
                'downpayments',
                'downpayments.downpayment_id', '=', 'payments.downpayment_id'
            )
            ->where('payments.client_house_id', $id)
            ->sum('monthly_paid');
    
        if ($client->price) {
            $housePrice = doubleval($client->price);
            $client->price = number_format($housePrice, 2, '.', ',');
        }
    
        $downpaymentValue = '';
    
        if (empty($downpayment->first()->downpayment_value)) {
            $downpaymentValue = 0;
        } else {
            $downpaymentValue = doubleval($downpayment->first()->downpayment_value);
        }
    
        $totalMonthlyPaidMadeValue = '';
    
        if (empty($totalMonthlyPaidMade)) {
            $totalMonthlyPaidMadeValue = 0;
        } else {
            $totalMonthlyPaidMadeValue = doubleval($totalMonthlyPaidMade);
        }
    
        $totalPaymentMade = $downpaymentValue + $totalMonthlyPaidMadeValue;
        $totalPaymentMade = number_format($totalPaymentMade, 2, '.', ',');
    
        return view('report.show', compact('client', 'monthlyPayments', 'downpayment', 'totalPaymentMade'));
    }
}
