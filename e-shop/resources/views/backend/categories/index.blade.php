@extends('layouts.backend.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>All Categories</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.index') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Categories</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if (session()->has('failed'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session()->get('failed') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="card">

                        <div class="card-header">
                            <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> New Category
                            </a>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-head-fixed text-nowrap text-center">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Seen in All Category</th>
                                        <th>Seen in Popular Categories</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($categories as $category)
                                        <tr>
                                            <th scope="row" class="align-middle">
                                                {{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}
                                            </th>
                                            <td class="align-middle">
                                                <img src="{{ asset('storage/category-images/' . $category->image) }}"
                                                    class="img-fluid" width="100px">
                                            </td>
                                            <td class="align-middle">{{ $category->name }}</td>
                                            <td class="align-middle">
                                                {{ $category->seen_in_all_category === 1 ? 'true' : 'false' }}
                                            </td>
                                            <td class="align-middle">
                                                {{ $category->seen_in_popular_categories === 1 ? 'true' : 'false' }}
                                            </td>
                                            <td class="align-middle">
                                                <div class="btn-group">
                                                    <a href="{{ route('categories.edit', $category->slug) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <form action="{{ route('categories.destroy', $category->slug) }}"
                                                        role="alert-delete" method="POST"
                                                        alert-text={{ $category->slug }} class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash-alt"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td scope="row" colspan="6" class="text-center">
                                                Category data not yet available
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if ($categories->hasPages())
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    {{ $categories->links() }}
                                </ul>
                            </div>
                        @endif
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Event : delete category
            $("form[role='alert-delete']").submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: "Warning !",
                    text: "Are you sure want to delete category " +
                        $(this).attr('alert-text') + "?",
                    icon: 'warning',
                    allowOutsideClick: false,
                    showCancelButton: true,
                    cancelButtonText: "Cancel",
                    confirmButtonText: "Yes, delete it",
                    cancelButtonColor: "#d33",
                    confirmButtonColor: "#3085d6",
                    reverseButtons: true,
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.target.submit();
                    }
                });
            });
        });
    </script>
@endpush
