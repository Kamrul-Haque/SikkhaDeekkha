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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->middleware(['guest','guest:admin','guest:student','guest:instructor']);

Route::get('/course','CourseController@index')->name('course.index');
Route::get('/course/{course}','CourseController@show')->name('course.show');

Auth::routes(['register'=>false]);

Route::group(['prefix'=>'/admin', 'as'=>'admin.'], function () {
    Route::get('/login', 'auth\LoginController@showAdminLoginForm')->name('login.form');
    Route::post('/login', 'auth\LoginController@adminLogin')->name('login');
    Route::post('/logout','AdminController@adminLogout')->name('logout');
    Route::get('/home', 'HomeController@index')->name('home')->middleware('auth:admin');
});

Route::group(['prefix'=>'/instructor', 'as'=>'instructor.'], function () {
    Route::get('/login', 'auth\LoginController@showInstructorLoginForm')->name('login.form');
    Route::post('/login', 'auth\LoginController@instructorLogin')->name('login');
    Route::post('/logout','instructorController@instructorLogout')->name('logout');
    Route::get('/register', 'auth\RegisterController@showInstructorRegisterForm')->name('register.form');
    Route::post('/register', 'auth\RegisterController@instructorCreate')->name('register');
    Route::get('/home', 'HomeController@index')->name('home')->middleware('auth:instructor');
    Route::resource('/course','CourseController')->middleware('auth:instructor');
    Route::get('/course/add-instructor/{course}','CourseController@addInstructorForm')->name('course.add.instructor')->middleware('auth:instructor');
    Route::put('/course/add-instructor/{course}','CourseController@addInstructor')->name('course.instructor.store')->middleware('auth:instructor');
});

Route::group(['prefix'=>'/student', 'as'=>'student.'], function () {
    Route::get('/login', 'auth\LoginController@showStudentLoginForm')->name('login.form');
    Route::post('/login', 'auth\LoginController@studentLogin')->name('login');
    Route::post('/logout','studentController@studentLogout')->name('logout');
    Route::get('/register', 'auth\RegisterController@showStudentRegisterForm')->name('register.form');
    Route::post('/register', 'auth\RegisterController@studentCreate')->name('register');
    Route::get('/home', 'HomeController@index')->name('home')->middleware('auth:student');
    Route::get('/course','CourseController@index')->name('course.index')->middleware('auth:student');
    Route::get('/course/{course}','CourseController@show')->name('course.show')->middleware('auth:student');
});

Route::group(['prefix'=>'/admin', 'as'=>'admin.', 'middleware'=>'auth:admin'], function (){
    Route::resource('/student', 'StudentController')->except(['create','store']);
    Route::resource('/instructor','InstructorController')->except(['create','store']);
    Route::resource('/institution','InstitutionController');
    Route::resource('/course','CourseController');
    Route::get('/course/add-instructor/{course}','CourseController@addInstructorForm')->name('course.add.instructor');
    Route::put('/course/add-instructor/{course}','CourseController@addInstructor')->name('course.instructor.store');
});
