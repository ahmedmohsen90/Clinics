<?php

use App\Models\AdminLog;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

function responseSuccess($message, $data)
{
    return response([
        "success" => true,
        "message" => $message,
        "data"    => $data,
    ], 200);
}

function responseSuccessMessage($message)
{
    return response([
        "success" => true,
        "message" => $message,
    ], 200);
}

function responseValid($message)
{
    return response([
        "success" => false,
        "message" => $message
    ], 200);
}

if (!function_exists('userLogs')) {
    function userLogs($data)
    {
        $log = new AdminLog();
        $log->user_id = Auth::user()->id;
        $log->model = $data["model"];
        $log->model_id = $data['model_id'];
        $log->description_ar = $data['description_ar'];
        $log->description_en = $data['description_en'];
        $log->status = $data['status'];
        $log->save();
    }
}

if (!function_exists('userLogin')) {
    function userLogin()
    {
        if (Auth::check()) {
            return Auth::user()->id;
        }
        return 0;
    }
}

if (!function_exists('aurl')) {
    function aurl($url)
    {
        return url($url);
    }
}


if (!function_exists('lang')) {
    function lang()
    {
        if (Request::is('api/*')) {
            return request()->header('Accept-Language');
        } else {
            if (session()->has('lang')) {
                return session()->get('lang');
            } else {
                if (Auth::check()) {
                    if (adminLogin()->details()->exists()) {
                        session()->put('lang', adminLogin()->details->language);
                        return adminLogin()->details->language;
                    }
                }
                session()->put('lang', 'ar');
                return 'ar';
            }
        }
    }
}

if (!function_exists('theme')) {
    function theme()
    {
        if (session()->has('theme')) {
            return session()->get('theme');
        } else {
            if (Auth::check()) {
                if (adminLogin()->details()->exists()) {
                    session()->put('theme', adminLogin()->details->theme);
                    return adminLogin()->details->theme;
                }
            }
            session()->put('theme', 'dark');
            return 'dark';
        }
    }
}

if (!function_exists('settings')) {
    function settings()
    {
        return Setting::first();
    }
}

if (!function_exists('adminLogin')) {
    function adminLogin()
    {
        return User::where('id', Auth::user()->id)->with('profile', 'details')->first();
    }
}

if (!function_exists('activeMenu')) {
    function activeMenu($url)
    {
        if (request()->is($url)) {
            return "active";
        }
        return "";
    }
}

if (!function_exists('openMenu')) {
    function openMenu($url)
    {
        if (request()->is($url) || request()->is($url . '/*')) {
            return "active open";
        }
        return "";
    }
}
