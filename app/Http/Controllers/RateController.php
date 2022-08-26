<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Rate;
use Illuminate\Http\Request;

class RateController extends Controller
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
        $rates = $request->rateList;
        $customerId = $request->customer_id;
        $rate = json_decode($rates, true);
        $collection = collect($rate);

        for ($i = 0; $i < $collection->count(); $i++) {
            $p = $collection[$i]['id'];
            $r = $collection[$i]['rate'];
            $r1 = Rate::where('customer_id', '=', $customerId)->where('product_id', '=', $p)->first();
            if ($r1 == NULL) {
                Rate::create(
                    [
                        'product_id' => $p,
                        'customer_id' => $customerId,
                        'rate' => $r,
                    ]
                );
            }else {
                $this_rate = Rate::find($r1->id);
                $this_rate->rate = $r;
                $this_rate->save();
            }
            $the_rate = Rate::all()->where('product_id', '=', $p)->average('rate');
            $product = Product::find($p);

            $rate = $the_rate;
            $product->rate = $rate;
            $product->save();
        }

        return Response()->json('rate stored', 201);


    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rate  $rate
     * @return float|int
     */
    public function show($id)
    {
        $rate = Rate::all()->where('product_id', '=', $id)->average('rate');
        return $rate;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function edit(Rate $rate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rate $rate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rate $rate)
    {
        //
    }
}
