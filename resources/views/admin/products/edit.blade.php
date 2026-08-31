@extends('admin.layouts.app')

@section('title', 'Edit Product')

@section('page_title', 'Edit Product')

@section('content')

<div class="container-fluid">

<form
    action="{{ route('admin.products.update', $product) }}"
    method="POST"
    enctype="multipart/form-data"
>

@csrf

@method('PUT')

<div class="row">

    <div class="col-lg-8">

        <div class="card border-0 shadow-sm mb-4">

            <div class="card-body">

                <h5 class="mb-4">
                    Product Information
                </h5>


                <div class="mb-3">

                    <label class="form-label">
                        Product Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $product->name) }}"
                        class="form-control"
                    >

                </div>


                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            SKU
                        </label>

                        <input
                            type="text"
                            name="sku"
                            value="{{ old('sku', $product->sku) }}"
                            class="form-control"
                        >

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Category
                        </label>

                        <select
                            name="category_id"
                            class="form-select"
                        >

                            @foreach($categories as $category)

                                <option
                                    value="{{ $category->id }}"
                                    @selected(
                                        old(
                                            'category_id',
                                            $product->category_id
                                        ) == $category->id
                                    )
                                >
                                    {{ $category->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>


                <div class="mb-3">

                    <label class="form-label">
                        Brand
                    </label>

                    <select
                        name="brand_id"
                        class="form-select"
                    >

                        <option value="">
                            Select Brand
                        </option>

                        @foreach($brands as $brand)

                            <option
                                value="{{ $brand->id }}"
                                @selected(
                                    old(
                                        'brand_id',
                                        $product->brand_id
                                    ) == $brand->id
                                )
                            >
                                {{ $brand->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                <div class="mb-3">

                    <label class="form-label">
                        Short Description
                    </label>

                    <textarea
                        name="short_description"
                        rows="3"
                        class="form-control"
                    >{{ old('short_description', $product->short_description) }}</textarea>

                </div>


                <div class="mb-3">

                    <label class="form-label">
                        Description
                    </label>

                    <textarea
                        name="description"
                        rows="7"
                        class="form-control"
                    >{{ old('description', $product->description) }}</textarea>

                </div>

            </div>

        </div>


        <div class="card border-0 shadow-sm mb-4">

            <div class="card-body">

                <h5 class="mb-4">
                    Pricing & Inventory
                </h5>

                <div class="row">

                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Price
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            min="0"
                            name="price"
                            value="{{ old('price', $product->price) }}"
                            class="form-control"
                        >

                    </div>


                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Sale Price
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            min="0"
                            name="sale_price"
                            value="{{ old('sale_price', $product->sale_price) }}"
                            class="form-control"
                        >

                    </div>


                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Stock
                        </label>

                        <input
                            type="number"
                            min="0"
                            name="stock"
                            value="{{ old('stock', $product->stock) }}"
                            class="form-control"
                        >

                    </div>


                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Weight
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            min="0"
                            name="weight"
                            value="{{ old('weight', $product->weight) }}"
                            class="form-control"
                        >

                    </div>

                </div>

            </div>

        </div>


        <div class="card border-0 shadow-sm mb-4">

            <div class="card-body">

                <h5 class="mb-4">
                    SEO
                </h5>

                <div class="mb-3">

                    <label class="form-label">
                        Meta Title
                    </label>

                    <input
                        type="text"
                        name="meta_title"
                        value="{{ old('meta_title', $product->meta_title) }}"
                        class="form-control"
                    >

                </div>


                <div class="mb-3">

                    <label class="form-label">
                        Meta Description
                    </label>

                    <textarea
                        name="meta_description"
                        rows="4"
                        class="form-control"
                    >{{ old('meta_description', $product->meta_description) }}</textarea>

                </div>

            </div>

        </div>

    </div>


    <div class="col-lg-4">

        <div class="card border-0 shadow-sm mb-4">

            <div class="card-body">

                <h5 class="mb-3">
                    Status
                </h5>

                <select
                    name="status"
                    class="form-select mb-3"
                >

                    <option
                        value="1"
                        @selected(old('status', $product->status) == 1)
                    >
                        Active
                    </option>

                    <option
                        value="0"
                        @selected(old('status', $product->status) == 0)
                    >
                        Inactive
                    </option>

                </select>


                <div class="form-check">

                    <input
                        type="checkbox"
                        name="featured"
                        value="1"
                        class="form-check-input"
                        id="featured"
                        @checked(old('featured', $product->featured))
                    >

                    <label
                        class="form-check-label"
                        for="featured"
                    >
                        Featured Product
                    </label>

                </div>

            </div>

        </div>


        {{-- Thumbnail --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-body">

                <h5 class="mb-3">
                    Thumbnail
                </h5>

                @if($product->thumbnail)

                    <img
                        src="{{ asset('storage/' . $product->thumbnail) }}"
                        width="150"
                        height="150"
                        class="rounded border mb-3"
                        style="object-fit: cover;"
                        alt="{{ $product->name }}"
                    >

                @endif

                <input
                    type="file"
                    name="thumbnail"
                    class="form-control"
                    accept="image/*"
                >

            </div>

        </div>


        {{-- Existing Gallery --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-body">

                <h5 class="mb-3">
                    Product Gallery
                </h5>

                @if($product->images->count())

                    <div class="row g-2 mb-3">

                        @foreach($product->images as $image)

                            <div class="col-4">

                                <img
                                    src="{{ asset('storage/' . $image->image) }}"
                                    class="img-fluid rounded border"
                                    style="height:80px;width:100%;object-fit:cover;"
                                    alt="{{ $product->name }}"
                                >

                            </div>

                        @endforeach

                    </div>

                @endif


                <input
                    type="file"
                    name="images[]"
                    class="form-control"
                    accept="image/*"
                    multiple
                >

                <small class="text-muted">
                    New images will be added to the gallery.
                </small>

            </div>

        </div>


        <div class="d-grid gap-2">

            <button
                type="submit"
                class="btn btn-primary"
            >
                Update Product
            </button>

            <a
                href="{{ route('admin.products.index') }}"
                class="btn btn-secondary"
            >
                Cancel
            </a>

        </div>

    </div>

</div>

</form>

</div>

@endsection