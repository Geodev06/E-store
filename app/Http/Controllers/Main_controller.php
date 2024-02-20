<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\System_settings;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class Main_controller extends Controller
{

    private function get_settings()
    {
        $sys_name = System_settings::where('setting_name', SYSTEM_NAME)->first();
        $sys_logo = System_settings::where('setting_name', SYSTEM_LOGO)->first();
        $sys_banner = System_settings::where('setting_name', SYSTEM_BANNER)->first();

        $sys_email = System_settings::where('setting_name', SYSTEM_EMAIL)->first();
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

        return $settings;
    }

    public function index()
    {
        list($categories, $settings, $products) = $this->getCategoriesSettingsAndProducts();
        return view('main.index', compact('categories', 'settings', 'products'));
    }

    public function contact()
    {
        list($categories, $settings, $products) = $this->getCategoriesSettingsAndProducts();
        return view('main.contact', compact('categories', 'settings', 'products'));
    }

    public function shop()
    {
        list($categories, $settings, $products) = $this->getCategoriesSettingsAndProducts();
        return view('main.shop', compact('categories', 'settings', 'products'));
    }

    private function getCategoriesSettingsAndProducts()
    {
        $categories = Category::all();
        $settings = $this->get_settings();
        $products = Product::where('active_flag', ENUM_YES)->get();

        foreach ($products as $product) {
            $categoryIds = explode(",", $product->category_ids);
            // Retrieve categories associated with the product
            $p_categories = Category::whereIn('id', $categoryIds)->pluck('category')->toArray();
            $p_categories = implode(" ", $p_categories);
            // Assign the categories array to the product
            $product->categories = $p_categories;
        }

        return [$categories, $settings, $products];
    }


    public function login()
    {

        if (Auth::check()) {
            return redirect()->route('main.index');
        }
        $settings = $this->get_settings();

        return view('main.login', compact('settings'));
    }


    public function user_store(Request $request)
    {

        // Define validation rules
        $rules = [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ];

        // Run validation
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            // Return validation errors in JSON format
            return response()->json(['errors' => $validator->errors(), 'status' => 400], 201);
        }


        $data = $request->except('_token');
        $data['type'] = 'C';

        // Create the user
        $user = User::create($data);

        // Trigger the Registered event
        event(new Registered($user));

        // Automatically log in the user
        Auth::login($user);

        // Return a JSON response with a success message and the redirection URL
        return response()->json([
            'message' => $user->name . ' ' . SUCCESS_MSG,
            'status' => 200,
            'redirect' => route('verification.notice')
        ], 200);
    }

    public function auth(Request $request)
    {

        // Your authentication logic
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->has('remember'))) {

            $user = Auth::user();

            if (!$user->email_verified_at) {

                return response()->json(['message' => EMAIL_NOTIF_SEND, 'email_sent' => 'ok', 'status' => 201], 200);
            }

            return response()->json(['status' => 200], 200);
        }
        return response()->json(SIGN_IN_ERR, 401);
    }
}
