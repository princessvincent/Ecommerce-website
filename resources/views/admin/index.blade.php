@php
if (Auth::user()->role_as == '0') {
    return redirect('/')->with('status', 'Access Denied! as you are not as admin');
}
@endphp

@extends('layouts.head')

@section('title', 'Dashboard')

@section('content')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (session('status'))
        <script>
            swal("{{ session('status') }}");
        </script>
    @endif

    <div class="row my-5" style="margin-left:40px;">
       <div class="col-md-3">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">

                    Total Users
                    <h2>{{ $users }}</h2>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link  text-decoration-none" href="{{ url('users') }}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>



        <div class="col-md-3">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    Total Products
                    <h2>{{ $prod }}</h2>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link  text-decoration-none" href="{{ url('prods') }}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>



        <div class="col-md-3">
            <div class="card bg-secondary text-white mb-4">
                <div class="card-body">
                    Total Categories
                    <h2>{{ $categ }}</h2>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link  text-decoration-none" href="{{ url('cat') }}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>



        <div class="col-md-3">
            <div class="card bg-info text-white mb-4">
                <div class="card-body">
                  Total Completed Orders
                    <h2>{{  $completed_order }}</h2>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link text-decoration-none" href="{{ url('order_history') }}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-info text-white mb-4">
                <div class="card-body">
                    Total New Orders
                    <h2>{{ $uncompleted_order }}</h2>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link  text-decoration-none" href="{{ url('orders') }}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- @endsection --}}
