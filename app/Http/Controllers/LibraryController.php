<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nontification;
use App\Models\book;
class LibraryController extends Controller
{
   public function index(){
    $nots=Nontification::all();
    $files = book::all();
    return view('Library',compact('nots','files'));
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
       $path = $file->storeAs('book', $filename, 'public');
       $size=$file->getSize();
       // حفظ مسار الملف في قاعدة البيانات
       $fileRecord = new book();
       $fileRecord->name = $request->name;
       $fileRecord->path = $path;
       $fileRecord->about = $request->about;
       $fileRecord->size=$size/1024;
       $fileRecord->save();

       return redirect()->route('homelibrary');
   }

   public function downloadbook($id)
        {
            $file = book::findOrFail($id);
            $filePath = storage_path('app/public/' . $file->path);

            return response()->download($filePath, $file->name);
        }
        public function deletebook($id)
        {
            book::destroy($id);
            return redirect()->route('homelibrary');
        }
}
