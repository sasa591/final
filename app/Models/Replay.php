<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Replay extends Model
{
    use HasFactory;
    protected $fillable = [
        'uu_id',
        'cc_id',
        'replay_comment',

    ];
}
