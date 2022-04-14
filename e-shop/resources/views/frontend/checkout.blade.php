@extends('layouts.frontend.app')

@section('content')
    <div class="shadow-sm bg-warning border-top ">
        <div class="container mt-5 py-3">
            <h6 class="mb-0">
                <a href="{{ url('/') }}" class="text-decoration-none text-dark">
                    Home
                </a> /
                <a href="{{ route('view.cart') }}" class="text-decoration-none text-dark">
                    Cart
                </a> /
                <span>Checkout</span>
            </h6>
        </div>
    </div>

    <div class="container py-4">
        <form action="{{ route('place.order') }}" method="POST">
            {{ csrf_field() }}
            <div class="row">
                <h2 class="mb-3 text-center">Checkout</h2>
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <h5>Basic Details</h5>
                            <hr>
                            <div class="row checkout-form">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="firstName" class="fw-bold">First Name</label>
                                        <input type="text" name="first_name"
                                            class="form-control @error('first_name')
                                            is-invalid
                                        @enderror"
                                            placeholder="Enter first name"
                                            value="{{ old('first_name', Auth::user()->name) }}">
                                        @error('first_name')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="lastName" class="fw-bold">Last Name</label>
                                        <input type="text" name="last_name"
                                            class="form-control @error('last_name')
                                        is-invalid
                                    @enderror"
                                            placeholder="Enter last name"
                                            value="{{ old('last_name', Auth::user()->last_name) }}">
                                        @error('last_name')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="fw-bold">Email</label>
                                        <input type="email" name="email"
                                            class="form-control @error('email')
                                        is-invalid
                                    @enderror"
                                            placeholder="Enter email" value="{{ old('email', Auth::user()->email) }}">
                                        @error('email')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phoneNumber" class="fw-bold">Phone Number</label>
                                        <input type="number" name="phone"
                                            class="form-control @error('phone')
                                        is-invalid
                                    @enderror"
                                            placeholder="Enter phone number"
                                            value="{{ old('phone', Auth::user()->phone) }}">
                                        @error('phone')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tableNo" class="fw-bold">Table No</label>
                                        <input type="number" name="table_no"
                                            class="form-control @error('table_no')
                                        is-invalid
                                    @enderror"
                                            placeholder="Enter phone number"
                                            value="{{ old('table_no', Auth::user()->table_no) }}">
                                        @error('table_no')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="address" class="fw-bold">Address</label>
                                        <input type="text" name="address"
                                            class="form-control @error('address')
                                        is-invalid
                                    @enderror"
                                            placeholder="Enter address"
                                            value="{{ old('address', Auth::user()->address) }}">
                                        @error('address')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="city" class="fw-bold">City</label>
                                        <input type="text" name="city"
                                            class="form-control @error('city')
                                        is-invalid
                                    @enderror"
                                            placeholder="Enter city" value="{{ old('city', Auth::user()->city) }}">
                                        @error('city')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="province" class="fw-bold">Province</label>
                                        <input type="text" name="province"
                                            class="form-control @error('province')
                                        is-invalid
                                    @enderror"
                                            placeholder="Enter province"
                                            value="{{ old('province', Auth::user()->province) }}">
                                        @error('province')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="country" class="fw-bold">Country</label>
                                        <input type="text" name="country"
                                            class="form-control @error('country')
                                        is-invalid
                                    @enderror"
                                            placeholder="Enter country"
                                            value="{{ old('country', Auth::user()->country) }}">
                                        @error('country')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="pinCode" class="fw-bold">Pin Code</label>
                                        <input type="text" name="pin_code"
                                            class="form-control @error('pin_code')
                                        is-invalid
                                    @enderror"
                                            placeholder="Enter Pin Code"
                                            value="{{ old('pin_code', Auth::user()->pin_code) }}">
                                        @error('pin_code')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <h5>Order Details</h5>
                            <hr>
                            <table class="table table-striped table-borderless table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @forelse ($cartItems as $cartItem)
                                        <tr>
                                            <td>{{ $cartItem->products->name }}</td>
                                            <td>{{ $cartItem->product_qty }}</td>
                                            <td>Rp{{ number_format($cartItem->products->selling_price, 0, '', '.') }}
                                            </td>
                                        </tr>
                                        @php
                                            $total += $cartItem->products->selling_price * $cartItem->product_qty;
                                        @endphp
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="3">
                                                No products in cart
                                            </td>
                                        </tr>
                                    @endforelse
                                    <tr>
                                        <td colspan="2" class="fw-bold">Total : </td>
                                        <td colspan="1" class="fw-bold">Rp{{ number_format($total, 0, '', '.') }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            <button type="submit" class="btn btn-primary w-100">
                                Place Order | COD
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
