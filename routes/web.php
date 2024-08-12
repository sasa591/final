<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\rproffesorController;
use App\Http\Controllers\rstudentController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\postController;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\QuizController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('login', function () {
    return view('auth.login');
})->name('login');

Route::get('ww', function () {
    return view('inbox');
})->name('ww');

Route::get('/friends', function () {
    return view('friends');
})->name('friends');
Route::get('/friend_pro', function () {
    return view('friends_pofile');
})->name('friend_pro');

Route::get('doctor', function () {
    return view('auth.registerdoctor');
})->name('doctor');

Route::get('student', function () {
    $dd="";
    return view('auth.registerstudent',compact('dd'));
})->name('student');

Route::get('admin', function () {
    return view('auth.registeradmin');
})->name('admin');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('profilauth', [App\Http\Controllers\updateController::class, 'prof'])->name('profilauth');
Route::resource('rdoctor',rproffesorController::class);
Route::resource('rstudent',rstudentController::class);
Route::resource('radmin',adminController::class);
Route::post('wqw',[App\Http\Controllers\adminmangementController::class,'ddd'])->name('gret');
//
Route::post('update', [App\Http\Controllers\updateController::class, 'update1'])->name('update');

Route::post('update2', [App\Http\Controllers\updateController::class, 'update2'])->name('update2');

Route::get('update3', [App\Http\Controllers\updateController::class, 'update3'])->name('update3');
Route::get('update4', [App\Http\Controllers\updateController::class, 'update4'])->name('update4');

Route::post('update5', [App\Http\Controllers\updateController::class, 'update5'])->name('update5');
Route::get('update6', [App\Http\Controllers\updateController::class, 'update6'])->name('update6');




Route::get('lll', [App\Http\Controllers\updateController::class, 'update1'])->name('lll');
Route::get('profile', [App\Http\Controllers\photoController::class, 'show'])->name('profile');
Route::get('hoome', [App\Http\Controllers\postController::class, 'user'])->name('hoome');
Route::post('filtr', [App\Http\Controllers\postController::class, 'filetpost'])->name('filtr');
/////////////////////////////////////////////////////////////////////////////////////postat
Route::post('post', [App\Http\Controllers\postController::class, 'store'])->name('post');

Route::get('post_show', [App\Http\Controllers\postController::class, 'show'])->name('post_show');
Route::post('post_destroy/{id}', [App\Http\Controllers\postController::class, 'destroy'])->name('post_destroy');
Route::post('replay_destroy/{id}', [App\Http\Controllers\postController::class, 'destroy_replay'])->name('replay_destroy');
Route::post('comment_destroy/{id}', [App\Http\Controllers\postController::class, 'destroy_comment'])->name('comment_destroy');
Route::post('postupdate/{id}', [App\Http\Controllers\postController::class, 'updatePost'])->name('postupdate');
Route::post('commentupdate/{id}', [App\Http\Controllers\postController::class, 'updatecomment'])->name('commentupdate');
Route::post('replaytupdate/{id}', [App\Http\Controllers\postController::class, 'updatereplay'])->name('replayupdate');



Route::post('comment/{id}', [App\Http\Controllers\postController::class, 'store_commment'])->name('comment');
Route::post('replay/{id}', [App\Http\Controllers\postController::class, 'store_replay'])->name('replay');



Route::get('notfriends', [App\Http\Controllers\friendsController::class, 'not'])->name('notfriends');
Route::get('notfriendsprofil/{id}', [App\Http\Controllers\friendsController::class, 'notfp'])->name('notfriendsprofil');
Route::post('search', [App\Http\Controllers\friendsController::class, 'search'])->name('search');




Route::get('/services', [App\Http\Controllers\servicesController::class, 'service'])->name('services');
Route::get('/object/{id}', [App\Http\Controllers\servicesController::class, 'selectservice'])->name('object');
Route::post('/obj', [App\Http\Controllers\servicesController::class, 'objectstore'])->name('objectstor');
Route::get('/servicesadmin', [App\Http\Controllers\servicesController::class, 'serviceadmin'])->name('servicesadmin');

////////////////////student//////////////


Route::get('hoomestudent', [App\Http\Controllers\postController::class, 'userstudent'])->name('hoomestudent');




