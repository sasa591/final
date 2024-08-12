<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lecture extends Model
{
    use HasFactory;
    protected $fillable = [
        'd_id',
        'c_id',
        'name',
        'path',
        'size'
    ];
}
