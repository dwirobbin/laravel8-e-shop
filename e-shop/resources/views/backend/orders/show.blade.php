@extends('layouts.backend.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Order Detail</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.index') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('orders.index') }}">Orders</a>
                        </li>
                        <li class="breadcrumb-item active">Detail Order</li>
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
                        <div class="card-header bg-primary pb-1">
                            <h4 class="text-white">Order View
                                <a href="{{ route('orders.index') }}" class="btn btn-warning btn-sm float-right">Back
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
                                        <input type="text" class="form-control" value="{{ $orders->first_name }}"
                                            disabled>
                                    </div>
                                    <div class="mb-2">
                                        <label for="lastName">Last Name</label>
                                        <input type="text" class="form-control" value="{{ $orders->last_name }}"
                                            disabled>
                                    </div>
                                    <div class="mb-2">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" value="{{ $orders->first_name }}"
                                            disabled>
                                    </div>
                                    <div class="mb-2">
                                        <label for="contactNo">Contact no.</label>
                                        <input type="text" class="form-control" value="{{ $orders->phone }}" disabled>
                                    </div>
                                    <div class="mb-2">
                                        <label for="shippingAddress">Shipping Address</label>
                                        <textarea class="form-control"
                                            disabled>{{ $orders->address }},{{ $orders->city }},{{ $orders->province }},{{ $orders->country }}</textarea>
                                    </div>
                                    <div class="mb-2">
                                        <label for="zipCode">Zip Code</label>
                                        <input type="text" class="form-control" value="{{ $orders->pin_code }}"
                                            disabled>
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
                                    <h5 class="font-weight-bold">
                                        Grand Total :
                                        <span class="float-right">
                                            Rp{{ number_format($orders->total_price, 0, '', '.') }}
                                        </span>
                                    </h5>

                                    <form action="{{ route('orders.update', $orders->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group mt-3">
                                            <label for="orderStatus">Order Status</label>
                                            <select name="order_status" class="form-control">
                                                <option {{ $orders->status == '0' ? 'selected' : '' }} value="0">Pending
                                                </option>
                                                <option {{ $orders->status == '1' ? 'selected' : '' }} value="1">
                                                    Completed
                                                </option>
                                            </select>
                                            <button type="submit" class="btn btn-success mt-2 w-100">Update</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
