<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $images = Image::with('product');
        return view('image.show_image',compact('images'));
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
        return view('image.create_image',compact('products'));
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
            'url' => ['required', 'string', 'max:255'],
            'product_id'=>['required']
        ]);

        if ($validator->fails()) {
            return redirect()->route('image.create',$request->product_id)->withErrors($validator);
        }

        $image = Image::create([
            'url' => $request->url,
            'product_id'=>$request->product_id
        ]);

        return redirect()->route('image.create',$request->product_id)->with('message','success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\image  $image
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(image $image)
    {
        $collct = collect($image->product_id);

        $product = Product::find($collct)->first();
        return view('image.edit_image',compact('image','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\image  $image
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, image $image)
    {
        $validator = Validator::make($request->all(), [
            'url' => ['required', 'string', 'max:255'],
            'product_id' => ['required']
        ]);

        if ($validator->fails()) {
            return redirect()->route('image.edit',$image)->withErrors($validator);
        }
        if(asset($image)){
            $image->update($request->all());
            return redirect()->route('product.index')->with('message','success');

        }else{
            return redirect()->route('product.index')->with('message','you cant do that');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\image  $image
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(image $image)
    {
        $image->delete();
        return redirect()->route('product.index')
            ->with('message', 'image deleted');
    }
}
