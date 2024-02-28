<?php

namespace App\Http\Controllers;

use App\Models\System_settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class Admmin_dashboard_controller extends Controller
{
    public function admin_dashboard()
    {
        return view('admin.admin-dashboard');
    }
    public function admin_settings()
    {
        $sys_name = System_settings::where('setting_name', SYSTEM_NAME)->first();
        $sys_logo = System_settings::where('setting_name', SYSTEM_LOGO)->first();
        $sys_banner = System_settings::where('setting_name', SYSTEM_BANNER)->first();

        $sys_email= System_settings::where('setting_name', SYSTEM_EMAIL)->first();
        $sys_contact = System_settings::where('setting_name', SYSTEM_CONTACT)->first();
        $sys_address = System_settings::where('setting_name', SYSTEM_ADDRESS)->first();

 

        

        $settings = [
            'sys_name' => $sys_name->value ?? '',
            'sys_logo' => $sys_logo->value ?? '',
            'sys_banner' => $sys_banner->value ?? '',
            'sys_email' => $sys_email->value ?? '',
            'sys_contact' => $sys_contact->value ?? '',
            'sys_address' => $sys_address->value ?? '',


        ];
        // dd($settings['sys_name']);
        return view('admin.admin-settings', compact('settings'));
    }

    public function save_store_info(Request $request)
    {
        $system_name = $request->system_name ?? '';

        $request->validate([
            'system_name' => 'min:3|string'
        ]);

        System_settings::updateOrCreate(['setting_name' => SYSTEM_NAME], ['SYSTEM_LOGO' => SYSTEM_NAME, 'value' => $system_name]);

        $sys_logo = System_settings::where('setting_name', SYSTEM_LOGO)->first();
        $sys_banner = System_settings::where('setting_name', SYSTEM_BANNER)->first();

        $current_logo = public_path($sys_logo->value ?? '');
        $current_banner = public_path($sys_banner->value ?? '');

        if ($request->hasFile('sys_logo')) {

            if (File::exists($current_logo)) {
                // Delete the current photo
                File::delete($current_logo);
            }

            $file = $request->file('sys_logo');
            $filename = time() . '-' . $file->getClientOriginalName();
            $filePath = 'uploads/' . $filename; // Relative path to save in the database
            $file->move(public_path('uploads'), $filename);
            System_settings::updateOrCreate(['setting_name' => SYSTEM_LOGO], ['SYSTEM_LOGO' => SYSTEM_LOGO, 'value' => $filePath]);
        }

        if ($request->hasFile('store_banner')) {

            if (File::exists($current_banner)) {
                // Delete the current photo
                File::delete($current_banner);
            }

            $file = $request->file('store_banner');
            $filename = time() . '-' . $file->getClientOriginalName();
            $filePath = 'uploads/' . $filename; // Relative path to save in the database
            $file->move(public_path('uploads'), $filename);
            System_settings::updateOrCreate(['setting_name' => SYSTEM_BANNER], ['SYSTEM_BANNER' => SYSTEM_BANNER, 'value' => $filePath]);
        }

        return redirect()->route('admin.settings')->with('msg_save', SYSTEM_SAVE_SUCCESS);
    }

    public function save_store_info_2(Request $request)
    {
        $system_name = $request->system_email ?? '';
        $system_contact = $request->system_contact ?? '';
        $system_address = $request->system_address ?? '';


        $request->validate([
            'system_email' => 'required|min:3|string',
            'system_contact' => 'required|min:3|string',
            'system_address' => 'required|min:3|string',

        ]);

        System_settings::updateOrCreate(['setting_name' => SYSTEM_EMAIL], ['SYSTEM_EMAIL' => SYSTEM_EMAIL, 'value' => $system_name]);
        System_settings::updateOrCreate(['setting_name' => SYSTEM_CONTACT], ['SYSTEM_CONTACT' => SYSTEM_CONTACT, 'value' => $system_contact]);
        System_settings::updateOrCreate(['setting_name' => SYSTEM_ADDRESS], ['SYSTEM_EMAIL' => SYSTEM_ADDRESS, 'value' => $system_address]);

        return redirect()->route('admin.settings')->with('msg_save', SYSTEM_SAVE_SUCCESS);
    }
}
