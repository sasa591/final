<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nontification;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;
class updateController extends Controller
{
    public function update1(Request $request){
        $id=Auth::user()->id;
        $us=User::findorfail($id);
        $us->first_name=$request->first_name;
        $us->last_name=$request->last_name;
        if($request->adress !=""){
            $us->adress=$request->adress;
        }

        $us->save();
        $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
        return view('profile',compact('nots'));
    }

    public function update2(Request $request){
        $id=Auth::user()->id;
        $us=User::findorfail($id);
        $us->email=$request->email;
        $us->phone=$request->phone;
        $us->birth=$request->birth;
        $us->save();
        $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
        return view('profile',compact('nots'));
    }

    public function update3(Request $request){
        $id=Auth::user()->id;
        $us=User::findorfail($id);
        if($request->title !=""){
            $us->title=$request->title;
        }
        if(Auth::user()->type=='Professor')
        {
            $us->purview=$request->purview;
            $us->years_experience=$request->experience;
            $us->save();
            $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
            return view('profile',compact('nots'));
        }
        elseif(Auth::user()->type=='student'){
            $us->year=$request->year;
            $us->years_experience=$request->experience;
            $us->save();
            $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
            return view('profile',compact('nots'));
        }
    }

    public function update4(Request $request){
        $id=Auth::user()->id;
        $us=User::findorfail($id);
        $us->about_me=$request->about_me;
        $us->save();
        $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
        return view('profile',compact('nots'));
    }

    public function update5(Request $request){
        $id=Auth::user()->id;
        $us=User::findorfail($id);
        if($request->photo!="")
        {
        $imge= $request->file('photo')->getClientOriginalName();
        $path= $request->file('photo')->storeAS('users',$imge,'mohammad');
        $us->img= $path;
        $us->save();
        }
        $usr=auth()->user();
        $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
        return view('profile',compact('nots','usr'));

    }

    public function update6(Request $request){
        $id=Auth::user()->id;
        $us=User::findorfail($id);

        $password_old = $request->input('password_old');
        $hashedPassword = $us->password;
        if (Hash::check($password_old, $hashedPassword)){
                $request->validate([
                    'password' => 'required',
                    'password_confirmation' => 'required|same:password',
                ]);
                $us->password=Hash::make($request['password']);
                $us->save();
                $usr=auth()->user();
                $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
                return view('profile',compact('nots','usr'));
        }
        else{
            return redirect()->route('profile')->with('error', 'Validate password');
        }

    }
    public function prof(){
        $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
        $usr=auth()->user();
        return view('profile',compact('nots','usr'));
    }
}


