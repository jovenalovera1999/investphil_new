<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\House;
use App\Models\Category;

class HouseController extends Controller
{
    public function index() {
        $categories = Category::all();

        $houses = House::join('categories', 'categories.category_id', '=', 'houses.category_id')
            ->select('houses.*', 'categories.category', DB::raw('FORMAT(houses.price, 2) as price'))
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

        return view('house.index', compact('houses', 'categories'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'house_no' => ['required', 'numeric'],
            'category_id' => ['required', 'exists:categories,category_id'],
            'description' => ['required'],
            'price' => ['required', 'numeric']
        ], [
            'category_id.required' => 'The category field is required.',
            'category_id.exists' => 'The category is invalid.'
        ]);

        House::create($validated);

        return back()->with('message_success', 'House successfully added!');
    }

    public function edit($id) {
        $house = House::join('categories', 'categories.category_id', '=', 'houses.category_id')
            ->find($id);
        
        return view('house.edit', compact('house'));
    }
}
