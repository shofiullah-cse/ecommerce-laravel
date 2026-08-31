@extends('frontend.layouts.app')

@section('title', 'Shop - My Store')

@section('content')

<div class="container py-5">

    <div class="row">

        {{-- Sidebar --}}
        <div class="col-lg-3 mb-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <h5 class="mb-3">
                        Categories
                    </h5>

                    <a
                        href="{{ route('shop') }}"
                        class="d-block mb-2 text-decoration-none"
                    >
                        All Products
                    </a>

                    @foreach($categories as $category)

                        <a
                            href="{{ route('shop', ['category' => $category->id]) }}"
                            class="d-block mb-2 text-decoration-none"
                        >
                            {{ $category->name }}
                        </a>

                    @endforeach

                </div>

            </div>

        </div>


        {{-- Products --}}
        <div class="col-lg-9">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <h2>
                    Shop
                </h2>

                <span class="text-muted">
                    {{ $products->total() }} products
                </span>

            </div>


            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">

                @forelse($products as $product)

                    @include(
                        'frontend.partials.product-card',
                        ['product' => $product]
                    )

                @empty

                    <div class="col-12">

                        <div class="alert alert-info">
                            No products found.
                        </div>

                    </div>

                @endforelse

            </div>


            <div class="mt-5">

                {{ $products->links() }}

            </div>

        </div>

    </div>

</div>

@endsection