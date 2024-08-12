<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permenancydocument extends Model
{
    use HasFactory;
    protected $table='permenancydocuments';
    protected $fillable = [
        'usr_id',
        'chapter',
        'image_hweya',
        'year',
        'status',
        'price',
        'replay'
    ];
}
