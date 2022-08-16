@extends('layouts.nav')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if ($verify_purchase->count() > 0)
                            <h5>You are writing a Review for {{ $product->name }}</h5>
                            <form action="{{ url('addreviews') }}" method="POST">
                            @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <textarea name="user_review" class="form-control" placeholder="Write a Review" rows="10"></textarea>
                                <button type="submit" class="btn btn-primary mt-3">Submit Review</button>
                            </form>
                        @else
                            <div class="alert alert-danger">
                                <h5>You are not Eligible to Write a Review.</h5>
                                <p>
                                    For the Trustworthy of the Review only Customers who purchase this Product can write a
                                    Review.
                                </p>

                                <a href="{{ url('/') }}" class="btn btn-primary mt-3">Go to Home Page</a>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
