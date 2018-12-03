<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProduct;
use Validator;
use Response;
use App\Product;
use App\Category;
use App\Manufacture;
use App\Color;
use App\Size;
use App\Gallary_image;
use App\Product_Detail;
use Yajra\Datatables\Datatables;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::orderBy('id', 'desc')->get();
        $categories= Category::all();
        $manufactures= Manufacture::all();
        $colors= Color::all();
        $sizes= Size::all();
        return view('admin.products.create',[
            'products' => $products,
            'categories' => $categories,
            'manufactures' => $manufactures,
            'sizes' => $sizes,
            'colors' => $colors,
        ]);
        // return view('admin.layouts.master');
    }

    public function anyData()
    {
        return Datatables::of(Product::query())
        ->addColumn('action', function ($products) {
           return '<button href="" class="show-modal btn btn-success btn-detail" data-id="'.$products->id.'" data-title="'.$products->name.'"    data-content="{{$categories->description}}">
                                        <span class="glyphicon glyphicon-eye-open"></span> </button>
                                        <a href="" class="edit-modal btn btn-info" data-id="'.$products->id.'" data-title="'.$products->name.'" >
                                        <span class="glyphicon glyphicon-edit"></span> </a>
                                        <a href="" class="delete btn btn-danger" data-id="'.$products->id.'">
                                        <span class="glyphicon glyphicon-trash"></span> </a>';
        })
        ->make(true);
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
   
    public function store(StoreProduct $request)
    {
       

        date_default_timezone_set("Asia/Ho_Chi_Minh");

        $date = date("YmdHis", time());

        $data = $request->all(); //Để lấy dữ liệu từ phía người dùng nhập vào

        $data['slug'] = str_slug($data['name']);
        $dataProduct = array();
        $dataProduct['name'] =  $data['name'];
        $dataProduct['category_id'] = $data['category_id'];
        $dataProduct['manufacture_id'] = $data['manufacture_id'];
        $dataProduct['origin_price'] = $data['origin_price'];
        $dataProduct['slug'] = $data['slug'];
        $dataProduct['description'] = $data['description'];
        $dataProduct['content'] = $data['content'];

        $product = Product::create($dataProduct);
        $imageName = request()->file->getClientOriginalName();
        request()->file->move(public_path('upload'), $imageName);
        
        $dataDetail = array();
        $product_detail  = new Product_Detail();
        $product_detail->size_id = $data['size_id']; 
        $product_detail->product_id = $product->id; 
        $product_detail->color_id = $data['color_id']; 
        $product_detail->quantity = $data['quantity']; 
        $product_detail->save(); 
        $image = new Gallary_image();
        $image->link = $data['image'];
        // $image->link = $data['name'];
        $image->product_id = $product->id; 
        // $image->product_id = $product->id; 
        $image->save();



        // dd($data);
        // return response()->json($data);
        return response()->json(['uploaded' => '/upload/'.$imageName],$data);
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product_details=Product_Detail::all();
        $colors = Color::all();
        $sizes = Size::all();
        $products=Product::all();
        return view('admin.products.listProduct',[
            'products' => $products,
            'sizes' => $sizes,
            'colors' => $colors,
            'product_details' => $product_details,
        ]);
    }
     public function anydataListProduct($id_product){

        return Datatables::of(Product_Detail::where('product_id', '=', $id_product)->with('code')->with('size'))
        // ->addColumn('code', function () {
        //     return'<input id="color" class="form-control" type="color" style="width: 20px" placeholder="Click to select a color" stype="width:20px;">';
        // })
        ->make(true);
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
    public function destroy(Request $request, $id)
    {
        $id = $request->all()['product_id'];

        
        Product::destroy($id);

        return \Response::json([
            'error' => false,
        ]);
    }
}
