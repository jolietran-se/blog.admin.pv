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
use Illuminate\Support\Facades\Storage;
use App\Gallary_image;
use App\Product_Detail;
use Yajra\Datatables\Datatables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @ret\Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::orderBy('id', 'desc')->get();
        $categories= Category::all();
        $manufactures= Manufacture::all();
        $colors= Color::all();
        $sizes= Size::all();
        return view('admin.products.index1',[
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
           return '<button href="" class="show-modal btn btn-success btn-xs btn-detail " data-id="'.$products->id.'" data-title="'.$products->name.'"    data-content="{{$categories->description}}">
                                        <span class="glyphicon glyphicon-eye-open "></span> </button>
                                        <a href="" class="edit-modal btn btn-info btn-xs" data-id="'.$products->id.'" data-title="'.$products->name.'" >
                                        <span class="glyphicon glyphicon-edit "></span> </a>
                                        <a href="" class="delete btn btn-danger btn-xs" data-id="'.$products->id.'">
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
    public function store(Request $request)
    {
        $imageName = request()->files->getClientOriginalName();
        request()->files->move(public_path('upload'), $imageName);

        return response()->json(['uploaded' => '/upload/'.$imageName]);
    }
    public function storeProduct(StoreProduct $request)
    {
       
        date_default_timezone_set("Asia/Ho_Chi_Minh");

        $date = date("YmdHis", time());

        $data = $request->all(); //Để lấy dữ liệu từ phía người dùng nhập vào

        


        // dd($data['content']);


        $data['slug'] = str_slug($data['name']);
        $dataProduct = array();
        $dataProduct['name'] =  $data['name'];
        $dataProduct['category_id'] = $data['category_id'];
        $dataProduct['manufacture_id'] = $data['manufacture_id'];
        $dataProduct['origin_price'] = $data['origin_price'];
        $dataProduct['sale_price'] = $data['sale_price'];
        $dataProduct['slug'] = $data['slug'];
        $dataProduct['description'] = $data['description'];
        $dataProduct['content'] = $data['content'];

        $product = Product::create($dataProduct);

        $details = json_decode($request->details);

        //$product_detail->size_id = $data['size_id']; 
        // $product_detail->product_id = $product->id; 
        //$product_detail->color_id = $data['color_id']; 
        //$product_detail->quantity = $data['quantity']; 
        if (!empty($details)){
            foreach ($details as $detail) {

  

                $product_detail  = new Product_Detail();
                $size = $detail->size;
                $color = $detail->color;
                $qty = $detail->qty;
                $Size = Size::where('size',$size)->first();
                $Color = Color::where('name',$color)->first();
                if ($Size) {

                }
                else{
                    $Size = Size::create(['size'=>$size]);
                }
                $size_id = $Size->id;
                if ($Color) {

                }
                else{
                    $Color = Color::create(['name'=>$color]);
                }

                $color_id = $Color->id;
                    // ---
                $product_detail->color_id = $color_id;
                $product_detail->size_id = $size_id;
                $product_detail->quantity = $qty;
                $product_detail->product_id = $product->id;
                
                $product_detail->save();
            }
        } 



        if($request->has('image')){
            // return response()->json($files);
            foreach($request->file('image') as $key =>$file){
                $temp = [];
                // $temp['link'] = Storage::disk('local')->put('upload', $file);
                $temp['link'] = $file->store('images');
                $temp['name'] = $request['name'];
                $temp['product_id'] = $product['id'];
                Gallary_image::storeData($temp);
            }
        }
        return response()->json(['data'], 200);
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
