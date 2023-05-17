<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

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
}
