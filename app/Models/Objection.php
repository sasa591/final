<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objection extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'code',
        'year',
        'subject',
        'oretical_partical',
        'reason_for_objection',
        'mark',
        'img',
        'price',
        'replay'
    ];

}
