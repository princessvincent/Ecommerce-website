@extends('layouts.nav')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                            <h5>You are Editing Review for {{ $review->product->name }}</h5>
                            <form action="{{ url('update_review/' .$review->id) }}" method="POST">
                            @csrf
                            
                                <input type="hidden" name="review_id" value="{{ $review->id }}">
                                <textarea name="user_review" class="form-control"  rows="10">{{  $review->user_review }}</textarea>
                                <button type="submit" class="btn btn-primary mt-3">Update Review</button>
                            </form>
                        

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
