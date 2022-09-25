<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Type;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypeController extends Controller
{
    use GeneralTrait;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $types = Type::all();
        return view('type.create_type',compact('types'));
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
        ];

        $customMessages = [
            'required' => 'هذا الحقل مطلوب',
            'unique' => 'الاسم موجود سابقاَ',
            'url'=> 'يجب ان يكون رابط'
        ];
        $validator = Validator::make($request->all(), $rules,$customMessages);

        if ($validator->fails()) {
            return redirect()->route('type.create')->withErrors($validator);
        }

        $product = Type::create([
            'type_name' => $request->type_name,

        ]);

        return redirect()->route('type.create')->with('message','تمت اضافة النوع');
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
            return redirect()->route('type.create')->with('message','تمت تعديل النوع');

        }else{
            return redirect()->route('type.create')->with('message','لا يمكن الاضافة');
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
        return redirect()->route('type.create')
            ->with('message','تم حذف النوع');
    }
    public function findTypeByName(Request $request)
    {
        $data = Category::select('category_name', 'id')->where('type_id',$request->id)->take(100)->get();
        return response()->json($data);
    }
}
