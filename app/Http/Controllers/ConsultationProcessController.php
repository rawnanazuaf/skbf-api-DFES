<?php

namespace App\Http\Controllers;

use App\Models\ConsultationProcess;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConsultationProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ConsultationProcess::select('id', 'process', 'atlas_process')->get();

        $response_code = Response::HTTP_OK;
        $message = 'Consultation Process';

        $response = [
            'response_code' => $response_code,
            'message' => $message,
            'data' => $data
        ];

        return response()->json($response, $response_code);
    }
}
