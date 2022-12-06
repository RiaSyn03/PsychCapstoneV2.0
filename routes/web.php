<?php

use App\Http\Controllers\Admin\UserController;
use illuminate\Support\Facades\Route;

Route::get('/', function () {
        return view('welcome');
    })->name('/');

//Student Views
Route::get('/wellness', function () {
    if(Auth()->check() && (auth()->user()->role_id != 3)){
        Auth::logout();
        return redirect()->route('login')->with('message', 'Your account is restricted');
    }
    return view('admin.users.student.wellness');
});

Route::get('/category', function () {
    if(Auth()->check() && (auth()->user()->role_id != 3)){
        Auth::logout();
        return redirect()->route('login')->with('message', 'Your account is restricted');
    }
    return view('admin.users.student.category');
});


//Counselour Views

Route::get('/editquestionaire', function () {
    return view('admin.users.councilour.questions.editquestion');
});

Route::get('/updateschedule', function () {
    return view('admin.users.councilour.updateschedule');
});


//Edited Gio / Admin Views
Route::get('/addstudent', function(){
    $course = App\Course::all();
    return view('admin.users.addstudent', ['course' => $course]);
});
Route::get('/addcouncilor', function(){
    return view('admin.users.addcouncilor');
});
Route::get('/addcourse', function(){
    $depts = App\Department::all();
    return view('admin.users.addcourse', ['depts' => $depts]);
});
Route::get('/course', function(){
    return view('admin.users.course');
});
Route::get('/department', function(){
    return view('admin.users.department');
});

Route::get('/edit/{id}', 'Admin\UserController@edit');

Route::post('/addcouncilor','Admin\UserController@makecounselour')->name('addcouncilor');
Route::resource('course', CourseController::class);
Route::resource('/department', DepartmentController::class);

//end



Auth::routes();

// Admin //
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/index', function(){
    return view('admin.users');
}) ->middleware(['auth', 'auth.admin']);
Route::put('/user-update/{id}', 'Admin\UserController@updateAccount');
Route::get('/user-edit/{id}', 'Admin\UserController@editAccount');
Route::delete('/user-delete/{id}', 'Admin\UserController@destroy');
Route::namespace('Admin') ->prefix('admin')->middleware(['auth', 'auth.admin']) ->name('admin.')->group(function(){
Route::resource('/users', 'UserController', ['except' => ['show', 'create', 'store']]);
});
Route::get('/questions', 'Admin\QuestionController@index')->name('questions');
Route::post('/questions', 'Admin\QuestionController@create')->name('questions');
Route::delete('/question-delete/{id}', 'Admin\QuestionController@destroy');
Route::get('/manageappointments', 'Councilour\Appointmentlist@adminappointments')->name('manageappointments');
Route::put('/manageappointments-update/{id}', 'Councilour\Appointmentlist@adminupdate')->name('manageappointments-update');
Route::get('/updatequestion/{id}', 'Admin\QuestionController@edit')->name('updatequestion');
Route::put('/updatequestion-edit/{id}', 'Admin\QuestionController@update')->name('updatequestion-edit');
Route::post('/add-department', 'DepartmentController@create')->name('add-department');
Route::resource('/user', Admin\UserController::class);
Auth::routes();

//Counselour//
Route::get('/viewtime', 'Councilour\Appointmentlist@index')->name('viewtime');
Route::get('/change-status/{id}', 'Councilour\Appointmentlist@updatetime')->name('changestatus');
Route::get('/change-done/{id}', 'Councilour\Appointmentlist@done')->name('changedone');
Route::get('/viewquestions', 'Councilour\QuestionController@index')->name('viewquestions');
Route::post('/viewquestions', 'Councilour\QuestionController@create')->name('viewquestions');
Route::get('/myfinishappointments', 'Councilour\Appointmentlist@finishappointments')->name('myfinishappointments');
Route::get('/updateschedule/{id}', 'Councilour\Appointmentlist@getreschedid')->name('updateschedule');
Route::put('/updateschedule-edit/{id}', 'Councilour\Appointmentlist@updateresched')->name('updateschedule-edit');
Route::get('/reschedule/{id}', 'Councilour\Appointmentlist@reschedstatus')->name('reschedule');
Route::put('/reschedule-status/{id}', 'Councilour\Appointmentlist@sendmail')->name('reschedule-status');

//Student//
Route::post('/appointment_history', 'Councilour\Appointmentlist@store')->name('appointment_history');
Route::get('/appointment_history', 'Councilour\Appointmentlist@show')->name('appointment_history');
Route::get('/stress_exam', 'Councilour\QuestionController@stress')->name('stress_exam');
Route::post('/stress_exam', 'Councilour\QuestionController@sstore')->name('stress_exam');
Route::get('/personality_exam', 'Councilour\QuestionController@personality')->name('personality_exam');
Route::post('/personality_exam', 'Councilour\QuestionController@pstore')->name('personality_exam');
Route::get('/exams_history', 'Councilour\QuestionController@showexam')->name('exams_history');
Route::get('/learner_exam', 'Councilour\QuestionController@learner')->name('learner_exam');
Route::post('/learner_exam', 'Councilour\QuestionController@lstore')->name('learner_exam');
Route::delete('/appointment-delete/{id}', 'Councilour\Appointmentlist@destroy');
Route::delete('/completed-delete/{id}', 'Councilour\Appointmentlist@destroycompleted');
Route::delete('/delete-history/{id}', 'Councilour\QuestionController@destroyhistory');
























