<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultationStatus extends Model
{
    use HasFactory;
    protected $fillable = [
        'consultation_id', 
        'review_process', 
        'review_state', 
        'review_status', 
        'atlas_status', 
        'review_date'
    ];
    protected static function boot(){
        parent::boot();
    }

    public function consultation()
    {
        return $this->belongsTo(Consultation::class, 'consultation_id', 'consultation_id');
    }
}
