@extends('layouts.head')
@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
               
                    <div class="card-header bg-primary">
                        <h4 class="text-white"> Order View
                            <a href="{{ url('orders') }}" class="btn btn-warning float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4><strong>Shipping Details</strong></h4>
                                <hr>
                                <label for="">First Name</label>
                                <div class="border p-2"> {{ $vieworde->fname }}</div>
                                <label for="">Last Name</label>
                                <div class="border p-2"> {{ $vieworde->lname }}</div>
                                <label for="">Email</label>
                                <div class="border p-2"> {{ $vieworde->email }}</div>
                                <label for="">Contact</label>
                                <div class="border p-2"> {{ $vieworde->phone }}</div>
                                <label for="">Shipping Address</label>
                                <div class="border p-2">
                                    {{ $vieworde->address1 }},
                                    {{ $vieworde->address2 }},
                                    {{ $vieworde->city }},
                                    {{ $vieworde->state }},
                                    {{ $vieworde->country }},
                                </div>
                                <label for="">Zip Code</label>
                                <div class="border p-2"> {{ $vieworde->pincode }}</div>
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

                                        @foreach ($vieworde->orderitem as $orders)
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


                                <h4>Grand Total : <span class="float-end">{{ $vieworde->total_price }}</span></h4>
                                <div class="mt-3">
                                    <label for="" clas="col-md-12">Order Status</label>
                                    <form method="post" action="{{ url('update_status/' . $vieworde->id) }}">
                                    @csrf
                                    @method('PUT')
                                        <select class="form-select form-control" name="status">
                                            <option {{ $vieworde->status == '0' ? 'selected' : '' }} value="0">
                                                Pending</option>
                                            <option {{ $vieworde->status == '1' ? 'selected' : '' }} value="1">
                                                Completed</option>
                                        </select>

                                        <button type="submit" class="btn btn-primary mt-3 form-control">Update Status</button>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
