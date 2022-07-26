@extends('layouts.nav')
@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white"> Order View
                        <a href="{{ url('my_orders') }}" class="btn btn-warning float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4><strong>Shipping Details</strong></h4>
                                <hr>
                                <label for="">First Name</label>
                                <div class="border p-2"> {{ $order->fname }}</div>
                                <label for="">Last Name</label>
                                <div class="border p-2"> {{ $order->lname }}</div>
                                <label for="">Email</label>
                                <div class="border p-2"> {{ $order->email }}</div>
                                <label for="">Contact</label>
                                <div class="border p-2"> {{ $order->phone }}</div>
                                <label for="">Shipping Address</label>
                                <div class="border p-2">
                                    {{ $order->address1 }},
                                    {{ $order->address2 }},
                                    {{ $order->city }},
                                    {{ $order->state }},
                                    {{ $order->country }},
                                </div>
                                <label for="">Zip Code</label>
                                <div class="border p-2"> {{ $order->pincode }}</div>
                                {{-- <label for="">First Name</label>
                                <div class="border p-2"> {{ $order->fname }}</div> --}}
                            </div>
                            <div class="col-md-6">
                                <h4><strong>Order Details</strong></h4>
                                <hr>
                                <table class="table table-bodered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($order->orderitem as $orders)
                                            <tr>
                                                <td>{{ $orders->product->name }}</td>
                                                <td>{{ $orders->qty }}</td>
                                                <td>{{ $orders->price }}</td>
                                                <td>
                                                    <img src="{{ asset('img/product/' . $orders->product->image) }}"
                                                        alt="Image" height="100px" width="100px">
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                                <h4>Grand Total : <span class="float-end">{{ $order->total_price }}</span></h4>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
