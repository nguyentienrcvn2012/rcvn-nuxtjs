<?php

namespace App\Http\Controllers\Api\V1;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use GuzzleHttp\Exception\ClientException;
use CloudCreativity\LaravelJsonApi\Document\Error\Error;
use CloudCreativity\LaravelJsonApi\Http\Controllers\JsonApiController;
use App\Models\Customer;
use App\Http\Resources\CustomerResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\CustomerRequest;
use App\Http\Requests\Api\V1\Auth\CustomerByIdRequest;
use App\Http\Requests\Api\V1\Auth\CustomerCreateRequest;
use App\Http\Requests\Api\V1\Auth\Test;
class ProductController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $data = Customer::get();
		return CustomerResource::collection($data);
        
    }

    public function getById(CustomerByIdRequest $request){
        try {
            $params = $request->all();
            if (isset($params['id']) ) {
                $data = Customer::where('id', $params['id'])->get();
                return CustomerResource::collection($data);
            }
            
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'mgs' => 'false'
            ], 500);
        }
    }

    public function update(CustomerRequest $request){
        try {
            $params = $request->all();
            if (isset($params['id']) ) {
                $customer = Customer::where('id', $params['id'])->get();
                if (!empty($customer)) {
                    Customer::where('id',$params['id'])->update([
                        'name' => $params['name'],
                        'email' => $params['email'],
                        'phone' => $params['phone'],
                        'address' => $params['address']
                    ]);
                    return response()->json([
                        'status' => true,
                        'mgs' => 'update success!'
                    ], 200);
                }

                return response()->json([
                    'status' => false,
                    'mgs' => 'update false!'
                ], 200);
            }                                           
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'mgs' => 'update false'
            ], 500);
        }
    }
    public function deleteById(CustomerByIdRequest $request){
        try {
            $params = $request->all();
            if (isset($params['id']) ) {
                $customer = Customer::where('id', $params['id'])->delete();
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

    public function create(CustomerCreateRequest $request){
        try {
            $params = $request->all();
            if (!empty($params)) {
                Customer::create([
                    'name' => $params['name'] ,
                    'email' => $params['email'],
                    'phone' => $params['phone'],
                    'address' => $params['address']
                ]);
                return response()->json([
                    'status' => true,
                    'mgs' => 'create success!'
                ], 200);
            }

            return response()->json([
                'status' => false,
                'mgs' => 'create false!'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'mgs' => 'create false'
            ], 500);
        }
    }

}
