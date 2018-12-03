<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Validator;
use Response;
use App\Color;
use App\Product;
use App\Http\Requests\StoreColor;

class ColorController extends Controller
{

    protected $rules =
    [
        'name' => 'required',
        // 'code' => 'required'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors=Color::all();
        return view('admin.colors.index',[
            'colors' => $colors,
        ]);
    }

    public function anyData()
    {
        return Datatables::of(Color::query())
        ->addColumn('action', function ($colors) {
          
            return '<a href="" class="show-modal btn btn-success btn-detail btn-xs" data-id="'.$colors->id.'">
                                        <span class="glyphicon glyphicon-eye-open"></span> </a>
                                        <a href="" class="edit-modal btn btn-info btn-xs" data-id="'.$colors->id.'" >
                                        <span class="glyphicon glyphicon-edit "></span> </a>
                                        <a href="" class="delete btn btn-danger btn-xs" data-id="'.$colors->id.'" >
                                        <span class="glyphicon glyphicon-trash"></span> </a>';
        })
        ->rawColumns(['code','action'])
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
         $validator = Validator::make($request->all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $colors = new Color();
            $colors->name = $request->name;
            $colors->code = $request->code;
            $colors->save();
            return response()->json($colors);
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
         $colors=Color::all();
        // $products=Product::all();
        return view('admin.colors.listProduct',[
            'colors' => $colors,
            // 'products' => $products,
        ]);
    }

    public function anydataListProduct($id_color){

        return Datatables::of(Color::where('id', '=', $id_color))->rawColumns(['description'])->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       return Color::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreColor $request, $id)
    {

        // $colors = Color::findOrFail($id);
        // $update = $colors->update($request->all());
        $data['name'] = $request->input('name');
        $data['code'] = $request->input('code');

        $colors = Color::where('id', $id)->update($data);
        return response()->json($colors);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $id = $request->all()['color_id'];
        
        Color::destroy($id);

        return \Response::json([
            'error' => false,
        ]);
    }
}
