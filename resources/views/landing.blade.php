@extends('layouts.nav')
@section('content')
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('img/beach-7302072_1920.jpg') }}" class="d-block w-100" style="height: 600px;"
                    alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/sunrise-1014712_1920.jpg') }}" class="d-block w-100" style="height: 600px;"
                    alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/sea-164989_1280.jpg') }}" class="d-block w-100" style="height: 600px;"
                    alt="...">
            </div>
        </div>
    </div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@if(session('status'))
   <script> 
   swal("{{ session('status') }}");
   
   </script> 
@endif
    <div class="py-5">
        <div class="container">
            <div class="row">
                <strong>
                    <h2 class="mb-3">Trending Products</h2>
                </strong>
                <div class="owl-carousel owl-theme">
                    @foreach ($trend as $trends)
                        <div class="item">
                            <div class="card">
                                <img src="{{ asset('img/product/' . $trends->image) }}" alt="Product Image"
                                    style="height: 500px;">
                                <div class="card-body">
                                    <h5>{{ $trends->name }}</h5>
                                    <span class="float-start">{{ $trends->selling_price }}</span>
                                     <span class="float-end"> <s>{{ $trends->original_price }} </s></span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>



    <div class="py-5">
        <div class="container">
            <div class="row">
                <strong>
                    <h2 class="mb-3">Trending Categories</h2>
                </strong>
                <div class="owl-carousel owl-theme">
                    @foreach ($catrend as $catrends)
                     <a href="{{ url('view-category/'.$catrends->slug) }}" class="text-decoration-">
                        <div class="item">
                            <div class="card">
                                <img src="{{ asset('img/category/' . $catrends->image) }}" alt="Product Image"
                                    style="height: 500px;">
                                <div class="card-body">
                                    <h5>{{ $catrends->name }}</h5>
                                    <p class="float-start">{{ $catrends->description }}</p>
                                     {{-- <span class="float-end"> <s>{{ $trends->original_price }} </s></span> --}}
                                </div>
                            </div>
                        </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            dots: false,
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
@endsection
