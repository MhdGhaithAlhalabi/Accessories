<?php

namespace App\Http\Controllers;

use App\Models\Color;
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
         $colors = Color::find($num)->first();
        return view('image.create_image',compact('colors'));
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
            'url' => ['required', 'string', 'url'],
            'color_id'=>['required']
        ];

        $customMessages = [
            'required' => 'هذا الحقل مطلوب',
            'url'=>'يجب وضع رابط'
        ];
        $validator = Validator::make($request->all(),$rules,$customMessages);

        if ($validator->fails()) {
            return redirect()->route('image.create',$request->color_id)->withErrors($validator);
        }

        $image = Image::create([
            'url' => $request->url,
            'color_id'=>$request->color_id
        ]);

        return redirect()->route('image.create',$request->color_id)->with('message','تم اضافة الصورة');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\image  $image
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(image $image)
    {
        $collct = collect($image->color_id);
        $color = Color::find($collct)->first();
        return view('image.edit_image',compact('image','color'));
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
        $rules = [
            'url' => ['required', 'string', 'url'],
            'color_id'=>['required']        ];

        $customMessages = [
            'required' => 'هذا الحقل مطلوب',
            'url'=>'يجب وضع رابط'
        ];
        $validator = Validator::make($request->all(),$rules,$customMessages);


        if ($validator->fails()) {
            return redirect()->route('image.edit',$image)->withErrors($validator);
        }
        if(asset($image)){
            $image->update($request->all());
            return redirect()->route('image.edit',$image)->with('message','تم تعديل الصورة');

        }else{
            return redirect()->route('image.edit',$image)->with('message','لا يمكن التعديل');
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
            ->with('message', 'تم حذف الصورة');
    }
}
