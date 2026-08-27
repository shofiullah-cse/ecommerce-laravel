@extends('admin.layouts.app')

@section('title', 'Edit Brand')

@section('page_title', 'Edit Brand')

@section('content')

<div class="container-fluid">

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <form
                action="{{ route('admin.brands.update', $brand) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                @method('PUT')

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Brand Name
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $brand->name) }}"
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
                            Change Logo
                        </label>

                        <input
                            type="file"
                            name="logo"
                            class="form-control @error('logo') is-invalid @enderror"
                            accept="image/*"
                        >

                        @error('logo')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror


                        @if($brand->logo)

                            <div class="mt-2">

                                <img
                                    src="{{ asset('storage/' . $brand->logo) }}"
                                    alt="{{ $brand->name }}"
                                    width="100"
                                    height="100"
                                    class="border rounded"
                                    style="object-fit: contain;"
                                >

                            </div>

                        @endif

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Status
                        </label>

                        <select
                            name="status"
                            class="form-select"
                        >

                            <option
                                value="1"
                                @selected(old('status', $brand->status) == 1)
                            >
                                Active
                            </option>

                            <option
                                value="0"
                                @selected(old('status', $brand->status) == 0)
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
                    Update Brand
                </button>

                <a
                    href="{{ route('admin.brands.index') }}"
                    class="btn btn-secondary"
                >
                    Cancel
                </a>

            </form>

        </div>

    </div>

</div>

@endsection