<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;
    //protected $primaryKey = 'consultation_id';

    protected $fillable = [
        'consultation_id',
        'application_id',
        'contract_id',
        'sales_id',
        'customer_name',
        'spouse_name',
        'director_name',
        'shareholders',
        'dealer_name',
        'sales_name',
        'produk',
        'brand',
        'vehicle_model',
        'vehicle_year',
        'vehicle_price',
        'loanAmt',
        'unitsAmt',
        'insurance',
        'dpPercent',
        'tenure',
        'addm_addb',
        'effectiveRate',
        'telno',
        'consultation_area',
        'ktp',
        'kk',
        'npwp',
        'consultation_date',
        'contract_tenure',
        'contract_starting_date',
        'contract_termination_date'
    ];

    protected static function boot(){
        parent::boot();

        static::creating(function($model){
            $model->id = Consultation::max('id') + 1;
            $model->consultation_id = 'APP'.str_pad($model->id, 5, '0', STR_PAD_LEFT);
        });
    }

    public function consultationStatus()
    {
        return $this->hasMany(ConsultationStatus::class, 'consultation_id', 'consultation_id');
    }
}
