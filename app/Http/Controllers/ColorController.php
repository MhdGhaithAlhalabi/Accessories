<?php

namespace App\Http\Controllers;

use App\Models\color;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $colors = Color::with('product');
        return view('color.show_color',compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        $collct = collect($request->all());
        $num = $collct->keys();
        $products = Product::find($num)->first();
        return view('color.create_color',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'color' => ['required', 'string', 'max:255'],
            'product_id'=>['required']
        ]);

        if ($validator->fails()) {
            return redirect()->route('color.create',$request->product_id)->withErrors($validator);
        }

        $color = Color::create([
            'color' => $request->color,
            'product_id'=>$request->product_id
        ]);

        return redirect()->route('color.create',$request->product_id)->with('message','success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\color  $color
     * @return \Illuminate\Http\Response
     */
    public function show(Color $color)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\color  $color
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(color $color,Request $request)
    {

        $collct = collect($color->product_id);

        $product = Product::find($collct)->first();
        return view('color.edit_color',compact('color','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\color  $color
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Color $color)
    {
        $validator = Validator::make($request->all(), [
            'color' => ['required', 'string', 'max:255'],
            'product_id' => ['required']
        ]);

        if ($validator->fails()) {
            return redirect()->route('color.edit',$color)->withErrors($validator);
        }
        if(asset($color)){
            $color->update($request->all());
            return redirect()->route('product.index')->with('message','success');

        }else{
            return redirect()->route('product.index')->with('message','you cant do that');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\color  $color
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Color $color)
    {
            $color->delete();
            return redirect()->route('product.index')
                ->with('message', 'color deleted');
    }
}
