<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
        Mail::to($order->email)->send(new OrderMail($order));
        return redirect()->to("/admin/orders/".$order->id);
    }

    public function products(){
        $products = Product::orderBy("id","desc")->paginate(20);
        return view("admin.products",
            [
                "products"=>$products
            ]);
    }

    public function productCreate(){
        $categories = Category::all();
        return view('admin.product_form',[
            "categories"=>$categories
        ]);
    }

    public function productSave(Request $request){
        $request->validate([
            "name"=>"required",
            "price"=>"required|numeric|min:0",
            "qty"=>"required|numeric|min:0"
        ],[
            // thong bao gi thi thong bao
        ]);
        // upload file
        $thumbnail = null;
        if($request->hasFile("thumbnail")){
            $file = $request->file("thumbnail");
            $fileName = time().$file->getClientOriginalName();
            $path = public_path("uploads");
            $file->move($path,$fileName);
            $thumbnail = "/uploads/".$fileName;
        }
        Product::create([
            "name"=>$request->get("name"),
            "slug"=>Str::slug($request->get("name")),
            "price"=>$request->get("price"),
            "qty"=>$request->get("qty"),
            "description"=>$request->get("description"),
            "category_id"=>$request->get("category_id"),
            "thumbnail"=>$thumbnail
        ]);
        return redirect()->to("/admin/products");
    }
}
