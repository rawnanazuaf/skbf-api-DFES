<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanRate extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'dp', 'tenure', 'flat_rate'];
}
