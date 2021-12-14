<?php

namespace App\Http\Controllers\Api\V1;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use GuzzleHttp\Exception\ClientException;
use CloudCreativity\LaravelJsonApi\Document\Error\Error;
use CloudCreativity\LaravelJsonApi\Http\Controllers\JsonApiController;
use App\Models\Users;
use App\Http\Resources\UsersResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\UsersRequest;
use App\Http\Requests\Api\V1\Auth\UsersByIdRequest;
use App\Http\Requests\Api\V1\Auth\UsersCreateRequest;
class UserController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $data = Users::get();
		return UsersResource::collection($data);
        
    }

    public function getById(UsersByIdRequest $request){
        try {
            
            $params = $request->all();
            if (isset($params['id']) ) {
                $data = Users::where('id', $params['id'])->get();
                return UsersResource::collection($data);
            }
            
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'mgs' => 'false'
            ], 500);
        }
    }

    public function update(UsersRequest $request){
        try {
            $params = $request->all();
            if (isset($params['id']) ) {
                $customer = Users::where('id', $params['id'])->get();
                if (!empty($customer)) {
                    Users::where('id',$params['id'])->update([
                        'name' => $params['name'],
                        'email' => $params['email'],
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
    public function deleteById(UsersByIdRequest $request){
        try {
            $params = $request->all();
            if (isset($params['id']) ) {
                $customer = Users::where('id', $params['id'])->delete();
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

    public function create(UsersCreateRequest $request){
        try {
            $params = $request->all();
            
            if (!empty($params)) {
                Users::create([
                    'name' => $params['name'],
                    'email' => $params['email'],
                    'password' =>$params['password'],
                ]);
                return response()->json([
                    'status' => true,
                    'mgs' => 'create success',
                ], 200);
            }
            return response()->json([
                'status' => false,
                'mgs' => 'create false!'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'mgs' => 'create false 500',
            ], 500);
        }
    }

}
