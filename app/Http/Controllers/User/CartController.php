<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
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

        return view('user.cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->stock
        ]);

        $cart = session('cart', []);
        $quantity = $request->quantity;

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'quantity' => $quantity,
                'name' => $product->name,
                'price' => $product->price,
            ];
        }

        session(['cart' => $cart]);

        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->stock
        ]);

        $cart = session('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = $request->quantity;
            session(['cart' => $cart]);
        }

        return back()->with('success', 'Keranjang berhasil diperbarui!');
    }

    public function remove(Product $product)
    {
        $cart = session('cart', []);

        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            session(['cart' => $cart]);
        }

        return back()->with('success', 'Produk berhasil dihapus dari keranjang!');
    }

    public function clear()
    {
        session()->forget('cart');

        return back()->with('success', 'Keranjang berhasil dikosongkan!');
    }
}
