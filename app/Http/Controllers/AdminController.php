<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        // cập nhật status cuả order thành 1 (cònfirm)
        $order->update(["status"=>1]);
        // gửi email cho khách báo đơn đã đc chuyển trạng thái
        Mail::to("hoatq4@fpt.edu.vn")->send(new OrderMail($order));
        return redirect()->to("/admin/orders/".$order->id);
    }
}
