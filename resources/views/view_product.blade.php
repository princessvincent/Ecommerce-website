@extends('layouts.nav')
@section('content')
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h4>
                <a href="{{ url('category') }}" class="text-black text-decoration-none">
                    collections
                </a>/

                <a href="{{ url('view-category/' . $category->slug) }}" class="text-black text-decoration-none">
                    {{ $category->name }}
                </a>

            </h4>
        </div>
    </div>

    <div class="py-5">
        <div class="container">
            <div class="row">
                <strong>
                    <h2 class="mb-3">{{ $category->name }}</h2>
                </strong>
                @foreach ($product as $products)
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <a href="{{ url('view-category/' . $category->slug . '/' . $products->slug) }}"
                                class="text-decoration-none">
                                <img src="{{ asset('img/product/' . $products->image) }}" alt="Product Image"
                                    style="height: 500px;">
                                <div class="card-body">
                                    <h5>{{ $products->name }}</h5>
                                    <span class="float-start">{{ $products->selling_price }}</span>
                                    <span class="float-end"> <s>{{ $products->original_price }} </s></span>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
