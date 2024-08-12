<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Objection;
use App\Models\document;
use App\Models\detectingsign;
use App\Models\permenancydocument;
use App\Models\downloadmaterial;
use App\Models\User;
use App\Models\Nontification;
use App\Models\Service;
use App\Models\group;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Storage;

class servicesController extends Controller
{
    public function service(){
        $services=Service::all();
        $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
        return view('Services',compact('nots','services'));
    }

    public function selectservice($id){
        $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
        $mon="";
        if($id==1)
        {
            $servic=Service::find($id);
            return view('objection',compact('nots','mon','servic'));
        }
        else if($id==5){
            $servic=Service::find($id);
            return view('u_life.university_life',compact('nots','mon','servic'));
        }
        else if($id==2){
            $servic=Service::find($id);
            return view('signs.detecting_signs',compact('nots','mon','servic'));
        }
        else if($id==3){
            $servic=Service::find($id);
            return view('d_material.download_material',compact('nots','mon','servic'));
        }
        else if($id==4){
            $servic=Service::find($id);
            return view('permanency.Permanencydocument',compact('nots','mon','servic'));
        }

    }
/////////////////////Objection////////////
    public function objectstore(Request $request){
        $servic=Service::find(1);
        $u=new Objection();
        $user=auth()->user();

        $validator=Validator::make($request->all(),[
            'First_Name'=>  ['required',
                            Rule::in($user->first_name)
                            ],

            'Last_Name'=>   ['required',
                            Rule::in($user->last_name)
                            ],
            'year'=>        ['required',
                            Rule::in([$user->year])
                            ],

            'University_id'=>   ['required',
                            Rule::in([$user->code])
                            ],
        ],

        [
            'First_Name.in'=>'ffff',
            'Last_Name.in'=>'llll',
            'year.in'=>'yyyy',
            'University_id'=>'ccc'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }
        elseif($user->balance<$servic->price)
        {

            $mon="bbb";
            $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
            return view('objection',compact('nots','mon','servic'));
        }
        else
        {
            $grop=new group();
            $servic=Service::find(1);
            $mon="ooo";
            $u->usr_id=$user->id;
            $u->subject= $request->subject;
            $u->oretical_partical= $request->sub;
            $u->mark= $request->mark;
            $u->reason_for_objection= $request->reason_for_objection;
            $imge= $request->file('photo')->getClientOriginalName();
            $path= $request->file('photo')->storeAS('users',$imge,'mohammad');
            $u->img=$path;
            $user->balance=$user->balance-$servic->price;
            $user->save();
            $u->save();
            $grop->id_name=$u->id;
            $grop->name='objection';
            $grop->status='pending';
            $grop->save();
            $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
            return view('objection',compact('nots','mon','servic'));
        }

    }

//////////////////university_life//////////////////////

public function univercitylife(Request $request){
    $servic=Service::find(5);
    $u=new document();
    $user=auth()->user();

    $validator=Validator::make($request->all(),[
        'First_Name'=>  ['required',
                        Rule::in([strtolower($user->first_name),ucfirst($user->first_name)])
                        ],

        'Last_Name'=>   ['required',
                        Rule::in([strtolower($user->last_name),ucfirst($user->last_name)])
                        ],
        'year'=>        ['required',
                        Rule::in([$user->year])
                        ],

        'University_id'=>   ['required',
                        Rule::in([$user->code])
                        ],
    ],

    [
        'First_Name.in'=>'ffff',
        'Last_Name.in'=>'llll',
        'year.in'=>'yyyy',
        'University_id'=>'ccc'
    ]);

    if($validator->fails())
    {
        return redirect()->back()->withErrors($validator);
    }
    elseif($user->balance<$servic->price)
    {

        $mon="bbb";
        $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
        return view('u_life.university_life',compact('nots','mon','servic'));
    }
    else
    {
        $grop=new group();
        $mon="ooo";
        $u->usr_id=$user->id;
        $u->student_type=$request->sub;

        $imge= $request->file('photo')->getClientOriginalName();
        $path= $request->file('photo')->storeAS('users',$imge,'mohammad');
        $u->image_hweya=$path;

        $ii= $request->file('photoblood')->getClientOriginalName();
        $pathh= $request->file('photoblood')->storeAS('users',$ii,'mohammad');
        $u->image_blood=$pathh;

        $user->balance=$user->balance-$servic->price;
        $user->save();
        $u->save();
        $grop->id_name=$u->id;
        $grop->name='Univercity life';
        $grop->status='pending';
        $grop->save();
        $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
        return view('u_life.university_life',compact('nots','mon','servic'));
    }

}


public function detectingsigns(Request $request){
    $servic=Service::find(2);
    $u=new detectingsign();
    $user=auth()->user();

    $validator=Validator::make($request->all(),[
        'First_Name'=>  ['required',
                        Rule::in([strtolower($user->first_name),ucfirst($user->first_name)])
                        ],

        'Last_Name'=>   ['required',
                        Rule::in([strtolower($user->last_name),ucfirst($user->last_name)])
                        ],
        'year'=>        ['required',
                        Rule::in([$user->year])
                        ],

        'University_id'=>   ['required',
                        Rule::in([$user->code])
                        ],
    ],

    [
        'First_Name.in'=>'ffff',
        'Last_Name.in'=>'llll',
        'year.in'=>'yyyy',
        'University_id'=>'ccc'
    ]);

    if($validator->fails())
    {
        return redirect()->back()->withErrors($validator);
    }
    elseif($user->balance<$servic->price)
    {

        $mon="bbb";
        $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
        return view('u_life.university_life',compact('nots','mon','servic'));
    }
    else
    {
        $grop=new group();
        $mon="ooo";
        $u->usr_id=$user->id;
        $u->student_type=$request->sub;

        $imge= $request->file('photo')->getClientOriginalName();
        $path= $request->file('photo')->storeAS('users',$imge,'mohammad');
        $u->image_hweya=$path;

        $ii= $request->file('image_clearance')->getClientOriginalName();
        $pathh= $request->file('image_clearance')->storeAS('users',$ii,'mohammad');
        $u->image_clearance=$pathh;

        $user->balance=$user->balance-$servic->price;
        $user->save();
        $u->save();
        $grop->id_name=$u->id;
        $grop->name='detecting signs';
        $grop->status='pending';
        $grop->save();
        $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
        return view('signs.detecting_signs',compact('nots','mon','servic'));
    }

}


public function downloadmaterial(Request $request){
    $servic=Service::find(3);
    $u=new  downloadmaterial();
    $user=auth()->user();

    $validator=Validator::make($request->all(),[
        'First_Name'=>  ['required',
                        Rule::in([strtolower($user->first_name),ucfirst($user->first_name)])
                        ],

        'Last_Name'=>   ['required',
                        Rule::in([strtolower($user->last_name),ucfirst($user->last_name)])
                        ],

        'University_id'=>   ['required',
                        Rule::in([$user->code])
                        ],
    ],

    [
        'First_Name.in'=>'ffff',
        'Last_Name.in'=>'llll',
        'University_id'=>'ccc'
    ]);

    if($validator->fails())
    {
        return redirect()->back()->withErrors($validator);
    }
    elseif($user->balance<$servic->price)
    {

        $mon="bbb";
        $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
        return view('u_life.university_life',compact('nots','mon','servic'));
    }
    else
    {
        $grop=new group();
        $mon="ooo";
        $u->usr_id=$user->id;
        $u->chapter=$request->sub;
        $u->first_material=$request->article_one;
        if($request->article_two!=null)
        {
            $u->second_material=$request->article_two;
        }

        $u->year_of_the_artical=$request->year;

        $imge= $request->file('photo')->getClientOriginalName();
        $path= $request->file('photo')->storeAS('users',$imge,'mohammad');
        $u->image_hweya=$path;

        $user->balance=$user->balance-$servic->price;
        $user->save();
        $u->save();
        $grop->id_name=$u->id;
        $grop->name='download material';
        $grop->status='pending';
        $grop->save();
        $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
        return view('d_material.download_material',compact('nots','mon','servic'));
    }

}


public function permenancy(Request $request){
    $servic=Service::find(4);
    $u=new permenancydocument();
    $user=auth()->user();

    $validator=Validator::make($request->all(),[
        'First_Name'=>  ['required',
                        Rule::in([strtolower($user->first_name),ucfirst($user->first_name)])
                        ],

        'Last_Name'=>   ['required',
                        Rule::in([strtolower($user->last_name),ucfirst($user->last_name)])
                        ],

        'University_id'=>   ['required',
                        Rule::in([$user->code])
                        ],
    ],

    [
        'First_Name.in'=>'ffff',
        'Last_Name.in'=>'llll',
        'University_id'=>'ccc'
    ]);

    if($validator->fails())
    {
        return redirect()->back()->withErrors($validator);
    }
    elseif($user->balance<$servic->price)
    {

        $mon="bbb";
        $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
        return view('u_life.university_life',compact('nots','mon','servic'));
    }
    else
    {
        $grop=new group();
        $mon="ooo";
        $u->usr_id=$user->id;
        $u->chapter=$request->sub;

        $u->year=$request->year;

        $imge= $request->file('photo')->getClientOriginalName();
        $path= $request->file('photo')->storeAS('users',$imge,'mohammad');
        $u->image_hweya=$path;

        $user->balance=$user->balance-$servic->price;
        $user->save();
        $u->save();
        $grop->id_name=$u->id;
        $grop->name='permenancy document';
        $grop->status='pending';
        $grop->save();
        $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
        return view('permanency.Permanencydocument',compact('nots','mon','servic'));
    }

}
///////////////////////admin//////////////////////////////














    public function serviceadmin(){
        $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
        $services=Service::all();
        return view('servicesadmin',compact('services','nots'));
    }

    public function adminupdateprice(Request $request,$id){
        $serv=Service::findOrFail($id);
        if($request->price != "")
        {
            $serv->price=$request->price;
            $serv->save();
            return redirect()->route('servicesadmin');
        }
    }

}


