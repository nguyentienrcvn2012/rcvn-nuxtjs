<?php

namespace App\Http\Controllers\Api\V1;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Order;
use App\Models\Product;
use App\Http\Resources\OrderResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\ProductCreateRequest;
use App\Http\Requests\Api\V1\Auth\ProductUpdateRequest;
use App\Http\Requests\Api\V1\Auth\OrderRequest;
use App\Http\Resources\CategoryResource;

class OrderController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $data = Order::get();
		return OrderResource::collection($data);
        
    }

    public function getById(Request $request){
        $params = $request->all();
        if (empty($params['id']) ) {
            return response()->json([
                'status' => false,
                'mgs' =>'Param id is required'
            ], 301);
        }
        try {   
            $data = Order::where('id', $params['id'])->get();
            return OrderResource::collection($data);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'mgs' => 'false'
            ], 500);
        }
    }

    public function update(Request $request){
        $params = $request->all();
        if (empty($params['id']) ) {
            return response()->json([
                'status' => false,
                'mgs' =>'Param id is required'
            ], 301);
        }
        try {
            $order = Order::where('id', $params['id'])->get();
            if (!empty($order)) {
                $flag = Product::where('id',$params['id'])->update([
                    'status' => 1
                ]);
                return response()->json([
                    'status' => true,
                    'mgs' => 'update success!'
                ], 200);
            }                                   
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'mgs' => 'update false'
            ], 500);
        }
    }
    public function deleteById(Request $request){
        $params = $request->all();
        if (empty($params['id']) ) {
            return response()->json([
                'status' => false,
                'mgs' =>'Param id is required'
            ], 301);
        }
        try {
            if (isset($params['id']) ) {
                $order = Order::where('id', $params['id'])->delete();
                return response()->json([
                    'status' => true,
                    'mgs' => 'delete success!'
                ], 200);
            }
            return response()->json([
                'status' => false,
                'mgs' => 'delete false!'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'mgs' => 'false'
            ], 500);
        }
    }
    public function createOrder(Request $request){
        $params = $request->all();
       \Log::info( auth()->id());
        // try {
            if (empty($params['id']) ) {
                return response()->json([
                    'status' => false,
                    'mgs' =>'Param id is required'
                ], 301);
            }
            $data = Product::where('id', $params['id'])->first();
           
            if (empty($data) ) {
                return response()->json([
                    'status' => false,
                    'mgs' =>'Product no exist'
                ], 301);
            }
            $order_data = [
                'customerId' =>(String)auth()->id(),
                'productId' => $data->id,
                'quantily' => 1,
                'totalPrice' => $data->price *1,
                'status' => 0
            ];
            \Log::info( $order_data);
            $order = Order::create($order_data);
                \Log::info($order->toSql());
                return response()->json([
                    'status' => true,
                    'mgs' => 'create success!'
                ], 200);
        // } catch (\Throwable $th) {
        //     return response()->json([
        //         'status' => false,
        //         'mgs' => 'create false'
        //     ], 500);
        // }
    }
    
}
