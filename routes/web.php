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
});

Route::group(['prefix'=>'/admin', 'as'=>'admin.', 'middleware'=>'auth:admin'], function (){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('/student', 'StudentController')->except(['create','store']);
    Route::resource('/instructor','InstructorController')->except(['create','store']);
    Route::resource('/institution','InstitutionController');
    Route::resource('/course','CourseController');
    Route::get('/course/add-instructor/{course}','CourseController@addInstructorForm')->name('course.add.instructor');
    Route::put('/course/add-instructor/{course}','CourseController@addInstructor')->name('course.instructor.store');
    Route::get('/course/{course}/module','ModuleController@index')->name('course.module');
    Route::get('/course/{course}/module/create','ModuleController@create')->name('course.module.create');
    Route::post('/course/{course}/module/create','ModuleController@store')->name('course.module.store');
    Route::get('/course/{course}/module/{module}/edit','ModuleController@edit')->name('course.module.edit');
    Route::put('/course/{course}/module/{module}/edit','ModuleController@update')->name('course.module.update');
    Route::delete('/course/{course}/module/{module}','ModuleController@destroy')->name('course.module.destroy');
});

Route::group(['prefix'=>'/instructor', 'as'=>'instructor.'], function () {
    Route::get('/login', 'auth\LoginController@showInstructorLoginForm')->name('login.form');
    Route::post('/login', 'auth\LoginController@instructorLogin')->name('login');
    Route::post('/logout','instructorController@instructorLogout')->name('logout');
    Route::get('/register', 'auth\RegisterController@showInstructorRegisterForm')->name('register.form');
    Route::post('/register', 'auth\RegisterController@instructorCreate')->name('register');
});

Route::group(['prefix'=>'/instructor', 'as'=>'instructor.', 'middleware'=>'auth:instructor'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('/course','CourseController');
    Route::get('/course/add-instructor/{course}','CourseController@addInstructorForm')->name('course.add.instructor');
    Route::put('/course/add-instructor/{course}','CourseController@addInstructor')->name('course.instructor.store');
    Route::get('/course/{course}/module','ModuleController@index')->name('course.module');
    Route::get('/course/{course}/module/create','ModuleController@create')->name('course.module.create');
    Route::post('/course/{course}/module/create','ModuleController@store')->name('course.module.store');
    Route::get('/course/{course}/module/{module}/edit','ModuleController@edit')->name('course.module.edit');
    Route::put('/course/{course}/module/{module}/edit','ModuleController@update')->name('course.module.update');
    Route::delete('/course/{course}/module/{module}','ModuleController@destroy')->name('course.module.destroy');
});

Route::group(['prefix'=>'/student', 'as'=>'student.'], function () {
    Route::get('/login', 'auth\LoginController@showStudentLoginForm')->name('login.form');
    Route::post('/login', 'auth\LoginController@studentLogin')->name('login');
    Route::post('/logout','studentController@studentLogout')->name('logout');
    Route::get('/register', 'auth\RegisterController@showStudentRegisterForm')->name('register.form');
    Route::post('/register', 'auth\RegisterController@studentCreate')->name('register');
});

Route::group(['prefix'=>'/student', 'as'=>'student.', 'middleware'=>'auth:student'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/course','CourseController@index')->name('course.index');
    Route::get('/course/{course}','CourseController@show')->name('course.show');
    Route::post('/course/{course}/enroll','CourseController@enroll')->name('course.enroll');
    Route::get('/course/{course}/module','ModuleController@index')->name('course.module');
});
