<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PaymentController extends Controller
{
    public function index() {
        $clients = User::join('genders', 'genders.gender_id', '=', 'users.gender_id')
            ->join('user_roles', 'user_roles.user_role_id', '=', 'users.user_role_id')
            ->join('client_houses', 'client_houses.user_id', '=', 'users.user_id')
            ->join('houses', 'houses.house_id', '=', 'client_houses.house_id')
            ->join('categories', 'categories.category_id', '=', 'houses.category_id')
            ->where('user_roles.role', 'Client')
            ->where('client_houses.is_deleted', 0)
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
                            ->where('client_houses.is_deleted', 0)
                            ->orderBy('users.first_name', 'asc');

                            session(['searchTermClientPayment' => $searchTerm]);
                    });
                } else {
                    session()->forget('searchTermClientPayment');
                }
            }

        $clients = $clients->simplePaginate(3);

        return view('payment.index', compact('clients'));
    }

    public function view($id) {
        $client = User::join('genders', 'genders.gender_id', '=', 'users.gender_id')
            ->find($id);

        return view('payment.view', compact('client'));
    }
}
