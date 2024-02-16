<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index()
    {

        return view('category.index');
    }

    public function store(Request $request)
    {
        // Define validation rules
        $rules = [
            'category' => 'required|string|min:3|max:255|unique:categories',
            'category_description' => 'max:255',

        ];
        // Run validation
        $validator = Validator::make($request->all(), $rules);
        // Check if validation fails
        if ($validator->fails()) {
            // Return validation errors in JSON format
            return response()->json(['errors' => $validator->errors(), 'status' => 400], 201);
        }
        $data = $request->except('_token');
        Category::create($data);
        return response()->json(['status' => 200, 'message' => $request->category . ' ' . SUCCESS_MSG], 200);
    }

    public function update($id, Request $request)
    {
        // Define validation rules
        $rules = [
            'category' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('categories')->ignore($id), // Replace $categoryId with the ID of the current category
            ],
            'category_description' => 'max:255',

        ];
        // Run validation
        $validator = Validator::make($request->all(), $rules);
        // Check if validation fails
        if ($validator->fails()) {
            // Return validation errors in JSON format
            return response()->json(['errors' => $validator->errors(), 'status' => 400], 201);
        }
        $data = $request->except('_token');
        Category::where('id', $id)->update($data);
        return response()->json(['status' => 200, 'message' => $request->category . ' ' . UPDATED_MSG], 200);
    }

    public function category_table(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::select('*')
                ->orderBy('created_at', 'desc')
                ->getQuery();


            return DataTables::of($data)
                ->filter(function ($query) {
                    // Check if there's a search value
                    if (request()->has('search') && !empty(request('search')['value'])) {
                        $searchValue = request('search')['value'];
                        $query->where(function ($subquery) use ($searchValue) {
                            $subquery->where('created_at', 'like', '%' . $searchValue . '%')
                                ->orWhere('category', 'like', '%' . $searchValue . '%')
                                ->orWhere('category_description', 'like', '%' . $searchValue . '%');
                            // Add more columns as needed
                        });
                    }
                })
                ->addColumn('created_at', function ($data) {
                    return Carbon::parse($data->created_at)->format('M-d-Y');
                })
                ->addColumn('action', function ($data) {
                    $btn_view = '<span data-id="' . $data->id . '" class="btn-edit text-info mx-2 fs-6" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tooltip on top"><span class="mdi mdi-pencil" style="cursor:pointer"></span></span>';
                    $btn_delete = '<span data-id="' . $data->id . '" class="btn-delete text-danger mx-2 fs-6" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tooltip on top"><span class="mdi mdi-trash-can-outline" style="cursor:pointer"></span></span>';

                    return $btn_view .= $btn_delete;
                })
                ->rawColumns(['category', 'category_description', 'created_at', 'action'])

                ->make(true);
        }
    }

    public function get($id)
    {
        $data = Category::where('id', $id)->first();
        return response()->json($data, 200);
    }

    public function delete($id)
    {
        $DELETED = Category::where('id', $id)->delete();
        return response()->json(['msg' => DELETED_MSG], 200);
    }
}
