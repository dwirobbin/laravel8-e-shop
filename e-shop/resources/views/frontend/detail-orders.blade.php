@extends('layouts.frontend.app')

@section('content')
    <div class="shadow-sm bg-warning border-top ">
        <div class="container mt-5 py-3">
            <h6 class="mb-0">
                <a href="{{ url('/') }}" class="text-decoration-none text-dark">
                    Home
                </a> /
                <a href="{{ route('my.orders') }}" class="text-decoration-none text-dark">
                    My Orders
                </a> /
                <span>Detail Order</span>
            </h6>
        </div>
    </div>

    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary pb-0">
                        <h4 class="text-white">Order View
                            <a href="{{ route('my.orders') }}" class="btn btn-warning btn-sm float-end">Back
                            </a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Shipping Details</h4>
                                <hr>
                                <div class="mb-2">
                                    <label for="firstName">First Name</label>
                                    <input type="text" class="form-control" value="{{ $orders->first_name }}" disabled>
                                </div>
                                <div class="mb-2">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" class="form-control" value="{{ Str::title($orders->last_name) }}"
                                        disabled>
                                </div>
                                <div class="mb-2">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" value="{{ $orders->first_name }}" disabled>
                                </div>
                                <div class="mb-2">
                                    <label for="contactNo">Contact no.</label>
                                    <input type="text" class="form-control" value="{{ $orders->phone }}" disabled>
                                </div>
                                <div class="mb-2">
                                    <label for="shippingAddress">Shipping Address</label>
                                    <input type="text" class="form-control"
                                        value="{{ Str::title($orders->address . ', ' . $orders->city . ', ' . $orders->province . ', ' . $orders->country) }}"
                                        disabled>
                                </div>
                                <div class="mb-2">
                                    <label for="zipCode">Zip Code</label>
                                    <input type="text" class="form-control" value="{{ $orders->pin_code }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4>Order Details</h4>
                                <hr>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders->orderItems as $item)
                                            <tr>
                                                <td>{{ $item->products->name }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->price }}</td>
                                                <td>
                                                    <img src="{{ asset('storage/product-images/' . $item->products->image) }}"
                                                        alt="" width="80px" height="50px">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <h5 class="px-2">
                                    Grand Total :
                                    <span class="float-end">
                                        Rp{{ number_format($orders->total_price, 0, '', '.') }}
                                    </span>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
