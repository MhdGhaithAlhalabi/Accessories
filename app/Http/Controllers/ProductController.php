<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $products = Product::with('type','category')->get();
        return view('product\show_product')->with('products',$products);
    }
    public function index2()
    {
        $products = Product::with('type','category')->get();
        return view('product\show_product2')->with('products',$products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $categories = Category::all();
        return view('product/create_product',compact('types','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', 'unique:products'],
            'details'=>['required'],
            'price'=>['required'],
            'priceSale'=>['nullable'],
            'status'=>['nullable'],
            'category_id'=>['required'],
            'type_id'=>['required']
        ]);

        if ($validator->fails()) {
            return redirect()->route('product.create')->withErrors($validator);
        }

        $product = Product::create($request->all());

        return redirect()->route('product.create')->with('message','success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Product $product)
    {
        $types = Type::all();
        $categories = Category::all();
        return view('product/edit_product',compact('product','categories','types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'details'=>['required'],
            'price'=>['required'],
            'priceSale'=>['nullable'],
            'status'=>['nullable'],
            'category_id'=>['required'],
            'type_id'=>['required']
        ]);

        if ($validator->fails()) {
            return redirect()->route('product.edit',$product)->withErrors($validator);
        }
        if(asset($product)){
            $product->update($request->all());
            return redirect()->route('product.index')->with('message','success');

        }else{
            return redirect()->route('product.index')->with('message','you cant do that');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')
            ->with('message','product deleted');
    }
}
