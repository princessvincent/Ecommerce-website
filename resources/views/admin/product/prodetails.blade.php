@extends('layouts.nav')
@section('content')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h4>
                <a href="{{ url('category') }}" class="text-black text-decoration-none">
                    collections
                </a>/

                <a href="{{ url('view-category/' . $prods->category->slug) }}" class="text-black text-decoration-none">
                    {{ $prods->category->name }}
                </a>/

                <a href="{{ url('view-category/' . $prods->category->slug . '/' . $prods->slug) }}"
                    class="text-black text-decoration-none">
                    {{ $prods->name }}
                </a>
            </h4>
        </div>
    </div>

    <div class="container">
        <div class="card shadow product_data">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 border-right">
                        <img src="{{ asset('img/product/' . $prods->image) }}" alt="" class="w-100">

                    </div>
                    <div class="col-md-8">
                        <h2 class="mb-0">
                            {{ $prods->name }}
                            <label style="font-size:16px;"
                                class="float-end badge bg-danger trending_tag">{{ $prods->trending == '1' ? 'Trending' : '' }}</label>
                        </h2>
                        <hr>
                        <label class="me-3">Original Price: <s>Rs {{ $prods->original_price }}</s> </label>
                        <label class="fw-bold">Selling Price: Rs {{ $prods->selling_price }} </label>
                        <p class="mt-3">
                            {{ $prods->small_description }}
                        </p>
                        <hr>

                        @if ($prods->qty > 0)
                            <label class="badge bg-success">In Stock</label>
                        @else
                            <label class="badge bg-danger">Out of Stock</label>
                        @endif

                        <div class="row nt-3">
                            <div class="col-md-2">
                                <input type="hidden" value="{{ $prods->id }}" class="prod_id">
                                <label for="Quantity">Quantity</label>
                                <div class="input-group text-center mb-3">
                                    <span class="input-group-text decrement-btn">-</span>
                                    <input type="text" name="quantity" value="1" class="form-control qty-input">
                                    <span class="input-group-text increment-btn">+</span>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <br />
                                @if ($prods->qty > 0)
                                    <button type="button" class="btn btn-success addtowish float-start me-3">Add to Wishlist</button>
                                    <button type="button" class="btn btn-primary addtocart float-start me-3">Add to
                                        Cart</button>
                                @else
                                    <button type="button" class="btn btn-success float-start me-3">Add to Wishlist</button>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <hr>
                        <h3>Description</h3>
                        <p class="mt-3">
                            {{ $prods->description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>
@endsection
