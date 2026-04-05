<?php

namespace App\Http\Controllers\v1;

use App\Events\AttendanceEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\AttendanceEmployeeRequest;
use App\Http\Requests\v1\AttendanceRequest;
use App\Http\Resources\v1\AttendanceResource;
use App\Models\Attendance;
use App\Models\AttendanceEmployee;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of all attendance records.
     */
    public function index(Request $request)
    {
        $query = Attendance::with(['segments', 'transportation_expenses', 'attendance_subcontractor_segments']);

        if ($request->filled('employee_id')) {
            $query->where('employee_id', $request->employee_id);
        }

        if ($request->filled('work_date')) {
            $query->whereDate('work_date', $request->work_date);
        }

        return response()->json([
            'message' => 'Attendance list retrieved successfully',
            'data' => $query->get(),
            'request' => $request->all()
        ]);
    }

    /**
     * Store a newly created attendance record.
     */
    public function store(AttendanceRequest $request)
    {
        $validated = $request->validated();

        $existing = Attendance::where('employee_id', $validated['employee_id'])
            ->where('work_date', $validated['work_date'])
            ->first();

        if ($existing) {
            return response()->json([
                'message' => 'Attendance already exists for this work date',
                'data' => $existing
            ], 200);
        }

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

    public function dashboard()
    {
        $attendances = Attendance::with([
            'employees',                     // updated relation
            'segments',
            'transportation_expenses',
            'attendance_subcontractor_segments',
        ])->get();

        return AttendanceResource::collection($attendances);
    }

    public function attendance_employee(AttendanceEmployeeRequest $request)
    {
        $attendanceEmployee = AttendanceEmployee::create([
            'attendance_id' => $request->attendance_id,
            'employee_id' => $request->employee_id,
        ]);

        return response()->json([
            'message' => 'Employee assigned to attendance successfully',
            'data' => $attendanceEmployee,
        ]);
    }

    public function get_attendance_employee_by_attendance(Request $request)
    {
        $attendance_id = $request->query('attendance_id');

        if (!$attendance_id) {
            return response()->json([
                'message' => 'attendance_id is required',
            ], 400);
        }

        // Assuming AttendanceEmployee has a relationship to segments
        $attendanceEmployees = AttendanceEmployee::with('segments') // eager load segments
            ->where('attendance_id', $attendance_id)
            ->get();

        return response()->json([
            'message' => 'Employees and segments for attendance retrieved successfully',
            'data' => $attendanceEmployees,
        ]);
    }
}
