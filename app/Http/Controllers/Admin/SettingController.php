<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class SettingController extends Controller
{

    public function index()
    {
        return view('admin.settings.index', [
            'title' => trans('admin.Settings'),
            'setting' => Setting::first()
        ]);
    }

    public function about()
    {
        return view('admin.settings.about', [
            'title' => trans('admin.About Us'),
            'setting' => Setting::first()
        ]);
    }

    public function terms()
    {
        return view('admin.settings.terms', [
            'title' => trans('admin.Terms & Conditions'),
            'setting' => Setting::first()
        ]);
    }

    public function language($lang)
    {
        session()->put('lang', $lang);
        if (adminLogin()->details()->exists()) {
            UserDetail::where('user_id', adminLogin()->id)->update([
                'language' => $lang
            ]);
        } else {
            UserDetail::create([
                'user_id' => adminLogin()->id,
                'language' => $lang,
                'theme' => theme(),
            ]);
        }
        return back()->with('success', 'language change successful');
    }

    public function theme($theme)
    {
        try {
            session()->put('theme', $theme);
            if (adminLogin()->details()->exists()) {
                UserDetail::where('user_id', adminLogin()->id)->update([
                    'theme' => $theme
                ]);
            } else {
                UserDetail::create([
                    'user_id' => adminLogin()->id,
                    'language' => lang(),
                    'theme' => $theme,
                ]);
            }
            return responseSuccessMessage(trans('admin.operation success'));
        } catch (\Exception $ex) {
            return responseValid(trans('admin.Please Try Again'));
        }
    }

    public function update(Request $request)
    {
        $setting = Setting::first();

        if ($request->hasFile('logo')) {
            ini_set('memory_limit', '-1');
            $file = $request->file('logo');
            $image_extension = $file->getClientOriginalExtension();
            $image_imageName = date('mdYHis') . uniqid() . '.' . $image_extension;
            $image_path = date("Y-m-d") . '/';
            File::makeDirectory(public_path('storage/settings/' . $image_path), $mode = 0777, true, true);
            Image::make($file)
                ->save(public_path('storage/settings/' . $image_path) . $image_imageName, 90);

            $setting->logo = url('') . '/storage/settings/' . $image_path . $image_imageName;
        }

        if ($request->name_ar) {
            $setting->name_ar = $request->name_ar;
        }

        if ($request->name_en) {
            $setting->name_en = $request->name_en;
        }

        if ($request->email) {
            $setting->email = $request->email;
        }

        if ($request->phone) {
            $setting->phone = $request->phone;
        }

        if ($request->address_ar) {
            $setting->address_ar = $request->address_ar;
        }

        if ($request->address_en) {
            $setting->address_en = $request->address_en;
        }

        if ($request->about_ar) {
            $setting->about_ar = $request->about_ar;
        }

        if ($request->about_en) {
            $setting->about_en = $request->about_en;
        }

        if ($request->terms_ar) {
            $setting->terms_ar = $request->terms_ar;
        }

        if ($request->terms_en) {
            $setting->terms_en = $request->terms_en;
        }

        if ($request->goals) {
            $setting->goals = $request->goals;
        }

        if ($request->email) {
            $setting->email = $request->email;
        }

        if ($request->phone) {
            $setting->phone = $request->phone;
        }

        if ($request->whatsapp) {
            $setting->whatsapp = $request->whatsapp;
        }

        if ($request->facebook) {
            $setting->facebook = $request->facebook;
        }

        if ($request->instagram) {
            $setting->instagram = $request->instagram;
        }

        if ($request->twitter) {
            $setting->twitter = $request->twitter;
        }

        if ($request->snapchat) {
            $setting->snapchat = $request->snapchat;
        }

        $setting->save();

        return back()->with('success', 'operation success');
    }

    public function goals()
    {
        return view('admin.settings.goals', [
            'title' => trans('admin.Goals'),
            'setting' => Setting::first()
        ]);
    }

    public function search(Request $request){
        $users = User::where("name","LIKE","%".$request->search."%")->paginate(20);

        return view('admin.search.users', [
            'title' => trans('admin.Search Result'),
            'users' => $users
        ]);
    }
}
