<?php

namespace App\Http\Controllers;

use App\Models\order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
     //view all orders in admin dashboard

    public function userorders(){
        $allorder = order::where('status', '0')->get();
return view('orders.allorders', compact('allorder'));
    }

     //view a particular order in admin dashboard

public function vieworder($id){
    $vieworde = order::where('id', $id)->first();
    return view('orders.adminview', compact('vieworde'));
    }

    //update status in the order table

public function statusupd(Request $request, $id){
    $updorder = order::find($id);
    $updorder->status = $request->status;
    $updorder->update();
    return redirect('orders')->with('status', 'Status Updated Successfully!');
    }

    public function orderhis(){
        $allorder = order::where('status', '1')->get();
        return view('orders.complete_order', compact('allorder'));
    }

}
