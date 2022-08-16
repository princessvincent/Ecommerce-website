@php
   if(Auth::user()->role_as == '0')
   {
      return redirect('/')->with('status','Access Denied! as you are not as admin');
   }
@endphp

@extends('layouts.head')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-5">
                 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            @if (session('status'))
                <script>
                    swal("{{ session('status') }}");
                </script>
            @endif
                    <div class="card-header bg-primary">
                        <h4>New Orders
                        <a href="{{ url('order_history') }}" class="btn btn-warning float-end">Order History</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bodered">
                            <thead>
                                <tr>
                                    <th>Order Date</th>
                                    <th>Tracking No</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($allorder as $orders)
                                    <tr>
                                        <td>{{ date('d-m-y', strtotime($orders->create_at)) }}</td>
                                        <td>{{ $orders->tracking_no }}</td>
                                        <td>{{ $orders->total_price }}</td>
                                        <td>{{ $orders->status == '0' ? 'Pending' : 'Completed' }}</td>
                                        <td>
                                            <a href="{{ url('adminview_order/' . $orders->id) }}"
                                                class="btn btn-primary">View</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
