@extends('frontend.layouts.app')

@section('title', 'Home - My Store')

@section(
    'meta_description',
    'Shop quality products at My Store.'
)

@section('content')

{{-- Hero --}}
<section class="bg-dark text-white">

    <div class="container py-5">

        <div class="row align-items-center">

            <div class="col-lg-7">

                <h1 class="display-4 fw-bold">
                    Shop Quality Products
                </h1>

                <p class="lead">
                    Find the products you need at the best prices.
                </p>

                <a
                    href="{{ route('shop') }}"
                    class="btn btn-light btn-lg"
                >
                    Shop Now
                </a>

            </div>

        </div>

    </div>

</section>


{{-- Categories --}}
<section class="py-5">

    <div class="container">

        <div class="d-flex justify-content-between mb-4">

            <h2>
                Shop by Category
            </h2>

            <a
                href="{{ route('shop') }}"
                class="text-decoration-none"
            >
                View All
            </a>

        </div>


        <div class="row row-cols-2 row-cols-md-4 g-4">

            @foreach($categories as $category)

                <div class="col">

                    <a
                        href="{{ route('shop', ['category' => $category->id]) }}"
                        class="text-decoration-none text-dark"
                    >

                        <div class="card border-0 shadow-sm text-center category-card">

                            <div class="card-body py-4">

                                <h5 class="mb-0">
                                    {{ $category->name }}
                                </h5>

                            </div>

                        </div>

                    </a>

                </div>

            @endforeach

        </div>

    </div>

</section>


{{-- Featured Products --}}
@if($featuredProducts->count())

<section class="py-5 bg-white">

    <div class="container">

        <h2 class="mb-4">
            Featured Products
        </h2>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">

            @foreach($featuredProducts as $product)

                @include(
                    'frontend.partials.product-card',
                    ['product' => $product]
                )

            @endforeach

        </div>

    </div>

</section>

@endif


{{-- Latest Products --}}
<section class="py-5">

    <div class="container">

        <h2 class="mb-4">
            Latest Products
        </h2>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">

            @foreach($latestProducts as $product)

                @include(
                    'frontend.partials.product-card',
                    ['product' => $product]
                )

            @endforeach

        </div>

    </div>

</section>

@endsection