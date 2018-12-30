<?php

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



Route::get('/hello', function () {
    return "Helo World";
});

Route::resource('news', 'NewsController');
Route::resource('users', 'UsersController')->except([
    'show'
]);
Route::resource('course', 'CoursesController')->except([
    'index'
]);
Route::resource('lesson', 'LessonsController')->except([
    'index'
]);
Route::resource('marks', 'MarksController')->except([
    'show'
]);
Route::resource('attendances', 'AttendancesController')->except([
    'show'
]);


Route::resource('groups', 'GroupsController');

Route::post('/course/{course}/addTeacher', [
    'uses'=>'CoursesController@add_teacher',
    'as'=>'course.add_teacher'
    ]);
Route::post('/course/{course}/removeTeacher', [
    'uses'=>'CoursesController@remove_teacher',
    'as'=>'course.remove_teacher'
    ]);
Route::post('/course/{course}/addGroup', [
    'uses'=>'CoursesController@add_group',
    'as'=>'course.add_group'
    ]);
Route::post('/course/{course}/removeGroup', [
    'uses'=>'CoursesController@remove_group',
    'as'=>'course.remove_group'
    ]);

Route::post('/groups/{group}/addStudent', [
    'uses'=>'GroupsController@add_student',
    'as'=>'groups.add_student'
    ]);
Route::post('/groups/{group}/removeStudent', [
    'uses'=>'GroupsController@remove_student',
    'as'=>'groups.remove_student'
    ]);
Route::post('/lesson/updatePercentage', [
    'uses'=>'MarksController@update_percentage',
    'as'=>'lesson.update_percentage'
    ]);
Auth::routes();

Route::get('/','PagesController@index');

Route::get('/home', [
    'as' => 'home' , 'uses' =>'HomeController@index'
]);

Route::match(['put', 'patch'],'users/changePassword/{user}',['uses' => 'UsersController@changePassword', 'as'=>'users.changePassword']);

Route::get('/profile',[
    'as' => 'profile' , 'uses' =>'UsersController@profile'
]);

Route::get('/marks/{lesson}/{user}', 'MarksController@create_or_edit');

Route::get('/marks/{course}', 'MarksController@show');

Route::get('/attendances/{lesson}/{user}', 'AttendancesController@create_or_edit');

Route::get('/attendances/{course}', 'AttendancesController@show');

Route::get('/gpa', [
    'uses' => 'UsersController@gpa',
    'as' => 'gpa'
 ]);