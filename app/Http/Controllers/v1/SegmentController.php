<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\SegmentRequests;
use App\Models\Segment;

class SegmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $segments = Segment::all();
        return response()->json([
            'success' => true,
            'data' => $segments
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SegmentRequests $request)
    {
        $validated = $request->validated();

        $segment = Segment::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Segment created successfully',
            'data' => $segment
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $segment = Segment::find($id);

        if (!$segment) {
            return response()->json([
                'success' => false,
                'message' => 'Segment not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $segment
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SegmentRequests $request, string $id)
    {
        $segment = Segment::find($id);

        if (!$segment) {
            return response()->json([
                'success' => false,
                'message' => 'Segment not found'
            ], 404);
        }

        $validated = $request->validated();

        $segment->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Segment updated successfully',
            'data' => $segment
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $segment = Segment::find($id);

        if (!$segment) {
            return response()->json([
                'success' => false,
                'message' => 'Segment not found'
            ], 404);
        }

        $segment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Segment deleted successfully'
        ]);
    }
}
