<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Validator;
use Response;
use App\Category;
use App\Product;

class CategoryController extends Controller
{

    protected $rules =
    [
        'name' => 'required',
        'description' => 'required'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::all();
        return view('admin.categories.index',[
            'categories' => $categories,
        ]);
    }

    public function anyData()
    {
        return Datatables::of(Category::query())
        ->addColumn('action', function ($categories) {
          
            return '<a href="" class="show-modal btn btn-success btn-detail btn-xs" data-id="'.$categories->id.'" data-title="'.$categories->name.'"    data-content="{{$categories->description}}">
                                        <span class="glyphicon glyphicon-eye-open"></span> </a>
                                        <a href="" class="edit-modal btn btn-info btn-xs" data-id="'.$categories->id.'" data-title="'.$categories->name.'" data-content="{{$categories->description}}">
                                        <span class="glyphicon glyphicon-edit"></span> </a>
                                        <a href="" class="delete btn btn-danger btn-xs" data-id="'.$categories->id.'">
                                        <span class="glyphicon glyphicon-trash"></span> </a>';
        })
        ->rawColumns(['description','action'])
        ->make(true);
    }


    public function changeStatus() 
    {
        $id = Category::get('id');

        $categories = Category::findOrFail($id);
        $categories->status = !$categories->status;
        $categories->save();

        return response()->json($categories);
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

   
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $categories = new Category();
            $categories->name = $request->name;
            $categories->status = $request->status;
            $categories->description = $request->description;
            $categories->save();

            // var_dump($categories);
            // die;
            return response()->json($categories);
        }
    }

    
    public function show($id)
    {
        $categories=Category::all();
        $products=Product::all();
        return view('admin.categories.listProduct',[
            'categories' => $categories,
            'products' => $products,
        ]);
    }

    public function anydataListProduct($id_category){

        return Datatables::of(Product::where('category_id', '=', $id_category))->rawColumns(['description'])->make(true);
    }

    
    public function edit($id)
    {
        return Category::findOrFail($id);
    }

     public function update(Request $request, $id)
    {   

        $validator = Validator::make($request->all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $categories = Category::findOrFail($id);
            $update = $categories->update($request->all());
            return response()->json($update);
        }


    }

   
    public function destroy(Request $request, $id)
    {
        $id = $request->all()['category_id'];
        
        Category::destroy($id);

        return \Response::json([
            'error' => false,
        ]);
    }
}
