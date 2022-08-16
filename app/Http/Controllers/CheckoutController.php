<?php

namespace App\Http\Controllers;

// use auth;
use App\Models\cart;
use App\Models\User;
use App\Models\order;
use App\Models\product;
use App\Models\orderitem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(){
        // $user = User::where('id', auth::user()->id)->get();

        $old_cart = cart::where('user_id', Auth::user()->id)->get();
        foreach($old_cart as $item)
        {
            if(!product::where('id', $item->prod_id)->where('qty', '>=', $item->prod_qty)->exists())
            {
            $removeitem = cart::where('user_id', auth::user()->id)->where('prod_id', $item->prod_id)->first();
            $removeitem->delete();
            }
        }
        $cart = cart::where('user_id', auth::user()->id)->get();
        return view('checkout.check', compact('cart'));
    }

    public function placeorder(Request $request){
$order = new order();
$order->fname = $request->fname;
$order->lname = $request->lname;
$order->email = $request->email;
$order->phone = $request->phone;
$order->address1 = $request->address1;
$order->address2 = $request->address2;
$order->city = $request->city;
$order->state = $request->state;
$order->country = $request->country;
$order->pincode = $request->pincode;

$order->payment_mode = $request->payment_mode;
$order->payment_id = $request->payment_id;
$order->tracking_no = 'prisca'. rand(1111, 9999);
// $order->id = auth::user()->id;
// $order->save();

//calculate total price
$total = 0;
$total_price = cart::where('user_id', auth::user()->id)->get();
foreach($total_price as $price)
{
    $total += $price->product->selling_price * $price->prod_qty;
}
$order->total_price = $total;
$order->tracking_no = 'prisca'. rand(1111, 9999);
$order->user_id = auth::user()->id;
$order->save();

$cart = cart::where('user_id', auth::user()->id)->get();
foreach($cart as $carts)
{
    orderitem::create([
        'order_id' => $order->id,
        'prod_id' => $carts->prod_id,
        'qty' => $carts->prod_qty,
        'price' => $carts->product->selling_price,
    ]);
}

if(Auth::user()->address1 == NULL)
    {
$user =  User::where('id', auth::user()->id)->first();
$user->name = $request->fname;
$user->lname = $request->lname;
$user->email = $request->email;
$user->phone = $request->phone;
$user->address1 = $request->address1;
$user->address2 = $request->address2;
$user->city = $request->city;
$user->state = $request->state;
$user->country = $request->country;
$user->pincode = $request->pincode;
$user->update();
    }
    $cartitems = cart::where('user_id', Auth::user()->id)->get();
    cart::destroy($cartitems);

if($request->payment_mode == 'Paid by Razorpay'  || $request->payment_mode == 'Paid by Paypal')
{
    return response()->json([
        'status' => 'You have Successfully Placed Order!'
    ]);
}
return redirect('checkout')->with('status', 'You have Successfully Placed Order!');
    }

    public function razorpay(Request $request){
$cart = cart::where('user_id', Auth::user()->id)->get();
$totalprice = 0;
foreach ($cart as $item)
{
    $totalprice += $item->product->selling_price * $item->prod_qty;   
}

 $name = $request->name;
$lname = $request->lname;
$email = $request->email;
$phone = $request->phone;
$address1 = $request->address1;
$address2 = $request->address2;
$city = $request->city;
$state = $request->state;
$country = $request->country;
$pincode  = $request->pincode;

return response()->json([
"name" => $name,
"lname" => $lname,
"email" => $email,
"phone" => $phone,
"address1" => $address1,
"address2" => $address2,
"city" =>   $city,
"state" => $state,
"country" => $country,
"pincode" => $pincode,
'total_price' => $totalprice,
]);
    }
}