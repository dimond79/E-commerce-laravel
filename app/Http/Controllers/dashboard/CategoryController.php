<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;

class CategoryController extends Controller
{
    public function index(){

        $categories = ProductCategory::all();
        // dd($categories->toArray());

        return view('dashboard.products.add-category',compact('categories'));
    }
    public function add(Request $request){
        // dd($request->toArray());
        try{
            $data = $request->validate([
                'title'=> 'required|string',
                'image'=> 'nullable|string'
            ]);
            ProductCategory::create($data);

            return redirect()->route('category.show')->with('success','Category Added Successfully!');

        }catch(\Exception $e)
        {
            return redirect()->route('category.show')->with('error','Something Went Wrong!!'.$e->getMessage());
        }
    }

    public function edit($id){
        // dd($id);

        $categories = ProductCategory::findOrFail($id);
        // dd($categories->toArray());

        return view('dashboard.products.edit-category',compact('categories'));

    }

    public function update(Request $request){

        // dd($request->toArray());
        try{
            $data = $request->validate([
                'title'=> 'required|string',
                'image'=> 'nullable|string'
            ]);
            ProductCategory::where('id',$request->category_id)->update($data);

            return redirect()->route('category.show')->with('success','Category Updated Successfully!');

        }catch(\Exception $e)
        {
            return redirect()->route('category.show')->with('error','Something Went Wrong!!'.$e->getMessage());
        }
    }

    public function delete(Request $request,$id){
        // dd($id);
        try{
            $categories = ProductCategory::findOrFail($id);
            // dd($data->toArray());
            $categories->delete();


            return redirect()->route('category.show')->with('success','Category Deleted Successfully!!');
        }catch(\Exception $e){
            return redirect()->route('category.show')->with('error','Something Went Wrong!'.$e->getMessage());
        }

    }

}

