@extends('admin.layouts.app')

@section('title', 'Products')

@section('page_title', 'Products')

@section('content')

<div class="container-fluid">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h4 class="mb-0">
            Products
        </h4>

        <a
            href="{{ route('admin.products.create') }}"
            class="btn btn-primary"
        >
            + Add Product
        </a>

    </div>


    {{-- Search --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <form
                method="GET"
                action="{{ route('admin.products.index') }}"
            >

                <div class="row g-2">

                    <div class="col-md-6">

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            class="form-control"
                            placeholder="Search by product name or SKU"
                        >

                    </div>

                    <div class="col-md-2">

                        <button
                            type="submit"
                            class="btn btn-dark w-100"
                        >
                            Search
                        </button>

                    </div>

                    <div class="col-md-2">

                        <a
                            href="{{ route('admin.products.index') }}"
                            class="btn btn-secondary w-100"
                        >
                            Reset
                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- Products --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover mb-0">

                    <thead class="table-light">

                        <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Brand</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th width="170">Action</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($products as $product)

                            <tr>

                                <td>
                                    {{ $products->firstItem() + $loop->index }}
                                </td>

                                <td>

                                    <div class="d-flex align-items-center gap-2">

                                        @if($product->thumbnail)

                                            <img
                                                src="{{ asset('storage/' . $product->thumbnail) }}"
                                                width="55"
                                                height="55"
                                                class="rounded border"
                                                style="object-fit: cover;"
                                                alt="{{ $product->name }}"
                                            >

                                        @endif

                                        <div>

                                            <strong>
                                                {{ $product->name }}
                                            </strong>

                                            <small class="d-block text-muted">
                                                SKU: {{ $product->sku }}
                                            </small>

                                            @if($product->featured)

                                                <span class="badge bg-warning text-dark">
                                                    Featured
                                                </span>

                                            @endif

                                        </div>

                                    </div>

                                </td>

                                <td>
                                    {{ $product->category->name }}
                                </td>

                                <td>
                                    {{ $product->brand?->name ?? '—' }}
                                </td>

                                <td>

                                    @if($product->sale_price)

                                        <del class="text-muted">
                                            ৳{{ number_format($product->price, 2) }}
                                        </del>

                                        <strong class="d-block">
                                            ৳{{ number_format($product->sale_price, 2) }}
                                        </strong>

                                    @else

                                        ৳{{ number_format($product->price, 2) }}

                                    @endif

                                </td>

                                <td>

                                    @if($product->stock > 0)

                                        <span class="text-success">
                                            {{ $product->stock }}
                                        </span>

                                    @else

                                        <span class="text-danger">
                                            Out of stock
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    @if($product->status)

                                        <span class="badge bg-success">
                                            Active
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            Inactive
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <a
                                        href="{{ route('admin.products.edit', $product) }}"
                                        class="btn btn-sm btn-warning"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('admin.products.destroy', $product) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Delete this product?')"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-danger"
                                        >
                                            Delete
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="8"
                                    class="text-center py-5"
                                >
                                    No products found.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    <div class="mt-4">

        {{ $products->links() }}

    </div>

</div>

@endsection