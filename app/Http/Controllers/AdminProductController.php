<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminProductController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['title'] = 'List products';
        $productsInfo = DB::table('products')
            ->orderBy('id', 'desc')
            ->paginate(10);
        $this->data['listProduct'] = $productsInfo;
        return view('admin.product.create', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['title'] = 'Add new product';
        $listCate = DB::table('categories')->orderBy('id', 'desc')->get();
        $this->data['listCate'] = $listCate;
        return view('admin.product.create', $this->data);
}
}

