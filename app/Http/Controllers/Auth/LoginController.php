<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:student')->except('logout');
        $this->middleware('guest:instructor')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    public function showStudentLoginForm()
    {
        return view('auth.login');
    }

    public function studentLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (Auth::guard('student')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended(route('student.home'))->with('toast_success','You are Logged In!');
        }
        return back()->with('toast_error','Credentials do not Match')->withInput($request->only('email', 'remember'));
    }

    public function showInstructorLoginForm()
    {
        return view('auth.login', ['url' => 'instructor']);
    }

    public function instructorLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (Auth::guard('instructor')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended(route('instructor.home'))->with('toast_success','You are Logged In!');
        }
        return back()->with('toast_error','Credentials do not Match')->withInput($request->only('email', 'remember'));
    }

    public function showAdminLoginForm()
    {
        return view('Admin.login');
    }

    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended(route('admin.home'))->with('toast_success','You are Logged In!');
        }
        return back()->with('toast_error','Credentials do not Match')->withInput($request->only('email', 'remember'));
    }
}
