@extends('admin.layouts.app')

@section('title', 'Edit Category')

@section('page_title', 'Edit Category')

@section('content')

<div class="container-fluid">

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <form
                action="{{ route('admin.categories.update', $category) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Category Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $category->name) }}"
                            class="form-control @error('name') is-invalid @enderror"
                        >

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Parent Category
                        </label>

                        <select
                            name="parent_id"
                            class="form-select"
                        >

                            <option value="">
                                -- Main Category --
                            </option>

                            @foreach($categories as $parent)

                                <option
                                    value="{{ $parent->id }}"
                                    @selected(
                                        old(
                                            'parent_id',
                                            $category->parent_id
                                        ) == $parent->id
                                    )
                                >
                                    {{ $parent->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="col-md-12 mb-3">

                        <label class="form-label">
                            Description
                        </label>

                        <textarea
                            name="description"
                            rows="4"
                            class="form-control"
                        >{{ old('description', $category->description) }}</textarea>

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Change Image
                        </label>

                        <input
                            type="file"
                            name="image"
                            class="form-control"
                            accept="image/*"
                        >

                        @if($category->image)

                            <img
                                src="{{ asset('storage/' . $category->image) }}"
                                width="100"
                                height="100"
                                class="rounded mt-2"
                                style="object-fit: cover;"
                                alt="{{ $category->name }}"
                            >

                        @endif

                    </div>


                    <div class="col-md-3 mb-3">

                        <label class="form-label">
                            Sort Order
                        </label>

                        <input
                            type="number"
                            name="sort_order"
                            value="{{ old('sort_order', $category->sort_order) }}"
                            min="0"
                            class="form-control"
                        >

                    </div>


                    <div class="col-md-3 mb-3">

                        <label class="form-label">
                            Status
                        </label>

                        <select
                            name="status"
                            class="form-select"
                        >

                            <option
                                value="1"
                                @selected(old('status', $category->status) == 1)
                            >
                                Active
                            </option>

                            <option
                                value="0"
                                @selected(old('status', $category->status) == 0)
                            >
                                Inactive
                            </option>

                        </select>

                    </div>

                </div>


                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Update Category
                </button>

                <a
                    href="{{ route('admin.categories.index') }}"
                    class="btn btn-secondary"
                >
                    Cancel
                </a>

            </form>

        </div>

    </div>

</div>

@endsection