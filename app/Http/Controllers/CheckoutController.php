<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {
        $cart = $request->session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('shop')
                ->with(
                    'error',
                    'Your cart is empty.'
                );
        }

        $subtotal = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        $shippingCharge = 0;

        $total = $subtotal + $shippingCharge;

        return view(
            'frontend.checkout',
            compact(
                'cart',
                'subtotal',
                'shippingCharge',
                'total'
            )
        );
    }

    public function store(
        Request $request
    ): RedirectResponse {
        $cart = $request->session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('shop')
                ->with(
                    'error',
                    'Your cart is empty.'
                );
        }

        $validated = $request->validate([
            'customer_name' => [
                'required',
                'string',
                'max:255',
            ],

            'customer_email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'customer_phone' => [
                'required',
                'string',
                'max:30',
            ],

            'shipping_address' => [
                'required',
                'string',
                'max:1000',
            ],

            'city' => [
                'required',
                'string',
                'max:100',
            ],

            'payment_method' => [
                'required',
                'in:cod',
            ],

            'notes' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Re-check products from database
        |--------------------------------------------------------------------------
        */

        $productIds = array_keys($cart);

        $products = Product::whereIn(
            'id',
            $productIds
        )
            ->where('status', true)
            ->get()
            ->keyBy('id');

        $subtotal = 0;

        foreach ($cart as $productId => $item) {

            if (!isset($products[$productId])) {
                return back()->with(
                    'error',
                    'One of the products is no longer available.'
                );
            }

            $product = $products[$productId];

            $quantity = (int) $item['quantity'];

            if ($quantity > $product->stock) {
                return back()->with(
                    'error',
                    "{$product->name} does not have enough stock."
                );
            }

            $price = $product->sale_price
                ?? $product->price;

            $subtotal += $price * $quantity;
        }

        $shippingCharge = 0;

        $total = $subtotal + $shippingCharge;

        /*
        |--------------------------------------------------------------------------
        | Create Order
        |--------------------------------------------------------------------------
        */

        $order = DB::transaction(function () use (
            $request,
            $validated,
            $cart,
            $products,
            $subtotal,
            $shippingCharge,
            $total
        ) {

            $order = Order::create([
                'user_id' => auth()->id(),

                'order_number' =>
                    'ORD-' .
                    strtoupper(
                        Str::random(10)
                    ),

                'customer_name' =>
                    $validated['customer_name'],

                'customer_email' =>
                    $validated['customer_email'] ?? null,

                'customer_phone' =>
                    $validated['customer_phone'],

                'shipping_address' =>
                    $validated['shipping_address'],

                'city' =>
                    $validated['city'],

                'subtotal' =>
                    $subtotal,

                'shipping_charge' =>
                    $shippingCharge,

                'total' =>
                    $total,

                'payment_method' =>
                    $validated['payment_method'],

                'payment_status' =>
                    'pending',

                'status' =>
                    'pending',

                'notes' =>
                    $validated['notes'] ?? null,
            ]);

            foreach ($cart as $productId => $item) {

                $product = $products[$productId];

                $quantity = (int) $item['quantity'];

                $price = $product->sale_price
                    ?? $product->price;

                $itemTotal = $price * $quantity;

                $order->items()->create([
                    'product_id' =>
                        $product->id,

                    'product_name' =>
                        $product->name,

                    'product_sku' =>
                        $product->sku,

                    'price' =>
                        $price,

                    'quantity' =>
                        $quantity,

                    'total' =>
                        $itemTotal,
                ]);

                /*
                |--------------------------------------------------------------------------
                | Reduce stock
                |--------------------------------------------------------------------------
                */

                $product->decrement(
                    'stock',
                    $quantity
                );
            }

            return $order;
        });

        /*
        |--------------------------------------------------------------------------
        | Clear cart
        |--------------------------------------------------------------------------
        */

        $request->session()->forget('cart');

        return redirect()
            ->route(
                'checkout.success',
                $order
            );
    }

    public function success(
        Order $order
    ): View {
        return view(
            'frontend.checkout-success',
            compact('order')
        );
    }
}