<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Nontification;
use App\Models\Replay;
use App\Models\User;

use App\Notifications\NewPostNotification;
use App\Models\Comment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class postController extends Controller
{
    public function store(Request $request)
    {
        $color="r";
        $bool=FALSE;
        $u=new Post();
        $n=new Nontification();
        $id=Auth::user()->id;
        $u->u_id=$id;
        $u->first_name=Auth::user()->first_name;
        $u->last_name=Auth::user()->last_name;
        $u->filter= $request->filter;
        if($request->content != ""&&$request->photo == "")
        {
            $u->content=$request->content;
            $bool=TRUE;
            $u->save();
            $users = User::where('id', '!=', auth()->id())->get(); // الحصول على جميع المستخدمين باستثناء من أنشأ المنشور

            foreach ($users as $user) {
                $user->notify(new NewPostNotification($u));
            }

        }

        elseif($request->photo != ""&&$request->content == "")
        {
            $imge= $request->file('photo')->getClientOriginalName();
            $path= $request->file('photo')->storeAS('users',$imge,'mohammad');
            $u->file=$path;
            $bool=TRUE;
            $u->save();
            $users = User::where('id', '!=', auth()->id())->get(); // الحصول على جميع المستخدمين باستثناء من أنشأ المنشور

            foreach ($users as $user) {
                $user->notify(new NewPostNotification($u));
            }

        }
        elseif($request->photo != ""&& $request->content != ""){
            $u->content=$request->content;
            $imge= $request->file('photo')->getClientOriginalName();
            $path= $request->file('photo')->storeAS('users',$imge,'mohammad');
            $u->file=$path;
            $bool=TRUE;
            $u->save();
            $users = User::where('id', '!=', auth()->id())->get(); // الحصول على جميع المستخدمين باستثناء من أنشأ المنشور

            foreach ($users as $user) {
                $user->notify(new NewPostNotification($u));
            }
        }
        if($bool)
        {
            $n->notuser_id=Auth::user()->id;
            $n->type='post';
            $n->content_not='posted a new announcement';
            $n->notpost_id=Post::latest('id')->first()->id;
            $n->save();
            $posts=Post::orderby('id','desc')->get();
            $comments=Comment::all();
            $replays=Replay::all();
            $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
            return view('home',compact('posts','comments','replays','nots'));
        }
    }

// عرض البوستات مع الفلترة
    public function user()
    {
        if(session()->has('fltr') && session('fltr')=="General Annoucement"||session('fltr')=="First Year"|| session('fltr')=="Second Year"||session('fltr')=="Third Year"||session('fltr')=="Fourth Year-Software"||session('fltr')=="Fourth Year-AI"||session('fltr')=="Fourth Year-Networks"||session('fltr')=="'FiFth Year-Software'"||session('fltr')=="FiFth Year-AI"||session('fltr')=="FiFth Year-Networks"){
            $posts=Post::orderby('id','desc')->where('filter',session('fltr'))->get();
            $comments=Comment::all();
            $replays=Replay::all();
            $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
            return view('home',compact('posts','comments','replays','nots'));
        }
        elseif(session()->has('fltr')&& session('fltr')=="Posts By Me"){
            $usercurr=Auth::user()->id;
            $posts=Post::orderby('id','desc')->where('u_id',$usercurr)->get();
            $comments=Comment::all();
            $replays=Replay::all();
            $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
            return view('home',compact('posts','usercurr','comments','replays','nots'));
        }

        else{
            $posts=Post::orderby('id','desc')->get();
            $comments=Comment::all();
            $replays=Replay::all();
            $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
            return view('home',compact('posts','comments','replays','nots'));
        }



    }


    public function filetpost(Request $request)
    {
        $fl=$request->fltr;
        if($fl=="General Annoucement"||$fl=="First Year"|| $fl=="Second Year"||$fl=="Third Year"||$fl=="Fourth Year-Software"||$fl=="Fourth Year-AI"||$fl=="Fourth Year-Networks"||$fl=="'FiFth Year-Software'"||$fl=="FiFth Year-AI"||$fl=="FiFth Year-Networks"){
            $posts=Post::orderby('id','desc')->where('filter',$fl)->get();
            session()->put('fltr',$request->input('fltr'));
            $comments=Comment::all();
            $replays=Replay::all();
            $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
            return view('home',compact('posts','comments','replays','nots'));
        }

        elseif($fl=="Posts By Me"){
            $usercurr=Auth::user()->id;
            $posts=Post::orderby('id','desc')->where('u_id',$usercurr)->get();
            session()->put('fltr',$request->input('fltr'));
            $comments=Comment::all();
            $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
            $replays=Replay::all();

            return view('home',compact('posts','usercurr','comments','replays','nots'));
        }
        else{
            $posts=Post::orderby('id','desc')->where('content','like','%'.$fl.'%')->get();
            session()->put('fltr','');
            $comments=Comment::all();
            $replays=Replay::all();
            $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
            return view('home',compact('posts','comments','replays','nots'));
        }
        }




// الانتهاء من عرض البوستات مع الفلترة







//////////////////
////حذف البوست

    public function destroy($id)
    {
    Post::destroy($id);

        return redirect()->route('hoome');
    }
    public function destroy_comment($id){
        Comment::destroy($id);

        return redirect()->route('hoome');
    }
    public function destroy_replay($id){
        Replay::destroy($id);

        return redirect()->route('hoome');
    }


//////////////////
////هون تعديل البوست
    public function updatePost(Request $request,$id)
    {
        $po=Post::findOrFail($id);
        if($request->content != "")
        {
            $po->content=$request->content;
            $po->save();

        }

        if($request->photo != "")
        {
            $imge= $request->file('photo')->getClientOriginalName();
            $path= $request->file('photo')->storeAS('users',$imge,'mohammad');
            $po->file=$path;
            $po->save();
        }

        return redirect()->route('hoome');

    }


    public function updatecomment(Request $request,$id)
    {
        $com=Comment::findOrFail($id);
        if($request->editcom != "")
        {
            $com->content_comment=$request->editcom;
            $com->save();

        }

        return redirect()->route('hoome');

    }

    public function updatereplay(Request $request,$id)
    {
        $com=Replay::findOrFail($id);
        if($request->mmm != "")
        {
            $com->replay_comment=$request->mmm;
            $com->save();

        }

        return redirect()->route('hoome');
    }
////////////////////

public function store_commment(Request $request,$id)
{
    $c=new Comment();
    $user_id=Auth::user()->id;
    $c->u_id=$user_id;
    $c->p_id=$id;
    $c->content_comment=$request->content_comment;
    $c->save();
    return redirect()->route('hoome');

}
public function store_replay(Request $request,$id)
{
    $rep=new Replay();
    $userr_id=Auth::user()->id;
    $rep->uu_id=$userr_id;
    $rep->cc_id=$id;
    $rep->replay_comment=$request->replay_co;
    $rep->save();
    return redirect()->route('hoome');

}


////////////////////////////// توابع للطالب  //////////////

public function userstudent()
{
    if(session()->has('fltr') && session('fltr')=="General Annoucement"||session('fltr')=="First Year"|| session('fltr')=="Second Year"||session('fltr')=="Third Year"||session('fltr')=="Fourth Year-Software"||session('fltr')=="Fourth Year-AI"||session('fltr')=="Fourth Year-Networks"||session('fltr')=="'FiFth Year-Software'"||session('fltr')=="FiFth Year-AI"||session('fltr')=="FiFth Year-Networks"){
        $posts=Post::orderby('id','desc')->where('filter',session('fltr'))->get();
        $comments=Comment::all();
        $replays=Replay::all();
        $nots=Nontification::all();
        return view('homestudent',compact('posts','comments','replays','nots'));
    }
    elseif(session()->has('fltr')&& session('fltr')=="Posts By Me"){
        $usercurr=Auth::user()->id;
        $posts=Post::orderby('id','desc')->where('u_id',$usercurr)->get();
        $comments=Comment::orderby('id','desc')->get();
        $replays=Replay::orderby('id','desc')->get();
        $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
        return view('homestudent',compact('posts','usercurr','comments','replays','nots'));
    }

    else{
        $posts=Post::orderby('id','desc')->get();
        $comments=Comment::orderby('id','desc')->get();
        $replays=Replay::orderby('id','desc')->get();
        $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
        return view('homestudent',compact('posts','comments','replays','nots'));
    }



}


}















