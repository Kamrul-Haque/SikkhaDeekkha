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

Route::get('/guest/course','CourseController@index')->name('guest.course.index')->middleware('guest');
Route::get('/guest/course/{course}','CourseController@show')->name('guest.course.show')->middleware('guest');

//Although we are not using default guard 'user', Auth routes are required for other guard authentication routes to work
Auth::routes(['register'=>false]);

Route::group(['middleware'=>['auth:admin,instructor']],function (){
    Route::resource('/course','CourseController')->except(['index','show']);
    Route::get('/course/{course}/add-instructor','CourseController@addInstructorForm')->name('course.add.instructor');
    Route::put('/course/{course}/add-instructor','CourseController@addInstructor')->name('course.instructor.store');
    Route::post('/course/{course}/leave','CourseController@leaveCourse')->name('course.instructor.leave');
    Route::get('/course/{course}/image-upload','CourseController@imageUploadForm')->name('course.image.form');
    Route::put('/course/{course}/image-upload','CourseController@imageUpload')->name('course.image.upload');
    Route::resource('/course/{course}/module','ModuleController')->except(['index']);
    Route::resource('/course/module/{module}/content','ContentController')->except(['show']);
    Route::resource('/course/module/{module}/assessment','AssessmentController')->except(['show']);
    Route::post('/course/module/{module}/assessment/{assessment}','AssessmentController@publish')->name('assessment.publish');
    Route::resource('/course/module/{module}/assessment/{assessment}/question','QuestionController')->except(['index','show']);
    Route::resource('/course/module/{module}/assessment/{assessment}/question/{question}/response','ResponseController')->except(['create','store']);
    Route::post('/course/module/{module}/assessment/{assessment}/question/{question}/response/{response}/grade','ResponseController@grade')->name('response.grade');
});

Route::group(['middleware'=>['auth:admin,instructor,student']],function (){
    Route::get('/course','CourseController@index')->name('course.index');
    Route::get('/course/{course}','CourseController@show')->name('course.show');
    Route::get('/course/{course}/module','ModuleController@index')->name('module.index');
    Route::get('/course/module/{module}/content/{content}','ContentController@show')->name('content.show');
    Route::get('/course/module/{module}/assessment/{assessment}','AssessmentController@show')->name('assessment.show');
    Route::post('/course/module/{module}/assessment/{assessment}/question/{question}/response','ResponseController@store')->name('response.store');
});

Route::group(['prefix'=>'/admin', 'as'=>'admin.'], function () {
    Route::get('/login', 'auth\LoginController@showAdminLoginForm')->name('login.form');
    Route::post('/login', 'auth\LoginController@adminLogin')->name('login');
    Route::post('/logout','AdminController@adminLogout')->name('logout');
});

Route::group(['prefix'=>'/admin', 'as'=>'admin.', 'middleware'=>'auth:admin'], function (){
    Route::get('/', function () {
        return view('Admin.profile');
    })->name('profile');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('/admin', 'AdminController');
    Route::resource('/student', 'StudentController');
    Route::resource('/instructor','InstructorController');
    Route::resource('/institution','InstitutionController');
    Route::resource('/subject','SubjectController');
    Route::get('/course/{course}/assign-institution/','CourseController@assignInstitutionForm')->name('course.assign.institution');
    Route::post('/course/{course}/assign-institution/','CourseController@assignInstitution')->name('course.institution.store');
});

Route::group(['prefix'=>'/instructor', 'as'=>'instructor.'], function () {
    Route::get('/login', 'auth\LoginController@showInstructorLoginForm')->name('login.form');
    Route::post('/login', 'auth\LoginController@instructorLogin')->name('login');
    Route::post('/logout','instructorController@instructorLogout')->name('logout');
    Route::get('/register', 'auth\RegisterController@showInstructorRegisterForm')->name('register.form');
    Route::post('/register', 'auth\RegisterController@instructorCreate')->name('register');
});

Route::group(['prefix'=>'/instructor', 'as'=>'instructor.', 'middleware'=>'auth:instructor'], function () {
    Route::get('/', function () {
        return view('Instructor.profile');
    })->name('profile');
    Route::get('/home', 'HomeController@index')->name('home');
});

Route::group(['prefix'=>'/student', 'as'=>'student.'], function () {
    Route::get('/login', 'auth\LoginController@showStudentLoginForm')->name('login.form');
    Route::post('/login', 'auth\LoginController@studentLogin')->name('login');
    Route::post('/logout','studentController@studentLogout')->name('logout');
    Route::get('/register', 'auth\RegisterController@showStudentRegisterForm')->name('register.form');
    Route::post('/register', 'auth\RegisterController@studentCreate')->name('register');
});

Route::group(['prefix'=>'/student', 'as'=>'student.', 'middleware'=>'auth:student'], function () {
    Route::get('/', function () {
        return view('Student.profile');
    })->name('profile');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('/course/{course}/enroll','CourseController@enroll')->name('course.enroll');
    Route::post('/course/{course}/un-enroll','CourseController@unenroll')->name('course.unenroll');
    Route::get('/course/{course}/rating/','CourseController@ratingForm')->name('course.rating');
    Route::post('/course/{course}/rating/','CourseController@rating')->name('course.rating.store');
    Route::get('/course/{course}/rating/{rating}','CourseController@editRatingForm')->name('course.rating.edit');
    Route::put('/course/{course}/rating/{rating}','CourseController@editRating')->name('course.rating.update');
    Route::post('course/{course}/wishlist','WishlistController@wishlist')->name('wishlist');
    Route::delete('course/remove-wishlist/{wishlist}','WishlistController@remove')->name('wishlist.remove');
});
