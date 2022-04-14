<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF Token ajax --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ ' | ' . config('app.name') }}</title>

    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Css Owl-Carousel 2 -->
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">

    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/sweetalert2/sweetalert2.min.css') }}">

    {{-- Sweetalert --}}
    <link rel="stylesheet" href="{{ asset('backend/plugins/sweetalert2/sweetalert2.min.css') }}">
</head>

<body class="d-flex flex-column min-vh-100">

    @include('layouts.frontend.partials.header')

    <div class="content">
        @yield('content')
    </div>

    @include('layouts.frontend.partials.footer')

    {{-- J-Query --}}
    <script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>

    <!-- Bootstrap Bundle -->
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Js Owl-Carousel 2 -->
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>

    <!-- Toastr -->
    <script src="{{ asset('backend/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    {{-- Sweetalert --}}
    <script src="{{ asset('backend/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- Custom -->
    <script src="{{ asset('frontend/js/custom.js') }}"></script>

    @stack('scripts')
</body>

</html>
