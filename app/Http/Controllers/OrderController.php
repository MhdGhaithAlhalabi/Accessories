<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $orderList = $request->orderList;
            $order = json_decode($orderList, true);
            $collection = collect($order);
            $c_price = 0;
            //  $temp = 0;
            for ($i = 0; $i < $collection->count(); $i++) {
                $product_id = $collection[$i]['id'];
                $price = Product::find($product_id)->price;
                $priceSale = Product::find($product_id)->priceSale;
                $qty = $collection[$i]['qty'];
                if ($priceSale == NULL) {
                    $c_price = $c_price + $price * $qty;
                } else {
                    $c_price = $c_price + $priceSale * $qty;
                }

            }
            $customer_id = $request->customerId;
            $amount = $c_price;
            $address =$request->address;

            $cart = Cart::create([
                'customer_id' => $customer_id,
                'amount' => $amount,
                'address'=>$address,
                'status' => 'waiting',
            ]);
            $mytime = Carbon::now();
            $date = $mytime->toDateTimeString();
            $tt = 'new order';
            $text = $tt . $date;
           // event(new orderStore($text));

            $cart_id = DB::table('carts')
                ->select('id')
                ->where('customer_id', '=', $customer_id)
                ->orderBy('id', 'desc')
                ->first()->id;

            for ($i = 0; $i < $collection->count(); $i++) {
                $p = $collection[$i]['id'];
                $q = $collection[$i]['qty'];
                $c = $collection[$i]['color'];
                $h = $collection[$i]['has_name'];
                $m = $collection[$i]['has_measure'];

                Order::create(
                    [
                        'product_id' => $p,
                        'cart_id' => $cart_id,
                        'qty' => $q,
                        'color'=>$c,
                        'has_name'=>$h,
                        'has_measure'=>$m
                    ]
                );
            }

return  Response()->json('done', 201);

        } catch (\Exception $e) {
            return Response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
