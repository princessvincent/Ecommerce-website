<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function add($slug)
    {
        $product = product::where('slug', $slug)->where('status', '0')->first();

        if ($product) {
            $product_id = $product->id;
            $review = Review::where('user_id', Auth::user()->id)->where('prod_id', $product_id)->first();

            if ($review) {
                return view('reviews.editreview', compact('review'));
            } else {

                $verify_purchase = order::where('orders.user_id', Auth::user()->id)->join('order_items', 'orders.id', 'order_items.order_id')
                    ->where('order_items.prod_id', $product_id)->get();

                return view('reviews.addreview', compact('verify_purchase', 'product'));
            }
        } else {
            return redirect()->back()->with('status', 'The link you followed was broken!');
        }

    }

    public function create(Request $request)
    {
        $product_id = $request->product_id;

        $product = product::where('id', $product_id)->where('status', '0')->first();

        if ($product) {
            $user_review = $request->user_review;
            $new_review = Review::create([
                'user_id' => Auth::user()->id,
                'prod_id' => $product_id,
                'user_review' => $user_review,
            ]);
            $category_slug = $product->category->slug;
            $prod_slug = $product->slug;

            if ($new_review) {
                return redirect('view-category/' . $category_slug . '/' . $prod_slug)->with('status', 'Thank You for your Review');
            }

        } else {
            return redirect()->back()->with('status', 'The link you followed was broken!');
        }
    }

    public function edit($prod_slug)
    {
        $product = product::where('slug', $prod_slug)->where('status', '0')->first();

        if ($product) {
            $product_id = $product->id;

            $review = Review::where('user_id', Auth::user()->id)->where('prod_id', $product_id)->first();

            if ($review) {
                return view('reviews.editreview', compact('review'));
            } else {
                return redirect()->back()->with('status', 'The link you followed was broken!');
            }
        } else {
            return redirect()->back()->with('status', 'The link you followed was broken!');
        }
    }

    public function update(Request $request)
    {
        $user_review = $request->user_review;
        if ($user_review != "") {
            $review_id = $request->review_id;
            $review = Review::where('id', $review_id)->where('user_id', Auth::user()->id)->first();
            if ($review) {

                $review->user_review = $request->user_review;
                $review->update();
                return redirect('view-category/' . $review->product->category->slug . '/' . $review->product->slug)->with('status', 'Review Updated successfully!');
            } else {
                return redirect()->back()->with('status', 'The link you followed was broken!');
            }
        } else {
            return redirect()->back()->with('status', 'You can not submit empty Review!');
        }
    }
}
