<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;

class ProductController extends Controller
{
    function index(){
        //  $products = Product::all(); //Traditional or query method
        // $products = Product::where('is_featured',1)->get(); //Eloquent method
        // dd($products->toArray());

        $products = Product::with('category')->get(); //this get data with/from other table with relationship
        // dd($products->toArray());
        return view('dashboard.products.products',compact('products'));
    }

    public function createProduct()
    {
        // database bata data layera, view lai dine
        // reading/fetching data from database
        $categories = ProductCategory::all();
        // dd($categories->toArray());
        return view('dashboard.products.create-product',compact('categories'));
    }

    public function store(Request $request){
        // dd($request->all());
        try{
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'category_id' => 'required',
                'description' => 'nullable|string',
                'is_featured' => 'nullable|string',
                'price' => 'required',
                'sale_price' => 'nullable',
                'qty' => 'required|numeric',
                'featured_image' => 'required|file|max:2048',

            ]);

            if(isset($data['is_featured']) && $data['is_featured'] == 'on'){
                $data['is_featured'] = 1;
            }
            else{
                $data['is_featured'] = 0;
            }


            //file/midea upload logic

            if($request->hasFile('featured_image')){
                $file = $request->file('featured_image');
                $filename = time().'.'.$file->getClientOriginalExtension();
                $file->move(public_path('uploads/product_media'),$filename);

                // filename = uploads/product_media/name_of_file.jpf in database
                $data['featured_image'] = 'uploads/product_media/'.$filename;
            }


            Product::create($data);

            return redirect()->route('admin.product')->with('success','Product Created Successfully.');

        }
        catch(\Exception $e){
            return redirect()->route('create.product')->with('error','Something went wrong.'.$e->getMessage());
        }
    }

    public function edit($id){
        // dd($id);
        $categories = ProductCategory::all();
        // select * from product_categories;

        $product = Product::with('category')->findOrFail($id);
        // select * from Product where id = $id;
        // dd($product->toArray());

        return view('dashboard.products.edit-product',compact('categories','product'));



    }

    public function update(Request $request){

        // dd($request->toArray());
        try{
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'category_id' => 'required',
                'description' => 'nullable|string',
                'is_featured' => 'nullable|string',
                'price' => 'required',
                'sale_price' => 'nullable',
                'qty' => 'required|numeric',
                'featured_image' => 'nullable|file',

            ]);

            if(isset($data['is_featured']) && $data['is_featured'] == 'on'){
                $data['is_featured'] = 1;
            }
            else{
                $data['is_featured'] = 0;
            }

            $product = Product:: findOrFail($request->product_id);
            // dd($product->toArray());

            //file/midea upload logic


            if($request->hasFile('featured_image')){

                $oldFile = $product->featured_image;
                // dd($oldFile);
                if(file_exists($oldFile)){
                    unlink($oldFile);
                }

                $file = $request->file('featured_image');
                $filename = time().'.'.$file->getClientOriginalExtension();
                $file->move(public_path('uploads/product_media'),$filename);

                // filename = uploads/product_media/name_of_file.jpf in database
                $data['featured_image'] = 'uploads/product_media/'.$filename;
            }


            Product::where('id',$request->product_id)->update($data);

            return redirect()->route('admin.product')->with('success','Product Updated Successfully.');

        }
        catch(\Exception $e){
            return redirect()->route('product.edit',['id' => $request->product_id])->with('error','Something went wrong.'.$e->getMessage());
        }
    }

    public function delete($id){
        // dd($id);
        try{

            $product = Product::findOrFail($id);
            // dd($product->toArray());
            $oldImage = $product->featured_image;
            // $result = file_exists($oldImage);
            // dd($result);
            // dd($oldImage);

            if(file_exists($oldImage)){
                unlink($oldImage);

            }

            $product->delete();

            return redirect()->route('admin.product')->with('success','Product Deleted Successfully.');

        }catch(\Exception $e){
            return redirect()->route('admin.product')->with('error',"Something went wrong".$e->getMessage());
        }

    }
}

