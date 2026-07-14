<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'items.product'])
            ->latest()
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:Menunggu Pembayaran,Diproses,Dikirim,Selesai,Dibatalkan',
        ]);

        $order->update([
            'status' => $request->status,
        ]);

        return back()->with(
            'success',
            'Status pesanan berhasil diperbarui.'
        );
    }
}