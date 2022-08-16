@extends('layouts.nav')
@section('content')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (session('status'))
        <script>
            swal("{{ session('status') }}");
        </script>
    @endif
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="{{ url('add_rating') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $prods->id }}">

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Rate {{ $prods->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="rating-css">
                            <div class="star-icon">
                                @if ($user_rating)
                                    @for ($i = 1; $i <= $user_rating->stars_rated; $i++)
                                        <input type="radio" value="{{ $i }}" name="product_rating" checked
                                            id="rating{{ $i }}">
                                        <label for="rating{{ $i }}" class="fa fa-star"></label>
                                    @endfor

                                    @for ($j = $user_rating->stars_rated + 1; $j <= 5; $j++)
                                        <input type="radio" value="{{ $i }}" name="product_rating"
                                            id="rating{{ $i }}">
                                        <label for="rating{{ $i }}" class="fa fa-star"></label>
                                    @endfor
                                @else
                                    <input type="radio" value="1" name="product_rating" checked id="rating1">
                                    <label for="rating1" class="fa fa-star"></label>
                                    <input type="radio" value="2" name="product_rating" id="rating2">
                                    <label for="rating2" class="fa fa-star"></label>
                                    <input type="radio" value="3" name="product_rating" id="rating3">
                                    <label for="rating3" class="fa fa-star"></label>
                                    <input type="radio" value="4" name="product_rating" id="rating4">
                                    <label for="rating4" class="fa fa-star"></label>
                                    <input type="radio" value="5" name="product_rating" id="rating5">
                                    <label for="rating5" class="fa fa-star"></label>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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

                        <div class="rating">
                            @php $ratnum = number_format($rating_value) @endphp
                            @for ($i = 1; $i <= $ratnum; $i++)
                                <i class="fa fa-star checked"></i>
                            @endfor
                            @for ($j = $ratnum + 1; $j <= 5; $j++)
                                <i class="fa fa-star"></i>
                            @endfor
                            <span>

                                @if ($ratings->count() > 0)
                                    <span>{{ $ratings->count() }} Ratings</span>
                                @else
                                    No Ratings
                                @endif
                            </span>
                        </div>

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
                                    <button type="button" class="btn btn-success addtowish float-start me-3">Add to
                                        Wishlist <i class="fa fa-heart"></i></button>
                                    <button type="button" class="btn btn-primary addtocart float-start me-3">Add to
                                        Cart <i class="fa fa-shopping-cart"></i></button>
                                @else
                                    <button type="button" class="btn btn-success float-start me-3">Add to Wishlist <i
                                            class="fa fa-heart"></i></button>
                                @endif

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
                    <hr>
                    <div class="row">
                        <div class="col-md-4">

                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Rate Product
                            </button>

                            <a href="{{ url('add_review/' . $prods->slug . '/userreview') }}" class="btn btn-secondary">
                                Write a Review
                            </a>
                        </div>

                        <div class="col-md-8">
                            @foreach ($review as $reviews)
                                <div class="user_review">
                                    <label for="">{{ $reviews->user->name . ' ' . $reviews->user->lname }}</label>
                                    @if ($reviews->user_id == Auth::user()->id)
                                        <a href="{{ url('edit_review/'.$prods->slug) }}">Edit</a>
                                    @endif

                                    <br>
                                    @php
                                        $rating = App\Models\Rating::where('prod_id', $prods->id)->where('user_id', $reviews->user->id)->first();
                                    @endphp
                                    @if ($rating)
                                    @php
                                        $user_rated = $rating->stars_rated;
                                    @endphp
                                        @for ($i = 1; $i <= $user_rated; $i++)
                                            <i class="fa fa-star checked"></i>
                                        @endfor
                                        @for ($j = $user_rated + 1; $j <= 5; $j++)
                                            <i class="fa fa-star"></i>
                                        @endfor
                                    @endif
                                    <small>Reviewed on {{ $reviews->created_at->format('d M Y') }}</small>
                                    <p>
                                    {{ $reviews->user_review }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>




                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>
@endsection
