<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    use HasFactory;
    protected $fillable = [
        'u_id',
        'first_name',
        'last_name',
        'content',
        'file',
        'filter'
    ];

}
