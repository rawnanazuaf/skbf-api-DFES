<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\ConsultationStatus;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $consultation = Consultation::orderBy('consultation_date', 'DESC')->get();
        
        DB::enableQueryLog();
        $consultation = Consultation::join(DB::raw('(SELECT consultation_id, min(review_process) as review_process, review_state from `consultation_statuses` where `review_state` is null or `review_state` = 0 group by consultation_id) A'), function($join){
            $join->on('consultations.consultation_id', 'A.consultation_id');
        })->selectRaw('consultations.*, A.*')
        ->orderBy('consultation_date', 'DESC')->get();

        // dd(DB::getQueryLog());

        $response_code = Response::HTTP_OK;
        $message = 'List consultation order by constultation date';

        $response = [
            'response_code' => $response_code,
            'message' => $message,
            'data' => $consultation
        ];

        return response()->json($response, $response_code);
    }

    public function all($sales_id)
    {
        // $consultation = Consultation::orderBy('consultation_date', 'DESC')->get();
        
        // DB::enableQueryLog();
        
        DB::enableQueryLog();
        $consultation = Consultation::join(DB::raw('(SELECT consultation_id, min(review_process) as review_process, review_state from `consultation_statuses` group by consultation_id) A'), function($join){
            $join->on('consultations.consultation_id', 'A.consultation_id');
        })->selectRaw('consultations.*, A.*')
        ->where('sales_id', $sales_id)
        ->orderBy('consultation_date', 'DESC')->get();

        // dd(DB::getQueryLog());

        $response_code = Response::HTTP_OK;
        $message = 'List consultation order by constultation date';

        $response = [
            'response_code' => $response_code,
            'message' => $message,
            'data' => $consultation
        ];

        return response()->json($response, $response_code);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'customer_name' => ['required'],
            'vehicle_model' => ['required'],
            'vehicle_year' => ['required'],
            'vehicle_price' => ['required', 'numeric'],
            'consultation_area' => ['required']
        ]);

        if($validator->fails()){
            $response_code = Response::HTTP_UNPROCESSABLE_ENTITY;
            $message = array();
            foreach ($validator->errors()->toArray() as $error)  {
                foreach($error as $sub_error){
                    array_push($err, $sub_error);
                }
            }

            $response = [
                'response_code' => $response_code,
                'message' => $message
            ];

            return response()->json($response, $response_code);
        }

        try{
            $user = auth()->user();
            $data = $request->all();
            $id = Consultation::max('id') + 1;
            if($request->has('ktp')){
                $id = Consultation::max('id') + 1;
                $file = $request->file('ktp');
                $extension = $file->extension();
                $name = $id."_KTP.".$extension;
                $file->storeAs('public/files/'.$user->id, $name);              
                $data['ktp'] = $name;
            }
            if($request->has('kk')){
                $id = Consultation::max('id') + 1;
                $file = $request->file('kk');
                $extension = $file->extension();
                $name = $id."_KK.".$extension;
                $file->storeAs('public/files/'.$user->id, $name);              
                $data['kk'] = $name;
            }
            if($request->has('npwp')){
                $id = Consultation::max('id') + 1;
                $file = $request->file('npwp');
                $extension = $file->extension();
                $name = $id."_NPWP.".$extension;
                $file->storeAs('public/files/'.$user->id, $name);              
                $data['npwp'] = $name;
            }
            $data['sales_name'] = $user->name;
            $consultation_id = 'APP'.str_pad($id, 5, '0', STR_PAD_LEFT);
            $data['sales_id'] = $user->id;
            $consultation = Consultation::create($data);
            $consultation_status_data = array(
                array('consultation_id'=>$consultation_id, 'review_process'=>'1'),
                array('consultation_id'=>$consultation_id, 'review_process'=>'2'),
                array('consultation_id'=>$consultation_id, 'review_process'=>'3'),
                array('consultation_id'=>$consultation_id, 'review_process'=>'4'),
                array('consultation_id'=>$consultation_id, 'review_process'=>'5'),
                array('consultation_id'=>$consultation_id, 'review_process'=>'6'),
                array('consultation_id'=>$consultation_id, 'review_process'=>'7')
            );
            ConsultationStatus::insert($consultation_status_data);

            $response_code = Response::HTTP_CREATED;
            $message = 'Consultation created';
            $data = Consultation::where('consultation_id', $consultation_id)->get();

            $response = [
                'response_code' => $response_code,
                'message' => $message,
                'data' => $data
            ];

            return response()->json($response, $response_code);
        }catch(QueryException $e){
            return response()->json([
                'message' => "Failed".var_dump($e->errorInfo)
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($consultation_id)
    {
        $consultation = Consultation::where('consultation_id', $consultation_id)->firstOrFail();
        $response_code = Response::HTTP_OK;
        $message = 'Detail of Consultation';

        $response = [
            'response_code' => $response_code,
            'message' => $message,
            'data' => $consultation
        ];

        return response()->json($response, $response_code);
    }

    /**
     * Display the resources based on user.
     *
     * @param  int  $sales_id
     * @return \Illuminate\Http\Response
     */
    public function showMyConsultation($sales_id)
    {
        // $consultation = Consultation::where('sales_id', $sales_id)->orderBy('consultation_date', 'DESC')->get();
        DB::enableQueryLog();
        
        $consultation = Consultation::join(DB::raw('(SELECT *, min(review_process) as current_process from (SELECT A.consultation_id , A.review_process, B.process, B.atlas_process, A.review_state, A.review_date from consultation_statuses A, consultation_processes B where A.review_process = B.id) A where A.`review_state` is null or A.`review_state` = 0 group by A.consultation_id) A'), function($join){
            $join->on('consultations.consultation_id', 'A.consultation_id')
                ->where('review_state', null)
                ->whereIn('review_process', array('1', '2', '3', '4', '5', '6'));
        })->selectRaw('consultations.*, A.*')
        ->where('sales_id', $sales_id)
        ->where(DB::raw("NOT (`review_process` = 2 and `review_state` = 1)"), true)
        ->orderBy('consultation_date', 'DESC')->get();
        // dd(DB::getQueryLog());
        
        $response_code = Response::HTTP_OK;
        $message = 'List of My Consultation';

        $response = [
            'response_code' => $response_code,
            'message' => $message,
            'data' => $consultation
        ];

        return response()->json($response, $response_code);
    }

    /**
     * Display the resources based on user.
     *
     * @param  int  $sales_id
     * @return \Illuminate\Http\Response
     */
    public function showMyActive($sales_id)
    {
        $consultation = Consultation::join('consultation_statuses', 'consultations.consultation_id', 'consultation_statuses.consultation_id')
            ->where('sales_id', $sales_id)
            ->where('review_process', '7')
            ->where('review_state', '1')
            ->orderBy('consultation_date', 'DESC')->get();

        $response_code = Response::HTTP_OK;
        $message = 'List of Consultation History';

        $response = [
            'response_code' => $response_code,
            'message' => $message,
            'data' => $consultation
        ];

        return response()->json($response, $response_code);
    }

    /**
     * Display the resources based on user.
     *
     * @param  int  $sales_id
     * @return \Illuminate\Http\Response
     */
    public function showMyHistory($sales_id)
    {
        $consultation = Consultation::join(DB::raw('(SELECT consultation_id, min(review_process) as review_process, review_state from `consultation_statuses` where `review_state` = 0 group by consultation_id) A'), function($join){
            $join->on('consultations.consultation_id', 'A.consultation_id')
                ->whereIn('review_process', array('1', '2', '3', '4', '5', '6', '7'));
        })->selectRaw('consultations.*, A.*')
        ->where('sales_id', $sales_id)
        ->orderBy('consultation_date', 'DESC')->get();

        $response_code = Response::HTTP_OK;
        $message = 'List of Consultation History';

        $response = [
            'response_code' => $response_code,
            'message' => $message,
            'data' => $consultation
        ];

        return response()->json($response, $response_code);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $consultation_id)
    {
        try{
            $user = auth()->user();
            $data = $request->all();
            // $consultation_id = 'APP'.str_pad($consultation_id, 5, '0', STR_PAD_LEFT);

            $consultation_status = Consultation::find($consultation_id)->max('review_process');
            $consultation_status->review_process = $data['review_process'];
            $consultation_status->save();
            $response_code = Response::HTTP_OK;
            $message = 'Consultation has been updated';

            $response = [
                'response_code' => $response_code,
                'message' => $message
            ];

            return response()->json($response, $response_code);
        }catch(QueryException $e){
            return response()->json([
                'message' => "Failed".$e->errorInfo
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateState(Request $request, $consultation_id)
    {
        try{
            $data = $request->all();
            // DB::enableQueryLog();

            ConsultationStatus::where('consultation_id', $consultation_id)->where('review_process', $request->review_process)->update($data); 
            // dd(DB::getQueryLog());
            
            $response_code = Response::HTTP_OK;
            $message = 'Consultation has been updated';

            $response = [
                'response_code' => $response_code,
                'message' => $message
            ];

            return response()->json($response, $response_code);
        }catch(QueryException $e){
            return response()->json([
                'message' => "Failed".var_dump($e->errorInfo)
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($consultation_id)
    {
        Consultation::where('consultation_id', $consultation_id)->delete();
        ConsultationStatus::where('consultation_id', $consultation_id)->delete();

        $response_code = Response::HTTP_OK;
        $message = 'Consultation data has been deleted';
        $response = [
            'response_code' => $response_code,
            'message' => $message
        ];

        return response()->json($response, $response_code);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard($sales_id)
    {
        // $data['myconsultation'] = Consultation::where('sales_id', $sales_id)->count();
        // $user = auth()->user();
        // DB::enableQueryLog();
        $data['all'] = Consultation::where('sales_id', $sales_id)->count();
        $data['myconsultation'] = Consultation::join(DB::raw('(SELECT *, min(review_process) as current_process from (SELECT A.consultation_id , A.review_process, B.process, B.atlas_process, A.review_state, A.review_date from consultation_statuses A, consultation_processes B where A.review_process = B.id) A where A.`review_state` is null or A.`review_state` = 0 group by A.consultation_id) A'), function($join){
                                        $join->on('consultations.consultation_id', 'A.consultation_id')
                                            ->where('review_state', null)
                                            ->whereIn('review_process', array('1', '2', '3', '4', '5', '6'));
                                    })->selectRaw('consultations.*, A.*')
                                    ->where('sales_id', $sales_id)
                                    ->where(DB::raw("NOT (`review_process` = 2 and `review_state` = 1)"), true)
                                    ->orderBy('consultation_date', 'DESC')->count();
        $data['active'] = Consultation::join('consultation_statuses', 'consultations.consultation_id', 'consultation_statuses.consultation_id')
                                ->where('sales_id', $sales_id)
                                ->where('consultation_statuses.review_process', '7')
                                ->where('consultation_statuses.review_state', '1')
                                ->where('sales_id', $sales_id)->count();
        $data['history'] = Consultation::join('consultation_statuses', function($join){
                            $join->on('consultations.consultation_id', 'consultation_statuses.consultation_id')
                                ->where('consultation_statuses.review_state', '0');
                            })->where('sales_id', $sales_id)->count();
        // dd(DB::getQueryLog());
        $response_code = Response::HTTP_OK;
        $message = 'Dashboard data';
        $response = [
            'response_code' => $response_code,
            'message' => $message,
            'data' => $data
        ];

        return response()->json($response, $response_code);
    }

}
