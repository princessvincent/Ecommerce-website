<?php

namespace App\Http\Controllers;

// use auth;
use App\Models\User;
use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $order = order::where('user_id', Auth::user()->id)->get();
        return view('orders.index', compact('order'));
    }
    public function view($id){
        $order = order::where('id', $id)->where('user_id', auth::user()->id)->first();
        return view('orders.view', compact('order'));
    }
//view all users in admin dashboard
    public function allusers(){
$user = User::all();
return view('admin.alluser', compact('user'));
    }

    //view a particular user 
    public function viewuser($id){
$user = User::find($id);
        return view('admin.eachuser', compact('user'));
    }
}
