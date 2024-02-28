<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CustomerBook;
use App\Models\Product;
use App\Models\User_stash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Omnipay\Omnipay;
use Stripe\Customer;

class StripeController extends Controller
{
    public function session(Request $request)
    {
        $user = $request->user(); // Get authenticated user using Laravel's built-in authentication

        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $products = [];
        if ($request->has('products')) {
            foreach ($request->products as $id) {
                $product = Product::find($id);
                if ($product) {
                    $categoryNames = Category::whereIn('id', explode(',', $product->category_ids))
                        ->pluck('category')
                        ->toArray();

                    $products[] = [
                        'price_data' => [
                            'currency'     => 'php',
                            'product_data' => [
                                'name' => $product->name,
                            ],
                            'unit_amount'  => $product->price * 100, // Convert price to cents
                        ],
                        'quantity'   => 1,
                    ];
                }
            }
        }

        $success_data = [
            'order_ids' => $request->order_id,
            'products' => $request->products
        ];

        // Encode the $success_data array as JSON and urlencode it
        $encoded_success_data = urlencode(json_encode($success_data));

        $success_url = route('success', ['data' => $encoded_success_data]);

        $session = \Stripe\Checkout\Session::create([
            'line_items'  => $products,
            'mode'        => 'payment',
            'success_url' => $success_url,
            'cancel_url'  => route('main.cart'),
        ]);

        return redirect()->away($session->url);
    }

    public function success(Request $request, $data)
    {
        $success_data = json_decode($data, true);

        $orderIds = $success_data['order_ids'];
        $products = $success_data['products'];

        if ($products) {
            foreach ($products as $id) {
                $product = Product::find($id);
                if ($product) {

                    $where = ['user_id' => Auth::user()->id, 'product_id' => $id];
                    if (CustomerBook::where($where)->count() == 0) {
                        CustomerBook::create(['user_id' => Auth::user()->id, 'product_id' => $id]);
                    }

                    $categoryNames = Category::whereIn('id', explode(',', $product->category_ids))
                        ->pluck('category')
                        ->toArray();
                }
            }
        }

        if ($orderIds) {
            foreach ($orderIds as $oid) {
                User_stash::where('id', $oid)->delete();
            }
        }
        return redirect()->route('main.cart')->with('success_payment', SUCCESS_MSG_PAYMENT);
    }
}
