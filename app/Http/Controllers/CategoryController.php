<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $categories = Category::with('type')->get();
        return view('category.show_category',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $types = Type::all();
        return view('category.create_category',compact('types'));
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
            'category_name' => ['required', 'string', 'max:255', 'unique:categories'],
            'type_id'=>['required'],
            'category_image'=>['required','url'],
        ];

        $customMessages = [
            'required' => 'هذا الحقل مطلوب',
            'unique'=> 'هذا الاسم موجود سابقاً',
            'url'=>'يجب ان يكون رابط'

        ];
        $validator = Validator::make($request->all(),$rules,$customMessages);


        if ($validator->fails()) {
            return redirect()->route('type.index')->withErrors($validator);
        }

        $category = Category::create([
            'category_name' => $request->category_name,
            'type_id'=>$request->type_id,
            'category_image'=>$request->category_image
        ]);

        return redirect()->route('type.index')->with('message','تمت اضافة الصنف');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Category $category)
    {
        $types = Type::all();
        return view('category.edit_category',compact('category','types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Category $category)
    {
        $rules = [
            'category_name' => ['required', 'string', 'max:255','unique:categories,category_name,'.$category->id],
            'type_id'=>['required'],
            'category_image' => ['required','url']
        ];

        $customMessages = [
            'required' => 'هذا الحقل مطلوب',
            'url'=>'يجب ان يكون رابط'
        ];

        $validator = Validator::make($request->all(),$rules,$customMessages);

        if ($validator->fails()) {
            return redirect()->route('category.edit',$category)->withErrors($validator);
        }
        if(asset($category)){
            $category->update($request->all());
            return redirect()->route('type.index')->with('message','تم تعديل الصنف');

        }else{
            return redirect()->route('type.index')->with('message','لا يمكنك التعديل');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('type.index')
            ->with('message','تم حذف الصنف');
    }
}
