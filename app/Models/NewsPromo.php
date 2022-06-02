<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsPromo extends Model
{
    use HasFactory;
    protected $table = 'news_promo';
    protected $fillable = ['id', 'title', 'category', 'content', 'author','image'];
}
