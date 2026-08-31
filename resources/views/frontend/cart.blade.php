@extends('frontend.layouts.app')

@section('title', 'Shopping Cart')

@section('content')

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1>
            Shopping Cart
        </h1>

        @if(count($cart))
            <form
                action="{{ route('cart.clear') }}"
                method="POST"
            >
                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="btn btn-outline-danger"
                    onclick="return confirm('Clear your cart?')"
                >
                    Clear Cart
                </button>

            </form>
        @endif

    </div>


    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    @if(session('error'))

        <div class="alert alert-danger">
            {{ session('error') }}
        </div>

    @endif


    @if(count($cart))

        <div class="row g-4">

            {{-- Cart Items --}}
            <div class="col-lg-8">

                <div class="card border-0 shadow-sm">

                    <div class="card-body">

                        @foreach($cart as $item)

                            <div
                                class="row align-items-center py-3
                                @if(!$loop->last) border-bottom @endif"
                            >

                                {{-- Image --}}
                                <div class="col-3 col-md-2">

                                    @if($item['thumbnail'])

                                        <img
                                            src="{{ asset('storage/' . $item['thumbnail']) }}"
                                            class="img-fluid rounded"
                                            style="height:80px;width:80px;object-fit:cover;"
                                            alt="{{ $item['name'] }}"
                                        >

                                    @else

                                        <div
                                            class="bg-light rounded d-flex align-items-center justify-content-center"
                                            style="height:80px;width:80px;"
                                        >
                                            No Image
                                        </div>

                                    @endif

                                </div>


                                {{-- Product --}}
                                <div class="col-9 col-md-4">

                                    <a
                                        href="{{ route('product.show', $item['slug']) }}"
                                        class="text-dark text-decoration-none"
                                    >
                                        <h6 class="mb-1">
                                            {{ $item['name'] }}
                                        </h6>
                                    </a>

                                    <span class="text-muted">
                                        ৳{{ number_format($item['price'], 2) }}
                                    </span>

                                </div>


                                {{-- Quantity --}}
                                <div class="col-6 col-md-3 mt-3 mt-md-0">

                                    <form
                                        action="{{ route('cart.update', $item['product_id']) }}"
                                        method="POST"
                                    >

                                        @csrf
                                        @method('PUT')

                                        <div class="input-group">

                                            <input
                                                type="number"
                                                name="quantity"
                                                value="{{ $item['quantity'] }}"
                                                min="1"
                                                class="form-control"
                                            >

                                            <button
                                                type="submit"
                                                class="btn btn-outline-secondary"
                                            >
                                                Update
                                            </button>

                                        </div>

                                    </form>

                                </div>


                                {{-- Total --}}
                                <div class="col-4 col-md-2 mt-3 mt-md-0">

                                    <strong>
                                        ৳{{ number_format(
                                            $item['price'] * $item['quantity'],
                                            2
                                        ) }}
                                    </strong>

                                </div>


                                {{-- Remove --}}
                                <div class="col-2 col-md-1 mt-3 mt-md-0">

                                    <form
                                        action="{{ route('cart.remove', $item['product_id']) }}"
                                        method="POST"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                            title="Remove"
                                        >
                                            ×
                                        </button>

                                    </form>

                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>


            {{-- Summary --}}
            <div class="col-lg-4">

                <div class="card border-0 shadow-sm">

                    <div class="card-body">

                        <h4 class="mb-4">
                            Order Summary
                        </h4>


                        <div class="d-flex justify-content-between mb-3">

                            <span>
                                Subtotal
                            </span>

                            <strong>
                                ৳{{ number_format($subtotal, 2) }}
                            </strong>

                        </div>


                        <div class="d-flex justify-content-between mb-3">

                            <span>
                                Shipping
                            </span>

                            <span>
                                Calculated at checkout
                            </span>

                        </div>


                        <hr>


                        <div class="d-flex justify-content-between mb-4">

                            <strong>
                                Total
                            </strong>

                            <strong class="fs-5">
                                ৳{{ number_format($total, 2) }}
                            </strong>

                        </div>


                        <a
                            href="{{ route('checkout.index') }}"
                            class="btn btn-dark w-100 btn-lg"
                        >
                            Proceed to Checkout
                        </a>


                        <a
                            href="{{ route('shop') }}"
                            class="btn btn-outline-secondary w-100 mt-2"
                        >
                            Continue Shopping
                        </a>

                    </div>

                </div>

            </div>

        </div>

    @else

        <div class="card border-0 shadow-sm">

            <div class="card-body text-center py-5">

                <h3>
                    Your cart is empty
                </h3>

                <p class="text-muted">
                    You haven't added any products yet.
                </p>

                <a
                    href="{{ route('shop') }}"
                    class="btn btn-dark"
                >
                    Start Shopping
                </a>

            </div>

        </div>

    @endif

</div>

@endsection