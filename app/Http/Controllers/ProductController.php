<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::all();

        return view('product.index',compact(['products']))->with('category',Category::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('product.create')->with('categories',Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "name"=>"required",
            "description"=>"required",
            "photo"=>"required|image",
            "price"=>"required",
            "category_id"=>"required",
        ]);
        $photo=$request->photo;
        $photo_new_name= time().$photo->getClientOriginalName();
        $photo->move('uploads/product/',$photo_new_name);
        $product=Product::create([
            "name"=>$request->name,
            "description"=>$request->description,
            "photo"=>'uploads/product/'.$photo_new_name,
            "price"=>$request->price,
            "category_id"=>$request->category_id,
        ]);

        return redirect(route('product.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Product::find($id);
        return view('product.edit',compact(['product']))->with('categories',Category::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product=Product::find($id);
        $this->validate($request, [
            "name"=>"required",
            "description"=>"required",
            "price"=>"required",
            "category_id"=>"required",
        ]);

        if ($request->hasFile('photo')) {
            $photo = $request->photo;
            $photo_new_name = time() . $photo->getClientOriginalName();
            $photo->move('uploads/product/', $photo_new_name);
            $product->photo = 'uploads/product/'. $photo_new_name;
        }

            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->category_id = $request->category_id;
            $product->save();


        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::find($id);
        $product->delete();
        return back();
    }
}
