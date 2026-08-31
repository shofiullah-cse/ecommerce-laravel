<div class="col">

    <div class="card h-100 border-0 shadow-sm product-card">

        <a
            href="{{ route('product.show', $product) }}"
            class="text-decoration-none"
        >

            @if($product->thumbnail)

                <img
                    src="{{ asset('storage/' . $product->thumbnail) }}"
                    class="card-img-top product-image"
                    alt="{{ $product->name }}"
                >

            @else

                <div
                    class="bg-light d-flex align-items-center justify-content-center product-image"
                >
                    No Image
                </div>

            @endif

        </a>


        <div class="card-body">

            <small class="text-muted">
                {{ $product->category->name }}
            </small>

            <h6 class="card-title mt-1">

                <a
                    href="{{ route('product.show', $product) }}"
                    class="text-dark text-decoration-none"
                >
                    {{ $product->name }}
                </a>

            </h6>


            @if($product->sale_price)

                <del class="text-muted">
                    ৳{{ number_format($product->price, 2) }}
                </del>

                <strong class="text-danger ms-2">
                    ৳{{ number_format($product->sale_price, 2) }}
                </strong>

            @else

                <strong>
                    ৳{{ number_format($product->price, 2) }}
                </strong>

            @endif

        </div>


        <div class="card-footer bg-white border-0">

            <a
                href="{{ route('product.show', $product) }}"
                class="btn btn-dark w-100"
            >
                View Product
            </a>

        </div>

    </div>

</div>