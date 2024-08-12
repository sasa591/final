<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Nontification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class photoController extends Controller
{
    public function show(){
        $usr=auth()->user();
        $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
        return view('profile',compact('nots'));
        return view('profile',compact('nots','usr'));
    }
}
