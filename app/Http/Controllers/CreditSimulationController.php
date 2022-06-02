<?php

namespace App\Http\Controllers;

use App\Models\CreditSimulation;
use App\Models\DepreciationRate;
use App\Models\LoanRate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class CreditSimulationController extends Controller
{
    /**
     * Display .
     *
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function calculate(Request $request)
    {
        // $simulation_data = CreditSimulation::;

        $data = $request->all();
        
        $dp_percentage = $request->dp_amount / $request->otr *100;
        $tenure = $request->tenure;
        $tenure_year = $request->tenure / 12;
        $otr = $request->otr;
        $dp = $request->dp_amount;
        $vehicle_type = "Passenger";
        $wilayah = $request->wilayah;
        $type = "CP";
        $data['total_ph'] = 0;
        $depreciation_amount = 0;
        for($i = 1; $i <= $tenure_year; $i++) {
            switch ($i){
                case 1:
                    $depreciation = $otr * 1;
                    $depreciation_rate = $this->getDepreciationRate($depreciation, $vehicle_type, $wilayah, $type);
                    $depreciation_amount += $depreciation_rate * $depreciation;
                    break;
                case 2:
                    $depreciation = $otr * 0.9;
                    $depreciation_rate = $this->getDepreciationRate($depreciation, $vehicle_type, $wilayah, $type);
                    $depreciation_amount += $depreciation_rate * $depreciation;
                    break;
                case 3:
                    $depreciation = $otr * 0.8;
                    $depreciation_rate = $this->getDepreciationRate($depreciation, $vehicle_type, $wilayah, $type);
                    $depreciation_amount += $depreciation_rate * $depreciation;
                    break;
                case 4:
                    $depreciation = $otr * 0.7;
                    $depreciation_rate = $this->getDepreciationRate($depreciation, $vehicle_type, $wilayah, $type);
                    $depreciation_amount += $depreciation_rate * $depreciation;
                    break;
                case 5:
                    $depreciation = $otr * 0.7;
                    $depreciation_rate = $this->getDepreciationRate($depreciation, $vehicle_type, $wilayah, $type);
                    $depreciation_amount += $depreciation_rate * $depreciation;
                    break;
            }
        }
        $total_ph = $otr - $dp + $depreciation_amount;
        $flat_rate = $this->getLoanRate($dp_percentage, $tenure);
        $total_interest = $total_ph * $tenure_year * $flat_rate;
        $loaned_amount = $total_interest + $total_ph;
        $installment = $loaned_amount / $tenure;
        $data['depreciation_amount'] = $depreciation_amount;
        $data['dp_percentage'] = $dp_percentage;
        $data['total_ph'] = $total_ph;
        $data['loan_rate'] = $flat_rate;
        $data['total_interest'] = $total_interest;
        $data['loaned_amount'] = $loaned_amount;
        $data['installment'] = $installment;

        $response_code = Response::HTTP_OK;
        $message = 'List of Consultation History';

        $response = [
            'response_code' => $response_code,
            'message' => $message,
            'data' => $data
        ];

        return response()->json($response, $response_code);
    }

    public function getDepreciationRate($amount, $vehicle_type, $wilayah, $type){
        $code = 0;
        switch ($amount){
            case $amount < 125000000:
                $code = 1;
                break;      
            case $amount > 125000000 && $amount <= 200000000:
                $code = 2;
                break;
            case $amount > 200000000 && $amount <= 400000000:
                $code = 3;
                break;
            case $amount > 400000000 && $amount <= 800000000:
                $code = 4;
                break;
            case $amount > 800000000:
                $code = 5;
                break;
        }
        // DB::enableQueryLog();
        $rate = DepreciationRate::where([
            'vehicle_type' => $vehicle_type,
            'wilayah' => $wilayah,
            'type' => $type,
            'code' => $code
            ])->select('first_year')->first()->first_year;
        // dd(DB::getQueryLog());
        return $rate/100;
    }

    public function getLoanRate($dp, $tenure){
        // DB::enableQueryLog();
        $rate = LoanRate::where([
            'dp' => $dp,
            'tenure' => $tenure
            ])->select('flat_rate')->first()->flat_rate;
        // dd(DB::getQueryLog());
        $rate += 1;
        return $rate/100;
    }
}
