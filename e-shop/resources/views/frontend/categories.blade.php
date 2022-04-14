@extends('layouts.frontend.app')

@section('content')
    <div class="shadow-sm bg-warning border-top ">
        <div class="container mt-5 py-3">
            <h6 class="mb-0">
                <a href="{{ url('/') }}" class="text-decoration-none text-dark">
                    Home
                </a> /
                <span>Categories</span>
            </h6>
        </div>
    </div>
    <div class="container py-4">
        <div class="row">
            <h2 class="text-center">All Categories</h2>
            @forelse ($categories as $category)
                <div class="col-md-4 my-4">
                    <a href="{{ route('view-product-by-category', $category->slug) }}" class="text-decoration-none">
                        <div class="card bg-dark text-white">
                            <img src="{{ asset('storage/category-images/' . $category->image) }}" class="card-img"
                                alt="{{ $category->name }}" height="320px">
                            <div class="card-img-overlay d-flex align-items-center p-0">
                                <h5 class="card-title flex-fill p-4 text-center fs-3"
                                    style="background-color: rgba(0, 0, 0, .7)">{{ $category->name }}
                                </h5>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="alert alert-warning" role="alert">
                    Category not yet available
                </div>
            @endforelse
        </div>
    </div>
@endsection
