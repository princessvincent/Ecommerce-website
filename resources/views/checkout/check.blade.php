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
    @php $total = 0; @endphp

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (session('status'))
        <script>
            swal("{{ session('status') }}");
        </script>
    @endif
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
                                    <input type="text" class="form-control fname" name="fname"
                                        value="{{ Auth::user()->name }}" required>
                                    <span id="fname_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="lastname">Lastname</label>
                                    <input type="text" class="form-control lname" name="lname"
                                        value="{{ Auth::user()->lname }}">
                                    <span id="lname_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control email" name="email"
                                        value="{{ Auth::user()->email }}">
                                    <span id="email_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="phone">Phone Number</label>
                                    <input type="number" class="form-control phone" name="phone"
                                        value="{{ Auth::user()->phone }}">
                                    <span id="phone_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="address1">Address 1</label>
                                    <input type="text" class="form-control address1" name="address1"
                                        value="{{ Auth::user()->address1 }}">
                                    <span id="address1_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="address2">Address 2</label>
                                    <input type="text" class="form-control address2" name="address2"
                                        value="{{ Auth::user()->address2 }}">
                                    <span id="address2_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control city" name="city"
                                        value="{{ Auth::user()->city }}">
                                    <span id="city_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="state">State</label>
                                    <input type="text" class="form-control state" name="state"
                                        value="{{ Auth::user()->state }}">
                                    <span id="state_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="country">Country</label>
                                    <input type="text" class="form-control country" name="country"
                                        value="{{ Auth::user()->country }}">
                                    <span id="country_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="pin code">Enter Pin Code</label>
                                    <input type="text" class="form-control pincode" name="pincode"
                                        value="{{ Auth::user()->pincode }}">
                                    <span id="pincode_error" class="text-danger"></span>
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
                            @if ($cart->count() > 0)
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
                                            @php $total += $carts->product->selling_price * $carts->prod_qty;@endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                <h6 class="px-2">Grand Total: <span class="float-end">Rs {{ $total }}</span></h6>

                                <hr>
                                <input type="hidden" name="payment_mode" value="COD">
                                <button type="submit" class="btn btn-outline-primary form-control">Place Order |
                                    COD</button>
                                <button type="submit" class="btn btn-success mt-3 mb-3 form-control razorpay">Pay with
                                    Razorpay</button>
                                <div id="paypal-button-container"></div>

                        </div>
                    @else
                        <h6 class="text-center">No Product in Cart</h6>
                        @endif

                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>
    <script
        src="https://www.paypal.com/sdk/js?client-id=AXHFYG989DngxybvLGpdsYpRYvwMd3fMI2pvObPk9gv0bdujW6LNc70VjKEPiycpyUXtbBGjuUVmxX4-">
    </script>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>



    <script>
        paypal.Buttons({
            // Sets up the transaction when a payment button is clicked
            createOrder: (data, actions) => {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '{{ $total }}' // Can also reference a variable or function
                        }
                    }]
                });
            },
            // Finalize the transaction after payer approval
            onApprove: (data, actions) => {
                return actions.order.capture().then(function(orderData) {
                    // Successful capture! For dev/demo purposes:
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    const transaction = orderData.purchase_units[0].payments.captures[0];
                    // alert(
                    //     `Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });



                    var fname = $('.fname').val()
                    var lname = $('.lname').val()
                    var email = $('.email').val()
                    var phone = $('.phone').val()
                    var address1 = $('.address1').val()
                    var address2 = $('.address2').val()
                    var city = $('.city').val()
                    var state = $('.state').val()
                    var country = $('.country').val()
                    var pincode = $('.pincode').val()


                    $.ajax({
                        method: "POST",
                        url: "/placeorder",
                        data: {
                            'fname': fname,
                            'lname': lname,
                            'email': email,
                            'phone': phone,
                            'address1': address1,
                            'address2': address2,
                            'city': city,
                            'state': state,
                            'country': country,
                            'pincode': pincode,
                            'payment_mode': 'Paid by Paypal',
                            'payment_id': transaction.id,

                        },
                        success: function(responseb) {
                            // alert(responseb.status)
                            Swal.fire(responseb.status)
                                .then((value) => {
                                    window.location.href = 'my_orders'
                                });
                        }
                    })
                });
            }
        }).render('#paypal-button-container');
    </script>
@endsection
