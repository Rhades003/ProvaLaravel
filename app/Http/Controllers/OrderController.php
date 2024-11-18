<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;

class OrderController extends Controller
{
    public function setOrder(Request $request) {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'pickup_day' => 'required|date',
            'pickup_time' => 'required|date_format:H:i',
            'address' => 'required|string|max:255',
            'payment_type' => 'required|in:efectivo,tarjeta'
        ]);
    
        $order = Order::create([
            'product_id' => $request->input('product_id'),
            'pickup_day' => $validatedData['pickup_day'],
            'pickup_time' => $validatedData['pickup_time'],
            'address' => $validatedData['address'],
            'payment_type' => $validatedData['payment_type'],
            'user_id' => auth()->id(), 
        ]);
    
        return response()->json($order, 201);
    }

    public function getOrderHistory() {
        $orders = Order::all();
        return response()->json($orders);
    }
}
