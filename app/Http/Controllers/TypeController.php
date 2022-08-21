<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        return view('type.show_type',compact('types'));
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
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', 'unique:types'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('type.create')->withErrors($validator);
        }

        $product = Type::create([
            'name' => $request->name,
        ]);

        return redirect()->route('type.create')->with('message','success');
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
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', 'unique:types'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('type.edit',$type)->withErrors($validator);
        }
        if(asset($type)){
            $type->update($request->all());
            return redirect()->route('type.index')->with('message','success');

        }else{
            return redirect()->route('type.index')->with('message','you cant do that');
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
            ->with('message','type deleted');
    }
    public function findTypeByName(Request $request)
    {
        $data = Category::select('name', 'id')->where('type_id',$request->id)->take(100)->get();
        return response()->json($data);
    }
}