////////////////////admin///////////////////
Route::post('/updateprice/{id}', [App\Http\Controllers\servicesController::class, 'adminupdateprice'])->name('updateprice');

Route::get('mmmangement', [App\Http\Controllers\adminmangementController::class, 'index'])->name('mangement');
Route::get('qwe', [App\Http\Controllers\adminmangementController::class, 'charge'])->name('charge');
Route::post('updateblane', [App\Http\Controllers\adminmangementController::class, 'updatemoney'])->name('updateblane');
Route::get('deletuser', [App\Http\Controllers\adminmangementController::class, 'index2'])->name('deleteuser');
Route::post('admindeleteuser', [App\Http\Controllers\adminmangementController::class, 'deleteuser'])->name('admindeleteuser');

Route::get('adduser', [App\Http\Controllers\adminmangementController::class, 'index3'])->name('adminadd');


Route::get('object_admin/{id}', [App\Http\Controllers\adminservicesproccesController::class, 'index4'])->name('object_admin');


Route::get('/object_replay/{id}', [App\Http\Controllers\adminservicesproccesController::class, 'index5'])->name('object_admin_replay');
Route::get('/univercity_replay/{id}', [App\Http\Controllers\adminservicesproccesController::class, 'index6'])->name('univercity_admin_replay');
Route::get('/detecting_replay/{id}', [App\Http\Controllers\adminservicesproccesController::class, 'index7'])->name('detectingsigns_admin_replay');
Route::get('/downloadmaterial_replay/{id}', [App\Http\Controllers\adminservicesproccesController::class, 'index8'])->name('downloadmaterial_admin_replay');
Route::get('/permanency_replay/{id}', [App\Http\Controllers\adminservicesproccesController::class, 'index9'])->name('permanency_admin_replay');


Route::post('store_replay/{id}', [App\Http\Controllers\adminservicesproccesController::class, 'storereplayobjection'])->name('store_replay');
Route::post('store_replay_univercity/{id}', [App\Http\Controllers\adminservicesproccesController::class, 'storereplayunivercity'])->name('store_replay_univercity');
Route::post('store_replay_detectingsigns/{id}', [App\Http\Controllers\adminservicesproccesController::class, 'storereplaydetecting'])->name('store_replay_detectingsigns');
Route::post('store_replay_downloadmaterial/{id}', [App\Http\Controllers\adminservicesproccesController::class, 'storereplaymaterial'])->name('store_replay_downloadmaterial');
Route::post('store_replay_permanency/{id}', [App\Http\Controllers\adminservicesproccesController::class, 'storereplaypermanency'])->name('store_replay_permanency');


Route::get('inbox', [App\Http\Controllers\inboxController::class, 'index'])->name('inbox');

Route::get('deleteinbox/{id}', [App\Http\Controllers\inboxController::class, 'destroy_inbox'])->name('deleteinboxemail');
Route::get('deleteinboxemaildetecting/{id}', [App\Http\Controllers\inboxController::class, 'destroy_inbox_detecting'])->name('deleteinboxemaildetecting');
Route::get('deleteinboxemailmaterial/{id}', [App\Http\Controllers\inboxController::class, 'destroy_inbox_material'])->name('deleteinboxemailmaterial');
Route::get('deleteinboxemailpermenancy/{id}', [App\Http\Controllers\inboxController::class, 'destroy_inbox_permenancy'])->name('deleteinboxemailpermenancy');
Route::get('deleteinboxemailunivercity/{id}', [App\Http\Controllers\inboxController::class, 'destroy_inbox_univercity'])->name('deleteinboxemailunivercity');
Route::post('filtinbox', [App\Http\Controllers\inboxController::class, 'filtrbox'])->name('filtinbox');



Route::post('/universtor', [App\Http\Controllers\servicesController::class, 'univercitylife'])->name('universtor');
Route::post('/detectingstor', [App\Http\Controllers\servicesController::class, 'detectingsigns'])->name('detectingstor');
Route::post('/downloadmaterial', [App\Http\Controllers\servicesController::class, 'downloadmaterial'])->name('downloadmaterial');

Route::post('/permenancy', [App\Http\Controllers\servicesController::class, 'permenancy'])->name('permenancy');


