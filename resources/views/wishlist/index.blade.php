@extends('layouts.nav')
@section('content')
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">

            <h4>
                <a href="{{ url('/') }}" class="text-black text-decoration-none">
                    Home
                </a>/

                <a href="{{ url('wishlist') }}" class="text-black text-decoration-none">
                    Wishlist
                </a>/
            </h4>
        </div>
    </div>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (session('status'))
        <script>
            swal("{{ session('status') }}");
        </script>
    @endif
    <div class="container my-5">
        <div class="card shadow">
            <div class="card-body">
                @if ($wishlist->count() > 0)
                    @foreach ($wishlist as $wishs)
                        <div class="row product_data">
                            <div class="col-md-2 my-auto">
                                <img src="{{ asset('img/product/' . $wishs->product->image) }}" alt="image here"
                                    height="170px" class="w-100">
                            </div>
                            <div class="col-md-3 my-auto">
                                <h3>{{ $wishs->product->name }}</h3>
                            </div>

                            <div class="col-md-2 my-auto">
                                <h4> Rs {{ $wishs->product->selling_price }}</h4>
                            </div>

                            <div class="col-md-2 my-auto">
                                <input type="hidden" class="prod_id" value="{{ $wishs->prod_id }}">
                                @if ($wishs->product->qty > $wishs->prod_qty)
                                    <label for="Quantity">Quantity</label>
                                    <div class="input-group text-center mb-3">
                                        <span class="input-group-text  decrement-btn">-</span>
                                        <input type="text" name="quantity" value="1" class="form-control qty-input">
                                        <span class="input-group-text  increment-btn">+</span>
                                    </div>
                                @else
                                    <button class="btn btn-danger">Out of Stock</button>
                                @endif

                            </div>
                            <div class="col-md-2 my-auto">
                                <button class="btn btn-primary addtocart">Add To Cart</button>
                                <button class="btn btn-danger delete-wish">Remove</button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h4>Your Wishlist is Empty</h4>
                @endif
            </div>

        </div>
    </div>
@endsection

@section('script')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>
@endsection
