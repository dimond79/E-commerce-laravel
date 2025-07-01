<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(){
        return view('frontend.cart.cart-item');
    }

    public function addToCart(Request $request){
        // dd($request->toArray());
        $productId = $request->product_id;
        // dd($productId);

        try{
            //another method to get logged in user id, next is applying hidden input in form
            $user = Auth::user();

            // ensure the user has a cart
            $cart = $user->cart()->firstOrCreate([]);
            // dd($cart->toArray());

            //checking the item in cart_items table.
            $item = $cart->items()->where('product_id',$productId)->first();
            // dd($item);

            if($item){
                //increment the quantity of product as product is already i items table
                $item->quantity += 1;
                $item->save();
            }
            else{
                $cart->items()->create([
                    'product_id'=> $productId,
                    'quantity' => 1,
                ]);
            }

            return response()->json([
                'status' => 'success',
                'data' => $cart,
            ]);



        }catch(\Exception $e)
        {
            return response()->json($e->getMessage());

        }
    }
}
