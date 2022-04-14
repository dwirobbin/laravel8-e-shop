@extends('layouts.backend.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>All products</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.index') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Products</li>
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
                            <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> New Product
                            </a>
                            <div class="card-tools">
                                <form action="{{ route('products.index') }}" method="GET">
                                    @csrf
                                    <div class="input-group" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control form-control float-right"
                                            placeholder="Search...">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-head-fixed text-nowrap text-center">
                                <thead>
                                    <tr>
                                        <th width="1%">No.</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Ori Price</th>
                                        <th>Selling Price</th>
                                        <th>Qty</th>
                                        <th>Tax</th>
                                        <th>Status</th>
                                        <th>Trending</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($products as $product)
                                        <tr>
                                            <th scope="row" class="align-middle">
                                                {{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}
                                            </th>
                                            <td class="align-middle">
                                                <img src="{{ asset('storage/product-images/' . $product->image) }}"
                                                    class="img-fluid" width="100px">
                                            </td>
                                            <td class="align-middle">
                                                {{ $product->name }}
                                            </td>
                                            <td class="align-middle">
                                                {{ $product->category->name }}
                                            </td>
                                            <td class="align-middle">
                                                Rp {{ number_format($product->original_price, 0, '', '.') }}
                                            </td>
                                            <td class="align-middle">
                                                Rp {{ number_format($product->selling_price, 0, '', '.') }}
                                            </td>
                                            <td class="align-middle">
                                                {{ $product->quantity }}
                                            </td>
                                            <td class="align-middle">
                                                {{ $product->tax }}%
                                            </td>
                                            <td class="align-middle">
                                                {{ $product->seen_in_all_product === 1 ? 'true' : 'false' }}
                                            </td>
                                            <td class="align-middle">
                                                {{ $product->seen_in_trending_products === 1 ? 'true' : 'false' }}
                                            </td>
                                            <td class="align-middle">
                                                <div class="btn-group">
                                                    <a href="{{ route('products.edit', $product->slug) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('products.destroy', $product->slug) }}"
                                                        role="alert-delete" method="POST" alert-text={{ $product->slug }}
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td scope="row" colspan="11" class="text-center">
                                                Products data not yet available
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if ($products->hasPages())
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    {{ $products->links() }}
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
            // Event : delete products
            $("form[role='alert-delete']").submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: "Warning !",
                    text: "Are you sure want to delete products " + $(this).attr('alert-text') +
                        " ?",
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
