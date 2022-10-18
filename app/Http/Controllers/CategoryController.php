<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Dotenv\Validator;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $categories = Category::with('subCategories')->get();
        $sub_categories = SubCategory::with('category')->get();
        $categories = Category::all();
        //  dd($sub_categories);
        return view('management.category',compact('sub_categories','categories'));
    }
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //get
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //post
        $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->save();
        // dd($category);
        return response()->json($category);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //get
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //get
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);
        //put
        $data= Category::findOrFail($id);
        $data->update([
            'name' => $request->name
        ]);
      
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete
        $data= Category::findOrFail($id);
        $data->delete();
        return response()->json($data);
    }
}
