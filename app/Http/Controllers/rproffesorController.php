<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\userrequest;
use Illuminate\Support\Facades\Crypt;
use App\Mail\EmailVerificationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class rproffesorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(userrequest $request)
    {

        if($request->id==3333)
        {

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
        return redirect()->route('email.verify.form.doctor', ['email' => $emaill,'code' => Crypt::encryptString($request->input('id')),'first_name'=>Crypt::encryptString($request->input('First_Name')),'last_name'=>Crypt::encryptString($request->input('Last_Name')),'purview'=>Crypt::encryptString($request->input('purview')),'password'=>Crypt::encryptString($request->input('password'))]);
        // return redirect()->route('email.verify.form.doctor', ['email' => $request->input('Email'),'code' => $request->input('id'),'first_name'=>$request->input('First_Name'),'last_name'=>$request->input('Last_Name'),'purview'=>$request->input('purview'),'password'=>$request->input('password')]);
        }



        // $u=new User();
        // $u->first_name= ucfirst($request->First_Name);
        // $u->last_name= ucfirst($request->Last_Name);
        // $u->code= $request->id;
        // $u->purview= $request->purview;
        // $u->email= $request->Email;
        // $u->password=Hash::make($request['password']);

        // $u->type= "Professor";
        // if($u->code==3333){
        //     $u->save();
        // return view('auth.login');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
