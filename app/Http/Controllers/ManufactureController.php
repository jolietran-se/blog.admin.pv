<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;
use Validator;
use Response;
use App\Manufacture;
use App\Product;

class ManufactureController extends Controller
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
        $manufactures=Manufacture::orderBy('id', 'DESC')->get();;
        return view('admin.manufactures.index',[
            'manufactures' => $manufactures,
        ]);
    }

    public function anyData()
    {
        return Datatables::of(Manufacture::query())
        ->addColumn('action', function ($manufactures) {
          
            return '<a href="" class="show-modal btn btn-success btn-detail btn-xs" data-id="'.$manufactures->id.'" >
                                        <span class="glyphicon glyphicon-eye-open"></span> </a>
                                        <a href="" class="edit-modal btn btn-info btn-xs" data-id="'.$manufactures->id.'" >
                                        <span class="glyphicon glyphicon-edit"></span> </a>
                                        <a href="" class="delete btn btn-danger btn-xs"  data-id="'.$manufactures->id.'" >
                                        <span class="glyphicon glyphicon-trash"></span> </a>';
        })
        ->rawColumns(['description','action'])
        ->make(true);
    }


    public function changeStatus() 
    {
        $id = Manufacture::get('id');

        $manufactures = Manufacture::findOrFail($id);
        $manufactures->status = !$manufactures->status;
        $manufactures->save();

        return response()->json($manufactures);
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

        $validator = Validator::make($request->all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $manufactures = new Manufacture();
            $manufactures->name = $request->name;
            $manufactures->description = $request->description;
            $manufactures->save();

            
            return response()->json($manufactures);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $manufactures=Manufacture::all();
        $products=Product::all();
        return view('admin.manufactures.listProduct',[
            'manufactures' => $manufactures,
            'products' => $products,
        ]);
    }

    public function anydataListProduct($id_manufacture){

        return Datatables::of(Product::where('manufacture_id', '=', $id_manufacture))->rawColumns(['description'])->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Manufacture::findOrFail($id);
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

        $validator = Validator::make($request->all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $manufactures = Manufacture::findOrFail($id);
            $update = $manufactures->update($request->all());
            return response()->json($update);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $id = $request->all()['manufacture_id'];

        Manufacture::destroy($id);

        return \Response::json([
            'error' => false,
        ]);
    }
}
