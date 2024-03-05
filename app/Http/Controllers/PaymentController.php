<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ClientHouse;
use App\Models\Downpayment;
use App\Models\Payment;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index() {
        $clients = User::join('genders', 'genders.gender_id', '=', 'users.gender_id')
            ->join('user_roles', 'user_roles.user_role_id', '=', 'users.user_role_id')
            ->join('client_houses', 'client_houses.user_id', '=', 'users.user_id')
            ->join('houses', 'houses.house_id', '=', 'client_houses.house_id')
            ->join('categories', 'categories.category_id', '=', 'houses.category_id')
            ->select(
                'client_houses.client_house_id',
                'users.first_name',
                'users.middle_name',
                'users.last_name',
                'houses.house_no',
                'categories.category',
                'client_houses.is_full_paid'
            )
            ->where('user_roles.role', 'Client')
            ->where('client_houses.is_deleted', false)
            ->orderBy('users.first_name', 'asc');

            if(request()->has('search')) {
                $searchTerm = request()->get('search');

                if($searchTerm) {
                    $clients = $clients->where(function($query) use ($searchTerm) {
                        $query->where('users.first_name', 'like', "%$searchTerm%")
                            ->orWhere('users.middle_name', 'like', "%$searchTerm%")
                            ->orWhere('users.last_name', 'like', "%$searchTerm%")
                            ->orWhere('users.email', 'like', "%$searchTerm%")
                            ->orWhere('users.contact_number', 'like', "%$searchTerm%")
                            ->orWhere('houses.house_no', 'like', "%$searchTerm%")
                            ->orWhere('categories.category', 'like', "%$searchTerm%")
                            ->where('client_houses.is_deleted', false)
                            ->orderBy('users.first_name', 'asc');
                    });
                }
            }

        $clients = $clients->paginate(4);

        return view('payment.index', compact('clients'));
    }

    public function show($id) {
        $client = ClientHouse::join('users', 'users.user_id', '=', 'client_houses.user_id')
            ->join('houses', 'houses.house_id', '=', 'client_houses.house_id')
            ->join('genders', 'genders.gender_id', '=', 'users.gender_id')
            ->find($id);

        $monthlyPayments = Payment::join('client_houses', 'client_houses.client_house_id', '=', 'payments.client_house_id')
            ->join('houses', 'houses.house_id', '=', 'client_houses.house_id')
            ->select(
                'payments.invoices',
                DB::raw('FORMAT(payments.monthly_paid, 2) as monthly_paid'),
                'payments.created_at'
                )
            ->where('payments.client_house_id', $id)
            ->get();

        $downpayment = Payment::join('client_houses', 'client_houses.client_house_id', '=', 'payments.client_house_id')
            ->join('houses', 'houses.house_id', '=', 'client_houses.house_id')
            ->join('downpayments', 'downpayments.downpayment_id', '=', 'payments.downpayment_id')
            ->select(
                'downpayments.downpayment as downpayment_value',
                DB::raw('FORMAT(price, 2) as price'),
                DB::raw('FORMAT(downpayment, 2) as downpayment')
            )
            ->where('payments.client_house_id', $id)
            ->get();

        $totalMonthlyPaidMade = Payment::join('client_houses', 'client_houses.client_house_id', '=', 'payments.client_house_id')
            ->join('houses', 'houses.house_id', '=', 'client_houses.house_id')
            ->join('downpayments', 'downpayments.downpayment_id', '=', 'payments.downpayment_id')
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

        return view('payment.view', compact('client', 'monthlyPayments', 'downpayment', 'totalPaymentMade'));
    }

    public function create($id) {
        $paymentMethods = PaymentMethod::all();

        $clientHouse = ClientHouse::join('users', 'users.user_id', '=', 'client_houses.user_id')
            ->join('houses', 'houses.house_id', '=', 'client_houses.house_id')
            ->join('categories', 'categories.category_id', '=', 'houses.category_id')
            ->find($id);

        $downpayment = Downpayment::join('payments', 'payments.downpayment_id', '=', 'downpayments.downpayment_id')
            ->select('downpayments.downpayment')
            ->where('payments.client_house_id', $clientHouse->client_house_id)
            ->first();

        $clientHouse->price = number_format(doubleval($clientHouse->price), 2, '.', ',');

        $downpaymentAmount = $downpayment->downpayment ?? 0;
        $downpayment = number_format(doubleval($downpaymentAmount), 2, '.', ',');

        return view('payment.create', compact('paymentMethods', 'clientHouse', 'downpayment'));
    }

    public function store(Request $request, $id) {
        $validated = $request->validate([
            'already_have_downpayment' => ['nullable'],
            'invoices' => ['required', 'numeric'],
            'payment_method_id' => ['required', 'exists:payment_methods,payment_method_id'],
            'amount_to_pay' => ['required', 'numeric']
        ], [
            'payment_method_id.required' => 'The payment method field is required.',
            'payment_method_id.exists' => 'The payment method is invalid.'
        ]);

        if($request->is_downpayment) {
            $downpayment = Downpayment::where('downpayment', $validated['amount_to_pay'])->first();

            if(!empty($downpayment)) {
                Payment::create([
                    'payment_method_id' => $validated['payment_method_id'],
                    'invoices' => $validated['invoices'],
                    'client_house_id' => $id,
                    'downpayment_id' => $downpayment->downpayment_id,
                    'monthly_paid' => 0
                ]);
            } else {
                $downpayment = Downpayment::create([
                    'downpayment' => $validated['amount_to_pay']
                ]);

                Payment::create([
                    'payment_method_id' => $validated['payment_method_id'],
                    'invoices' => $validated['invoices'],
                    'client_house_id' => $id,
                    'downpayment_id' => $downpayment->downpayment_id,
                    'monthly_paid' => 0
                ]);
            }

            return back()->with('message_success', 'Downpayment successfully saved!');
        } else {
            $stringWithoutComma = str_replace(',', '', $validated['already_have_downpayment']);
            $stringWithDot = str_replace('.', '', $stringWithoutComma);
            $validated['already_have_downpayment'] = substr_replace($stringWithDot, '.', -2, 0);
            
            $downpayment = Downpayment::where('downpayment', doubleval($validated['already_have_downpayment']))->first();

            if (!empty($downpayment)) {
                Payment::create([
                    'payment_method_id' => $validated['payment_method_id'],
                    'invoices' => $validated['invoices'],
                    'client_house_id' => $id,
                    'downpayment_id' => $downpayment->downpayment_id,
                    'monthly_paid' => $validated['amount_to_pay']
                ]);

                $housePrice = ClientHouse::join('houses', 'houses.house_id', '=', 'client_houses.house_id')
                    ->where('client_houses.client_house_id', $id)
                    ->value('houses.price');

                $downpayment = ClientHouse::join('payments', 'payments.client_house_id', '=', 'client_houses.client_house_id')
                    ->join('downpayments', 'downpayments.downpayment_id', '=', 'payments.downpayment_id')
                    ->where('client_houses.client_house_id', $id)
                    ->value('downpayments.downpayment');

                $monthlyPaid = Payment::where('client_house_id', $id)
                    ->sum('monthly_paid');

                $totalPaymentMade = 0;

                if (!empty($downpayment)) {
                    $totalPaymentMade = doubleval($downpayment) + doubleval($monthlyPaid);
                } else {
                    $totalPaymentMade = doubleval($monthlyPaid);
                }

                if ($totalPaymentMade >= doubleval($housePrice)) {
                    $clientHouse = ClientHouse::find($id);
                    $clientHouse->update([
                        'is_full_paid' => true
                    ]);
                }
            } else {
                $downpayment = Downpayment::create([
                    'downpayment' => doubleval($validated['already_have_downpayment'])
                ]);

                Payment::create([
                    'payment_method_id' => $validated['payment_method_id'],
                    'invoices' => $validated['invoices'],
                    'client_house_id' => $id,
                    'downpayment_id' => $downpayment->downpayment_id,
                    'monthly_paid' => $validated['amount_to_pay']
                ]);

                $housePrice = ClientHouse::join('houses', 'houses.house_id', '=', 'client_houses.house_id')
                    ->where('client_houses.client_house_id', $id)
                    ->value('houses.price');

                $downpayment = ClientHouse::join('payments', 'payments.client_house_id', '=', 'client_houses.client_house_id')
                    ->join('downpayments', 'downpayments.downpayment_id', '=', 'payments.downpayment_id')
                    ->where('client_houses.client_house_id', $id)
                    ->value('downpayments.downpayment');

                $monthlyPaid = Payment::where('client_house_id', $id)
                    ->sum('monthly_paid');

                $totalPaymentMade = 0;

                if (!empty($downpayment)) {
                    $totalPaymentMade = doubleval($downpayment) + doubleval($monthlyPaid);
                } else {
                    $totalPaymentMade = doubleval($monthlyPaid);
                }

                if ($totalPaymentMade >= doubleval($housePrice)) {
                    $clientHouse = ClientHouse::find($id);
                    $clientHouse->update([
                        'is_full_paid' => true
                    ]);
                }
            }

            return back()->with('message_success', 'Payment successfully saved!');
        }
    }
}
