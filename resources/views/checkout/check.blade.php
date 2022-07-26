@extends('layouts.nav')
@section('content')

 <div class="py-3 mb-4 shadow-sm bg-warning border-top">
            <div class="container">
                <h4>
                    <a href="{{ url('/') }}" class="text-black text-decoration-none">
                        Home
                    </a>/

                    <a href="{{ url('checkout') }}" class="text-black text-decoration-none">
                        Checkout
                    </a>/
                </h4>
            </div>
        </div>
    <div class="container mt-5">
<form action="{{ url('placeorder') }}" method="POST">
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h6>Basic Details</h6>
                        <hr>
                       
                            <div class="row form-checkout">
                            @csrf
                                <div class="col-md-6">
                                    <label for="firstname">Firstname</label>
                                    <input type="text" class="form-control" name="fname" value="{{ Auth::user()->name }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="lastname">Lastname</label>
                                    <input type="text" class="form-control" name="lname" value="{{ Auth::user()->lname }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="phone">Phone Number</label>
                                    <input type="number" class="form-control" name="phone" value="{{ Auth::user()->phone }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="address1">Address 1</label>
                                    <input type="text" class="form-control" name="address1" value="{{ Auth::user()->address1 }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="address2">Address 2</label>
                                    <input type="text" class="form-control" name="address2" value="{{ Auth::user()->address2 }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" name="city" value="{{ Auth::user()->city }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="state">State</label>
                                    <input type="text" class="form-control" name="state" value="{{ Auth::user()->state }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="country">Country</label>
                                    <input type="text" class="form-control" name="country" value="{{ Auth::user()->country }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="pin code">Enter Pin Code</label>
                                    <input type="text" class="form-control" name="pincode" value="{{ Auth::user()->pincode }}">
                                </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h6>Order Details</h6>
                    <hr>
                    <table class="table table-striped table-border">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $carts)
                                <tr>
                                    <td>{{ $carts->product->name }}</td>
                                    <td>{{ $carts->prod_qty }}</td>
                                    <td>{{ $carts->product->selling_price }}</td>


                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <hr>
                    <button type="submit" class="btn btn-outline-primary form-control">Place Order</button>
                </div>
            </div>
        </div>
    </div>
    </form>
    </div>
@endsection
