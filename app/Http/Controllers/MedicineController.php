<?php

namespace App\Http\Controllers;

use App\Models\MCategory;
use App\Models\MMedicine;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use Storage;
use File;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use Ramsey\Uuid\Type\Integer;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicine = MMedicine::latest()->get();
        return view('backend.medicine.index', compact('medicine'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = MCategory::pluck('CategoryName', 'id');
        return view('backend.medicine.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'MedicineName' => 'required',
                'MedicineDescription' => 'required',
                'Price' => 'required|numeric',
                'Qty' => 'required|integer',
                'CategoryId' => 'required|exists:tblCategories,id',
                'ExpDate' => 'required|date',
                'Image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
            ]);

            if ($request->hasFile('Image')) {
                $image_path = $request->file('Image')->store('public/images', 'public');
                $data['Image'] = $image_path;
            } else {
                return back()->with('error', 'Image upload failed!');
            }

            MMedicine::create($data);

            return redirect()->route('get-medicine')->with('success', 'Medicine has been created successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $medicine = MMedicine::findOrFail($id);
        return view('backend.medicine.view-detail', compact('medicine'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = MCategory::all();
        $medicine = MMedicine::findOrFail($id);
        return view('backend.medicine.edit', compact('medicine', 'categories', 'id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        try{
            $data = $request->validate([
                'MedicineName' => 'required',
                'MedicineDescription' => 'required',
                'Price' => 'required|numeric',
                'Qty' => 'required|integer',
                'CategoryId' => 'required|exists:tblCategories,id',
                'ExpDate' => 'required|date',
                'Image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
            ]);

            $medicine = MMedicine::findOrFail($id);
            $data = $request->except(['Image']);

            if($request->hasFile('Image')) {
                if($medicine->Image && Storage::disk('public')->exists($medicine->Image)) {
                    Storage::disk('public')->delete($medicine->Image);
                }

                $image_path = $request->file('Image')->store('images', 'public');
                $data['Image'] = $image_path;
            }
            $medicine->update($data);

            return redirect()->route('get-medicine')->with('success', 'Medicine updated successfully!');

        }catch(\Illuminate\Validation\ValidationException $e){
            dd($e->error());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $medicine = MMedicine::findOrFail($id);

        if($medicine->Image && Storage::disk('public')->exists($medicine->Image)) {
            Storage::disk('public')->delete($medicine->Image);
        }

        $medicine->delete();
        return redirect()->back()->with('success', 'Medicine deleted successfully!');
    }
}
