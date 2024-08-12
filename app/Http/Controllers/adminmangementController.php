<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Objection;
use App\Models\User;
use App\Http\Requests\adduser;
use App\Models\Nontification;
use App\Models\Service;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Mail\EmailVerificationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class adminmangementController extends Controller
{
    public function index(){
        return view('adminmangement');
    }

    public function charge(){
        $blan="";
        $e="";
        return view('admin_charge',compact('blan','e'));
    }

    public function updatemoney(Request $request){
        $user=User::all()->where('code',$request->University_id)->first();
        if($user==""){
            $e="account not found";
            $blan="";
            return view('admin_charge',compact('e','blan'));
        }
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
            'mony' => 'required',

            'monyconfirm' => 'required|same:mony',
        ],

        [
            'First_Name.in'=>'bbbb',
            'Last_Name.in'=>'bbbb',
            'University_id'=>'bbbb'
        ]);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }
        else{
            $e="";
            $blan="ook";
            $user->balance=$user->balance+$request->monyconfirm;
            $user->save();
            return view('admin_charge',compact('blan','e'));
        }
    }


    public function index2(){
        $dd="";
        $o="";
        return view('admin_delete_user',compact('dd','o'));
    }


    public function deleteuser(Request $request){
        $user=User::all()->where('code',$request->code)->first();
        if($user==""){
            $dd="account not found";
            $o="";
            return view('admin_delete_user',compact('dd','o'));
        }
        elseif($user->first_name==ucfirst($request->first_name) &&$user->last_name==ucfirst($request->last_name)&&$user->code==$request->code &&$user->year==$request->year)
        {
            $dd="";
            $o="ok";
            User::destroy($user->id);

            return view('admin_delete_user',compact('dd','o'));
        }
        else{
            $dd="account not found";
            $o="";
            return view('admin_delete_user',compact('dd','o'));
        }
    }


    public function index3(){
        $blan="";
        return view('admin_add_user',compact('blan'));
    }



    public function ddd(adduser $request)
    {

        $user=User::all()->where('code',$request->University_id)->first();
        if($user==""){
            $dd="the number error";
            return view('auth.registerstudent',compact('dd'));
        }
        else{




                // التحقق من صحة البيانات
                // $request->validate([
                //     'University_id' => 'required',
                //     'email' => 'required|string|email|max:255|unique:users',
                //     'password' => 'required|string|confirmed|min:8',
                // ]);

                // إنشاء رمز تحقق عشوائي
                $verificationCode = Str::random(4);

                // تخزين رمز التحقق في قاعدة البيانات
                DB::table('email_verifications')->updateOrInsert(
                    ['email' => $request->input('Email')],
                    ['verification_code' => $verificationCode]
                );

                // إرسال البريد الإلكتروني
                Mail::to($request->input('Email'))->send(new EmailVerificationMail($verificationCode));

                // توجيه المستخدم إلى صفحة التحقق

                $emaill= Crypt::encryptString($request->input('Email'));
                return redirect()->route('email.verify.form', ['email' => $emaill,'code' => Crypt::encryptString($request->input('University_id')),'password'=>Crypt::encryptString($request->input('password'))]);

            }
        }
    }

