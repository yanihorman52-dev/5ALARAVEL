<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        return view('cart.index', compact('carts'));
    }

    public function store(Product $product)
    {
        $cart = Cart::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($cart) {
            if ($cart->quantity < $product->stock) {
                $cart->increment('quantity');
            }
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->route('home')
            ->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function increase(Cart $cart)
    {
        if (
            $cart->user_id == Auth::id() &&
            $cart->quantity < $cart->product->stock
        ) {
            $cart->increment('quantity');
        }

        return back();
    }

    public function decrease(Cart $cart)
    {
        if ($cart->user_id == Auth::id()) {
            if ($cart->quantity > 1) {
                $cart->decrement('quantity');
            } else {
                $cart->delete();
            }
        }

        return back();
    }

    public function destroy(Cart $cart)
    {
        if ($cart->user_id == Auth::id()) {
            $cart->delete();
        }

        return back()
            ->with('success', 'Produk dihapus dari keranjang.');
    }
}