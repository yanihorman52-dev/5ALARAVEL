<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index');
        }

        $total = $carts->sum(function ($cart) {
            return $cart->product->price * $cart->quantity;
        });

        return view('checkout.index', compact('carts', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index');
        }

        DB::transaction(function () use ($request, $carts) {

            $total = $carts->sum(function ($cart) {
                return $cart->product->price * $cart->quantity;
            });

            $order = Order::create([
                'user_id' => Auth::id(),
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'payment_method' => $request->payment_method,
                'total' => $total,
                'status' => 'Menunggu Pembayaran',
            ]);

            foreach ($carts as $cart) {

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->product->price,
                ]);

                $cart->product->decrement(
                    'stock',
                    $cart->quantity
                );
            }

            Cart::where('user_id', Auth::id())->delete();
        });

        return redirect()
            ->route('orders.index')
            ->with('success', 'Pesanan berhasil dibuat 🐾');
    }
}