<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\SubContractorsWorkers;
use App\Models\SubContractorWorker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubContractorWorkersController extends Controller
{
    public function index()
    {
        $workers = SubContractorsWorkers::all();
        return response()->json(['data' => $workers]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subcontractor_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'name_kana' => 'nullable|string|max:255',
            'status' => 'required|string|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $worker = SubContractorsWorkers::create($validator->validated());

        return response()->json([
            'message' => 'Worker created successfully',
            'data' => $worker,
        ], 201);
    }

    public function show($id)
    {
        $worker = SubContractorsWorkers::find($id);

        if (!$worker) {
            return response()->json(['message' => 'Worker not found'], 404);
        }

        return response()->json(['data' => $worker]);
    }

    public function update(Request $request, $id)
    {
        $worker = SubContractorsWorkers::find($id);

        if (!$worker) {
            return response()->json(['message' => 'Worker not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'subcontractor_id' => 'sometimes|integer',
            'name' => 'sometimes|string|max:255',
            'name_kana' => 'nullable|string|max:255',
            'status' => 'sometimes|string|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $worker->update($validator->validated());

        return response()->json([
            'message' => 'Worker updated successfully',
            'data' => $worker,
        ]);
    }

    public function destroy($id)
    {
        $worker = SubContractorsWorkers::find($id);

        if (!$worker) {
            return response()->json(['message' => 'Worker not found'], 404);
        }

        $worker->delete();

        return response()->json(['message' => 'Worker deleted successfully']);
    }
}
