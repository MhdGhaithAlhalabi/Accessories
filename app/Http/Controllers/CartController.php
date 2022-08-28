<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        $carts = Cart::with('order:cart_id,qty,product_id',
            'order.product:id,name',
            'customer:id,name,phone')
            ->where('status', '=', 'waiting')->get();


        return $carts;
    }
    public function cartView(Cart $cart){
        return view('cart.cart_view',compact('cart'));
    }
    public function cartDone(Cart $cart)
    {
            $cart->status = 'done';
            $cart->save();

        return redirect()->route('dashboard')->with('message','تمت التعيين كجاهزة');

    }
    public function index2($customer_id)
    {
        $carts = Cart::with('order:cart_id,qty,product_id',
            'order.product:id,name,details,price,priceSale,status,rate,type_id',
            'order.product.type:id,type_name')
            ->where('customer_id', '=', $customer_id)
            ->latest()->get();
        return $carts;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();
        return redirect()->route('dashboard')
            ->with('message','تم حذف الطلب');
    }
}
