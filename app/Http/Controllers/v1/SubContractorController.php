<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\SubContractorRequest;
use App\Http\Resources\v1\SubContractorResource;
use App\Models\SubContractors;
use App\Models\SubContractorsWorkers;
use App\Models\SubcontractorWorker;
use Illuminate\Http\JsonResponse;

class SubContractorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $subcontractors = SubContractors::with([
            'siteSubcontractor.site',
            'workers'
        ])->latest()->get();

        return response()->json([
            'success' => true,
            'data' => SubContractorResource::collection($subcontractors)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubContractorRequest $request): JsonResponse
    {
        $worker = SubContractorsWorkers::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Worker created successfully.',
            'data' => $worker
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $worker = SubContractorsWorkers::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $worker
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubContractorRequest $request, string $id): JsonResponse
    {
        $worker = SubContractorsWorkers::findOrFail($id);

        $worker->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Worker updated successfully.',
            'data' => $worker
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $worker = SubContractorsWorkers::findOrFail($id);

        $worker->delete();

        return response()->json([
            'success' => true,
            'message' => 'Worker deleted successfully.'
        ]);
    }
}
