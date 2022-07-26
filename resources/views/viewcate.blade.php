@extends('layouts.nav')
@section('content')
 <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h4>
                <a href="{{ url('category') }}" class="text-black text-decoration-none">
                    collections
                </a>/


            </h4>
        </div>
    </div>

    <div class="py-5">
        <div class="container">
            <div class="row">
                {{-- <div class="col-md-12"> --}}
                <h1>All Categories</h1>
                @foreach ($category as $cate)
                    <div class="col-md-4">
                        <a href="{{ url('view-category/'.$cate->slug) }}" class="text-decoration-none">
                            <div class="card">
                                <img src="{{ asset('img/category/' . $cate->image) }}" alt="Category Image"
                                    style="height: 500px;">
                                <div class="card-body">
                                    <h5>{{ $cate->name }}</h5>
                                    <p class="float-start">{{ $cate->description }}</p>
                                    {{-- <span class="float-end"> <s>{{ $trends->original_price }} </s></span> --}}
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    </div>
@endsection
