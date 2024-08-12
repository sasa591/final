<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nontification;
use App\Models\Objection;
use App\Models\detectingsign;
use App\Models\group;
use App\Models\document;
use App\Models\permenancydocument;
use App\Models\downloadmaterial;
use Illuminate\Support\Facades\Auth;

class inboxController extends Controller
{
    public function index(){
        $nots=Nontification::all();
        $i=Auth::user()->id;
        $groups=group::orderby('id','desc')->get();
        $access1='eee';
        $ones=Objection::orderby('id','desc')->where('usr_id',$i)->get();
        $two=detectingsign::orderby('id','desc')->where('usr_id',$i)->get();
        $three=downloadmaterial::orderby('id','desc')->where('usr_id',$i)->get();
        $four=permenancydocument::orderby('id','desc')->where('usr_id',$i)->get();
        $five=document::orderby('id','desc')->where('usr_id',$i)->get();

        return view('inbox',compact('nots','groups','access1','ones','two','three','four','five'));


    }

    public function destroy_inbox($id){
        Objection::destroy($id);
        group::where('id_name', $id)->where('name','objection')->delete();
        return redirect()->route('inbox');
    }
    public function destroy_inbox_detecting($id){
        detectingsign::destroy($id);
        group::where('id_name', $id)->where('name','detecting signs')->delete();
        return redirect()->route('inbox');
    }
    public function destroy_inbox_material($id){
        downloadmaterial::destroy($id);
        group::where('id_name', $id)->where('name','download material')->delete();
        return redirect()->route('inbox');
    }
    public function destroy_inbox_permenancy($id){
        permenancydocument::destroy($id);
        group::where('id_name', $id)->where('name','permenancy document')->delete();
        return redirect()->route('inbox');
    }
    public function destroy_inbox_univercity($id){
        document::destroy($id);
        group::where('id_name', $id)->where('name','Univercity life')->delete();
        return redirect()->route('inbox');
    }

    public function filtrbox(Request $request){
        $nots=Nontification::all();
        $i=Auth::user()->id;
        $access1='eee';
        $ones=[];
        $two=[];
        $three=[];
        $four=[];
        $five=[];
        if($request->type=="Objection"){
            $groups=group::orderby('id','desc')->where('name','objection')->where('status',$request->statu)->get();
            $ones=Objection::orderby('id','desc')->where('usr_id',$i)->where('status',$request->statu)->get();
            return view('inbox',compact('nots','access1','groups','ones','two','three','four','five'));
        }
        else if($request->type=="detecting signs"){
            $groups=group::orderby('id','desc')->where('name','detecting signs')->where('status',$request->statu)->get();
            $two=detectingsign::orderby('id','desc')->where('usr_id',$i)->where('status',$request->statu)->get();
            return view('inbox',compact('nots','access1','groups','ones','two','three','four','five'));
        }
        else if($request->type=="download material"){
            $groups=group::orderby('id','desc')->where('name','download material')->where('status',$request->statu)->get();
            $three=downloadmaterial::orderby('id','desc')->where('usr_id',$i)->where('status',$request->statu)->get();
            return view('inbox',compact('nots','access1','groups','ones','two','three','four','five'));
        }
        else if($request->type=="permenancy document"){
            $groups=group::orderby('id','desc')->where('name','permenancy document')->where('status',$request->statu)->get();
            $four=permenancydocument::orderby('id','desc')->where('usr_id',$i)->where('status',$request->statu)->get();
            return view('inbox',compact('nots','access1','groups','ones','two','three','four','five'));
        }
        else if($request->type=="Univercity life"){
            $groups=group::orderby('id','desc')->where('name','Univercity life')->where('status',$request->statu)->get();
            $five=document::orderby('id','desc')->where('usr_id',$i)->where('status',$request->statu)->get();
            return view('inbox',compact('nots','access1','groups','ones','two','three','four','five'));
        }
    }

}
