<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Setting;
use Storage;

class SettingController extends Controller
{
    //

    public function settingsForm()
    {
        $settings = Setting::orderBy('id', 'desc')->first();
        $title = trans('admin.navbar.settings');
        return view('admin.settings', compact('title', 'settings'));
    }

    public function settings(Request $request)
    {
        $data = $this->validate($request, [
            'site_ar' => 'required',
            'site_en' => 'required',
            'email' => 'required|email',
            'logo' => validImg(),
            'icon' => validImg(),
            'lang' => 'required|in:ar,en',
            'status' => 'required|in:open,close',
            'maintenance_msg' => ''
        ], [], [
            'site_ar' => trans('admin.form.site_ar'),
            'site_en' => trans('admin.form.site_en'),
            'email' => trans('admin.form.email'),
            'lang' => trans('admin.form.lang'),
            'status' => trans('admin.form.status'),
            'logo' => trans('admin.form.logo'),
            'icon' => trans('admin.form.icon'),
            'maintenance_msg' => trans('admin.form.msg'),
        ]);

        $settings = Setting::orderBy('id', 'desc')->first();

        if($request->hasFile('icon'))
        {
            $data['icon'] = up()->upload($request, [
                'file' => 'icon',
                'path' => 'settings',
                'delete' => $settings->icon,
            ]);
        }

        if($request->hasFile('logo'))
        {
            $data['logo'] = up()->upload($request, [
                'file' => 'logo',
                'path' => 'settings',
                'delete' => $settings->logo,
            ]);
        }

        $settings->update($data);

        return back()->with(['success' => trans('admin.settingsUpdated')]);
    }
}
