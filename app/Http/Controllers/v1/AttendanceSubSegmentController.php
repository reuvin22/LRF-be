<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\AttendanceSubSegmentsRequest;
use App\Http\Resources\v1\AttendanceSubcontractorSegmentResource;
use Illuminate\Http\Request;
use App\Models\AttendanceSubSegments;

class AttendanceSubSegmentController extends Controller
{
    public function index()
    {
        $data = AttendanceSubSegments::with('segments', 'worker', 'site', 'subcontractor')->get();

        return response()->json([
            'success' => true,
            'data' => AttendanceSubcontractorSegmentResource::collection($data)
        ]);
    }

    public function store(AttendanceSubSegmentsRequest $request)
    {
        $record = AttendanceSubSegments::create($request->validated());

        return response()->json([
            'success' => true,
            'data' => $record
        ], 201);
    }

    public function show(string $id)
    {
        $record = AttendanceSubSegments::find($id);

        if (!$record) {
            return response()->json([
                'success' => false,
                'message' => 'Record not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $record
        ]);
    }

    public function update(Request $request, string $id)
    {
        $record = AttendanceSubSegments::find($id);

        if (!$record) {
            return response()->json([
                'success' => false,
                'message' => 'Record not found'
            ], 404);
        }

        $validated = $request->validate([
            'attendance_id' => 'sometimes|integer',
            'segment_id' => 'sometimes|integer',
            'worker_id' => 'sometimes|integer',
            'site_id' => 'sometimes|integer',
            'contract_type' => 'sometimes|string',
            'start_time' => 'sometimes|date',
            'end_time' => 'sometimes|date',
        ]);

        $record->update($validated);

        return response()->json([
            'success' => true,
            'data' => $record
        ]);
    }

    public function destroy(string $id)
    {
        $record = AttendanceSubSegments::find($id);

        if (!$record) {
            return response()->json([
                'success' => false,
                'message' => 'Record not found'
            ], 404);
        }

        $record->delete();

        return response()->json([
            'success' => true,
            'message' => 'Deleted successfully'
        ]);
    }

    public function getAttendanceSubcontractor(Request $request)
    {
        $data = AttendanceSubSegments::with('segments', 'worker', 'site', 'subcontractor')
            ->where('employee_id', $request->employee_id)
            ->get();

        return response()->json([
            'success' => true,
            'data' => AttendanceSubcontractorSegmentResource::collection($data)
        ]);
    }
}
