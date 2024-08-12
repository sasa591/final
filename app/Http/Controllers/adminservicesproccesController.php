<?php

namespace App\Http\Controllers;
use App\Models\Objection;
use App\Models\document;
use App\Models\group;
use App\Models\detectingsign;
use App\Models\User;
use App\Models\permenancydocument;
use App\Models\downloadmaterial;
use Illuminate\Http\Request;

class adminservicesproccesController extends Controller
{
    public function index4($id){
        if ($id==1)
        {
            $objects=Objection::orderby('id','desc')->get();
            return view('objection_admin',compact('objects'));
        }
        else if ($id==2)
        {
            $detectingsigns=detectingsign::orderby('id','desc')->get();
            return view('signs.detectingsigns_admin',compact('detectingsigns'));
        }
        else if ($id==3)
        {
            $downloadmaterials=downloadmaterial::orderby('id','desc')->get();
            return view('d_material.download_material_admin',compact('downloadmaterials'));
        }
        else if ($id==4)
        {
            $permenancydocuments=permenancydocument::orderby('id','desc')->get();
            return view('permanency.Permanencydocument_admin',compact('permenancydocuments'));
        }

        else if($id==5)
        {
            $documents=document::orderby('id','desc')->get();
            return view('u_life.univercity_admin',compact('documents'));
        }
        else {
            return 'coming  soon';
        }

    }
    public function index5($id){

        $ob=Objection::findorfail($id);
        return view('admin_replay_objection',compact('ob',));

    }

    public function index6($id){

        $ob=document::findorfail($id);
        return view('u_life.admin_replay_univercitylfie',compact('ob'));

    }

    public function index7($id){

        $ob=detectingsign::findorfail($id);
        return view('signs.detectingsigns_admin_replay',compact('ob'));

    }
    public function index8($id){

        $ob=downloadmaterial::findorfail($id);
        return view('d_material.download_material_admin_replay',compact('ob'));

    }
    public function index9($id){

        $ob=permenancydocument::findorfail($id);
        return view('permanency.Permanencydocument_admin_replay',compact('ob'));

    }
    public function storereplayobjection(Request $request ,$id){
        $s=Objection::findorfail($id);
        $g=group::where('id_name',$id)->where('name','objection')->first();
        $stat=group::findorfail($g->id);
        $stat->status=$request->sub;
        $stat->save();
        $s->replay=$request->replay;
        $s->status=$request->sub;
        $s->save();
        $stat->save();
        return redirect()->route('object_admin_replay',$id);
    }

    public function storereplayunivercity(Request $request ,$id){
        $s=document::findorfail($id);
        $s->replay=$request->replay;
        $s->status=$request->sub;
        $g=group::where('id_name',$id)->where('name','Univercity life')->first();
        $stat=group::findorfail($g->id);
        $stat->status=$request->sub;
        $stat->save();
        $s->save();
        return redirect()->route('univercity_admin_replay',$id);
    }
    public function storereplaydetecting(Request $request ,$id){
        $s=detectingsign::findorfail($id);
        $s->replay=$request->replay;
        $s->status=$request->sub;
        $g=group::where('id_name',$id)->where('name','detecting signs')->first();
        $stat=group::findorfail($g->id);
        $stat->status=$request->sub;
        $stat->save();
        $s->save();
        return redirect()->route('detectingsigns_admin_replay',$id);
    }

    public function storereplaymaterial(Request $request ,$id){
        $s=downloadmaterial::findorfail($id);
        $s->replay=$request->replay;
        $s->status=$request->sub;
        $g=group::where('id_name',$id)->where('name','download material')->first();
        $stat=group::findorfail($g->id);
        $stat->status=$request->sub;
        $stat->save();
        $s->save();
        return redirect()->route('downloadmaterial_admin_replay',$id);
    }

    public function storereplaypermanency(Request $request ,$id){
        $s=permenancydocument::findorfail($id);
        $s->replay=$request->replay;
        $s->status=$request->sub;
        $g=group::where('id_name',$id)->where('name','permenancy document')->first();
        $stat=group::findorfail($g->id);
        $stat->status=$request->sub;
        $stat->save();
        $s->save();
        return redirect()->route('permanency_admin_replay',$id);
    }

}
