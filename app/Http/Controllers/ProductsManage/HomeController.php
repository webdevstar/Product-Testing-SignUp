<?php

namespace App\Http\Controllers\ProductsManage;

use App\Product;
use App\Question;
use App\Answer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$products = Product::all();

        return view('productsManage/home', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productsManage/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newProductName = $request->input('productName');
        $newProductImage = $request->input('productImage');
        $newProductTitle = $request->input('productTitle');

        $product = new Product;
        $product->name = $newProductName;
        $product->image = $newProductImage;
        $product->title = $newProductTitle;
        $product->save();

        $latestId = $product->id;

        return view('productsManage/questionsManage/create', ['id' => $latestId]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$product = Product::find($id);
        $questions = Product::find($id)->questions;

        return view('productsManage/show', ['product' => $product, 'questions' => $questions, 'id' => $id]);
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
        $newProductName = $request->input('productName');
        $newProductImage = $request->input('productImage');
        $newProductTitle = $request->input('productTitle');

        $product = Product::find($id);
        $product->name = $newProductName;
        $product->image = $newProductImage;
        $product->title = $newProductTitle;
        $product->save();

        return redirect('/admin/products/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
        return redirect('/admin/products');
    }
}
