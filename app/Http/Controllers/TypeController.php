<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $types = Type::all();
        $categories = Category::with('type')->get();
        return view('type.show_type',compact('types','categories'));
    }
    public function typeView(){
        $types = Type::select('id','type_name')->get();
        return $types;
    }
    public function categoryView($id){
        $category = Category::select('id','category_name','type_id','category_image')->where('type_id','=',$id)->get();
        return $category;
    }
    public function productView($type_id,$category_id){
        $menu_product_id = Menu::all()->pluck('product_id')->values();
        $product = Product::all()->where('type_id','=',$type_id)
        ->where('category_id','=',$category_id)
        ->whereIn('id',$menu_product_id) ;
        return $product;
    }
    public function offerView(){
        $menu_product_id = Menu::all()->pluck('product_id')->values();
        $product = Product::with('type:id,type_name','category:id,category_name,type_id,category_image','color:id,color,product_id,color_hex','color.image:id,url,color_id')
        ->where('status','=','1')
        ->whereIn('id',$menu_product_id)->get() ;
        return $product;
    }
    public function searchByName(Request $request){
        $name = $request->name;
        $menu_product_id = Menu::all()->pluck('product_id')->values();
        $product = Product::with('type:id,type_name','category:id,category_name,type_id,category_image','color:id,color,product_id,color_hex','color.image:id,url,color_id')
        ->where('name','like',"%{$name}%")
        ->whereIn('id',$menu_product_id)->get() ;
        return $product;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('type.create_type');
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
            'type_name' => ['required', 'string', 'max:255', 'unique:types'],
           // 'type_image' => ['required','url']
        ];

        $customMessages = [
            'required' => 'هذا الحقل مطلوب',
            'unique' => 'الاسم موجود سابقاَ',
            'url'=> 'يجب ان يكون رابط'
        ];
        $validator = Validator::make($request->all(), $rules,$customMessages);

        if ($validator->fails()) {
            return redirect()->route('type.index')->withErrors($validator);
        }

        $product = Type::create([
            'type_name' => $request->type_name,
         //   'type_image' => $request->type_image,

        ]);

        return redirect()->route('type.index')->with('message','تمت اضافة النوع');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Type $type)
    {
        return view('type.edit_type',compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request,  Type $type)
    {
        $rules = [
            'type_name' => ['required', 'string', 'max:255','unique:types,type_name,'.$type->id],
         //   'type_image' => ['required','url']
        ];

        $customMessages = [
            'required' => 'هذا الحقل مطلوب',
            'url'=>'يجب ان يكون رابط',
            'unique'=> 'هذا الاسم موجود سابقاً',
        ];
        $validator = Validator::make($request->all(),$rules,$customMessages );

        if ($validator->fails()) {
            return redirect()->route('type.edit',$type)->withErrors($validator);
        }
        if(asset($type)){
            $type->update($request->all());
            return redirect()->route('type.index')->with('message','تمت تعديل النوع');

        }else{
            return redirect()->route('type.index')->with('message','لا يمكن الاضافة');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('type.index')
            ->with('message','تم حذف النوع');
    }
    public function findTypeByName(Request $request)
    {
        $data = Category::select('category_name', 'id')->where('type_id',$request->id)->take(100)->get();
        return response()->json($data);
    }
}
