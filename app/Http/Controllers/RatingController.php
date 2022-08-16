<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\Rating;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function add(Request $request)
    {
 $star_rate = $request->product_rating;
$product_id = $request->product_id;

$prod_check = product::where('id', $product_id)->where('status', '0')->first();
if($prod_check)
{
   $verify_purchase = order::where('orders.user_id', Auth::user()->id)->join('order_items', 'orders.id', 'order_items.order_id')
    ->where('order_items.prod_id', $product_id)->get();

    if($verify_purchase->count() > 0)
    {
        $existingrating = Rating::where('user_id', Auth::user()->id)->where('prod_id', $product_id )->first();
     
        if($existingrating)
        {
        $existingrating->stars_rated =  $star_rate;
        $existingrating->update();
    
}else{
        Rating::create([
            'user_id' => Auth::user()->id,
            'prod_id' => $product_id,
            'stars_rated' => $star_rate,
        ]);
    }
    return redirect()->back()->with('status', "Thank You for Rating this Product");
 
    }else{
        return redirect()->back()->with('status', "You can only rate this product when you purchase");

    }
    
}else{
        return redirect()->back()->with('status', "The link you followed is broken");
        
    }

    }
}
