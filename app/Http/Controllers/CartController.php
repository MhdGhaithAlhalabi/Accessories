<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    use GeneralTrait;
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

        return redirect()->back()->with('message','تمت التعيين كجاهزة');

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
        return redirect()->route('cart.ondel')
            ->with('message','تم حذف الطلب');
    }
    public function ondel()
    {
        return view('cart.ondel');
    }
}
