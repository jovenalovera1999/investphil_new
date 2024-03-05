<?php

namespace App\Http\Controllers;

use App\Models\ClientHouse;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrintController extends Controller
{
    public function printPaymentReport($id) {
        $client = ClientHouse::join(
                'users',
                'users.user_id',
                '=',
                'client_houses.user_id'
            )
            ->join(
                'houses',
                'houses.house_id',
                '=',
                'client_houses.house_id'
            )
            ->join(
                'categories',
                'categories.category_id', '=', 'houses.category_id'    
            )
            ->join(
                'genders',
                'genders.gender_id',
                '=',
                'users.gender_id'
            )
            ->find($id);

        $monthlyPayments = Payment::join(
                'client_houses',
                'client_houses.client_house_id',
                '=',
                'payments.client_house_id'
            )
            ->join(
                'houses',
                'houses.house_id',
                '=',
                'client_houses.house_id'
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
                'client_houses.client_house_id',
                '=',
                'payments.client_house_id'
            )
            ->join(
                'houses',
                'houses.house_id',
                '=',
                'client_houses.house_id'
            )
            ->join(
                'downpayments',
                'downpayments.downpayment_id',
                '=',
                'payments.downpayment_id'
            )
            ->select(
                'downpayments.downpayment as downpayment_value',
                DB::raw('FORMAT(price, 2) as price'),
                DB::raw('FORMAT(downpayment, 2) as downpayment')
            )
            ->where('payments.client_house_id', $id)
            ->get();

        $totalMonthlyPaidMade = Payment::join(
                'client_houses',
                'client_houses.client_house_id',
                '=',
                'payments.client_house_id'
            )
            ->join(
                'houses',
                'houses.house_id',
                '=',
                'client_houses.house_id'
            )
            ->join(
                'downpayments',
                'downpayments.downpayment_id',
                '=',
                'payments.downpayment_id'
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

        $currentDate = Carbon::now();
        $currentDate = $currentDate->format('m/d/Y');

        return view('print.payment', compact('client', 'monthlyPayments', 'downpayment', 'totalPaymentMade', 'currentDate'));
    }
}
