<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        return view("admin.dashboard");
    }

    public function orders(){
        $orders = Order::orderBy("id","desc")->paginate(12);
        return view("admin.orders",
        [
            "orders"=>$orders
        ]);
    }

    public function invoice(Order $order){
        return view("admin.invoice",["order"=>$order]);
    }

    public function confirm(Order $order){

    }
}
