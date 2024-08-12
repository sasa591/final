<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
use App\Models\degree;
use App\Models\Nontification;
use App\Models\StudentAnswer;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{

    public function index()
    {

        $quizzes = Quiz::all();
        return view('show', compact('quizzes'));
    }

    public function show($id)
    {
        $r=$id;
        $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
        $quiz = Quiz::with('questions.answers')->findOrFail($id);
        return view('exam.answer', compact('quiz','nots','r'));
    }
    public function submit(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id);

        $totalMarks = 0;
        $obtainedMarks = 0;

        foreach ($quiz->questions as $question) {
            $totalMarks += $question->mark;
            $answerId = $request->input("questions.{$question->id}");
            $isCorrect = $question->answers()->where('id', $answerId)->where('is_correct', 1)->exists();
            $obtainedMarks += $isCorrect ? $question->mark : 0;

            StudentAnswer::create([
                'quiz_id' => $quiz->id,
                'u_id'=>Auth::user()->id,
                'question_id' => $question->id,
                'answer_id' => $answerId,
                'is_correct' => $isCorrect
            ]);
        }
        degree::create([
            'u_id' =>Auth::user()->id,
            'quiz_id' => $quiz->id,
            'name'=> $quiz->name,
            'degree' => $obtainedMarks,
            'totalmark'=>$totalMarks
        ]);
        $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
        $quizzes=Quiz::all()->where('name',$quiz->name);
        $name=$quiz->name;
        return view('exam.showexam',compact('nots','quizzes','name'));
    }

    public function create($id)
    {
        $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();

        return view('exam.examadd',compact('nots','id'));
    }

    public function store(Request $request)
    {
        $quiz = Quiz::create([
            'u_id'=>Auth::user()->id,
            'title' => $request->title,
            'year'=>$request->year,
            'name'=>$request->name
        ]);

        foreach ($request->questions as $questionData) {
            $question = new Question([
                'question_text' => $questionData['question_text'],
                'mark' => $questionData['mark'],
                'time_limit' => $questionData['time_limit'] ?? null, // تأكد من وجود حقل time_limit في النموذج إذا كنت ترغب في إضافته
            ]);
            $quiz->questions()->save($question);

            if (isset($questionData['answers'])) {
                foreach ($questionData['answers'] as $index => $answerData) {
                    $answer = new Answer([
                        'answer_text' => $answerData['answer_text'],
                        'is_correct' => $index == $questionData['correct_answer'] ? 1 : 0
                    ]);
                    $question->answers()->save($answer);
                }
            }
        }

        return response()->json(['message' => 'تم إنشاء الاختبار بنجاح']);
    }

    public function showquizz($name)
    {
        $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
        $quizzes=Quiz::all()->where('name',$name);
        return view('exam.showexam',compact('nots','quizzes','name'));
    }
    public function deletequizze($id)
    {

            Quiz::destroy($id);
            $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
            $quizzes=Quiz::all();
            return view('exam.showexam',compact('nots','quizzes'));
        }


        public function result($id)
        {
            $results=degree::all()->where('quiz_id',$id);
            $name=Quiz::all()->where('id',$id)->first();
            if(count($results)!=0)
            {

                $totalmarkstudent = degree::where('quiz_id',$id)->whereColumn('totalmark','degree')->get();
                $halfstudent = degree::where('quiz_id', $id)->first()->value('totalmark');
                $halff=$halfstudent/2;
                $half=degree::all()->where('quiz_id',$id)->where('degree','>=',$halff);

                $halfmore=degree::all()->where('quiz_id',$id)->where('degree','<',$halfstudent/2);
                $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
                return view('exam.result',compact('results','nots','totalmarkstudent','half','halfmore','name'));
            }
            else{

                $results=[];
                $totalmarkstudent =[ ];
                $halfstudent = [ ];
                $halff=[ ];
                $half=[ ];

                $halfmore=[];
                $nots=Nontification::orderby('id','desc')->where('notuser_id','<>',Auth::user()->id)->get();
                return view('exam.result',compact('results','nots','totalmarkstudent','half','halfmore','name'));
            }

        }

}
