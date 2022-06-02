<?php

namespace Database\Seeders;
use App\Models\ConsultationProcess;
use App\Models\DepreciationRate;
use App\Models\FlatRate;
use App\Models\LoanRate;
use App\Models\SalesArea;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        ConsultationProcess::create([
            'process' => 'SLIK Credit Checking',
            'atlas_process' => 'SLIK Checking'
        ]);

        ConsultationProcess::create([
            'process' => 'Customer Registration',
            'atlas_process' => '1st Management'
        ]);

        ConsultationProcess::create([
            'process' => 'Survey',
            'atlas_process' => '2nd Management'
        ]);

        ConsultationProcess::create([
            'process' => 'Survey Result',
            'atlas_process' => '2nd Management'
        ]);

        ConsultationProcess::create([
            'process' => 'Final Approval',
            'atlas_process' => 'Review Management Approval'
        ]);

        ConsultationProcess::create([
            'process' => 'Purchase Order',
            'atlas_process' => 'Purchase Order'
        ]);

        ConsultationProcess::create([
            'process' => 'Loan Activation',
            'atlas_process' => 'Loan Drawdown'
        ]);

        SalesArea::create([
            'area' => 'Bekasi',
            'branch' => 'Jakarta'
        ]);

        SalesArea::create([
            'area' => 'Bogor',
            'branch' => 'Jakarta'
        ]);

        SalesArea::create([
            'area' => 'Cikarang',
            'branch' => 'Jakarta'
        ]);

        SalesArea::create([
            'area' => 'Kuningan',
            'branch' => 'Jakarta'
        ]);

        SalesArea::create([
            'area' => 'Tanah Abang',
            'branch' => 'Jakarta'
        ]);

        SalesArea::create([
            'area' => 'Matraman',
            'branch' => 'Jakarta'
        ]);

        // depreciation rate table
        DepreciationRate::create([
            'vehicle_type' => 'Passenger',
            'wilayah' => '2',
            'type' => 'CP',
            'code' => '1',
            'from' => '0',
            'to' => '125000000',
            'first_year' => 3.26
        ]);

        DepreciationRate::create([
            'vehicle_type' => 'Passenger',
            'wilayah' => '2',
            'type' => 'CP',
            'code' => '2',
            'from' => '125000001',
            'to' => '200000000',
            'first_year' => 2.47
        ]);

        DepreciationRate::create([
            'vehicle_type' => 'Passenger',
            'wilayah' => '2',
            'type' => 'CP',
            'code' => '3',
            'from' => '200000001',
            'to' => '400000000',
            'first_year' => 2.08
        ]);

        DepreciationRate::create([
            'vehicle_type' => 'Passenger',
            'wilayah' => '2',
            'type' => 'CP',
            'code' => '4',
            'from' => '400000001',
            'to' => '800000000',
            'first_year' => 1.20
        ]);

        DepreciationRate::create([
            'vehicle_type' => 'Passenger',
            'wilayah' => '2',
            'type' => 'CP',
            'code' => '5',
            'from' => '800000001',
            'to' => '125000000',
            'first_year' => 1.05
        ]);

        DepreciationRate::create([
            'vehicle_type' => 'Passenger',
            'wilayah' => '3',
            'type' => 'CP',
            'code' => '1',
            'from' => '0',
            'to' => '125000000',
            'first_year' => 2.53
        ]);

        DepreciationRate::create([
            'vehicle_type' => 'Passenger',
            'wilayah' => '3',
            'type' => 'CP',
            'code' => '2',
            'from' => '125000001',
            'to' => '200000000',
            'first_year' => 2.69
        ]);

        DepreciationRate::create([
            'vehicle_type' => 'Passenger',
            'wilayah' => '3',
            'type' => 'CP',
            'code' => '3',
            'from' => '200000001',
            'to' => '400000000',
            'first_year' => 1.79
        ]);

        DepreciationRate::create([
            'vehicle_type' => 'Passenger',
            'wilayah' => '3',
            'type' => 'CP',
            'code' => '4',
            'from' => '400000001',
            'to' => '800000000',
            'first_year' => 1.14
        ]);

        DepreciationRate::create([
            'vehicle_type' => 'Passenger',
            'wilayah' => '3',
            'type' => 'CP',
            'code' => '5',
            'from' => '800000001',
            'to' => '125000000',
            'first_year' => 1.05
        ]);

        LoanRate::create(['dp' => 20, 'tenure' => 12, 'flat_rate' => 6.83]);
        LoanRate::create(['dp' => 20, 'tenure' => 24, 'flat_rate' => 6.45]);
        LoanRate::create(['dp' => 20, 'tenure' => 36, 'flat_rate' => 6.6]);
        LoanRate::create(['dp' => 20, 'tenure' => 48, 'flat_rate' => 7.46]);
        LoanRate::create(['dp' => 20, 'tenure' => 60, 'flat_rate' => 8.15]);
        LoanRate::create(['dp' => 25, 'tenure' => 12, 'flat_rate' => 6.1]);
        LoanRate::create(['dp' => 25, 'tenure' => 24, 'flat_rate' => 5.78]);
        LoanRate::create(['dp' => 25, 'tenure' => 36, 'flat_rate' => 5.93]);
        LoanRate::create(['dp' => 25, 'tenure' => 48, 'flat_rate' => 6.77]);
        LoanRate::create(['dp' => 25, 'tenure' => 60, 'flat_rate' => 7.44]);
        LoanRate::create(['dp' => 30, 'tenure' => 12, 'flat_rate' => 5.83]);
        LoanRate::create(['dp' => 30, 'tenure' => 24, 'flat_rate' => 5.53]);
        LoanRate::create(['dp' => 30, 'tenure' => 36, 'flat_rate' => 5.69]);
        LoanRate::create(['dp' => 30, 'tenure' => 48, 'flat_rate' => 6.52]);
        LoanRate::create(['dp' => 30, 'tenure' => 60, 'flat_rate' => 7.18]);
        LoanRate::create(['dp' => 40, 'tenure' => 12, 'flat_rate' => 5.5]);
        LoanRate::create(['dp' => 40, 'tenure' => 24, 'flat_rate' => 5.23]);
        LoanRate::create(['dp' => 40, 'tenure' => 36, 'flat_rate' => 5.39]);
        LoanRate::create(['dp' => 40, 'tenure' => 48, 'flat_rate' => 6.21]);
        LoanRate::create(['dp' => 40, 'tenure' => 60, 'flat_rate' => 6.86]);
        LoanRate::create(['dp' => 50, 'tenure' => 12, 'flat_rate' => 5.5]);
        LoanRate::create(['dp' => 50, 'tenure' => 24, 'flat_rate' => 5.23]);
        LoanRate::create(['dp' => 50, 'tenure' => 36, 'flat_rate' => 5.39]);
        LoanRate::create(['dp' => 50, 'tenure' => 48, 'flat_rate' => 6.21]);
        LoanRate::create(['dp' => 50, 'tenure' => 60, 'flat_rate' => 6.86]);


    }
}
