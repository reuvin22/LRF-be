<?php

namespace App\Http\Controllers\v1;

use App\Events\AttendanceEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\AttendanceRequest;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of all attendance records.
     */
    public function index()
    {
        $attendances = Attendance::with(['segments', 'transportation_expenses'])->get();

        return response()->json([
            'message' => 'Attendance list retrieved successfully',
            'data' => $attendances
        ]);
    }

    /**
     * Store a newly created attendance record.
     */
    public function store(AttendanceRequest $request)
    {
        $validated = $request->validated();

        $attendance = Attendance::create($validated);
        event(new AttendanceEvent($attendance, 'updated'));
        return response()->json([
            'message' => 'Attendance created successfully',
            'data' => $attendance
        ], 201);
    }

    /**
     * Display the specified attendance record.
     */
    public function show(string $id)
    {
        $attendance = Attendance::findOrFail($id);

        return response()->json([
            'message' => 'Attendance retrieved successfully',
            'data' => $attendance
        ]);
    }

    /**
     * Update the specified attendance record.
     */
    public function update(AttendanceRequest $request, string $id)
    {
        $attendance = Attendance::findOrFail($id);

        $validated = $request->validated();

        $attendance->update($validated);
        event(new AttendanceEvent($attendance, 'updated'));
        return response()->json([
            'message' => 'Attendance updated successfully',
            'data' => $attendance
        ]);
    }

    /**
     * Remove the specified attendance record.
     */
    public function destroy(string $id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();
        event(new AttendanceEvent($attendance, 'updated'));
        return response()->json([
            'message' => 'Attendance deleted successfully'
        ]);
    }
}
