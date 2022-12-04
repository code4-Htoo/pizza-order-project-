<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    // return pizza list
    public function pizzaList(Request $requset){
        // logger($requset->status);
        if($requset->status == 'descending'){
            $data = Product::orderBy('created_at','desc')->get();
        }else{
            $data = Product::orderBy('created_at','asc')->get();
        }
        return response()->json($data, 200);
    }

    // reutrun pizza list
    public function addToCart(Request $requset){
        $data = $this->getOrderData($requset);
        Cart::create($data);

        $response =[
            'message' => 'Add to cart Complete',
            'status' => 'success'
        ];
        return response()->json($response, 200);
    }

    // order
    public function order(Request $request){
        $total = 0;
        foreach($request->all() as $item){
            $data = OrderList::create([
                'user_id' => $item ['user_id'],
                'product_id' => $item ['product_id'],
                'qty' => $item ['qty'],
                'total' => $item ['total'],
                'order_code' => $item ['order_code'],
            ]);

            $total += $data->total;
        }

        Cart::where('user_id',Auth::user()->id)->delete();


        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' =>$data->order_code,
            'total_price' => $total+3000,
        ]);

            return response()->json([
                'status' => 'true',
                'message' => 'Order ပြီးဆုံး'
            ], 200);
    }

    // get order data
    private function getOrderData($requset){
        return [
            'user_id' => $requset->userId,
            'product_id' => $requset->pizzaId,
            'qty' => $requset->count,
            'created_at' => Carbon::now(),
            'updated_at'=> Carbon::now(),
        ];
    }

    // clear cart
    public function clearCart(){
        Cart::where('user_id',Auth::user()->id)->delete();
    }

    // clear current product
    public function clearCurrentProduct (Request $request){
        Cart::where('user_id',Auth::user()->id)
        ->where('product_id',$request->productId)
        ->where('id',$request->orderId)
        ->delete();
    }

    // increase view count
    public function increaseVieweCount(Request $request){
        $pizza = Product::where('id',$request->productId)->first();

        $viewCount = [
            'view_count' => $pizza->view_count +1
        ];
        Product::where('id',$request->productId)->update($viewCount);
    }
}
