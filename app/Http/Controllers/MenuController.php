<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $menu_product_id = Menu::all()->pluck('product_id')->values();
        $menus = Product::with('category', 'type', 'menu')
            ->whereIn('id', $menu_product_id)
            ->get();
        //product not in menu
        $products = Product::with('category', 'type')
            ->whereNotIn('id', $menu_product_id)
            ->get();
        return view('menu.menu',compact('menus','products'));
    }


    public function outOfMenu()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $rules = [
            'product_id' => ['required'],

        ];

        $customMessages = [
            'required' => 'هذا الحقل مطلوب',
        ];

        $validator = Validator::make($request->all(),$rules,$customMessages);

        if ($validator->fails()) {
            return redirect()->route('menu.index')->withErrors($validator);
        }

        $menu = Menu::create([
            'product_id' => $request->product_id,
        ]);

        return redirect()->route('menu.index')->with('message','تمت اضافة المنتج للقائمة اليومية');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Menu $menu
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Menu $menu
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Menu $menu
     */
    public function update(Request $request, Menu $menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Menu $menu
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('menu.index')
            ->with('message', 'تم ازالة المنتج من القائمة اليومية');
    }
}

