<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    protected array $keys = [
        'site_name',
        'site_title',
        'site_email',
        'site_phone',
        'site_address',
        'facebook_url',
        'twitter_url',
        'linkedin_url',
        'payment_account_name',
        'payment_account_number',
        'payment_bank_name',
    ];

    public function edit(Request $request)
    {
        $title = "Settings - " . config('global.site_title');

        $settings = collect($this->keys)->mapWithKeys(
            fn ($key) => [$key => config('global.' . $key)]
        );

        $admin = Admin::where('admin_id', $request->session()->get('admin_id'))->first();

        return view('backend.settings', compact('title', 'settings', 'admin'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_title' => 'required|string|max:255',
            'site_email' => 'required|email|max:255',
            'site_phone' => 'required|string|max:50',
            'site_address' => 'nullable|string|max:500',
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'payment_account_name' => 'required|string|max:255',
            'payment_account_number' => 'required|string|max:50',
            'payment_bank_name' => 'required|string|max:255',
        ]);

        foreach ($this->keys as $key) {
            Setting::set($key, $request->input($key));
        }

        return redirect('/admin/settings')->with('status', ['text' => 'Settings updated successfully', 'type' => 'success']);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $admin = Admin::where('admin_id', $request->session()->get('admin_id'))->first();

        if (!$admin || !Hash::check($request->input('current_password'), $admin->password)) {
            return redirect('/admin/settings')->with('status', ['text' => 'Current password is incorrect', 'type' => 'danger']);
        }

        $admin->password = $request->input('password');
        $admin->save();

        return redirect('/admin/settings')->with('status', ['text' => 'Password updated successfully', 'type' => 'success']);
    }
}
