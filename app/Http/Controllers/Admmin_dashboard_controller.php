<?php

namespace App\Http\Controllers;

use App\Models\System_settings;
use Illuminate\Http\Request;

class Admmin_dashboard_controller extends Controller
{
    public function admin_dashboard()
    {
        return view('admin.admin-dashboard');
    }
    public function admin_settings()
    {
        $sys_name = System_settings::where('setting_name',SYSTEM_NAME)->first();
        $sys_logo = System_settings::where('setting_name',SYSTEM_LOGO)->first();
        $sys_banner = System_settings::where('setting_name',SYSTEM_BANNER)->first();

        $settings = [
            'sys_name'=>$sys_name->value ?? '',
            'sys_logo'=>$sys_logo->value ?? '',
            'sys_banner'=>$sys_banner->value ?? '',

        ];
        // dd($settings['sys_name']);
        return view('admin.admin-settings', compact('settings'));
    }

    public function save_store_info(Request $request)
    {
        $system_name = $request->system_name ?? '';
        
        $request->validate([
            'system_name'=>'min:3|string'
        ]);

        System_settings::updateOrCreate(['setting_name' => SYSTEM_NAME], ['SYSTEM_LOGO' => SYSTEM_NAME, 'value' => $system_name]);

        if ($request->hasFile('sys_logo')) {
            $file = $request->file('sys_logo');
            $filename = $file->getClientOriginalName();
            $filePath = 'uploads/' . $filename; // Relative path to save in the database
            $file->move(public_path('uploads'), $filename);
            System_settings::updateOrCreate(['setting_name' => SYSTEM_LOGO], ['SYSTEM_LOGO' => SYSTEM_LOGO, 'value' => $filePath]);
        }

        if ($request->hasFile('store_banner')) {
            $file = $request->file('store_banner');
            $filename = $file->getClientOriginalName();
            $filePath = 'uploads/' . $filename; // Relative path to save in the database
            $file->move(public_path('uploads'), $filename);
            System_settings::updateOrCreate(['setting_name' => SYSTEM_BANNER], ['SYSTEM_BANNER' => SYSTEM_BANNER, 'value' => $filePath]);
        }

        return redirect()->route('admin.settings')->with('msg_save', SYSTEM_SAVE_SUCCESS);
    }
}
