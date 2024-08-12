<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class degree extends Model
{
    use HasFactory;
    protected $fillable = [
        'u_id',
        'name',
        'quiz_id',
        'degree',
        'totalmark'
    ];
}
