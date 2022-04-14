@extends('layouts.frontend.app')

@section('content')
    <div class="shadow-sm bg-warning border-top ">
        <div class="container mt-5 py-3">
            <h6 class="mb-0">
                Collection / {{ $category->name }}
            </h6>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <h2 class="my-3 text-center">Products Category : {{ $category->name }}</h2>
            @foreach ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if ($product->image)
                            <img class="img-fluid" src="{{ asset('storage/product-images/' . $product->image) }}"
                                alt="" style="object-fit: scale-down;" />
                        @else
                            <img class=" img-fluid" src="https://dummyimage.com/700x435/dee2e6/6c757d.jpg" alt="" />
                        @endif
                        <div class="card-body">
                            <div class="text-muted fst-italic">
                                Posted on {{ date('d M Y', strtotime($product->created_at)) }}
                                </a>
                            </div>
                            <a class="badge bg-secondary text-decoration-none link-light my-2" href="#">
                                {{ $product->category->name }}
                            </a>
                            <h4 class="card-title">{{ $product->name }}</h4>

                            <div class="d-flex justify-content-between">
                                <span>
                                    Rp{{ number_format($product->selling_price, 0, '', '.') }}
                                </span>
                                <span>
                                    <s>Rp{{ number_format($product->original_price, 0, '', '.') }}
                                    </s>
                                </span>
                            </div>
                            <a class="btn btn-primary mt-2"
                                href="{{ url('view-product/category/' . $category->slug . '/' . $product->slug . '/detail') }}">
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
