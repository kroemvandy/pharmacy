<?php

namespace App\Http\Controllers;

use App\Models\MCart;
use App\Models\MCategory;
use App\Models\MMedicine;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicineModel = MMedicine::all(); 
        $category = MCategory::all(); 
        return view('backend.cart.index', compact('medicineModel', var_names: 'category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $medicine = MMedicine::select('id', 'MedicineName', 'Image')->get();
        return view('backend.cart.create', compact('medicine'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'MedicineId' => 'required',
            'Quantity'=> 'required|numeric'
        ]);

        MCart::create($data);
        return redirect()->route('get.cart')->with('success', 'Cart created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
