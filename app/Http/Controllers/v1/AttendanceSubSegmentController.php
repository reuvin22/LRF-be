<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\AttendanceSubcontractorSegmentResource;
use Illuminate\Http\Request;
use App\Models\AttendanceSubSegments;

class AttendanceSubSegmentController extends Controller
{
    /**
     * GET /attendance-subcontractor-segments
     */
    public function index()
    {
        $data = AttendanceSubSegments::with('segments', 'worker', 'site', 'subcontractor')->get();

        return response()->json([
            'success' => true,
            'data' => AttendanceSubcontractorSegmentResource::collection($data)
        ]);
    }

    /**
     * POST /attendance-subcontractor-segments
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'attendance_id' => 'required|integer',
            'segment_id' => 'required|integer',
            'company_id' => 'required|integer|max:50',
            'company_name' => 'required|string|max:255',
            'employee_id' => 'required|integer',
            'worker_id' => 'required|integer',
            'worker_name' => 'nullable|string|max:255',
            'site_id' => 'required|integer',
            'site_name' => 'required|string|max:255',
            'contract_type' => 'required|string|max:100',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time'
        ]);

        $record = AttendanceSubSegments::create($validated);

        return response()->json([
            'success' => true,
            'data' => $record
        ], 201);
    }

    /**
     * GET /attendance-subcontractor-segments/{id}
     */
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

    /**
     * PUT /attendance-subcontractor-segments/{id}
     */
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

    /**
     * DELETE /attendance-subcontractor-segments/{id}
     */
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
