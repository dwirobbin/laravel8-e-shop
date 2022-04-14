@extends('layouts.frontend.app')

@section('content')
    <div class="shadow-sm bg-warning border-top ">
        <div class="container mt-5 py-3">
            <h6 class="mb-0">
                <a href="{{ url('/') }}" class="text-decoration-none text-dark">Collection</a> /
                <a href="{{ route('view-product-by-category', $product->category->name) }}"
                    class="text-decoration-none text-dark">
                    {{ $product->category->name }}</a> /
                {{ $product->name }}
            </h6>
        </div>
    </div>

    <div class="container my-4">
        <div class="row">
            <h2 class="text-center">Product Detail : {{ $product->name }}</h2>
            <div class="card shadow mt-2 product_data">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 border-right">
                            <img src="{{ asset('storage/product-images/' . $product->image) }}" class="w-100"
                                alt="">
                        </div>
                        <div class="col-md-8">
                            <h2 class="mb-0">
                                {{ $product->name }}
                                @if ($product->seen_in_trending_products == 1)
                                    <label style="font-size: 16px;" class="float-end badge bg-danger treding_tag">Trending
                                    </label>
                                @endif
                            </h2>

                            <hr>
                            <label class="me-3">
                                Original Price :
                                <s>
                                    Rp{{ number_format($product->original_price, 0, '', '.') }}
                                </s>
                            </label>
                            <label class="fw-bold">
                                Selling Price : Rp
                                {{ number_format($product->selling_price, 0, '', '.') }}
                            </label>
                            <p class="mt-3">{!! $product->description !!}</p>
                            <hr>
                            @if ($product->quantity > 0)
                                <label class="badge bg-success">In stock</label>
                            @else
                                <label class="badge bg-danger">Out of stock</label>
                            @endif
                            <div class="row mt-2">
                                <div class="col-md-3">
                                    <input type="hidden" value="{{ $product->id }}" class="product_id">
                                    <label for="Quantity">Quantity</label>
                                    <div class="input-group text-center mt-1" style="width: 130px;">
                                        <button class="input-group-text decrement-btn">
                                            -
                                        </button>
                                        <input type="text" name="quantity" value="0"
                                            class="form-control qty-input text-center">
                                        <button class="input-group-text increment-btn">
                                            +
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-9 mt-1">
                                    <br>

                                    @if ($product->quantity > 0)
                                        <button type="button" class="btn btn-primary me-3 float-start addToCartBtn">
                                            Add to Cart <i class="fas fa-cart-plus"></i>
                                        </button>
                                    @endif
                                    <button type="button" class="btn btn-success me-3 addToWishlist float-start">
                                        Add to Wishlist <i class="fas fa-heart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
