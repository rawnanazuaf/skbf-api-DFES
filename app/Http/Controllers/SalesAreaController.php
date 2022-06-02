<?php

namespace App\Http\Controllers;

use App\Models\SalesArea;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SalesAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = SalesArea::select('area', 'branch')->get();

        $response_code = Response::HTTP_OK;
        $message = 'Sales Area';

        $response = [
            'response_code' => $response_code,
            'message' => $message,
            'data' => $data
        ];

        return response()->json($response, $response_code);
    }
}
