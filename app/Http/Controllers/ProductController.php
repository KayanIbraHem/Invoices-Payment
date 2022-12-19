<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\sections;
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
        return view('products.products',[
            'products'=>Product::all(),
            'sections'=>sections::all()

        ]);
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
    public function store(Request $request, Product $product)
    {
        $product->product_name=$request->product_name;
        $product->description=$request->description;
        $product->section_id=$request->section_name;
        $product->save();
    
        // $product->section()->attach($request->section_name);


        return redirect('products')->with('Add','تمت الاضافه بنجاح');

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
    public function update(Request $request)
    {
        // return $request;
        $product_id=$request->id;
        $product=Product::find( $product_id);
        $product->product_name=$request->product_name;
        $product->section_id=$request->section_name;
        $product->description=$request->description;
        $product->save();
        return redirect('products')->with('Add','تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
         
        $product->delete();
        return redirect('products')->with('delete','تم الحذف بنجاح'); 
    }
}
