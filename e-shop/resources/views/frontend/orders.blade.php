@extends('layouts.frontend.app')

@section('content')
    <div class="shadow-sm bg-warning border-top ">
        <div class="container mt-5 py-3">
            <h6 class="mb-0">
                <a href="{{ url('/') }}" class="text-decoration-none text-dark">
                    Home
                </a> /
                <span>My Orders</span>
            </h6>
        </div>
    </div>

    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>My Orders</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>Tracking Number</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr>
                                        <td>{{ $order->tracking_no }}</td>
                                        <td>{{ $order->total_price }}</td>
                                        <td>
                                            {{ $order->status == '0' ? 'pending' : 'completed' }}
                                        </td>
                                        <td>
                                            <a href="{{ route('view.order', $order->id) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i> Show
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center fw-bold">
                                            No Orders
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
