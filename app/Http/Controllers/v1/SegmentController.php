<?php

namespace App\Http\Controllers\v1;

use App\Events\SegmentEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\SegmentRequests;
use App\Models\Segment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SegmentController extends Controller
{
    public function index()
    {
        $segments = Segment::latest()->get()->map(function ($segment) {
            return $this->formatSegment($segment);
        });

        return response()->json([
            'success' => true,
            'data' => $segments
        ]);
    }

    public function store(SegmentRequests $request)
    {
        $validated = $request->validated();
        Log::info('payload', ['payload' => $validated]);
        if (!empty($validated['start_time'])) {
            $validated['start_time'] = Carbon::parse($validated['start_time'])->utc();
        }

        if (!empty($validated['end_time'])) {
            $validated['end_time'] = Carbon::parse($validated['end_time'])->utc();
        }

        $segment = Segment::create($validated);
        event(new SegmentEvent($segment, 'created'));
        return response()->json([
            'success' => true,
            'message' => 'Segment created successfully',
            'data' => $segment
        ], 201);
    }

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

        if (!empty($validated['start_time'])) {
            $validated['start_time'] = Carbon::parse($validated['start_time'])->utc();
        }

        if (!empty($validated['end_time'])) {
            $validated['end_time'] = Carbon::parse($validated['end_time'])->utc();
        }

        $segment->update($validated);
        event(new SegmentEvent($segment, 'update'));
        return response()->json([
            'success' => true,
            'message' => 'Segment updated successfully',
            'data' => $segment
        ]);
    }

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
                ? $segment->start_time->toISOString()
                : null,

            'end_time' => $segment->end_time
                ? $segment->end_time->toISOString()
                : null,

            'created_at' => $segment->created_at,
            'updated_at' => $segment->updated_at,
        ];
    }
}
