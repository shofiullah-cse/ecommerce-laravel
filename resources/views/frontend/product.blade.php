@extends('frontend.layouts.app')

@section(
    'title',
    $product->meta_title ?: $product->name
)

@section(
    'meta_description',
    $product->meta_description ?: $product->short_description
)

@section('content')

<div class="container py-5">

    <div class="row g-5">

        {{-- Images --}}
        <div class="col-lg-6">

            @if($product->thumbnail)

                <img
                    src="{{ asset('storage/' . $product->thumbnail) }}"
                    class="img-fluid rounded shadow-sm w-100"
                    style="max-height:500px;object-fit:contain;"
                    alt="{{ $product->name }}"
                >

            @endif


            @if($product->images->count())

                <div class="row g-2 mt-3">

                    @foreach($product->images as $image)

                        <div class="col-3">

                            <img
                                src="{{ asset('storage/' . $image->image) }}"
                                class="img-fluid rounded border"
                                style="height:90px;width:100%;object-fit:cover;"
                                alt="{{ $product->name }}"
                            >

                        </div>

                    @endforeach

                </div>

            @endif

        </div>


        {{-- Information --}}
        <div class="col-lg-6">

            <small class="text-muted">
                {{ $product->category->name }}
            </small>


            <h1 class="mt-2">
                {{ $product->name }}
            </h1>


            @if($product->brand)

                <p class="text-muted">
                    Brand:
                    <strong>
                        {{ $product->brand->name }}
                    </strong>
                </p>

            @endif


            {{-- Price --}}
            <div class="my-4">

                @if($product->sale_price)

                    <del class="text-muted fs-5">
                        ৳{{ number_format($product->price, 2) }}
                    </del>

                    <span class="fs-2 fw-bold text-danger ms-2">
                        ৳{{ number_format($product->sale_price, 2) }}
                    </span>

                @else

                    <span class="fs-2 fw-bold">
                        ৳{{ number_format($product->price, 2) }}
                    </span>

                @endif

            </div>


            {{-- Stock --}}
            @if($product->stock > 0)

                <div class="text-success mb-3">
                    In Stock
                    ({{ $product->stock }} available)
                </div>

            @else

                <div class="text-danger mb-3">
                    Out of Stock
                </div>

            @endif


            @if($product->short_description)

                <p class="lead">
                    {{ $product->short_description }}
                </p>

            @endif


            {{-- Quantity --}}
            @if($product->stock > 0)

                <div class="row align-items-end mb-4">

                    <div class="col-md-3">

                        <label class="form-label">
                            Quantity
                        </label>

                        <input
                            type="number"
                            min="1"
                            max="{{ $product->stock }}"
                            value="1"
                            class="form-control"
                            id="quantity"
                        >

                    </div>

                </div>


                <form
                    action="{{ route('cart.add', $product) }}"
                    method="POST"
                >
                    @csrf

                    <div class="row align-items-end mb-4">

                        <div class="col-md-3">

                            <label class="form-label">
                                Quantity
                            </label>

                            <input
                                type="number"
                                name="quantity"
                                min="1"
                                max="{{ $product->stock }}"
                                value="1"
                                class="form-control"
                            >

                        </div>

                    </div>

                    <button
                        type="submit"
                        class="btn btn-dark btn-lg"
                    >
                        Add to Cart
                    </button>

                </form>

            @else

                <button
                    type="button"
                    class="btn btn-secondary btn-lg"
                    disabled
                >
                    Out of Stock
                </button>

            @endif


            {{-- Description --}}
            @if($product->description)

                <div class="mt-5">

                    <h4>
                        Description
                    </h4>

                    <div>
                        {!! $product->description !!}
                    </div>

                </div>

            @endif

        </div>

    </div>


    {{-- Related Products --}}
    @if($relatedProducts->count())

        <section class="mt-5 pt-5 border-top">

            <h3 class="mb-4">
                Related Products
            </h3>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">

                @foreach($relatedProducts as $product)

                    @include(
                        'frontend.partials.product-card',
                        ['product' => $product]
                    )

                @endforeach

            </div>

        </section>

    @endif

</div>

@endsection