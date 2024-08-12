<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nontification extends Model
{
    use HasFactory;
    protected $fillable = [
        'notuser_id',
        'content_not'
    ];
}
