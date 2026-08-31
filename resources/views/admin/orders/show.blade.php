@extends('admin.layouts.app')

@section('title', 'Order Details')

@section('page_title', 'Order Details')

@section('content')

<div class="container-fluid">

    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    <div class="row g-4">

        {{-- Order Information --}}
        <div class="col-lg-8">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <h4 class="mb-4">
                        {{ $order->order_number }}
                    </h4>


                    <div class="table-responsive">

                        <table class="table">

                            <thead>

                                <tr>

                                    <th>
                                        Product
                                    </th>

                                    <th>
                                        SKU
                                    </th>

                                    <th>
                                        Price
                                    </th>

                                    <th>
                                        Qty
                                    </th>

                                    <th>
                                        Total
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @foreach($order->items as $item)

                                    <tr>

                                        <td>
                                            {{ $item->product_name }}
                                        </td>

                                        <td>
                                            {{ $item->product_sku }}
                                        </td>

                                        <td>
                                            ৳{{ number_format($item->price, 2) }}
                                        </td>

                                        <td>
                                            {{ $item->quantity }}
                                        </td>

                                        <td>
                                            ৳{{ number_format($item->total, 2) }}
                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>


                    <hr>


                    <div class="ms-auto" style="max-width:300px;">

                        <div class="d-flex justify-content-between">
                            <span>Subtotal</span>
                            <strong>
                                ৳{{ number_format($order->subtotal, 2) }}
                            </strong>
                        </div>

                        <div class="d-flex justify-content-between">
                            <span>Shipping</span>
                            <strong>
                                ৳{{ number_format($order->shipping_charge, 2) }}
                            </strong>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between">
                            <strong>Total</strong>
                            <strong>
                                ৳{{ number_format($order->total, 2) }}
                            </strong>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Customer + Status --}}
        <div class="col-lg-4">

            <div class="card border-0 shadow-sm mb-4">

                <div class="card-body">

                    <h5 class="mb-3">
                        Customer
                    </h5>

                    <p class="mb-1">
                        <strong>Name:</strong>
                        {{ $order->customer_name }}
                    </p>

                    <p class="mb-1">
                        <strong>Phone:</strong>
                        {{ $order->customer_phone }}
                    </p>

                    <p class="mb-1">
                        <strong>Email:</strong>
                        {{ $order->customer_email ?? '—' }}
                    </p>

                    <p class="mb-1">
                        <strong>City:</strong>
                        {{ $order->city }}
                    </p>

                    <p>
                        <strong>Address:</strong><br>
                        {{ $order->shipping_address }}
                    </p>

                </div>

            </div>


            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <h5 class="mb-3">
                        Update Order
                    </h5>


                    <form
                        action="{{ route('admin.orders.update', $order) }}"
                        method="POST"
                    >

                        @csrf

                        @method('PUT')


                        <div class="mb-3">

                            <label class="form-label">
                                Order Status
                            </label>

                            <select
                                name="status"
                                class="form-select"
                            >

                                @foreach([
                                    'pending',
                                    'confirmed',
                                    'processing',
                                    'shipped',
                                    'delivered',
                                    'cancelled'
                                ] as $status)

                                    <option
                                        value="{{ $status }}"
                                        @selected($order->status === $status)
                                    >
                                        {{ ucfirst($status) }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Payment Status
                            </label>

                            <select
                                name="payment_status"
                                class="form-select"
                            >

                                @foreach([
                                    'pending',
                                    'paid',
                                    'failed',
                                    'refunded'
                                ] as $status)

                                    <option
                                        value="{{ $status }}"
                                        @selected($order->payment_status === $status)
                                    >
                                        {{ ucfirst($status) }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                        >
                            Update Order
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection