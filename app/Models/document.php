<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class document extends Model
{
    use HasFactory;
    protected $fillable = [
        'usr_id',
        'student_type',
        'image_hweya',
        'image_blood',
        'status',
        'price',
        'replay'
    ];
}
