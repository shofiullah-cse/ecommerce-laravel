@extends('frontend.layouts.app')

@section('title', 'Order Confirmed')

@section('content')

<div class="container py-5">

    <div class="card border-0 shadow-sm">

        <div class="card-body text-center py-5">

            <div class="mb-4">

                <span
                    class="d-inline-flex align-items-center justify-content-center bg-success text-white rounded-circle"
                    style="width:70px;height:70px;font-size:35px;"
                >
                    ✓
                </span>

            </div>


            <h1 class="mb-3">
                Order Confirmed!
            </h1>


            <p class="lead">
                Thank you for your order.
            </p>


            <p>
                Your order number is:
                <strong>
                    {{ $order->order_number }}
                </strong>
            </p>


            <div class="mt-4">

                <a
                    href="{{ route('shop') }}"
                    class="btn btn-dark"
                >
                    Continue Shopping
                </a>

            </div>

        </div>

    </div>

</div>

@endsection