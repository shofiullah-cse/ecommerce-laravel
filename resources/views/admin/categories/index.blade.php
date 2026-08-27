@extends('admin.layouts.app')

@section('title', 'Categories')

@section('page_title', 'Categories')

@section('content')

<div class="container-fluid">

    {{-- Alert --}}
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


    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h4 class="mb-0">
            Categories
        </h4>

        <a
            href="{{ route('admin.categories.create') }}"
            class="btn btn-primary"
        >
            + Add Category
        </a>

    </div>


    {{-- Table --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover mb-0">

                    <thead class="table-light">

                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Parent</th>
                            <th>Sort Order</th>
                            <th>Status</th>
                            <th width="180">Action</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($categories as $category)

                            <tr>

                                <td>
                                    {{ $categories->firstItem() + $loop->index }}
                                </td>

                                <td>

                                    @if($category->image)

                                        <img
                                            src="{{ asset('storage/' . $category->image) }}"
                                            width="50"
                                            height="50"
                                            class="rounded"
                                            style="object-fit: cover;"
                                            alt="{{ $category->name }}"
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
                                        {{ $category->name }}
                                    </strong>

                                    <small class="d-block text-muted">
                                        {{ $category->slug }}
                                    </small>
                                </td>

                                <td>
                                    {{ $category->parent?->name ?? '—' }}
                                </td>

                                <td>
                                    {{ $category->sort_order }}
                                </td>

                                <td>

                                    @if($category->status)

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
                                        href="{{ route('admin.categories.edit', $category) }}"
                                        class="btn btn-sm btn-warning"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('admin.categories.destroy', $category) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this category?')"
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
                                    colspan="7"
                                    class="text-center py-5"
                                >
                                    No categories found.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- Pagination --}}
    <div class="mt-4">

        {{ $categories->links() }}

    </div>

</div>

@endsection