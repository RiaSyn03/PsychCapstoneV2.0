<?php

Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/unregistered', function () {
        return view('admin.users.student.unregistered');
    });

Route::get('markAsRead', function(){
    auth()->user()->unreadNotifications->markAsRead();
    return redirect()->back();
})->name('markRead');

Route::get('/councilourdash', function () {
    return view('admin.users.councilour.councilour');
});

Route::get('/studentdash', function () {
    return view('admin.users.student.studentdash');
});

Route::get('/studentdash', function () {
    return view('admin.users.student.wellness');
});

Route::get('/wellness', function () {
    return view('admin.users.student.wellness');
});

Route::get('/stdntappointment', function () {
    return view('admin.users.student.stdntappointment');
});

Route::get('/stdntbook', function () {
    return view('admin.users.student.stdntbook');
});

Route::get('/stdntbooked', function () {
    return view('admin.users.student.stdntbooked');
});

Route::get('/allstdntbooked.', function () {
    return view('admin.users.student.allstdntbooked');
});

Route::get('/stdnttime', function () {
    return view('admin.users.student.stdnttime');
});

Route::get('/questionaire', function () {
    return view('admin.users.student.questionaire');
});

Route::get('/listofstudent', function () {
    return view('admin.users.councilour.listofstudent');
});

Route::get('/councilourdash', function () {
    return view('admin.users.councilour.councilourdash');
});
Route::get('/create', function () {
    return view('admin.users.councilour.questions.create');
});
Route::get('/addquestion', function () {
    return view('admin.users.councilour.questions.addquestion');
});

Route::get('/viewtime', function () {
    return view('admin.users.councilour.viewtime');
});

Route::get('/listofapprovedappointments', function () {
    return view('admin.users.councilour.listofapprovedappointments');
});

Route::get('/appointment_history', function () {
    return view('admin.users.student.appointment_history');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/stdntquestionaire')->name('stdntquestionaire');
Route::get('/account/activate/{token}', 'AccountController@activate');
Route::resource('/questions','Councilour\QuestionController', ['except' => ['show', 'edit', 'update']]);
Route::resource('/listofstudent', 'Councilour\ListofStudents', ['except' => ['show', 'create', 'store']]);
Route::get('/viewtime', 'Councilour\Appointmentlist@index')->name('viewtime');
Route::resource('/listofapprovedappointments','Myapprovedappointments', ['except' => ['edit', 'update']]);
Route::get('/listofapprovedappointments', 'Myapprovedappointments@index')->name('listofapprovedappointments');
Route::post('/stdntappointment', 'Councilour\Appointmentlist@store')->name('stdntappointment');



Route::post('/stdnttime', 'Councilour\Appointmentlist@store',['except'=>['show','create','store']])->name('stdnttime');
Route::get('/admin/users/student/questionaire', 'StudentquestionaireController@index')->name('questionaire');
Route::get('/appointment_history', 'Councilour\Appointmentlist@show')->name('appointment_history');



Route::get('/index', function(){
    return view('admin.users');
}) ->middleware(['auth', 'auth.admin']);
Route::get('/admin/users', 'LiveSearch@index');
Route::post('/admin/users/index/action', 'LiveSearch@action')->name('admin.users.index.action');
Route::post('/admin/users/student/stdntbook', 'BookingController@index')->name('admin.users.student.stdntbook');

Route::namespace('Admin') ->prefix('admin')->middleware(['auth', 'auth.admin']) ->name('admin.')->group(function(){
Route::resource('/users', 'UserController', ['except' => ['show', 'create', 'store']]);
Route::get('/impersonate/user/{id}', 'ImpersonateController@index')->name('impersonate');

});
Route::delete('/service-cate-delete/{id}', 'Councilour\Appointmentlist@destroy');

Route::get('/admin/impersonate/destroy', 'Admin\ImpersonateController@destroy')->name('admin.impersonate.destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');