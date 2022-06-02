<?php

namespace App\Http\Controllers;

use App\Models\NewsPromo;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class NewsPromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = NewsPromo::orderBy('created_at', 'DESC')->get();
        $response_code = Response::HTTP_OK;
        $response = [
            'response_code' => $response_code,
            'message' => 'List of news and promotion order by constultation date',
            'data' => $news
        ];

        return response()->json($response, $response_code);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required'],
            'category' => ['required'],
            'content' => ['required']
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),

            Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try{
            $user = auth()->user();
            // $name = $request->file('image')->getClientOriginalName();
            $id = NewsPromo::max('id') + 1;
            $file = $request->file('image');
            $extension = $file->extension();
            $name = 'news'.$id.".".$extension;
            $data = $request->file('image')->storeAs('public/files/news/', $name);
            $data = $request->all();
            $data['image'] = $name;
            $data['author'] = $user->id;
            $newspromo = NewsPromo::create($data);
            $response_code = Response::HTTP_CREATED;
            $response = [
                'response_code' => $response_code,
                'message' => 'NewsPromo created',
                'data' => $newspromo
            ];

            return response()->json($response, $response_code);
        }catch(QueryException $e){
            return response()->json([
                'message' => "Failed".$e->errorInfo
            ]);
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $news = NewsPromo::where('id', $id)->first();
        $response_code = Response::HTTP_OK;
        $response = [
            'response_code' => $response_code,
            'message' => 'NewsPromo detail',
            'data' => $news
        ];

        return response()->json($response, $response_code);
    }
}
