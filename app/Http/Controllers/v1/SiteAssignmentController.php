<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\SiteAssignmentRequest;
use App\Http\Resources\v1\SiteAssignmentResource;
use App\Models\SiteAssignment;
use App\Models\SiteAssignments;

class SiteAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assignments = SiteAssignments::with(['employee', 'site'])
            ->orderBy('assignment_id', 'desc')
            ->get();

        return SiteAssignmentResource::collection($assignments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SiteAssignmentRequest $request)
    {
        $validated = $request->validated();

        $siteAssignment = SiteAssignments::create($validated);

        return response()->json([
            'message' => 'Site assignment created successfully',
            'data' => $siteAssignment
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $siteAssignment = SiteAssignments::findOrFail($id);

        return response()->json($siteAssignment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SiteAssignmentRequest $request, string $id)
    {
        $siteAssignment = SiteAssignments::findOrFail($id);

        $siteAssignment->update([
            'employee_id' => $request->employee_id,
            'site_id' => $request->site_id,
            'is_leader' => $request->is_leader ?? false,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return response()->json([
            'message' => 'Site assignment updated successfully',
            'data' => $siteAssignment
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $siteAssignment = SiteAssignments::findOrFail($id);
        $siteAssignment->delete();

        return response()->json([
            'message' => 'Site assignment deleted successfully'
        ]);
    }
}
