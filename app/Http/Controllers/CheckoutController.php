<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MMedicine;

class CheckoutController extends Controller
{
    //
    public function checkout(Request $request)
{
    // Validate the incoming data
    $validatedData = $request->validate([
        'cart.*.id' => 'required',
        'cart.*.quantity' => 'required|integer|min:1',
    ]);

   // dd($request->all());

    try {
        $cart = $validatedData['cart'];
       // dd($cart);

        foreach ($cart as $item) {
            $product = MMedicine::find($item['id']);
            // Check if there is enough stock
            $product->decrement('Qty', $item['quantity']);
        }

        // Insert the order into the database (optional)
        // E.g., $order = Order::create([...]);

        // DB::commit();

        return response()->json(['message' => 'Purchase completed successfully!'], 200);
    } catch (\Exception $e) {
        // DB::rollBack();

        return response()->json([
            'message' => 'An error occurred during checkout: ' . $e->getMessage(),
        ], 500);
    }
}
}
