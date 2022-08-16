<?php

namespace App\Http\Controllers;

// use auth;
use App\Models\cart;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function addcart(Request $request)
    {
       $product_id = $request->input('product_id');
       $product_qty = $request->input('product_qty');

       if(Auth::check()){
$prod_check = product::where('id', $product_id)->first();

if($prod_check){


    if(cart::where('prod_id', $product_id)->where('user_id', auth::user()->id)->exists()){
        return response()->json([

            'status' => $prod_check->name . ' '. 'Already Added to Cart'
        ]);
    }else{
        $catItem = new cart();
        $catItem->prod_id = $product_id;
        $catItem->prod_qty = $product_qty;
        $catItem->user_id = auth::user()->id;
        $catItem->save();

        return response()->json(['status' => $prod_check->name .' '. 'Added to Cart']);
        
    }
    
}
       }else{
        return response()->json([
            'status' => 'Login to Continue'
        ]);
       }
    }
public function viewcart(){
    $cart = cart::where('user_id', Auth::user()->id)->get();
    return view('cart.viewcart', compact('cart'));
}

public function updatecart(Request $request){
    $prod_id = $request->input('prod_id');
    $product_qty = $request->input('prod_qty');

    if(Auth::check())
    {
        if(cart::where('prod_id', $prod_id)->where('user_id', auth::user()->id)->exists())
        {
            $cart = cart::where('prod_id', $prod_id)->where('user_id', auth::user()->id)->first();
            $cart->prod_qty = $product_qty;
            $cart->update();

            return response()->json(['status' => 'Quantity Updated!']);
        }
    }
}


public function delete_cart(Request $request){
   
    if(Auth::check()){
        $prod_id = $request->input('prod_id');
        if(cart::where('prod_id', $prod_id)->where('user_id', auth::user()->id)->exists()){
$cartitem = cart::where('prod_id', $prod_id)->where('user_id', auth::user()->id)->first();
$cartitem->delete();
return response()->json(['status' => 'Product Successfully Removed from cart']);
        }
    } else{
        return response()->json([
            'status' => 'Login to Continue'
        ]);
       }
}

public function cartcount()
{
    $cartcount = cart::where('user_id', Auth::user()->id)->count();

    return response()->json([
        'count' => $cartcount,
    ]);
}

}




