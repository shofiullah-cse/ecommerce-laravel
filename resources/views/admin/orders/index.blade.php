@extends('admin.layouts.app')

@section('title', 'Orders')

@section('page_title', 'Orders')

@section('content')

<div class="container-fluid">

    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <h4 class="mb-4">
                Orders
            </h4>


            <div class="table-responsive">

                <table class="table table-hover">

                    <thead>

                        <tr>

                            <th>
                                Order
                            </th>

                            <th>
                                Customer
                            </th>

                            <th>
                                Phone
                            </th>

                            <th>
                                Total
                            </th>

                            <th>
                                Payment
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($orders as $order)

                            <tr>

                                <td>
                                    <strong>
                                        {{ $order->order_number }}
                                    </strong>

                                    <small class="d-block text-muted">
                                        {{ $order->created_at->format('d M Y h:i A') }}
                                    </small>
                                </td>


                                <td>
                                    {{ $order->customer_name }}
                                </td>


                                <td>
                                    {{ $order->customer_phone }}
                                </td>


                                <td>
                                    ৳{{ number_format($order->total, 2) }}
                                </td>


                                <td>

                                    @if($order->payment_status === 'paid')

                                        <span class="badge bg-success">
                                            Paid
                                        </span>

                                    @else

                                        <span class="badge bg-warning text-dark">
                                            {{ ucfirst($order->payment_status) }}
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    @php
                                        $statusClass = match($order->status) {
                                            'delivered' => 'success',
                                            'cancelled' => 'danger',
                                            'shipped' => 'info',
                                            'processing' => 'primary',
                                            'confirmed' => 'secondary',
                                            default => 'warning',
                                        };
                                    @endphp

                                    <span
                                        class="badge bg-{{ $statusClass }}"
                                    >
                                        {{ ucfirst($order->status) }}
                                    </span>

                                </td>


                                <td>

                                    <a
                                        href="{{ route('admin.orders.show', $order) }}"
                                        class="btn btn-sm btn-dark"
                                    >
                                        View
                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="7"
                                    class="text-center py-5"
                                >
                                    No orders found.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            <div class="mt-3">

                {{ $orders->links() }}

            </div>

        </div>

    </div>

</div>

@endsection