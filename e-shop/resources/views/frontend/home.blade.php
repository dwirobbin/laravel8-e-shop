@extends('layouts.frontend.app')

@section('content')

    {{-- Slider --}}
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item">
                <img src="{{ asset('frontend\img\2_baru.jpg') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item active">
                <img src="{{ asset('frontend\img\slide_03.jpg') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('frontend\img\4_baru.jpg') }}" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    {{-- End Slider --}}

    <div class="container mt-5">
        <h2>Trending Products</h2>
        <div class="row">
            <div class="owl-carousel featured-carousel owl theme">
                @foreach ($trendingProducts as $trendingProduct)
                    <div class="item">
                        <div class="card mt-2">
                            @if ($trendingProduct->image)
                                <img class="img-fluid"
                                    src="{{ asset('storage/product-images/' . $trendingProduct->image) }}" alt=""
                                    style="object-fit: scale-down;" />
                            @else
                                <img class=" img-fluid" src="https://dummyimage.com/700x435/dee2e6/6c757d.jpg" alt="" />
                            @endif
                            <div class="card-body">
                                <div class="text-muted fst-italic">
                                    Posted on {{ date('d M Y', strtotime($trendingProduct->created_at)) }}
                                    </a>
                                </div>
                                <a class="badge bg-secondary text-decoration-none link-light my-2" href="#">
                                    {{ $trendingProduct->category->name }}
                                </a>
                                <h2 class="card-title h4">{{ $trendingProduct->name }}</h2>

                                <div class="d-flex justify-content-between">
                                    <span>
                                        Rp{{ number_format($trendingProduct->selling_price, 0, '', '.') }}
                                    </span>
                                    <span>
                                        <s>Rp{{ number_format($trendingProduct->original_price, 0, '', '.') }}
                                        </s>
                                    </span>
                                </div>
                                <a class="btn btn-primary mt-2"
                                    href="{{ url('view-product/category/' . $trendingProduct->category->slug . '/' . $trendingProduct->slug . '/detail') }}">
                                    Detail →
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

    <div class="container my-5">
        <h2>Popular Categories</h2>
        <div class="row">
            <div class="owl-carousel featured-carousel owl theme">
                @foreach ($popularCategories as $popularCategory)
                    <div class="item">
                        <div class="card mt-2">
                            @if ($popularCategory->image)
                                <img class="img-fluid"
                                    src="{{ asset('storage/category-images/' . $popularCategory->image) }}" alt=""
                                    style="object-fit: scale-down;" />
                            @else
                                <img class=" img-fluid" src="https://dummyimage.com/700x435/dee2e6/6c757d.jpg" alt="" />
                            @endif
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title">
                                        {{ $popularCategory->name }}
                                    </h4>
                                    <span>
                                        {{-- {{ $total }} items --}}
                                    </span>
                                </div>
                                <a class="btn btn-primary mt-2"
                                    href="{{ route('view-product-by-category', $popularCategory->slug) }}">
                                    <i class="fas fa-eye"></i> Show
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('.featured-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            dots: true,
            autoplay: true,
            autoplayTimeout: 5200,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 3
                }
            }
        })
    </script>
@endpush
