<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index(){
        $title = 'Setting';
        $active = 'setting';

        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.setting.index', compact('title', 'active', 'settings'));
    }

    public function update(Request $request){
        $validate = [
            'name' => '',
            'logo' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'slogan' => '',
            'address' => '',
            'phone' => 'numeric',
            'instagram' => '',
            'youtube' => '',
            'email' => 'email',
            'image-chairman' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'name-chairman' => '',
            'welcome-chairman' => '',
            'vision' => '',
            'mission' => '',
            'profile-foundation' => '',
            'meta-seo' => '',
           
        ];
        $data = $this->validate($request, $validate);
        if ($request->hasFile('logo')) {
            $imageSetting = Setting::where('key', 'logo')->first();
            if (isset($imageSetting->value)) {
                Storage::delete($imageSetting->value);
            }
            $data['logo'] = $request->file('logo')->store('uploads/logo');
        }
        if ($request->hasFile('image-chairman')) {
            $imageSetting = Setting::where('key', 'image-chairman')->first();
            if (isset($imageSetting->value)) {
                Storage::delete($imageSetting->value);
            }
            $data['image-chairman'] = $request->file('image-chairman')->store('uploads/image-chairman');
        }
        foreach ($data as $key => $val) {
            $getData = Setting::firstOrCreate([
                'key' => $key
            ], [
                'title' => ucfirst(trans($key))
            ]);

            $getData->value = $val;
            $getData->save();
        }
        return redirect()->back()->with('success', 'Setting updated successfully');
    }

    public function updatePassword(Request $request){
        $data = $request->validate([
            'old_pass' => 'required',
            'new_pass' => "required",
            "new_pass_conf" => "required|same:new_pass"
        ], [
            "old_pass.required" => "Password lama harus diisi",
            "new_pass.required" => "Password baru harus diisi",
            "new_pass_conf.required" => "Konfirmasi password lama harus diisi",
            "new_pass_conf.same" => "Konfirmasi password tidak sesuai",
        ]);
        if (!password_verify($data['old_pass'],auth()->user()->password)) {
            return redirect()->back()->withErrors(['old_pass' => "Password lama tidak sesuai"]);
        }
        $user = User::find(auth()->user()->id);
        $user->update([
            'password' => bcrypt($data['new_pass_conf'])
        ]);
        return redirect()->back()->with('success', 'Password updated successfully');
    }
}
