<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class downloadmaterial extends Model
{
    use HasFactory;
    protected $table='downloadmaterials';
    protected $fillable = [
        'usr_id',
        'chapter',
        'image_hweya',
        'first_material',
        'second_material',
        'year_of_the_artical',
        'status',
        'price',
        'replay'
    ];
}
