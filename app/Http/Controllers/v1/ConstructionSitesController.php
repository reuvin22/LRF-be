<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\ConstructionSitesRequest;
use App\Models\ConstructionSite;
use App\Models\ConstructionSites;
use Illuminate\Http\JsonResponse;

class ConstructionSitesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $sites = ConstructionSites::all();

        return response()->json([
            'success' => true,
            'data' => $sites
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ConstructionSitesRequest $request): JsonResponse
    {
        $site = ConstructionSites::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Construction site created successfully.',
            'data' => $site
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $site = ConstructionSites::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $site
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ConstructionSitesRequest $request, string $id): JsonResponse
    {
        $site = ConstructionSites::findOrFail($id);

        $site->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Construction site updated successfully.',
            'data' => $site
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $site = ConstructionSites::findOrFail($id);

        $site->delete();

        return response()->json([
            'success' => true,
            'message' => 'Construction site deleted successfully.'
        ]);
    }
}
