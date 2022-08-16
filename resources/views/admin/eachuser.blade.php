@php
   if(Auth::user()->role_as == '0')
   {
      return redirect('/')->with('status','Access Denied! as you are not as admin');
   }
@endphp

@extends('layouts.head')
@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header bg-primary">
                        <h4 class="text-white"> User Details
                            <a href="{{ url('users') }}" class="btn btn-success float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                           
                                <h4><strong>Shipping Details</strong></h4>
                                <hr>
                                <div class="col-md-4">
                                    <label for="">Role</label>
                                    <div class="border p-2"> {{ $user->role_as == '0' ? 'Users' : 'Admin' }}</div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">First Name</label>
                                    <div class="border p-2"> {{ $user->name }}</div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Last Name</label>
                                    <div class="border p-2"> {{ $user->lname }}</div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Email</label>
                                    <div class="border p-2"> {{ $user->email }}</div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Contact</label>
                                    <div class="border p-2"> {{ $user->phone }}</div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Shipping Address</label>
                                    <div class="border p-2"> {{ $user->address1 }}</div>
                                </div>

                                <div class="col-md-4">
                                    <label for="">Shipping Address</label>
                                    <div class="border p-2">{{ $user->address2 }}</div>
                                </div>

                                <div class="col-md-4">
                                    <label for="">City</label>
                                    <div class="border p-2">{{ $user->city }}</div>
                                </div>

                                <div class="col-md-4">
                                    <label for="">City</label>
                                    <div class="border p-2"> {{ $user->state }}</div>
                                </div>

                                <div class="col-md-4">
                                    <label for="">City</label>
                                    <div class="border p-2"> {{ $user->country }}</div>
                                </div>



                                <div class="col-md-4">
                                    <label for="">Zip Code</label>
                                    <div class="border p-2"> {{ $user->pincode }}</div>
                                </div>

                            

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
