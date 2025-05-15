<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> --}}
    <title>@yield('title','dimond e-commerce')</title>

    @include('frontend.includes.header')
    <style>
        body {
            display: flex;
            flex-direction: column;
        }
    </style>
    @stack('styles')


</head>
<body>

    <!-- Navbar -->
    @include('frontend.includes.navbar')


    {{-- Main Content  --}}
    @yield('main-content')
    {{-- <main class="container my-4">
        @yield('main-content')
    </main> --}}

    {{-- Footer  --}}
    @include('frontend.includes.footer')


    {{-- BootStrap JS  --}}
    <script src="{{asset('dashboard/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" ></script>
    @stack('home-wishlist-scripts')
</body>
</html>
