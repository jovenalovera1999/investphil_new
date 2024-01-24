<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\House;

class HouseController extends Controller
{
    public function index() {
        $houses = House::join('categories', 'categories.category_id', '=', 'houses.category_id')
            ->orderBy('price', 'desc');

        return view('house.index', ['houses' => $houses->simplePaginate(2)]);
    }
}
