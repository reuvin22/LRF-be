<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\SiteSubContractorRequest;
use App\Http\Resources\v1\SiteSubContractorResource;
use App\Models\SiteSubContractors;
use App\Models\SubContractors;
use App\Models\v1\SiteSubContractor;
use Illuminate\Http\Request;

class SiteSubContractorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siteSubContractors = SiteSubContractors::with([
            'site',
            'subcontractor'
        ])->latest()->get();

        return response()->json([
            'success' => true,
            'data' => SiteSubContractorResource::collection($siteSubContractors)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SiteSubContractorRequest $request)
    {
        $data = SiteSubContractors::create($request->validated());

        return response()->json([
            'message' => 'Site subcontractor created successfully',
            'data' => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = SiteSubContractors::findOrFail($id);

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SiteSubContractorRequest $request, string $id)
    {
        $data = SiteSubContractors::findOrFail($id);

        $data->update($request->validated());

        return response()->json([
            'message' => 'Site subcontractor updated successfully',
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = SiteSubContractors::findOrFail($id);

        $data->delete();

        return response()->json([
            'message' => 'Site subcontractor deleted successfully'
        ]);
    }
}
