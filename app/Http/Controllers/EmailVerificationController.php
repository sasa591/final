<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Notifications\VerificationSuccessful;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class EmailVerificationController extends Controller
{
    public function showVerificationForm($email, $code,$password)
    {
        $emaild = Crypt::decryptString($email);
        $coded = Crypt::decryptString($code);
        $passwordd = Crypt::decryptString($password);
        return view('auth.verify', ['email' => $emaild ,'code' =>$coded,'password'=>$passwordd]);
    }

    public function showVeri($email, $code,$purview,$first_name,$last_name,$password)
    {
        $emaild = Crypt::decryptString($email);
        $coded = Crypt::decryptString($code);
        $purviewd = Crypt::decryptString($purview);
        $first_named = Crypt::decryptString($first_name);
        $last_named = Crypt::decryptString($last_name);
        $passwordd = Crypt::decryptString($password);
        return view('auth.verifyd', ['email' => $emaild ,'code' =>$coded,'purview'=>$purviewd,'first_name'=>$first_named,'last_name'=>$last_named,'password'=>$passwordd]);
    }

    public function showVeriA($email, $code,$first_name,$last_name,$password)
    {

        $emaild = Crypt::decryptString($email);
        $coded = Crypt::decryptString($code);
        $first_named = Crypt::decryptString($first_name);
        $last_named = Crypt::decryptString($last_name);
        $passwordd = Crypt::decryptString($password);

        return view('auth.verifyA', ['email' => $emaild ,'code' =>$coded,'first_name'=>$first_named,'last_name'=>$last_named,'password'=>$passwordd]);
    }


    public function verifyEmail(Request $request)
    {
        $email = $request->input('email');
        $code = $request->input('code');


        $enteredCode = $request->input('one').$request->input('two').$request->input('three').$request->input('four');


        $storedCode = DB::table('email_verifications')->where('email', $email)->value('verification_code');

        if ($enteredCode == $storedCode) {

            // تخزين المستخدم في قاعدة البيانات

            $user =User::all()->where('code',$code)->first();

            $user->email = $email;
            $user->code=$code;
            $user->password = Hash::make($request->input('password'));
            $user->save();

            // حذف رمز التحقق بعد التحقق
            DB::table('email_verifications')->where('email', $email)->delete();
            $a='yes';
            $user->notify(new VerificationSuccessful());
            return view('auth.confirmVerify',compact('a'));
        } else {
            session()->flash('alert', 'Inccorrect verfication code!!');

        $emaill= Crypt::encryptString($request->input('email'));
        return redirect()->route('email.verify.form', ['email' => $emaill,'code' => Crypt::encryptString($request->input('code')),'password'=>Crypt::encryptString($request->input('password'))]);

        }



    }


    public function verifyEmailD(Request $request)
    {
        $email = $request->input('email');
        $code = $request->input('code');

        $enteredCode = $request->input('one').$request->input('two').$request->input('three').$request->input('four');


        $storedCode = DB::table('email_verifications')->where('email', $email)->value('verification_code');

        if ($enteredCode === $storedCode) {
            // تخزين المستخدم في قاعدة البيانات

            $user =new User();
            $user->first_name= $request->input('first_name');
            $user->last_name= $request->input('last_name');
            $user->purview= $request->input('purview');
            $user->email = $email;
            $user->code=$code;
            $user->type='Professor';
            $user->password = Hash::make($request->input('password'));
            $user->save();

            // حذف رمز التحقق بعد التحقق
            DB::table('email_verifications')->where('email', $email)->delete();

        //     $a='yes';
        //     return view('auth.confirmVerify',compact('a'));
        // } else {
        //     $a='no';
        //     return view('auth.confirmVerify',compact('a'));

        // }
        $a='yes';
        $user->notify(new VerificationSuccessful());
        return view('auth.confirmVerify',compact('a'));
    } else {
        session()->flash('alert', 'Inccorrect verfication code!!');

    $emaill= Crypt::encryptString($request->input('email'));
    return redirect()->route('email.verify.form.doctor', ['email' => $emaill,'code' => Crypt::encryptString($request->input('code')),'first_name'=>Crypt::encryptString($request->input('first_name')),'last_name'=>Crypt::encryptString($request->input('last_name')),'purview'=>Crypt::encryptString($request->input('purview')),'password'=>Crypt::encryptString($request->input('password'))]);

    }




    }

    public function verifyEmailA(Request $request)
    {
        $email = $request->input('email');
        $code = $request->input('code');

        $enteredCode = $request->input('one').$request->input('two').$request->input('three').$request->input('four');


        $storedCode = DB::table('email_verifications')->where('email', $email)->value('verification_code');

        if ($enteredCode === $storedCode) {
            // تخزين المستخدم في قاعدة البيانات

            $user =new User();
            $user->first_name= $request->input('first_name');
            $user->last_name= $request->input('last_name');
            $user->email = $email;
            $user->code=$code;
            $user->type='admin';
            $user->password = Hash::make($request->input('password'));
            $user->save();

            // حذف رمز التحقق بعد التحقق
            DB::table('email_verifications')->where('email', $email)->delete();

            $a='yes';
            $user->notify(new VerificationSuccessful());
            return view('auth.confirmVerify',compact('a'));
        } else {
            session()->flash('alert', 'Inccorrect verfication code!!');

        $emaill= Crypt::encryptString($request->input('email'));
        return redirect()->route('email.verify.form.admin', ['email' => $emaill,'code' => Crypt::encryptString($request->input('code')),'first_name'=>Crypt::encryptString($request->input('first_name')),'last_name'=>Crypt::encryptString($request->input('last_name')),'password'=>Crypt::encryptString($request->input('password'))]);

        }
    }


}
