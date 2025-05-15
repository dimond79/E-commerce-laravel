<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;

class HomeController extends Controller
{
    public function index(){
        // $products = Product::all(); //for all data
        $featuredProducts = Product::orderBy('created_at','desc')->take(4)->where('is_featured',1)->with('category')->get();
        // dd($Fproducts->toArray());
        foreach($featuredProducts as $product){

            if($product -> price > 0 && $product->sale_price<$product->price){

                $discountAmount = ($product->price - $product->sale_price);
                $discountPercent = round(($discountAmount/$product->price) * 100);
                // echo $discount_per . '<br>';

                $product->discount_percent =  $discountPercent;

            }else{
                $product->discount_percent = 0;

            }
        }
        // dd($featuredProducts->toArray());


        return view('frontend.home.home',compact('featuredProducts'));
    }

    public function login(){

        return view('frontend.auth.login-register');
    }
}
