<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\House;

class HouseController extends Controller
{
    public function index() {
        $houses = House::join('categories', 'categories.category_id', '=', 'houses.category_id')
            ->orderBy('price', 'desc');

        if(request()->has('search')) {
            $searchTerm = request()->get('search');

            if($searchTerm) {
                $houses = $houses->where(function($query) use ($searchTerm) {
                    $query->where('house_no', 'like', "%$searchTerm%")
                        ->orWhere('category', 'like', "%$searchTerm%")
                        ->orWhere('description', 'like', "%$searchTerm%")
                        ->orWhere('price', 'like', "%$searchTerm%")
                        ->orderBy('price', 'desc');
                        
                        session(['searchTerm' => $searchTerm]);
                });
            } else {
                session()->forget('searchTerm');
            }
        }

        $houses = $houses->simplePaginate(2);

        return view('house.index', compact('houses'));
    }
}
