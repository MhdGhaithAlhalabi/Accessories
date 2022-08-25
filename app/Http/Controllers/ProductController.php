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
        return view('product.show_product')->with('products',$products);
    }
    public function index2()
    {
        $products = Product::with('type','category')->get();
        return view('product.show_product2')->with('products',$products);
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
        return view('product.create_product',compact('types','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255', 'unique:products'],
            'details'=>['required'],
            'price'=>['required'],
            'priceSale'=>['nullable'],
            'status'=>['nullable'],
            'category_id'=>['required'],
            'type_id'=>['required'],
            'has_name'=>['required'],
            'has_measure'=>['required'],


        ];

        $customMessages = [
            'required' => 'هذا الحقل مطلوب',
            'unique' => 'الاسم موجود سابقاَ'
        ];
       // 'rate' => 5,
        $validator = Validator::make(

      $request->all()
            , $rules,$customMessages);

        if ($validator->fails()) {
            return redirect()->route('product.create')->withErrors($validator);
        }

        $product = Product::create(  [
            'type_id' => $request->type_id,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'details' => $request->details,
            'price' => $request->price,
            'priceSale' => $request->priceSale,
            'status' => $request->status,
            'has_name'=>$request->has_name,
            'has_measure'=>$request->has_measure,
            'rate' => 5,
        ]);

        return redirect()->route('product.create')->with('message','تمت اضافة المنتج بنجاح');
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
        return view('product.edit_product',compact('product','categories','types'));
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
        $rules = [
            'name' => ['required', 'string', 'max:255','unique:products,name,'.$product->id],
            'details'=>['required'],
            'price'=>['required'],
            'priceSale'=>['nullable'],
            'status'=>['nullable'],
            'category_id'=>['required'],
            'type_id'=>['required'],
            'has_name'=>['required'],
            'has_measure'=>['required'],

        ];

        $customMessages = [
            'required' => 'هذا الحقل مطلوب',
            'unique' => 'الاسم موجود سابقاَ'

        ];
        $validator = Validator::make($request->all(),$rules,$customMessages);


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
