<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User_stash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StashController extends Controller
{

    public function get_item_count()
    {
        $stash_count = User_stash::where('user_id', Auth::user()->id)->count();
        $item_total = User_stash::where('user_id', Auth::user()->id)->sum('price');

        return response()->json(['status' => 200, 'item_count' => $stash_count, 'item_total' => $item_total], 200);
    }

    public function add_to_stash($product_id, Request $request)
    {
        $product = Product::where('id', $product_id)->first();

        $is_already_in_stash = User_stash::where(['product_id' => $product_id, 'user_id' => Auth::user()->id])->first();
        if ($is_already_in_stash) {
            return response()->json(['status' => 305, 'message' => $product->name . ' ' . ALREADY_ADDED], 200);
        }
        if ($product) {

            $data = [
                'user_id' => Auth::user()->id,
                'product_id' => $product_id,
                'qty' => 1,
                'price' => $product->price
            ];

            User_stash::create($data);

            return response()->json(['status' => 200, 'message' => $product->name . ' ' . ITEM_ADDED_TO_CART, 'dt' => $data], 200);
        }

        return response()->json(DATABASE_ERR, 404);
    }

    public function remove_from_stash($id)
    {
        User_stash::where(['id' => $id, 'user_id' => Auth::user()->id])->delete();

        return response()->json(['status' => 200, 'message' => ITEM_REMOVE], 200);
    }
}
