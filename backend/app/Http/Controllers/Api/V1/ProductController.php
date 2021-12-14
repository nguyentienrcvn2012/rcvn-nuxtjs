<?php

namespace App\Http\Controllers\Api\V1;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Product;
use App\Models\Category;
use App\Http\Resources\ProductResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\ProductCreateRequest;
use App\Http\Requests\Api\V1\Auth\ProductUpdateRequest;
use App\Http\Resources\CategoryResource;

class ProductController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $data = Product::get();
		return ProductResource::collection($data);
        
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
            $data = Product::where('id', $params['id'])->get();
            return ProductResource::collection($data);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'mgs' => 'false'
            ], 500);
        }
    }

    public function update(ProductUpdateRequest $request){
        $params = $request->all();
        if (empty($params['id']) ) {
            return response()->json([
                'status' => false,
                'mgs' =>'Param id is required'
            ], 301);
        }
        try {
            $product = Product::where('id', $params['id'])->get();
            if (!empty($product)) {
                $flag = Product::where('id',$params['id'])->update([
                    'productName' => $params['productName'],
                    'categoryId' => $params['categoryId'],
                    'price' => $params['price'],
                    'inventory' => $params['inventory'],
                    'description' => $params['description']
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
                $product = Product::where('id', $params['id'])->delete();
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

    public function create(ProductCreateRequest $request){
        try {
            $params = $request->all();
                Product::create([
                    'productName' => $params['productName'] ,
                    'description' => $params['description'],
                    'categoryId' => $params['categoryId'],
                    'price' => $params['price'],
                    'inventory' => $params['inventory']
                ]);
                return response()->json([
                    'status' => true,
                    'mgs' => 'create success!'
                ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'mgs' => 'create false'
            ], 500);
        }
    }
    public function getCategory(){
        $data  = Category::get();
        return  CategoryResource::collection($data);
    }

}
