<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Validator;
use Response;
use App\Slide;
// use App\Product;
// use App\Http\Requests\StoreColor;

class SlideController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $slides=Slide::all();
        return view('admin.slide.index',[
            'slides' => $slides,
        ]);
    }

    public function anyData()
    {
        return Datatables::of(Slide::query())
        ->addColumn('action', function ($slides) {
          
            return '<a href="" class="show-modal btn btn-success btn-detail btn-xs" data-id="'.$slides->id.'">
                                        <span class="glyphicon glyphicon-eye-open"></span> </a>
                                        <a href="" class="edit-modal btn btn-info btn-xs" data-id="'.$slides->id.'" >
                                        <span class="glyphicon glyphicon-edit "></span> </a>
                                        <a href="" class="delete btn btn-danger btn-xs" data-id="'.$slides->id.'" >
                                        <span class="glyphicon glyphicon-trash"></span> </a>';
        })
        // ->addColumn('image', function ($slides) {
            ->addColumn('image', function ($slides) {
                return '<img src="'.$slides->link.' " style="width: 200px" />';
            })
        
        ->rawColumns(['action','image'])
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
            $data=$request->all();
              $slides = array();
            $slides['name'] = $data['name'];
            $slides['caption1'] = $data['caption1'];
            $slides['caption2'] = $data['caption2'];
            $slides['caption3'] = $data['caption3'];
            $slides['link'] =$data['link'];
            Slide::create($slides);
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
    public function destroy($id)
    {
        //
    }
}
