<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */

    public function register(Request $request){
        $messages = [
            'email.required' => 'Email should be filled',
            'password.confirmed' => 'Pass',
        ];
        $rule = [
            'email' => ['required', 'string', 'unique:users,email'],
            'password' => ['required', 'string', 'confirmed'],
            'name' => ['string'],
            'area' => ['string'],
            'phone' => ['string'],
        ];

        $fields = Validator::make($request->all(), $rule);
        if ($fields->fails()) {
            $err = array();
            foreach ($fields->errors()->toArray() as $error)  {
                foreach($error as $sub_error){
                    array_push($err, $sub_error);
                }
            }
            
            $response_code = Response::HTTP_UNAUTHORIZED;
            $message = 'Consultation created';

            $response = [
                'response_code' => $response_code,
                'message' => $err,
            ];

            return response()->json($response, $response_code);
        }

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'area' => $request['area'],
            'activeYn' => '1',
            'phone' => $request['phone'],
            // 'lastLoginTime' => now()
        ]);

        //$token = $user->createToken('myapptoken')->plainTextToken;
        $response_code = Response::HTTP_CREATED;
        $message = 'User succesfully created';
        $response = [
            'response_code' => $response_code,
            'message' => $message
        ];

        return response($response, $response_code);
    }

    public function login(Request $request) {
        $fields = $request->validate([
            'email' => ['required', 'string'],
            'password' => ['required', 'string']
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'response_code' => Response::HTTP_UNAUTHORIZED,
                'message' => 'Email or password is incorrect'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $usertoken = $user->createToken('myapptoken')->plainTextToken;

        $response_code = Response::HTTP_OK;
        $message = 'User succesfully logged in';
        $data['user'] = $user;
        $data['user_token'] = $usertoken;
        
        $response = [
            'response_code' => $response_code,
            'message' => $message,
            'data' => $data,
        ];

        return response($response, $response_code);
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();

        $user_id = auth()->user()->id;
        $user_data = User::findOrFail($user_id);
        $user_data->device_token = '';
        $user_data->save();

        $response_code = Response::HTTP_OK;
        $message = 'User succesfully logged out';
        $response = [
            'response_code' => $response_code,
            'message' => $message
        ];

        return response($response, $response_code);
    }
}
