<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\System_settings;
use Illuminate\Http\Request;

class Main_controller extends Controller
{
    public function index()
    {
        $categories = Category::all();

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

        $products = Product::where('active_flag', ENUM_YES)->get();

        foreach ($products as $product) {
            $categoryIds = explode(",", $product->category_ids);

            // Retrieve categories associated with the product
            $p_categories = Category::whereIn('id', $categoryIds)->pluck('category')->toArray();

            $p_categories = implode(" ",$p_categories);
      
            // Assign the categories array to the product
            $product->categories = $p_categories;
        }

        return view('main.index', compact('categories', 'settings','products'));
    }
}
