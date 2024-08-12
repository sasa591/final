<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\programmer;
use App\Models\course;
use App\Models\lecture;
use App\Models\Grade;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Nontification;
class cousresController extends Controller
{
    public function index(){
        $nots=Nontification::all();
        return view('courses.courses_main',compact('nots'));
    }

    public function index2($id){
        $nots=Nontification::all();
        if($id==1)
        {
            $year='الأولى';
            $courses=course::all()->where('year','one');
            return view('courses.courses_year',compact('nots','courses','year'));
        }
        if($id==2)
        {
            $year='الثانية';
            $courses=course::all()->where('year','two');
            return view('courses.courses_year',compact('nots','courses','year'));
        }
        if($id==3)
        {
            $year='الثالثة';
            $courses=course::all()->where('year','three');
            return view('courses.courses_year',compact('nots','courses','year'));
        }
        if($id==4)
        {
            $year='الرابعة';
            $courses=course::all()->where('year','four');
            return view('courses.courses_year',compact('nots','courses','year'));
        }
        if($id==5)
        {
            $year='الخامسة';
            $courses=course::all()->where('year','five');
            return view('courses.courses_year',compact('nots','courses','year'));
        }
    }


    public function showprogrammes(){
        $nots=Nontification::all();
        $files = programmer::all();
        return view('courses.programmes',compact('nots','files'));
    }

    public function store(Request $request)
    {
        // التحقق من صحة الطلب
        $request->validate([
            'file' => 'required|mimes:pdf|max:10240', // 10 ميغا
        ]);

        // الحصول على الملف من الطلب
        $file = $request->file('file');

        // تعيين اسم فريد للملف
        $filename = time() . '_' . $file->getClientOriginalName();

        // تحديد المسار لتخزين الملف
        $path = $file->storeAs('uploads', $filename, 'public');
        $size=$file->getSize();
        // حفظ مسار الملف في قاعدة البيانات
        $fileRecord = new programmer();
        $fileRecord->name = $request->name;
        $fileRecord->path = $path;
        $fileRecord->size=$size/1024;
        $fileRecord->save();

        return redirect()->route('programmes');
    }

        // طريقة لتحميل ملف معين
        public function downloadprogrammes($id)
        {
            $file = programmer::findOrFail($id);
            $filePath = storage_path('app/public/' . $file->path);

            return response()->download($filePath, $file->name);
        }

        public function deleteprogrammer($id)
        {
            programmer::destroy($id);
            return redirect()->route('programmes');
        }




        /////////////////////lectures////////////////
        public function index3($id){
            $nots=Nontification::all();
            $lectures=lecture::all()->where('c_id',$id);
            return view('courses.one_lectures',compact('nots','id','lectures'));
        }

        public function storelectures(Request $request ,$id)
        {
            // التحقق من صحة الطلب
            $request->validate([
                'file' => 'required|mimes:pdf|max:20480', // 10 ميغا
            ]);

            // الحصول على الملف من الطلب
            $file = $request->file('file');

            // تعيين اسم فريد للملف
            $filename = time() . '_' . $file->getClientOriginalName();

            // تحديد المسار لتخزين الملف
            $path = $file->storeAs('lecture', $filename, 'public');
            $size=$file->getSize();
            // حفظ مسار الملف في قاعدة البيانات
            $fileRecord = new lecture();
            $fileRecord->d_id=auth()->user()->id;
            $fileRecord->c_id=$id;
            $fileRecord->name = $request->name;
            $fileRecord->path = $path;
            $fileRecord->size=$size/1024;
            $fileRecord->save();
            $nots=Nontification::all();
            $lectures=lecture::all()->where('c_id',$id);
            return view('courses.one_lectures',compact('nots','id','lectures'));
        }

        public function downloadlecture($id)
        {
            $file = lecture::findOrFail($id);
            $filePath = storage_path('app/public/' . $file->path);

            return response()->download($filePath, $file->name);
        }

        public function deletelecture($id)
        {
            $l=lecture::where('id',$id)->first();
            $num=$l->c_id;
            lecture::destroy($id);
            $nots=Nontification::all();
            $id=$num;
            $lectures=lecture::all()->where('c_id',$id);
            return view('courses.one_lectures',compact('nots','id','lectures'));
        }

                /////////////////////grads////////////////
                public function index4(){
                    $nots=Nontification::all();
                    $grades=Grade::all();
                    return view('courses.grades',compact('nots','grades'));
                }

                public function downloadgrads($id)
                {
                    $file = Grade::findOrFail($id);
                    $filePath = storage_path('app/public/' . $file->path);

                    return response()->download($filePath, $file->name);
                }

                public function deletegrads($id)
                {

                    Grade::destroy($id);
                    $nots=Nontification::all();
                    $grades=Grade::all();
                    return view('courses.grades',compact('nots','grades'));
                }

                public function storegrads(Request $request )
                {

                    // التحقق من صحة الطلب
                    $request->validate([
                        'file' => 'required|mimes:pdf|max:20480', // 10 ميغا
                    ]);

                    // الحصول على الملف من الطلب
                    $file = $request->file('file');

                    // تعيين اسم فريد للملف
                    $filename = time() . '_' . $file->getClientOriginalName();

                    // تحديد المسار لتخزين الملف
                    $path = $file->storeAs('grade', $filename, 'public');
                    $size=$file->getSize();
                    // حفظ مسار الملف في قاعدة البيانات
                    $fileRecord = new Grade();
                    $fileRecord->name = $request->name;
                    $fileRecord->path = $path;
                    $fileRecord->size=$size/1024;
                    $fileRecord->save();
                    $nots=Nontification::all();
                    $grades=Grade::all();

                    return view('courses.grades',compact('nots','grades'));
                }


///////////////quizzes///////////////////////
public function index5($id){
    $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
    $quizzess=Quiz::orderby('id','desc')->where('year',$id)->get();
    $quizzes= $quizzess->unique('name');
    return view('quizzes',compact('nots','id','quizzes'));
}
}
