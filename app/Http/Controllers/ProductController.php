<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\product;
use App\Models\Rating;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File as FacadesFile;

class ProductController extends Controller
{
    public function index()
    {
        $viewpr = product::all();

        return view('admin.product.viewpro', compact('viewpr'));
    }

    public function add()
    {
        $cat = category::all();
        return view('admin.product.addpro', compact('cat'));
    }

    public function addprod(Request $request)
    {
        $prod = new product();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . "." . $ext;
            $file->move('img/product/', $filename);
            $prod->image = $filename;
        }

        $prod->cate_id = $request->cate_id;
        $prod->name = $request->name;
        $prod->slug = $request->slug;
        $prod->small_description = $request->small_description;
        $prod->description = $request->description;
        $prod->original_price = $request->original_price;
        $prod->selling_price = $request->selling_price;
        $prod->qty = $request->qty;
        $prod->tax = $request->tax;
        $prod->status = $request->input('status') == true ? '1' : '0';
        $prod->trending = $request->input('trending') == true ? '1' : '0';
        $prod->metal_title = $request->metal_title;
        $prod->metal_keywords = $request->metal_keywords;
        $prod->metal_description = $request->metal_description;

        $prod->save();
        return redirect()->back()->with('prod', 'Product has been Successfully Added!');

    }

    public function editpro($id)
    {
        $editpr = product::find($id);
        return view('admin.product.editpro', compact('editpr'));
    }

    public function updatepro(Request $request, $id)
    {
        $upd = product::find($id);

        if ($request->hasFile('image')) {
            $path = 'img/product/' . $upd->imag;

            if (FacadesFile::exists($path)) {
                FacadesFile::delete($path);
            }
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $ext = $file->getClientOriginalExtension();
                $filename = time() . "." . $ext;
                $file->move('img/product/', $filename);
                $upd->image = $filename;
            }

        }
        // $upd->cate_id = $request->cate_id;
        $upd->name = $request->name;
        // $upd->slug = $request->slug;
        $upd->slug = $request->slug;
        $upd->small_description = $request->small_description;
        $upd->description = $request->description;
        $upd->original_price = $request->original_price;
        $upd->selling_price = $request->selling_price;
        $upd->qty = $request->qty;
        $upd->tax = $request->tax;
        $upd->status = $request->input('status') == true ? '1' : '0';
        $upd->trending = $request->input('trending') == true ? '1' : '0';
        $upd->metal_title = $request->metal_title;
        $upd->metal_keywords = $request->metal_keywords;
        $upd->metal_description = $request->metal_description;
        $upd->update();
        return redirect('prods')->with('upcat', 'Product Has been Updated Successfully!');

    }

    public function deletepro($id)
    {

        if (Auth::user()->role_as == '0') {
            return redirect('/')->with('status', 'Access Denied! as you are not as admin');
        } else {

            $delete = product::find($id);

            if ($delete->image) {
                $path = 'img/product/' . $delete->imag;

                if (FacadesFile::exists($path)) {
                    FacadesFile::delete($path);
                }
            }

            $delete->delete();
            return redirect('prods')->with('upcat', 'Product Has been Deleted Successfully!');
        }
    }

    //trending product

    public function trendingproduct()
    {
        $trend = product::where('trending', '1')->take(10)->get();

        $catrend = category::where('popular', '1')->take(10)->get();
        return view('landing', compact('trend', 'catrend'));
    }

    public function trendcategory()
    {
        $category = category::where('status', '0')->get();
        return view('viewcate', compact('category'));
    }

    public function view_cat($slug)
    {
        if (category::where('slug', $slug)->exists()) {
            $category = category::where('slug', $slug)->first();
            $product = product::where('cate_id', $category->id)->where('status', '0')->get();
            return view('view_product', compact('category', 'product'));
        } else {
            return redirect('/')->with('status', 'slug does not exist');
        }

    }

    public function prodetails($cate_slug, $pro_slug)
    {
        if(Auth::check()){

        
        if (category::where('slug', $cate_slug)->exists()) {

            if (product::where('slug', $pro_slug)->exists()) {

                $prods = product::where('slug', $pro_slug)->first();
                //for review
                $review = Review::where('prod_id', $prods->id)->get();
                //for rating
                $ratings = Rating::where('prod_id', $prods->id)->get();
                $user_rating = Rating::where('prod_id', $prods->id)->where('user_id', Auth::user()->id)->first();

                $rating_sum = Rating::where('prod_id', $prods->id)->sum('stars_rated');
                if ($ratings->count() > 0) {
                    $rating_value = $rating_sum / $ratings->count();
                } else {
                    $rating_value = 0;
                }

                return view('admin.product.prodetails', compact('prods', 'ratings', 'rating_value', 'user_rating', 'review'));

            } else {
                return "Product Slug does not exist";
            }
        } else {
            return "Category slug does not exists";
        }
    }else{
        return redirect()->back()->with('status', 'Please Login to Continue!');
    }
    }

    public function searchbox()
    {
        $product = product::select('name')->where('status', '0')->get();
        $data = [];

        foreach ($product as $item) {
            $data[] = $item['name'];

        }
        return $data;
    }

    public function searchproduct(Request $request)
    {
        $product_name = $request->productname;

        if ($product_name != "") {
            $product = product::where('name', "LIKE", "%$product_name%")->first();
            if ($product) {
                return redirect('view-category/' . $product->category->slug . '/' . $product->slug);
            } else {
                return redirect()->back()->with('status', 'No Product matched your search');
            }
        } else {
            return redirect()->back();
        }
    }
}
