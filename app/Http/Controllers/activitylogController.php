<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Nontification;
use App\Models\Replay;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Notifications\NewPostNotification;
use App\Models\Comment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class activitylogController extends Controller
{
    public function index1(){

        $postsQuery = DB::table('posts')->select('id','created_at',DB::raw("'Post' as activity_type"))->where('u_id', auth()->id()); // تحويل إلى Query Builder
        $commentsQuery = DB::table('comments')->select('id', 'created_at' ,DB::raw("'Comment' as activity_type"))->where('u_id', auth()->id());
        $replayQuery = DB::table('replays')->select('id', 'created_at' ,DB::raw("'Replay' as activity_type"))->where('uu_id', auth()->id());
        $lectureQuery = DB::table('lectures')->select('id', 'created_at' ,DB::raw("'Lecture' as activity_type"))->where('d_id', auth()->id());
        $quizzesQuery = DB::table('quizzes')->select('id', 'created_at' ,DB::raw("'Add Quizze' as activity_type"))->where('u_id', auth()->id());
        $takeaquizzeQuery = DB::table('degrees')->select('id', 'created_at' ,DB::raw("'Take A Quizze' as activity_type"))->where('u_id', auth()->id());
        $objectionsQuery = DB::table('objections')->select('id', 'created_at' ,DB::raw("'تقديم وثيقة اعتراض' as activity_type"))->where('usr_id', auth()->id());
        $permenancydocumentsQuery = DB::table('permenancydocuments')->select('id', 'created_at' ,DB::raw("'تقديم وثيقة دوام' as activity_type"))->where('usr_id', auth()->id());
        $downloadmaterialsQuery = DB::table('downloadmaterials')->select('id', 'created_at' ,DB::raw("'تقديم وثيقة تنزيل مواد' as activity_type"))->where('usr_id', auth()->id());
        $detectingsignsQuery = DB::table('detectingsigns')->select('id', 'created_at' ,DB::raw("'تقديم وثيقة كشف علامات' as activity_type"))->where('usr_id', auth()->id());
        $documentsQuery = DB::table('documents')->select('id', 'created_at' ,DB::raw("'تقديم وثيقة حياة جامعية ' as activity_type"))->where('usr_id', auth()->id());
        $combinedQuery = $postsQuery->unionAll($commentsQuery)->unionAll($replayQuery)->unionAll($lectureQuery)->unionAll($quizzesQuery)->unionAll($takeaquizzeQuery)->unionAll($objectionsQuery)->unionAll($permenancydocumentsQuery)->unionAll($downloadmaterialsQuery)->unionAll($detectingsignsQuery)->unionAll($documentsQuery);


        $activityLogs = DB::table(DB::raw("({$combinedQuery->toSql()}) as combined"))->mergeBindings($combinedQuery)->orderBy('created_at', 'desc')->get();


        $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
        return view('ActivityLog',compact('nots','activityLogs'));


    }



}
