<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::orderBy('name')->paginate(10);
        return view('Admin.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           'name'=>'required|string|min:5',
           'email'=>'required|email|unique:admins',
           'employee_id'=>'required|integer|unique:admins',
           'phone'=>'required|digits:10|unique:admins',
           'job_title'=>'required|string|min:5',
           'address'=>'nullable|string|min:5',
        ]);

        $admin = new Admin;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->employee_id = $request->employee_id;
        $admin->password = Hash::make($request->employee_id);
        $admin->phone = $request->phone;
        $admin->address = $request->address;
        $admin->job_title = $request->job_title;
        $admin->save();

        return redirect()->route('admin.admin.index')->with('toast_success','Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        $admin = Admin::find($admin->id);
        return view('Admin.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name'=>'required|string|min:5',
            'email'=>'required|email|unique:admins,email,'.$admin->id,
            'employee_id'=>'required|integer|unique:admins,employee_id,'.$admin->id,
            'phone'=>'required|digits:10|unique:admins,phone,'.$admin->id,
            'job_title'=>'required|string|min:5',
            'address'=>'nullable|string|min:5',
        ]);

        $admin = Admin::find($admin->id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->employee_id = $request->employee_id;
        $admin->phone = $request->phone;
        $admin->address = $request->address;
        $admin->job_title = $request->job_title;
        $admin->save();

        return redirect()->route('admin.admin.index')->with('toast_info','Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $admin = Admin::find($admin->id);
        $admin->delete();

        return redirect()->route('admin.admin.index')->with('toast_error','Record Deleted');
    }

    public function adminLogout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
