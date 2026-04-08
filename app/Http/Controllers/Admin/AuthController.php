<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('admin.auth.login');
    }

    public function auth(Request $request)
    {
        $data = $request->validate([
            'company' => 'required',
            'mobile' => 'required',
            'password' => 'required',
        ]);

        if (!str_starts_with($data['company'], 'cli')) {
            return back()->withErrors(['company' => trans('admin.Wrong Company ID')]);
        }

        $data['company'] = substr($data['company'], 3);

        if ($request->remember == "on") {
            $remember = true;
        } else {
            $remember = false;
        }

        if (Auth::attempt([
            'mobile' => $request->mobile,
            'password' => $request->password,
            'company_id' => substr($request->company, 3),
        ], $remember)) {
            session([
                'company_id' => substr($request->company, 3)
            ]);
            userLogs([
                'model' => '\App\Models\User',
                'model_id' => Auth::user()->id,
                'description_ar' => 'تسجيل الدخول',
                'description_en' => 'Login',
                'status' => 'login'
            ]);
            return redirect(url(''))->with('success', 'login success');
        }
        return redirect(url('auth/login'))->with('faild', 'login faild');
    }

    public function logout()
    {
        userLogs([
            'model' => '\App\Models\User',
            'model_id' => Auth::user()->id,
            'description_ar' => 'تسجيل خروج',
            'description_en' => 'Logout',
            'status' => 'logout'
        ]);
        Auth::logout();
        return redirect(aurl('auth/login'));
    }
}
