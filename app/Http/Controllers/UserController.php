<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function view($sales_id) {
        // get user data
        $data = User::where('id', $sales_id)->first();

        $response_code = Response::HTTP_OK;
        $message = 'User profile';
        
        $response = [
            'response_code' => $response_code,
            'message' => $message,
            'data' => $data,
        ];

        return response($response, $response_code);
    }

    public function edit($sales_id, Request $request) {
        $data = $request->all();
        $user_data = User::findOrFail($sales_id);
        $user_data->update($data);

        $response_code = Response::HTTP_OK;
        $message = 'Profile has been updated';
        
        $response = [
            'response_code' => $response_code,
            'message' => $message,
        ];

        return response($response, $response_code);
    }
}
