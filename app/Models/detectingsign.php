<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detectingsign extends Model
{
    use HasFactory;
    protected $table='detectingsigns';
    protected $fillable = [
        'usr_id',
        'student_type',
        'image_hweya',
        'image_clearance',
        'status',
        'price',
        'replay'
    ];
}
