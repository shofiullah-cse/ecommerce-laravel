@extends('admin.layouts.app')

@section('title', 'Brands')

@section('page_title', 'Brands')

@section('content')

<div class="container-fluid">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


    <div class="d-flex justify-content-between align-items-center mb-4">

        <h4 class="mb-0">
            Brands
        </h4>

        <a
            href="{{ route('admin.brands.create') }}"
            class="btn btn-primary"
        >
            + Add Brand
        </a>

    </div>


    <div class="card border-0 shadow-sm">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover mb-0">

                    <thead class="table-light">

                        <tr>
                            <th>#</th>
                            <th>Logo</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th width="180">Action</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($brands as $brand)

                            <tr>

                                <td>
                                    {{ $brands->firstItem() + $loop->index }}
                                </td>

                                <td>

                                    @if($brand->logo)

                                        <img
                                            src="{{ asset('storage/' . $brand->logo) }}"
                                            alt="{{ $brand->name }}"
                                            width="50"
                                            height="50"
                                            class="rounded"
                                            style="object-fit: contain;"
                                        >

                                    @else

                                        <div
                                            class="bg-light rounded d-flex align-items-center justify-content-center"
                                            style="width:50px;height:50px;"
                                        >
                                            —
                                        </div>

                                    @endif

                                </td>

                                <td>
                                    <strong>
                                        {{ $brand->name }}
                                    </strong>
                                </td>

                                <td>
                                    <span class="text-muted">
                                        {{ $brand->slug }}
                                    </span>
                                </td>

                                <td>

                                    @if($brand->status)

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
                                        href="{{ route('admin.brands.edit', $brand) }}"
                                        class="btn btn-sm btn-warning"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('admin.brands.destroy', $brand) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this brand?')"
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
                                    colspan="6"
                                    class="text-center py-5"
                                >
                                    No brands found.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    <div class="mt-4">

        {{ $brands->links() }}

    </div>

</div>

@endsection