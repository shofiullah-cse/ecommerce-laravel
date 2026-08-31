@extends('frontend.layouts.app')

@section('title', 'Checkout')

@section('content')

<div class="container py-5">

    <h1 class="mb-4">
        Checkout
    </h1>

    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    @if(session('error'))

        <div class="alert alert-danger">
            {{ session('error') }}
        </div>

    @endif


    <form
        action="{{ route('checkout.store') }}"
        method="POST"
    >

        @csrf

        <div class="row g-4">

            {{-- Customer Information --}}
            <div class="col-lg-7">

                <div class="card border-0 shadow-sm">

                    <div class="card-body">

                        <h4 class="mb-4">
                            Customer Information
                        </h4>


                        <div class="mb-3">

                            <label class="form-label">
                                Full Name
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="customer_name"
                                value="{{ old('customer_name') }}"
                                class="form-control"
                                required
                            >

                        </div>


                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Email
                                </label>

                                <input
                                    type="email"
                                    name="customer_email"
                                    value="{{ old('customer_email') }}"
                                    class="form-control"
                                >

                            </div>


                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Phone
                                    <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="customer_phone"
                                    value="{{ old('customer_phone') }}"
                                    class="form-control"
                                    required
                                >

                            </div>

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                City
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="city"
                                value="{{ old('city') }}"
                                class="form-control"
                                required
                            >

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Shipping Address
                                <span class="text-danger">*</span>
                            </label>

                            <textarea
                                name="shipping_address"
                                rows="4"
                                class="form-control"
                                required
                            >{{ old('shipping_address') }}</textarea>

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Order Notes
                            </label>

                            <textarea
                                name="notes"
                                rows="3"
                                class="form-control"
                                placeholder="Optional"
                            >{{ old('notes') }}</textarea>

                        </div>


                        <h5 class="mt-4 mb-3">
                            Payment Method
                        </h5>


                        <div class="form-check border rounded p-3">

                            <input
                                class="form-check-input"
                                type="radio"
                                name="payment_method"
                                value="cod"
                                id="cod"
                                checked
                            >

                            <label
                                class="form-check-label"
                                for="cod"
                            >
                                Cash on Delivery
                            </label>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Order Summary --}}
            <div class="col-lg-5">

                <div class="card border-0 shadow-sm">

                    <div class="card-body">

                        <h4 class="mb-4">
                            Your Order
                        </h4>


                        @foreach($cart as $item)

                            <div class="d-flex justify-content-between mb-3">

                                <div>

                                    <strong>
                                        {{ $item['name'] }}
                                    </strong>

                                    <small class="d-block text-muted">
                                        {{ $item['quantity'] }}
                                        ×
                                        ৳{{ number_format($item['price'], 2) }}
                                    </small>

                                </div>


                                <span>
                                    ৳{{ number_format(
                                        $item['price'] * $item['quantity'],
                                        2
                                    ) }}
                                </span>

                            </div>

                        @endforeach


                        <hr>


                        <div class="d-flex justify-content-between mb-2">

                            <span>
                                Subtotal
                            </span>

                            <strong>
                                ৳{{ number_format($subtotal, 2) }}
                            </strong>

                        </div>


                        <div class="d-flex justify-content-between mb-2">

                            <span>
                                Shipping
                            </span>

                            <strong>
                                ৳{{ number_format($shippingCharge, 2) }}
                            </strong>

                        </div>


                        <hr>


                        <div class="d-flex justify-content-between mb-4">

                            <strong class="fs-5">
                                Total
                            </strong>

                            <strong class="fs-5">
                                ৳{{ number_format($total, 2) }}
                            </strong>

                        </div>


                        <button
                            type="submit"
                            class="btn btn-dark btn-lg w-100"
                        >
                            Place Order
                        </button>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection