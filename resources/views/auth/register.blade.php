@extends('layouts.nav')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="lastname">First Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="First Name">
                                </div>

                                <div class="col-md-6">
                                    <label for="lastname">Lastname</label>
                                    <input type="text" class="form-control " name="lname" placeholder="Last Name">
                                </div>

                                <div class="col-md-6">
                                    <label for="phone">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Email">                                   <span id="phone_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="phone">Phone Number</label>
                                    <input type="number" class="form-control" name="phone" placeholder="Phone">
                                    <span id="phone_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="address1">Address 1</label>
                                    <input type="text" class="form-control" name="address1"
                                        placeholder="Address1">
                                    <span id="address1_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="address2">Address 2</label>
                                    <input type="text" class="form-control" name="address2"
                                        placeholder="Address2">
                                    <span id="address2_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" name="city" placeholder="City">
                                    <span id="city_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="state">State</label>
                                    <input type="text" class="form-control" name="state" placeholder="State">
                                    <span id="state_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="country">Country</label>
                                    <input type="text" class="form-control" name="country" placeholder="Country">
                                    <span id="country_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="pin code">Enter Pin Code</label>
                                    <input type="text" class="form-control " name="pincode" placeholder="Pincode">
                                </div>


                                <div class="col-md-6">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control " name="password" placeholder="Password">
                                   
                                </div>
                                

                                <div class="col-md-6">
                                    <label for="password-confirm">Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="password_confirmation">
                                </div>

                                
                                    {{-- <div class="col-md-12 offset-md-4"> --}}
                                        <button type="submit" class="btn btn-primary form-control mt-3">
                                            {{ __('Register') }}
                                        </button>
                                    {{-- </div> --}}
                            
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
