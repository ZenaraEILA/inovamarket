<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->with('orderItems.product')->latest()->paginate(10);

        return view('user.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('orderItems.product');

        return view('user.orders.show', compact('order'));
    }

    public function checkout()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }

        $cartItems = [];
        $total = 0;

        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            if ($product) {
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'subtotal' => $product->price * $item['quantity']
                ];
                $total += $product->price * $item['quantity'];
            }
        }

        return view('user.checkout', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'notes' => 'nullable|string|max:500'
        ]);

        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }

        $total = 0;
        $orderItems = [];

        // Calculate total and prepare order items
        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            if ($product) {
                $subtotal = $product->price * $item['quantity'];
                $total += $subtotal;

                $orderItems[] = [
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                ];
            }
        }

        // Create order
        $order = Order::create([
            'user_id' => auth()->id(),
            'status' => 'pending',
            'total_price' => $total,
            'notes' => $request->notes,
        ]);

        // Create order items
        foreach ($orderItems as $item) {
            $order->orderItems()->create($item);
        }

        // Clear cart
        session()->forget('cart');

        return redirect()->route('orders.show', $order)->with('success', 'Pesanan berhasil dibuat!');
    }
}