//////////////////////////////////courses////////////////////////////////
Route::get('homecourses', [App\Http\Controllers\cousresController::class, 'index'])->name('homecourses');
Route::get('programmes', [App\Http\Controllers\cousresController::class, 'showprogrammes'])->name('programmes');
Route::post('storeprogrammes', [App\Http\Controllers\cousresController::class, 'store'])->name('storeprogrammes');

Route::get('downloadprogrammes/{id}', [App\Http\Controllers\cousresController::class, 'downloadprogrammes'])->name('downloadprogrammes');
Route::get('deleteprogrammer/{id}', [App\Http\Controllers\cousresController::class, 'deleteprogrammer'])->name('deleteprogrammer');





Route::get('coursesyear/{id}', [App\Http\Controllers\cousresController::class, 'index2'])->name('coursesyear');

Route::get('onelectures/{id}', [App\Http\Controllers\cousresController::class, 'index3'])->name('onelectures');
Route::post('storelectures/{id}', [App\Http\Controllers\cousresController::class, 'storelectures'])->name('storelectures');
Route::get('deletelecture/{id}', [App\Http\Controllers\cousresController::class, 'deletelecture'])->name('deletelecture');
Route::get('downloadlecture/{id}', [App\Http\Controllers\cousresController::class, 'downloadlecture'])->name('downloadlecture');






///////////////////////library//////////////////

Route::get('homelibrary', [App\Http\Controllers\LibraryController::class, 'index'])->name('homelibrary');
Route::post('storebook', [App\Http\Controllers\LibraryController::class, 'store'])->name('storebook');
Route::get('deletebook/{id}', [App\Http\Controllers\LibraryController::class, 'deletebook'])->name('deletebook');
Route::get('downloadbook/{id}', [App\Http\Controllers\LibraryController::class, 'downloadbook'])->name('downloadbook');


/////////////////////grads///////////////////////

Route::get('homegrads', [App\Http\Controllers\cousresController::class, 'index4'])->name('homegrads');
Route::post('storegrads', [App\Http\Controllers\cousresController::class, 'storegrads'])->name('storegrads');
Route::get('deletegrads/{id}', [App\Http\Controllers\cousresController::class, 'deletegrads'])->name('deletegrads');
Route::get('downloadgrads/{id}', [App\Http\Controllers\cousresController::class, 'downloadgrads'])->name('downloadgrads');




///////////////quizzes////////////////

Route::get('homequizzes/{id}', [App\Http\Controllers\cousresController::class, 'index5'])->name('homequizzes');

Route::get('/quiz/create/{id}', [QuizController::class, 'create'])->name('create');
Route::post('/quiz/store', [QuizController::class, 'store']);

Route::get('/quiz/create/{id}', [QuizController::class, 'create'])->name('create');



Route::get('/quiz/show/{name}', [QuizController::class, 'showquizz'])->name('showquizz');
Route::get('deletequizze/{id}', [QuizController::class, 'deletequizze'])->name('deletequizze');

Route::get('/quiz/{id}', [QuizController::class, 'show'])->name('quizshow');
Route::post('/quiz/{id}/submit', [QuizController::class, 'submit'])->name('quiz.submit');

Route::get('result/{id}', [QuizController::class, 'result'])->name('quiz.result');






use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\activitylogController;

// عرض النموذج
Route::get('/verify-email/{email}/{code}/{password}', [EmailVerificationController::class, 'showVerificationForm'])->name('email.verify.form');
Route::get('/verify-email-doctor/{email}/{code}/{purview}/{first_name}/{last_name}/{password}', [EmailVerificationController::class, 'showVeri'])->name('email.verify.form.doctor');
Route::get('/verify-email-admin/{email}/{code}/{first_name}/{last_name}/{password}', [EmailVerificationController::class, 'showVeriA'])->name('email.verify.form.admin');

// التحقق من الرمز
Route::post('/verify-email', [EmailVerificationController::class, 'verifyEmail']);
Route::post('/verify-email-D', [EmailVerificationController::class, 'verifyEmailD']);
Route::post('/verify-email-A', [EmailVerificationController::class, 'verifyEmailA']);




// Route::get('/vvv', [activitylogController::class, 'index']);
Route::get('/activity', [activitylogController::class, 'index1'])->name('acty');
