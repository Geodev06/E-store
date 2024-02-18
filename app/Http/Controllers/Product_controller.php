<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Validator;
use Yajra\DataTables\Facades\DataTables;

class Product_controller extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('product.index', compact('categories'));
    }

    public function store(Request $request)
    {
        // Define validation rules
        $rules = [
            'name' => 'required|string|min:3|max:255|unique:products',
            'description' => 'required|max:2000',
            'category_ids' => 'required',
            'price' => 'required|double_with_decimal_places',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Example: Allow only image files (jpg, png, gif) with a maximum size of 2MB
            'file' => 'required|mimes:pdf',
        ];
        // Run validation
        $validator = Validator::make($request->all(), $rules, [
            'price.double_with_decimal_places' => 'The price must be a valid number with up to two decimal places.',
            'category_ids.required' => 'This field is required.'
        ]);
        // Check if validation fails
        if ($validator->fails()) {
            // Return validation errors in JSON format
            return response()->json(['errors' => $validator->errors(), 'status' => 400], 201);
        }
        $data = $request->except('_token');
        $data['active_flag'] = ENUM_YES;
        // return response()->json($data, 201);

        if ($request->hasFile('photo') && $request->hasFile('file')) {

            // photo
            $photo = $request->file('photo');
            $filename_photo = time() . '-' . $photo->getClientOriginalName();
            $filePath_photo = 'uploads/books_photo/' . $filename_photo;
            $photo->move(public_path('uploads/books_photo'), $filename_photo);
            $data['photo'] = $filePath_photo;

            // file
            $file = $request->file('file');
            $filename = time() . '-' . $file->getClientOriginalName();
            $filePath = 'uploads/books_files/' . $filename;
            $file->move(public_path('uploads/books_files'), $filename);
            $data['file'] = $filePath;
            $item = Product::create($data);

            if ($item) {
                return response()->json(['status' => 200, 'message' => $item->name . ' ' . SUCCESS_MSG], 200);
            }
        }
    }

    public function product_table(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('products as A')
                ->select([
                    'A.id',
                    'A.name',
                    'A.price',
                    DB::raw('(SELECT GROUP_CONCAT(category SEPARATOR ",") gg FROM categories WHERE FIND_IN_SET(categories.id, A.category_ids)) as category_ids'),
                    'A.active_flag',
                    'A.photo',
                    'A.file',
                    'A.created_at'
                ])
                ->orderBy('A.created_at', 'desc');


            return DataTables::of($data)
                ->filter(function ($query) {
                    // Check if there's a search value
                    if (request()->has('search') && !empty(request('search')['value'])) {
                        $searchValue = request('search')['value'];
                        $query->where(function ($subQuery) use ($searchValue) {
                            $subQuery->where('A.created_at', 'like', '%' . $searchValue . '%')
                                ->orWhere('A.name', 'like', '%' . $searchValue . '%')
                                ->orWhere('A.description', 'like', '%' . $searchValue . '%')
                                ->orWhere('A.price', 'like', '%' . $searchValue . '%')
                                ->orWhere('category_ids', 'like', '%' . $searchValue . '%')
                                ->orWhere('A.active_flag', 'like', '%' . $searchValue . '%');
                            // Add more columns as needed
                        });
                    }
                })
                ->addColumn('created_at', function ($data) {
                    return Carbon::parse($data->created_at)->format('M-d-Y');
                })
                ->addColumn('active_flag', function ($data) {
                    return $data->active_flag == ENUM_YES ? '<span class="badge badge-sm border border-success text-success bg-success">Active</span>' : '<span class="badge badge-sm border border-danger text-danger bg-danger">Inactive</span>';
                })
                ->addColumn('category_ids', function ($data) {
                    return '<span class="badge badge-sm border border-info text-info bg-info">' . $data->category_ids . '</span>';
                })
                ->addColumn('photo', function ($data) {
                    return '<img src="' . asset($data->photo) . '" class="table-img"></img>';
                })
                ->addColumn('price', function ($data) {
                    return '₱ ' . number_format($data->price, 2, '.', ',');
                })
                ->addColumn('action', function ($data) {
                    $btn_view = '<span data-id="' . $data->id . '" class="btn-view text-info mx-2 fs-6" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tooltip on top"><span class="mdi mdi-file-document-outline" style="cursor:pointer"></span></span>';
                    $btn_edit = '<span data-id="' . $data->id . '" class="btn-edit text-info mx-2 fs-6" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tooltip on top"><span class="mdi mdi-pencil" style="cursor:pointer"></span></span>';
                    $btn_delete = '<span data-id="' . $data->id . '" class="btn-delete text-danger mx-2 fs-6" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tooltip on top"><span class="mdi mdi-trash-can-outline" style="cursor:pointer"></span></span>';

                    return $btn_view .= $btn_edit .= $btn_delete;
                })
                ->rawColumns(['photo', 'name', 'category_ids', 'price', 'created_at', 'active_flag', 'action'])

                ->make(true);
        }
    }

    public function get($id)
    {
        $product = Product::where('id', $id)->first();
        $ids = explode(",", $product->category_ids);
        // return response()->json($ids, 200);

        $categories = Category::select('category')->whereIn('id', $ids)->get();
        $product['categories'] = $categories;
        // return response()->json($categories, 200);

        return response()->json($product, 200);
    }


    public function update($id, Request $request)
    {
        // Define validation rules
        $rules = [
            'name' => ['required', 'string', 'min:3', 'max:255', Rule::unique('products')->ignore($id)],
            'description' => 'required|max:2000',
            'category_ids' => 'required', // Ensure it's an array with at least 1 item and at most 5 items
            'price' => 'required|numeric', // Use "numeric" for double values, assuming you want to allow integers as well
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Example: Allow only image files (jpg, png, gif) with a maximum size of 2MB
            'file' => 'mimes:pdf',
        ];
        // Run validation
        $validator = Validator::make($request->all(), $rules, [
            'price.double_with_decimal_places' => 'The price must be a valid number with up to two decimal places.',
            'category_ids.required' => 'This field is required.'
        ]);
        // Check if validation fails
        if ($validator->fails()) {
            // Return validation errors in JSON format
            return response()->json(['errors' => $validator->errors(), 'status' => 400], 201);
        }
        $data = $request->except(['_token', 'edit_category_ids']);
        $data['active_flag'] = $request->active_flag;
        $data['category_ids'] = implode(",", $data['category_ids']);


        $product = Product::where('id', $id)->first();

        if ($request->hasFile('photo')) {
            // Get the current photo path
            $current_photo = public_path($product->photo);

            // Check if the current photo exists before attempting to delete it
            if (File::exists($current_photo)) {
                // Delete the current photo
                File::delete($current_photo);
            }

            // Upload the new photo
            $photo = $request->file('photo');
            $filename_photo = time() . '-' . $photo->getClientOriginalName();
            $filePath_photo = 'uploads/books_photo/' . $filename_photo;
            $photo->move(public_path('uploads/books_photo'), $filename_photo);

            // Update the photo path in the data array
            $data['photo'] = $filePath_photo;
        }

        if ($request->hasFile('file')) {
            // Get the current file path
            $current_file = public_path($product->file);

            // Check if the current file exists before attempting to delete it
            if (File::exists($current_file)) {
                // Delete the current file
                File::delete($current_file);
            }

            // Upload the new file
            $file = $request->file('file');
            $file_name = time() . '-' . $file->getClientOriginalName();
            $filePath_file = 'uploads/books_files/' . $file_name;
            $file->move(public_path('uploads/books_files'), $file_name);

            // Update the file path in the data array
            $data['file'] = $filePath_file;
        }

        $updated = Product::where('id', $id)->update($data);

        if ($updated) {
            return response()->json(['status' => 200, 'message' => $request->name . ' ' . UPDATED_MSG], 200);
        }
    }

    public function delete($id)
    {
        $p = Product::where('id', $id)->first();
        $current_photo = public_path($p->photo);
        $current_file = public_path($p->file);


        // Check if the current photo exists before attempting to delete it
        if (File::exists($current_photo)) {
            // Delete the current photo
            File::delete($current_photo);
        }

        if (File::exists($current_file)) {
            // Delete the current photo
            File::delete($current_file);
        }
        $DELETED = Product::where('id', $id)->delete();
        return response()->json(['msg' => DELETED_MSG], 200);
    }
}
