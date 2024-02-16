<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;


class Admin_auth_controller extends Controller
{
    public function admin_sign_up()
    {
        $admin = User::where('type', 'A')->first();

        if (!$admin) {
            return view('admin.admin-sign-up');
        }
        return redirect()->route('admin.login');
    }

    public function admin_login()
    {
        return view('admin.admin-log-in');
    }

    public function admin_register(Request $request)
    {
        // Define validation rules
        $rules = [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ];

        // Run validation
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            // Return validation errors in JSON format
            return response()->json(['errors' => $validator->errors(), 'status' => 400], 201);
        }

        if (!$request->terms) {
            return response()->json(TERMS_ERROR, 400);
        }
        $data = $request->except('_token');

        $data['type'] = 'A';
        $user = User::create($data);


        return response()->json(['message' => $user->name . ' ' . SUCCESS_MSG, 'status' => 200]);
    }

    public function admin_signin(Request $request)
    {
        // Your authentication logic
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->has('remember'))) {
            
            $user = Auth::user();

            if(!$user->email_verified_at) {
                event(new Registered($user));
                return response()->json(['msg'=>EMAIL_NOTIF_SEND,'email_sent'=>'ok']);
            }
            
            return response()->json(['sign_in_status'=>200 ],200);
        }
        return response()->json(SIGN_IN_ERR,401);
    }
}
