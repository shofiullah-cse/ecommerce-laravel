@extends('admin.layouts.app')

@section('title', 'Add Product')

@section('page_title', 'Add Product')

@section('content')

<div class="container-fluid">

<form
    action="{{ route('admin.products.store') }}"
    method="POST"
    enctype="multipart/form-data"
>

@csrf

<div class="row">

    {{-- Main Content --}}
    <div class="col-lg-8">

        <div class="card border-0 shadow-sm mb-4">

            <div class="card-body">

                <h5 class="mb-4">
                    Product Information
                </h5>

                {{-- Name --}}
                <div class="mb-3">

                    <label class="form-label">
                        Product Name
                        <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        class="form-control @error('name') is-invalid @enderror"
                        placeholder="Enter product name"
                    >

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="row">

                    {{-- SKU --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            SKU
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="sku"
                            value="{{ old('sku') }}"
                            class="form-control @error('sku') is-invalid @enderror"
                            placeholder="SKU-001"
                        >

                        @error('sku')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Category --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Category
                            <span class="text-danger">*</span>
                        </label>

                        <select
                            name="category_id"
                            class="form-select @error('category_id') is-invalid @enderror"
                        >

                            <option value="">
                                Select Category
                            </option>

                            @foreach($categories as $category)

                                <option
                                    value="{{ $category->id }}"
                                    @selected(old('category_id') == $category->id)
                                >
                                    {{ $category->name }}
                                </option>

                            @endforeach

                        </select>

                        @error('category_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>


                {{-- Brand --}}
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
                                @selected(old('brand_id') == $brand->id)
                            >
                                {{ $brand->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Short Description --}}
                <div class="mb-3">

                    <label class="form-label">
                        Short Description
                    </label>

                    <textarea
                        name="short_description"
                        rows="3"
                        class="form-control"
                    >{{ old('short_description') }}</textarea>

                </div>


                {{-- Description --}}
                <div class="mb-3">

                    <label class="form-label">
                        Description
                    </label>

                    <textarea
                        name="description"
                        rows="7"
                        class="form-control"
                    >{{ old('description') }}</textarea>

                </div>

            </div>

        </div>


        {{-- Pricing --}}
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
                            value="{{ old('price') }}"
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
                            value="{{ old('sale_price') }}"
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
                            value="{{ old('stock', 0) }}"
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
                            value="{{ old('weight') }}"
                            class="form-control"
                            placeholder="kg"
                        >

                    </div>

                </div>

            </div>

        </div>


        {{-- SEO --}}
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
                        value="{{ old('meta_title') }}"
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
                    >{{ old('meta_description') }}</textarea>

                </div>

            </div>

        </div>

    </div>


    {{-- Sidebar --}}
    <div class="col-lg-4">

        {{-- Status --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-body">

                <h5 class="mb-3">
                    Status
                </h5>

                <select
                    name="status"
                    class="form-select mb-3"
                >

                    <option value="1">
                        Active
                    </option>

                    <option value="0">
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
                        @checked(old('featured'))
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

                <input
                    type="file"
                    name="thumbnail"
                    class="form-control"
                    accept="image/*"
                >

                @error('thumbnail')

                    <div class="text-danger small mt-2">
                        {{ $message }}
                    </div>

                @enderror

            </div>

        </div>


        {{-- Gallery --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-body">

                <h5 class="mb-3">
                    Product Gallery
                </h5>

                <input
                    type="file"
                    name="images[]"
                    class="form-control"
                    accept="image/*"
                    multiple
                >

                <small class="text-muted">
                    You can select multiple images.
                </small>

            </div>

        </div>


        <div class="d-grid gap-2">

            <button
                type="submit"
                class="btn btn-primary"
            >
                Save Product
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