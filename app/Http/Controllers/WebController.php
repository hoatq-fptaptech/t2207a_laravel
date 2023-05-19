<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebController extends Controller
{
    public function home(){
        // lay sp trong db
        $new_products = Product::orderBy("id","desc")->limit(6)->get();
        $categories = Category::limit(10)->get();
        $products = Product::paginate(12);
        return view("welcome",[
            "new_products"=>$new_products,
            "categories"=>$categories,
            "products"=>$products
        ]);
    }

    public function shop(){
        return view("shop");
    }

    public function search(Request $request){
        $q = $request->get("q");
        $limit = $request->has("limit")?$request->get("limit"):18;
        $categories = Category::limit(10)->get();
//        $products = Product::where("name",$q)->paginate(18);
        $products = Product::where("name",'like',"%$q%")->paginate($limit);
//        dd($products);
        return view("search",
        [
            "categories"=>$categories,
            "products"=>$products
        ]);
    }

    public function category(Category $category){
//        $category = Category::find($id);
//        if($category==null)
//            return abort(404);
//        $category = Category::findOrFail($id);
        $products = Product::where("category_id",$category->id)->paginate(18);
        $categories = Category::limit(10)->get();
        return view("category",
            [
                "categories"=>$categories,
                "products"=>$products,
                "category"=>$category
            ]);
    }

    public function cart(){
        $products = session()->has("cart")?session()->get("cart"):[];
        $categories = Category::limit(10)->get();
        $total = 0;
        foreach ($products as $item){
            $total+= $item->price * $item->buy_qty;
        }
        return view("cart",[
            "products"=>$products,
            "categories"=>$categories,
            "total"=>$total
        ]);
    }

    public function addToCart(Product $product,Request $request){
        $cart = session()->has("cart")?session()->get("cart"):[];
        $qty = $request->has("qty")?$request->get("qty"):1;
        foreach ($cart as $item){
            if($item->id == $product->id){
                $item->buy_qty = $item->buy_qty+$qty;
                session(["cart"=>$cart]);
                return redirect()->to("/cart");
            }
        }
        $product->buy_qty = $qty;
        $cart[] = $product;
        session(["cart"=>$cart]);
        return redirect()->to("/cart");
    }

    public function checkout(){
        $products = session()->has("cart")?session()->get("cart"):[];
        $categories = Category::limit(10)->get();
        $total = 0;
        foreach ($products as $item){
            $total+= $item->price * $item->buy_qty;
        }
        return view("checkout",[
            "products"=>$products,
            "categories"=>$categories,
            "total"=>$total
        ]);
    }

    public function placeOrder(Request $request){
        $products = session()->has("cart")?session()->get("cart"):[];
        $total = 0;
        foreach ($products as $item){
            $total+= $item->price * $item->buy_qty;
        }
        $order = Order::create([
            "firstname"=>$request->get("firstname"),
            "lastname"=>$request->get("lastname"),
            "country"=>$request->get("country"),
            "address"=>$request->get("address"),
            "city"=>$request->get("city"),
            "state"=>$request->get("state"),
            "postcode"=>$request->get("postcode"),
            "phone"=>$request->get("phone"),
            "email"=>$request->get("email"),
            "total"=>$total,
            "payment_method"=>"COD",
          //  "is_paid"=>false,
         //   "status"=>0,
        ]);
        foreach ($products as $item){
            DB::table("order_products")->insert([
                "order_id"=>$order->id,
                "product_id"=>$item->id,
                "buy_qty"=>$item->buy_qty,
                "price"=>$item->price
            ]);
        }
        return redirect()->to("/thank-you/".$order->id);
    }

    public function thankYou(Order $order){

    }
}
