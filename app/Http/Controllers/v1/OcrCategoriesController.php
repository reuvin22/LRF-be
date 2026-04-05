<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OcrUploadCategory;
use Illuminate\Support\Facades\Validator;

class OcrCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = OcrUploadCategory::orderBy('category_name')->get();
        return response()->json(['data' => $categories], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'status' => 'required|in:Active,Inactive',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $category = OcrUploadCategory::create([
            'category_name' => $request->category_name,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return response()->json(['data' => $category], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = OcrUploadCategory::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json(['data' => $category], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = OcrUploadCategory::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'category_name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string|max:500',
            'status' => 'sometimes|required|in:Active,Inactive',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $category->update($request->only(['category_name', 'description', 'status']));

        return response()->json(['data' => $category], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = OcrUploadCategory::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $category->delete();

        return response()->json(['message' => 'Category deleted successfully'], 200);
    }
}
