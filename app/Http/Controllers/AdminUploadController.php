<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductImage;
use App\Product;

class AdminUploadController extends Controller
{
    function postImages(Request $request)
    {
        if ($request->ajax()) {
            if ($request->hasFile('file')) {
                $imageFiles = $request->file('file');
                // set destination path
                $folderDir = 'uploads/products';
                $destinationPath = base_path() . '/' . $folderDir;
                // this form uploads multiple files
                foreach ($request->file('file') as $fileKey => $fileObject ) {
                    // make sure each file is valid
                    if ($fileObject->isValid()) {
                        // make destination file name
                        $destinationFileName = time() . $fileObject->getClientOriginalName();
                        // move the file from tmp to the destination path
                        $fileObject->move($destinationPath, $destinationFileName);
                        // save the the destination filename
                        $prodcuctImage = new ProductImage;
			            $ProdcuctImage->image_path = $folderDir . $destinationFileName;
			            $prodcuctImage->title = $originalNameWithoutExt;
			            $prodcuctImage->alt = $originalNameWithoutExt;
			            $prodcuctImage->save();
                    }
                }
            }
        }
} }
