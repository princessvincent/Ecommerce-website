<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\order;
use App\Models\product;
use App\Models\category;
use Illuminate\Http\Request;

class DashController extends Controller
{
    public function counts()
    {
        $users = User::count();
        $prod = product::count();
        $categ = category::count();
        $completed_order = order::where('status', "1")->count();
        $uncompleted_order = order::where('status', "0")->count();

        return view('admin.index', compact('users', 'prod', 'categ', 'completed_order', 'uncompleted_order'));
        
    }
}
