<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('subCategory.category')->get();
        $categories = Category::all();
        // dd($subcategories);
        
        // $data = $products->concat($categories);
        // dd($products);
        return view('management.product',compact('products','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {   
        //api
        $subcategories = Category::with('subCategories')->find($id);
        return response()->json($subcategories);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:sub_categories|max:255',
            'sub_category_id' => 'required',
            'price' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            
        ]);

        $product = new Product;
        $product->name = $request->input('name');
        $product->sub_category_id = $request->input('sub_category_id');
        $product->price = $request->input('price');
        // dd($request);
        if($request->hasFile('image')){
            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('Image/'), $filename);
            $product->image = $filename;
        }
        $product->save();
        $data = Product::where('name','=',$request->name)->with('subCategory.category')->first();
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:sub_categories|max:255',
            'price' => 'required', 
        ]);
        $data= Product::findOrFail($id);
        $data->update([
            'name'=> $request->name,
            'price' => $request->price
        ]);
       
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $data =Product::findOrFail($id);
        // dd($data);
       unlink('Image/'.$data->image);
       $data->delete();
    }
}
