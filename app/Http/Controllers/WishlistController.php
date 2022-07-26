<?php

namespace App\Http\Controllers;

// use auth;
use App\Models\product;
use App\Models\wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index(){
        $wishlist = wishlist::where('user_id', auth::user()->id)->get();
        return view('wishlist.index', compact('wishlist'));
    }

    public function addwish(Request $request){
        if(Auth::check())
        {
            $prod_id = $request->input('product_id');
            if(product::find($prod_id))
            {
                $wish = new wishlist();
                $wish->prod_id = $prod_id;
                $wish->user_id = auth::user()->id;
                $wish->save();
                return response()->json([
                    "status" => "Product has been Added to Wishlist!"
                ]);
            }
            else{
                return response()->json([
                    "status" => "Product does not Exist!"
                ]);
            }
        }else{
            return response()->json([
                "status" => "Please Login to Continue!"
            ]);
        }
    }

    public function deletewish(Request $request){
        if(Auth::check()){
            $prod_id = $request->input('prod_id');
            if(wishlist::where('prod_id', $prod_id)->where('user_id', auth::user()->id)->exists()){
    $wishitem = wishlist::where('prod_id', $prod_id)->where('user_id', auth::user()->id)->first();
    $wishitem->delete();
    return response()->json(['status' => 'Product Successfully Removed from Wishlist']);
            }
        } else{
            return response()->json([
                'status' => 'Login to Continue'
            ]);
           }
    }
}
