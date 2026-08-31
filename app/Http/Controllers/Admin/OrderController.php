<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::latest()
            ->paginate(15);

        return view(
            'admin.orders.index',
            compact('orders')
        );
    }

    public function show(Order $order): View
    {
        $order->load('items');

        return view(
            'admin.orders.show',
            compact('order')
        );
    }

    public function update(
        Request $request,
        Order $order
    ): RedirectResponse {
        $validated = $request->validate([
            'status' => [
                'required',
                'in:pending,confirmed,processing,shipped,delivered,cancelled',
            ],

            'payment_status' => [
                'required',
                'in:pending,paid,failed,refunded',
            ],
        ]);

        $order->update($validated);

        return back()->with(
            'success',
            'Order updated successfully.'
        );
    }
}