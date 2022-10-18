<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::with('subCategories')->get();
        if(!$request->sub_categories_id && !$request->key){
            $products = Product::all();
        }
        else if($request->sub_categories_id && $request->key){
            $products = Product::whereIn("sub_category_id", explode(",",$request->sub_categories_id))->where("name",'LIKE','%'.$request->key.'%')->get();
        }
        else if($request->key){
            $products = Product::where("name",'LIKE','%'.$request->key.'%')->get();

        }
        else {
            $products = Product::whereIn("sub_category_id", explode(",",$request->sub_categories_id))->get();
        }
        $id = explode(",",$request->sub_categories_id);
        // return $id;
        // return $request;
        return view('lists.products',compact('products','categories','id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$params)
    {
        // $products = Product::with('subCategory.category')->where('sub_category_id', $request->data)->get();
        // // dd($products);
        // $categories = Category::with('subCategories')->get();
        // // return redirect(route('products.show', [$params]));
        // return redirect()->route('/', [$params]);
        
        // // return $params;

        //  return view('lists.products',compact('products','categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
