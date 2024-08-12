<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Nontification;
use App\Models\User;
class friendsController extends Controller
{
    public function not(){
        $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
        return view('friends',compact('nots'));
    }

    public function search(Request $request){
        $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
        $r=$request->searchname;
        if(is_numeric( $r)){
            $users=User::all()->where('code',$r);
            return view('friends',compact('nots','users'));
        }
        $r=trim($r);
        $words= explode(' ',$r);
        if(count($words)>1){
        $first=$words[0];
        $last=$words[1];
        $lastt=ucfirst(strtolower($last));
        $firstt=ucfirst(strtolower($first));
        $users=User::all()->where('first_name',$firstt)->where('last_name',$lastt);
        }
        else{
            $first=$words[0];
            $firstt=ucfirst(strtolower($first));
            $users=User::all()->where('first_name',$firstt);
        }

        return view('friends',compact('nots','users'));

    }
    public function notfp($id){
        $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
        $us=User::findorfail($id);
        return view('friends_pofile',compact('nots','us'));
    }

}
