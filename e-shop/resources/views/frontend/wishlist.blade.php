@extends('layouts.frontend.app')

@section('content')
    <div class="shadow-sm bg-warning border-top ">
        <div class="container mt-5 py-3">
            <h6 class="mb-0">
                <a href="{{ url('/') }}" class="text-decoration-none text-dark">
                    Home
                </a> /
                <span>Wishlist</span>
            </h6>
        </div>
    </div>

    <div class="container my-4">
        <div class="row">
            <h3 class="text-center">My Products in Wishlist</h3>
            <div class="card shadow mt-2">
                <div class="card-body pb-0">
                    @forelse ($wishlists as $wishlist)
                        <div class="row pb-3 product_data">
                            <div class="col-md-2 my-auto">
                                <img src="{{ asset('storage/product-images/' . $wishlist->products->image) }}"
                                    alt="Product Here" height="70px" width="100px">
                            </div>
                            <div class="col-md-2 my-auto">
                                <h6>{{ $wishlist->products->name }}</h6>
                            </div>
                            <div class="col-md-2 my-auto">
                                <h6>
                                    Rp {{ number_format($wishlist->products->selling_price, 0, '', '.') }}
                                </h6>
                            </div>
                            <div class="col-md-3 my-auto">
                                <input type="hidden" class="product_id" value="{{ $wishlist->products->id }}">

                                @if ($wishlist->products->quantity >= $wishlist->product_qty)
                                    <div class="input-group input-group-sm text-center mt-1" style="width: 130px;">
                                        <button class="input-group-text decrement-btn">
                                            -
                                        </button>
                                        <input type="text" name="quantity" value="0"
                                            class="form-control qty-input text-center">
                                        <button class="input-group-text increment-btn">
                                            +
                                        </button>
                                    </div>
                                @else
                                    <h6>Out of Stock</h6>
                                @endif
                            </div>
                            <div class="col-md-3 my-auto">
                                <div class="btn-group">
                                    <button class="btn btn-success btn-sm addToCartBtn">
                                        <i class="fas fa-shopping-cart"></i> Add to Cart
                                    </button>
                                    <button class="btn btn-danger btn-sm remove-wishlist-item">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="row pb-3 text-center">
                            <span class="fw-bolder">
                                There are no products in your Wishlist
                            </span>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
