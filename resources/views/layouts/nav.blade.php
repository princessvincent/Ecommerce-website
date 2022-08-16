<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tiro+Gurmukhi&display=swap" rel="stylesheet">

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.theme.default.min.css') }}" rel="stylesheet">


</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">E-Shop</a>
                {{-- <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a> --}}

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    {{-- <ul class="navbar-nav me-auto"> --}}
                    <form action="{{ url('searchproduct') }}" method="POST">
                        @csrf
                        <div class="search-bar">
                            <div class="input-group">
                                <input type="search" class="form-control" id="search_product" name="productname"
                                    placeholder="Search" aria-describedby="basic-addon1">
                                <button type="submit" class="input-group-text"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                    {{-- </ul> --}}

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">


                        {{-- <a class="navbar-brand" href="{{ url('/') }}">E-Shop</a> --}}
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('category') }}">Category</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('cart') }}">Cart <i
                                            class="fa fa-shopping-cart"></i>
                                        <span class="badge badge-pill bg-primary cart-count">0</span>
                                    </a>

                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('wishlist') }}">Wishlist <i
                                            class="fa fa-heart"></i>
                                        <span class="badge badge-pill bg-success wish-count">0</span>
                                    </a>

                                </li>


                                <!-- Authentication Links -->
                                @guest
                                    @if (Route::has('login'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                        </li>
                                    @endif

                                    @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                        </li>
                                    @endif
                                @else
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                            role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }}
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ url('my_orders') }}">
                                                My Orders
                                            </a>

                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                @endguest
                            </ul>
                        </div>
                </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
        <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        <script>
            $(function() {
                var availableTags = [];

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    method: "GET",
                    url: "/product_list",
                    success: function(response) {
                        // console.log(response);
                        startAutoComplete(response)
                    }

                })

                function startAutoComplete(availableTags) {
                    // $(document).ready(function() {
                        $("#search_product").autocomplete({
                            source: availableTags
                        });

                    // });
                    //   } );
                }


            });
        </script>

        <script src="{{ asset('js/custom.js') }}"></script>
        <script src="{{ asset('js/checkout.js') }}"></script>

        {{-- jquery --}}

 {{-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> --}}
 
        <div class="whatsapp-chat">

            <a href=" https://wa.me/+2348121326225?text=I'm%20not%20able%20to%20make%20order" target="_blank">
                <img src="{{ asset('./img/whatsapp.png') }}" alt="whatsapp icon" height="80px" width="80px">
            </a>
        </div>

        @yield('script')

    </div>
</body>

</html>
