<?php

namespace App\Http\Controllers\Api\Customer;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Feedback;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Product;
use App\Models\Rate;
use App\Models\Type;
use App\Traits\GeneralTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{

    use GeneralTrait;

    public function __construct()
    {
        $this->middleware('auth:customer-api');
    }
    public function typeView(){
        $types = Type::select('id','type_name')
            ->get();
        return $this->returnData('types',$types);
    }
    public function categoryView($id){
        $category = Category::select('id','category_name','type_id','category_image')
            ->where('type_id','=',$id)
            ->get();
        return $this->returnData('category',$category);
    }
    public function productView($type_id,$category_id){
        $menu_product_id = Menu::all()->pluck('product_id')->values();
        $product = Product::all()->where('type_id','=',$type_id)
            ->where('category_id','=',$category_id)
            ->whereIn('id',$menu_product_id) ;
        return $this->returnData('product',$product);
    }
    public function offerView(){
        $menu_product_id = Menu::all()->pluck('product_id')->values();
        $product = Product::with('type:id,type_name','category:id,category_name,type_id,category_image','color:id,color,product_id,color_hex','color.image:id,url,color_id')
            ->where('status','=','1')
            ->whereIn('id',$menu_product_id)->get() ;
        return $this->returnData('product',$product);
    }
    public function searchByName(Request $request){
        $name = $request->name;
        $menu_product_id = Menu::all()->pluck('product_id')->values();
        $product = Product::with('type:id,type_name','category:id,category_name,type_id,category_image','color:id,color,product_id,color_hex','color.image:id,url,color_id')
            ->where('name','like',"%{$name}%")
            ->whereIn('id',$menu_product_id)->get() ;
        return $this->returnData('product',$product);
    }

    public function rateStore(Request $request)
    {
        try {
            $rates = $request->rateList;
            $customerId = $request->customer_id;
            $rate = json_decode($rates, true);
            $collection = collect($rate);
            $validator = Validator::make([
                    'rateList' => $rates,
                    'customer_id' => $customerId,
                ]
                ,
                [
                    'rateList' => ['required'],
                    'customer_id' => ['required'],
                ]);

            if ($validator->fails()) {

                return $this->returnValidationError($validator->getMessageBag());
            }
            for ($i = 0; $i < $collection->count(); $i++) {
                $validator = Validator::make([
                        'product_id' => $collection[$i]['id'],
                        'rate' => $collection[$i]['rate'],
                    ]
                    ,
                    [
                        'product_id' => ['required'],
                        'rate' => ['required'],
                    ]);

                if ($validator->fails()) {

                    return $this->returnValidationError($validator->getMessageBag());
                }
            }
            for ($i = 0; $i < $collection->count(); $i++) {
                $p = $collection[$i]['id'];
                $r = $collection[$i]['rate'];
                $r1 = Rate::where('customer_id', '=', $customerId)
                    ->where('product_id', '=', $p)
                    ->first();
                if ($r1 == NULL) {
                    Rate::create(
                        [
                            'product_id' => $p,
                            'customer_id' => $customerId,
                            'rate' => $r,
                        ]
                    );
                } else {
                    $this_rate = Rate::find($r1->id);
                    $this_rate->rate = $r;
                    $this_rate->save();
                }
                $the_rate = Rate::all()->where('product_id', '=', $p)
                    ->average('rate');
                $product = Product::find($p);

                $rate = $the_rate;
                $product->rate = $rate;
                $product->save();
            }
        }catch (Exception $e){
            return  $this->returnError($e->getMessage());
        }
        return$this->returnSuccessMessage('rate stored');

    }
    public function orderCustomerView($customer_id)
    {
        $carts = Cart::with('order:cart_id,qty,product_id,color,has_name,has_measure',
            'order.product:id,name,details,price,priceSale,status,rate,type_id,category_id,has_name,has_measure',
            'order.product.type:id,type_name',
            'order.product.category:id,type_id,category_name,category_image',
            'order.product.color:id,color,product_id,color_hex',
            'order.product.color.image:id,url,color_id')
            ->where('customer_id', '=', $customer_id)
            ->latest()->get();
        return $this->returnData('carts',$carts)   ;
    }
    public function orderStore(Request $request)
    {
        try {
            $orderList = $request->orderList;
            $order = json_decode($orderList, true);
            $collection = collect($order);
            $c_price = 0;
            //  $temp = 0;
            $validator = Validator::make([
                    'orderList' => $orderList,

                ]
                ,
                [
                    'orderList' => ['required'],

                ]);

            if ($validator->fails()) {

                return  $this->returnValidationError($validator->getMessageBag());
            }
            for ($i = 0; $i < $collection->count(); $i++) {
                $validator = Validator::make([
                        'product_id' => $collection[$i]['id'],
                        'qty'=> $collection[$i]['qty'],
                    ]
                    ,
                    [
                        'product_id' => ['required'],
                        'qty' => ['required'],

                    ]);

                if ($validator->fails()) {

                    return  $this->returnValidationError($validator->getMessageBag());
                }
            }
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
            $customer_id = $request->customer_id;
            $amount = $c_price;
            $address =$request->address;
            $validator = Validator::make([
                    'customer_id' => $customer_id,
                    'amount' => $amount,
                    'address' => $address,
                ]
                ,
                [
                    'customer_id' => ['required'],
                    'amount'=> ['required'],
                    'address'=>['required'],
                ]);

            if ($validator->fails()) {

                return  $this->returnValidationError($validator->getMessageBag());
            }
             Cart::create([
                'customer_id' => $customer_id,
                'amount' => $amount,
                'address'=>$address,
                'status' => 'waiting',
            ]);
            $myTime = Carbon::now();
            $date = $myTime->toDateTimeString();
            $tt = 'new order';
            $text = $tt . $date;
            // event(new orderStore($text));

            $cart_id = DB::table('carts')
                ->select('id')
                ->where('customer_id', '=', $customer_id)
                ->orderBy('id', 'desc')
                ->first()->id;
            for ($i = 0; $i < $collection->count(); $i++) {
                $validator = Validator::make([
                        'id' => $collection[$i]['id'],
                        'qty' => $collection[$i]['qty'],
                        'color' => $collection[$i]['color'],
                    ]
                    ,
                    [
                        'id' => ['required'],
                        'qty'=> ['required'],
                        'color'=>['required'],
                    ]);

                if ($validator->fails()) {

                    return  $this->returnValidationError($validator->getMessageBag());
                }
            }
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


        } catch (Exception $e) {
            return  $this->returnError($e->getMessage());
        }
        return  $this->returnSuccessMessage('cart submitted');

    }
    public function feedbackStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => ['required'],
            'customer_id' => ['required'],
        ]);

        if ($validator->fails()) {

            return  $this->returnValidationError($validator->getMessageBag());
        }

        Feedback::create([
            'message' => $request->message,
            'customer_id' => $request->customer_id,
            'status' => 0
        ]);

        return  $this->returnSuccessMessage('feedback stored successfully');

    }
    public function menu()
    {
        $menu_product_id = Menu::all()->pluck('product_id')->values();
        $menu = Product::with('type:id,type_name','category:id,category_name,type_id,category_image','color:id,color,product_id,color_hex','color.image:id,url,color_id')
            ->whereIn('id', $menu_product_id)
            ->get();
        return $this->returnData('menu',$menu);
    }

}
