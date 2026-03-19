<?php

namespace App\Http\Controllers\v1;

use App\Events\SegmentEvent;
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
        $segments = Segment::all()->map(function ($segment) {
            return $this->formatSegment($segment);
        });

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
        event(new SegmentEvent($segment, 'created'));
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
        event(new SegmentEvent($segment, 'update'));
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
        event(new SegmentEvent($segment, 'deleted'));
        return response()->json([
            'success' => true,
            'message' => 'Segment deleted successfully'
        ]);
    }

    private function formatSegment($segment)
    {
        return [
            'segment_id' => $segment->segment_id,
            'attendance_id' => $segment->attendance_id,
            'type' => $segment->type,
            'segment_type' => $segment->segment_type,
            'site_id' => $segment->site_id,
            'site_name' => $segment->site_name,

            'start_time' => $segment->start_time
                ? $segment->start_time->addHours(8)->format('Y-m-d H:i:s')
                : null,

            'end_time' => $segment->end_time
                ? $segment->end_time->addHours(8)->format('Y-m-d H:i:s')
                : null,

            'created_at' => $segment->created_at,
            'updated_at' => $segment->updated_at,
        ];
    }
}
