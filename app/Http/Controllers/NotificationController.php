<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NotificationController extends Controller
{
    /**
     * Save device token
     *
     * @return \Illuminate\Http\Response
     */
    public function saveToken(Request $request)
    {
        
        $user_id = auth()->user()->id;
        $data = $request->all();
        $user_data = User::findOrFail($user_id);
        $user_data->device_token = $data['device_token'];
        $user_data->save();
        $response_code = Response::HTTP_OK;
        $message = 'Device token saved successfully';

        $response = [
            'response_code' => $response_code,
            'message' => $message
        ];

        return response()->json($response, $response_code);
    }

    /**
     * Remove device token
     *
     * @return \Illuminate\Http\Response
     */
    public function removeToken()
    {
        
        $user_id = auth()->user()->id;
        $user_data = User::findOrFail($user_id);
        $user_data->device_token = '';
        $user_data->save();
        $response_code = Response::HTTP_OK;
        $message = 'Device token removed successfully';

        $response = [
            'response_code' => $response_code,
            'message' => $message
        ];

        return response()->json($response, $response_code);
    }

    /**
     * Send notification to specific user
     *
     * @return response()
     */
    public function sendNotificationOne(Request $request)
    {
        $data = $request->all();
        $firebaseToken = User::where('id', $data['id'])->pluck('device_token')->all();
        
        $SERVER_API_KEY = config('api.FCM_API_KEY');
        // $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $request->title,
                "body" => $request->body,
                "content_available" => true,
                "priority" => "high",
            ]
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        dd($response);
    }

    /**
     * Send notification to specific user
     *
     * @return response()
     */
    public function sendNotificationAll(Request $request)
    {
        $data = $request->all();
        $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();
        
        $SERVER_API_KEY = config('api.FCM_API_KEY');
        
        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $request->title,
                "body" => $request->body,
                "content_available" => true,
                "priority" => "high",
            ]
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        dd($response);
    }
}

