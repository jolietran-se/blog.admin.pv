<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Slide;
use App\Product;
use App\Color;
// use App\Cart;
use App\Product_Detail;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $slides = Slide::all();
        $categories = Category::all();
        $products = Product::all();
        $colors = Color::all();
        
        return view('page.home',compact('slides','categories','colors'));
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
    public function show($id)
    {
        $product=Product::find($id);
        $product_detail=Product_Detail::where('product_id','=',$id)->with('code')->with('size')->get();
        // $colors=Color::where('product_id','=','id')->get();
        // $sizes=Size::where('product_id','=','id')->get();
        $images= $product->image()->first();
        // $product_detail=$product->product_detail();

        return response()->json([
            'product'=>$product,
            'product_detail'=>$product_detail,
            // 'colors'=>$colors,
            // 'sizes'=>$sizes,
            'images'=>$images,
            // 'product_detail'=>$product_detail,
        ]);
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
    public function postcart(Request $request)
    {
        Cart::add( $request['']);
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
