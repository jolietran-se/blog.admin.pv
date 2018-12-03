<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreSize;
use Validator;
use Response;
use App\Size;
// use App\Product;

class SizeController extends Controller
{

    //  protected $rules =
    // [
    //     'size' => 'required',
    //     // 'code' => 'required'
    // ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sizes=Size::all();
        return view('admin.sizes.index',[
            'sizes' => $sizes,
        ]);
    }

    public function anyData()
    {
        return Datatables::of(Size::query())
        ->addColumn('action', function ($sizes) {
          
            return '<a href="" class="show-modal btn btn-success btn-detail btn-xs" data-id="'.$sizes->id.'">
                                        <span class="glyphicon glyphicon-eye-open"></span> </a>
                                        <a href="" class="edit-modal btn btn-info btn-xs" data-id="'.$sizes->id.'" >
                                        <span class="glyphicon glyphicon-edit"></span> </a>
                                        <a href="" class="delete btn btn-danger btn-xs" data-id="'.$sizes->id.'" >
                                        <span class="glyphicon glyphicon-trash"></span> </a>';
        })
        ->rawColumns(['size','action'])
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
    public function store(StoreSize $request)
    {
            // $data = $request->all();
            $sizes = new Size();
            $sizes->size = $request->size;
            $sizes->save();
            return response()->json($sizes);
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy(Request $request, $id)
    {
        $id = $request->all()['size_id'];
        
        Size::destroy($id);

        return \Response::json([
            'error' => false,
        ]);
    }
}
