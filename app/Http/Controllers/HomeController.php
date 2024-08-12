<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tt=Auth::user()->type;
        if($tt=='Professor'|| $tt=="student" ||$tt=="admin")
        {
            return redirect()->route('hoome');
        }
        else{
            return"this is page for admin";
        }
    }
}
