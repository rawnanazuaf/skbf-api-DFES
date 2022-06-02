<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function uploadImage(Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'required|image:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if ($validator->fails()) {
            return sendCustomResponse($validator->messages()->first(),  'error', 500);
        }
        $uploadFolder = 'users';
        $image = $request->file('image');
        $image_uploaded_path = $image->store($uploadFolder, 'public');
        $uploadedImageResponse = array(
            "image_name" => basename($image_uploaded_path),
            "image_url" => Storage::disk('public')-  >url($image_uploaded_path),
            "mime" => $image->getClientMimeType()
        );
        return sendCustomResponse('File Uploaded Successfully', 'success',   200, $uploadedImageResponse);
    }
}
