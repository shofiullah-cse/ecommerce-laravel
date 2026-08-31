<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(Request $request): View
    {
        $cart = $request->session()->get('cart', []);

        $subtotal = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        return view('frontend.cart', [
            'cart' => $cart,
            'subtotal' => $subtotal,
            'total' => $subtotal,
        ]);
    }

    public function add(
        Request $request,
        Product $product
    ): RedirectResponse {
        if (!$product->status) {
            abort(404);
        }

        if ($product->stock <= 0) {
            return back()->with(
                'error',
                'This product is out of stock.'
            );
        }

        $validated = $request->validate([
            'quantity' => [
                'required',
                'integer',
                'min:1',
                'max:' . $product->stock,
            ],
        ]);

        $quantity = $validated['quantity'];

        $cart = $request->session()->get('cart', []);

        $productId = $product->id;

        $price = $product->sale_price ?? $product->price;

        if (isset($cart[$productId])) {

            $newQuantity =
                $cart[$productId]['quantity'] + $quantity;

            if ($newQuantity > $product->stock) {
                return back()->with(
                    'error',
                    'Requested quantity is not available in stock.'
                );
            }

            $cart[$productId]['quantity'] = $newQuantity;

        } else {

            $cart[$productId] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'price' => (float) $price,
                'quantity' => $quantity,
                'thumbnail' => $product->thumbnail,
            ];
        }

        $request->session()->put('cart', $cart);

        return redirect()
            ->route('cart.index')
            ->with(
                'success',
                'Product added to cart.'
            );
    }

    public function update(
        Request $request,
        Product $product
    ): RedirectResponse {
        $validated = $request->validate([
            'quantity' => [
                'required',
                'integer',
                'min:1',
            ],
        ]);

        $cart = $request->session()->get('cart', []);

        if (!isset($cart[$product->id])) {
            return back()->with(
                'error',
                'Product is not in your cart.'
            );
        }

        if ($validated['quantity'] > $product->stock) {
            return back()->with(
                'error',
                'Requested quantity exceeds available stock.'
            );
        }

        $cart[$product->id]['quantity'] =
            $validated['quantity'];

        $request->session()->put('cart', $cart);

        return back()->with(
            'success',
            'Cart updated successfully.'
        );
    }

    public function remove(
        Request $request,
        Product $product
    ): RedirectResponse {
        $cart = $request->session()->get('cart', []);

        unset($cart[$product->id]);

        $request->session()->put('cart', $cart);

        return back()->with(
            'success',
            'Product removed from cart.'
        );
    }

    public function clear(
        Request $request
    ): RedirectResponse {
        $request->session()->forget('cart');

        return redirect()
            ->route('cart.index')
            ->with(
                'success',
                'Cart cleared successfully.'
            );
    }
}