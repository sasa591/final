<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['title','u_id','year','name'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
