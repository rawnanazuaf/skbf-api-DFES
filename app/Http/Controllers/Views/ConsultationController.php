<?php

namespace App\Http\Controllers\Views;

use App\Models\User;
use App\Models\Consultation;
use Illuminate\Http\Request;
use App\Models\ConsultationStatus;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\ConsultationProcess;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;

class ConsultationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data_consultation = Consultation::join(DB::raw(
                '(select *, min(review_process) as current_process
                from (
                    SELECT A.consultation_id , A.review_process, B.process, B.atlas_process, A.review_state
                    from consultation_statuses A, consultation_processes B
                    where A.review_process = B.id
                ) A
                where A.`review_state` is null or A.`review_state` = 0
                group by A.consultation_id) A'
            ), function($join){
                $join->on('consultations.consultation_id', 'A.consultation_id');
            })->selectRaw('consultations.*, A.*')
        ->orderBy('consultation_date', 'DESC')
        ->get();
        // $data_process = ConsultationProcess::select('id', 'process')->get();
        foreach ($data_consultation as $cons) {
            if($cons->review_state == null){
                $cons->review_state = "Processing";
            }else if($cons->review_state == 0){
                $cons->review_state = "Rejected";
            }
        }
        return view('Consultation.consultation',['data_consultation' => $data_consultation]);
    }
    
    public function indexHistory()
    {
        //DB::enableQueryLog();
        $data_consultation = DB::table('consultation_statuses')
        ->selectRaw(
            'consultation_statuses.consultation_id
            , consultations.customer_name
            , consultations.brand
            , consultations.vehicle_model
            , consultations.vehicle_year
            , consultations.vehicle_price
            , MAX(review_process) AS review_process'
        )
        ->leftJoin('consultations', 'consultation_statuses.consultation_id', 'consultations.consultation_id')
        ->where('consultation_statuses.review_state', '!=','NULL')
        ->groupBy('consultation_statuses.consultation_id')
        ->get();
        //dd(DB::getQueryLog());
        
        return view('Consultation.consultation-history',['data_consultation' => $data_consultation]);
    }

    public function processing(){
       
        // $data_consultation = Consultation::join(DB::raw(
        //     '(SELECT consultation_id, 
        //              min(review_process) as review_process, 
        //              review_state 
        //       from `consultation_statuses` 
        //       where `review_state` is null or `review_state` = 0 
        //       group by consultation_id) A'
        // ), function($join){
        //     $join->on('consultations.consultation_id', 'A.consultation_id')
        //         ->where('review_state', null)
        //         ->whereIn('review_process', array('1', '2', '3', '4', '5', '6'));
        // })->selectRaw('consultations.*, A.*')
        // ->where(DB::raw("NOT (`review_process` = 2 and `review_state` = 1)"), true)
        // ->orderBy('consultation_date', 'DESC')->get();

        $data_consultation = Consultation::join(DB::raw(
            '(select *, min(review_process) as current_process
            from (
                SELECT A.consultation_id , A.review_process, B.process, B.atlas_process, A.review_state
                from consultation_statuses A, consultation_processes B
                where A.review_process = B.id
            ) A
            where A.`review_state` is null or A.`review_state` = 0
            group by A.consultation_id) A'
        ), function($join){
            $join->on('consultations.consultation_id', 'A.consultation_id')
                 ->where('review_state', null)
                 ->whereIn('review_process', array('1', '2', '3', '4', '5', '6','7'));
        })->selectRaw('consultations.*, A.*')
        ->orderBy('consultation_date', 'DESC')
        ->get();

        foreach ($data_consultation as $cons) {
            if($cons->review_state == null){
                $cons->review_state = "Processing";
            }else if($cons->review_state == 0){
                $cons->review_state = "Rejected";
            }
        }
        
        return view('Consultation.consultation-processing',['data_consultation' => $data_consultation]);
    }
    public function actived(){
        $data_consultation = Consultation::join('consultation_statuses', 'consultations.consultation_id', 'consultation_statuses.consultation_id')
            ->where('review_process', '7')
            ->where('review_state', '1')
            ->orderBy('consultation_date', 'DESC')
        ->get();
        foreach ($data_consultation as $cons) {
            if($cons->review_state == 1){
                $cons->review_state = "Actived";
            }
        }
        return view('Consultation.consultation-actived',['data_consultation' => $data_consultation]);
        
    }
    public function rejected(){
        $data_consultation = Consultation::join(DB::raw(
            '(select *, min(review_process) as current_process
            from (
                SELECT A.consultation_id , A.review_process, B.process, B.atlas_process, A.review_state
                from consultation_statuses A, consultation_processes B
                where A.review_process = B.id
            ) A
            where A.`review_state` is null or A.`review_state` = 0
            group by A.consultation_id) A'
        ), function($join){
            $join->on('consultations.consultation_id', 'A.consultation_id')
                 ->where('review_state', 0)
                 ->whereIn('review_process', array('1', '2', '3', '4', '5', '6','7'));
        })->selectRaw('consultations.*, A.*')
        ->orderBy('consultation_date', 'DESC')
        ->get();
        foreach ($data_consultation as $cons) {
            if($cons->review_state == 0){
                $cons->review_state = "Rejected";
            }
        }
        return view('Consultation.consultation-rejected',['data_consultation' => $data_consultation]);
    }

    public function detailConsultationProcessing($consultation_id){
        $data_consultation = Consultation::join(DB::raw(
            '(select *, min(review_process) as current_process
            from (
                SELECT A.consultation_id , A.review_process, B.process, B.atlas_process, A.review_state
                from consultation_statuses A, consultation_processes B
                where A.review_process = B.id
            ) A
            where A.`review_state` is null or A.`review_state` = 0
            group by A.consultation_id) A'
        ), function($join){
            $join->on('consultations.consultation_id', 'A.consultation_id')
                 ->where('review_state', null)
                 ->whereIn('review_process', array('1', '2', '3', '4', '5', '6','7'));
        })->selectRaw('consultations.*, A.*')
        ->where('consultations.consultation_id', $consultation_id)
        ->orderBy('consultation_date', 'DESC')
        ->get();

        foreach ($data_consultation as $cons) {
            if($cons->review_state == null){
                $cons->review_state = "Processing";
            }else if($cons->review_state == 0){
                $cons->review_state = "Rejected";
            }
        }
        
        return view('Consultation.detail-consultation-processing',['data_consultation' => $data_consultation]);
    }

    public function registration()
    {
        return view('Consultation.consultation-registration');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vehicle_model' => ['required'],
            'vehicle_year' => ['required'],
            'vehicle_price' => ['required', 'numeric'],
            'consultation_area' => ['required']
        ]);

        if($validator->fails()){
            Alert::error('Error', 'Creation Failed');
            return redirect('/consultation-registration');
        }

        try{
            $user = auth()->user();
            $data = $request->all();
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
            
            Alert::success('Good Joob', 'Consultation Created');
            return redirect('/consultation-processing');
        }catch(QueryException $e){
            Alert::error('Error', 'Creation Failed');
            return redirect('/consultation-registration');
        }
    }

    public function updateState(Request $request, $consultation_id)
    {
        // try{
        //     $data = $request->all();
        //     // DB::enableQueryLog();

        //     ConsultationStatus::where('consultation_id', $consultation_id)->where('review_state', $request->review_state)->update($data); 
        //     // dd(DB::getQueryLog());
            
        //     Alert::success('Good Joob', 'Review Process Updated');
        //     return redirect('/consultation-views');
        // }catch(QueryException $e){
        //     Alert::error('Error', 'Update Failed');
        //     return redirect('/consultation-views');
        // }
        // $status = ConsultationStatus::whereRaw('(SELECT consultation_id, min(review_process) AS review_process, review_state 
        //         from `consultation_statuses` 
        //         where `review_state` is null or `review_state` = 0 
        //         group by consultation_id) AS B')
        // ->where('consultation_id', $consultation_id)
        // ->update(['review_state' => $request->review_state]);

        // $status = ConsultationStatus::join(DB::raw(
        //     '(SELECT consultation_id, min(review_process) AS review_process, review_state 
        //         from `consultation_statuses` 
        //         where `review_state` is null or `review_state` = 0 
        //         group by consultation_id) AS B'
        // ), function($join){
        //     $join->on('consultation_statuses.consultation_id', 'B.consultation_id')
        //          ->where('consultation_statuses.review_process', 'B.review_process');
        // })
        // ->where('consultation_id', $consultation_id)
        // ->update(['consultation_statuses.review_state' => $request->review_state]);
        try {
            $data = $request->all();
            ConsultationStatus::where('consultation_id', $consultation_id)
                                ->where('review_process', $data['review_process'])
                                ->update(['review_state' => $data['review_state']]);
            Alert::success('Good Joob', 'Review Process Updated');
            return redirect('/consultation-views');
        } catch (\Throwable $th) {
            Alert::error('Error', 'Update Failed');
            return redirect('/consultation-views');
        }
    }

    public function sendNotificationUpdate()
    {
        // $user_id = Consultation::where('consultation_id', $request['consultation_id']);
        // $token = User::where('id', $user_id['sales_id']);
        $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();

        $SERVER_API_KEY = 'AAAAN7iGVy4:APA91bFtJDMAy5yX9K4Klo_HQKtyQcIx1RSzmrVRJj7YgXAur7Q8WISBMNskMUqcnTpUr0pwQfc3xQuY0SSW1N-7Qwpi8baRPVg55bcMuVNjnf3y4p0uqDudlja96mmADDVp4GYpx3H9';

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => "Status Change",
                "body" => "Consultation Status Has Changed",
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
        //dd($response);
        return redirect('/consultation-processing')->with($response);
    }

    public function updateConsultationProcessing(Request $request, $consultation_id){
        try {
            $data = $request->all();
            ConsultationStatus::where('consultation_id', $consultation_id)
                                ->where('review_process', $data['review_process'])
                                ->update(['review_state' => $data['review_state']]);
        
            $firebaseToken = User::where('id', $data['sales_id'])->pluck('device_token')->all();
            $SERVER_API_KEY = 'AAAAN7iGVy4:APA91bFtJDMAy5yX9K4Klo_HQKtyQcIx1RSzmrVRJj7YgXAur7Q8WISBMNskMUqcnTpUr0pwQfc3xQuY0SSW1N-7Qwpi8baRPVg55bcMuVNjnf3y4p0uqDudlja96mmADDVp4GYpx3H9';

            $data = [
                "registration_ids" => $firebaseToken,
                "notification" => [
                    "title" => "Status Change",
                    "body" => "Consultation Status Has Changed",
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
            //dd($response);
            Alert::success('Good Joob', 'Review Process Updated');
            return redirect('/consultation-processing')->with($response);
        } catch (\Throwable $th) {
            Alert::error('Error', 'Update Failed');
            return redirect('/consultation-processing');
        } 
        
    }

    
}
