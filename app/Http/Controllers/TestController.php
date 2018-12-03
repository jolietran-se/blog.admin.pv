<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gallary_image;

class TestController extends Controller
{
       /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function imagesUpload()

    {

        return view('imagesUpload');

    }



    /**

     * Create a new controller instance.

     *

     * @return void

     */
    public function store(Request $request)
    {      

        // $data = array();
        $images=array();
        if($files=$request->file('image')){
            foreach($files as $key =>$file){
                $temp = [];
                $temp['link'] = $file->store('link');
                // $temp['name'] = $request['name'];
                // $temp['product_id'] = $request['product_id'];
                Gallary_image::create($temp);
            }
        }
        return response()->json(['data' => $images], 200);
    }

    public function imagesUploadPost(Request $request)

    {

        request()->validate([

            'uploadFile' => 'required',

        ]);



        foreach ($request->file('uploadFile') as $key => $value) {

            $imageName = time(). $key . '.' . $value->getClientOriginalExtension();

            $value->move(public_path('images'), $imageName);

        }



        return response()->json(['success'=>'Images Uploaded Successfully.']);

    }
}
