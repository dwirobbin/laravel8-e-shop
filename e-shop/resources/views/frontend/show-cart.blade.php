@extends('layouts.frontend.app')

@section('content')
    <div class="shadow-sm bg-warning border-top ">
        <div class="container mt-5 py-3">
            <h6 class="mb-0">
                <a href="{{ url('/') }}" class="text-decoration-none text-dark">
                    Home
                </a> /
                <span>Cart</span>
            </h6>
        </div>
    </div>

    <div class="container my-4">
        <div class="row">
            <h3 class="text-center">My Products in Cart</h3>
            <div class="card shadow mt-2 product_data">
                <div class="card-body pb-0">
                    @php
                        $total = 0;
                    @endphp
                    @forelse ($cartItems as $cartItem)
                        <div class="row pb-3 product_data">
                            <div class="col-md-2 my-auto">
                                <img src="{{ asset('storage/product-images/' . $cartItem->products->image) }}"
                                    alt="Product Here" height="70px" width="100px">
                            </div>
                            <div class="col-md-3 my-auto">
                                <h5>{{ $cartItem->products->name }}</h5>
                            </div>
                            <div class="col-md-2 my-auto">
                                <h5>
                                    Rp {{ number_format($cartItem->products->selling_price, 0, '', '.') }}
                                </h5>
                            </div>
                            <div class="col-md-3 my-auto">
                                <input type="hidden" class="product_id" value="{{ $cartItem->products->id }}">

                                @if ($cartItem->products->quantity >= $cartItem->product_qty)
                                    <div class="input-group input-group-sm text-center mt-1" style="width: 120px;">
                                        <button class="input-group-text changeQuantity decrement-btn">
                                            -
                                        </button>
                                        <input type="text" name="quantity" value="{{ $cartItem->product_qty }}"
                                            class="form-control qty-input text-center">
                                        <button class="input-group-text changeQuantity increment-btn">
                                            +
                                        </button>
                                    </div>
                                    @php
                                        $total += $cartItem->products->selling_price * $cartItem->product_qty;
                                    @endphp
                                @else
                                    <h6>Out of Stock</h6>
                                @endif
                            </div>
                            <div class="col-md-2 my-auto">
                                <button class="btn btn-danger btn-sm delete-cart-item">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="row pb-3 text-center">
                            <span class="fw-bolder">Shopping cart is empty</span>
                        </div>
                    @endforelse
                </div>
                @if (!empty($cartItem))
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <h6>
                            Total Price = Rp.{{ number_format($total, 0, '', '.') }}
                        </h6>
                        <a href="{{ route('checkout') }}" class="btn btn-success">
                            Process to Checkout
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
