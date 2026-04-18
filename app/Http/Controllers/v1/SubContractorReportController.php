<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubContractorReport;

class SubContractorReportController extends Controller
{
    public function index()
    {
        $reports = SubContractorReport::all();

        return response()->json([
            'success' => true,
            'data' => $reports
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'attendance_id' => 'required|integer',
            'employee_id' => 'required|integer',
            'worker_id' => 'nullable|integer',
            'worker_name' => 'required|string|max:255',
            'contract_type' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'site_id' => 'required|integer|max:255',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
        ]);

        $report = SubContractorReport::create($validated);

        return response()->json([
            'success' => true,
            'data' => $report
        ], 201);
    }

    public function show(string $id)
    {
        $report = SubContractorReport::find($id);

        if (!$report) {
            return response()->json([
                'success' => false,
                'message' => 'SubContractorReport not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $report
        ]);
    }

    public function update(Request $request, string $id)
    {
        $report = SubContractorReport::find($id);

        if (!$report) {
            return response()->json([
                'success' => false,
                'message' => 'SubContractorReport not found'
            ], 404);
        }

        $validated = $request->validate([
            'attendance_id' => 'sometimes|integer',
            'worker_id' => 'sometimes|integer',
            'worker_name' => 'sometimes|string|max:255',
            'contract_type' => 'sometimes|string|max:255',
            'company_name' => 'sometimes|string|max:255',
            'site_id' => 'sometimes|string|max:255',
            'start_time' => 'sometimes|date',
            'end_time' => 'nullable|date',
        ]);

        $report->update($validated);

        return response()->json([
            'success' => true,
            'data' => $report
        ]);
    }

    public function destroy(string $id)
    {
        $report = SubContractorReport::find($id);

        if (!$report) {
            return response()->json([
                'success' => false,
                'message' => 'SubContractorReport not found'
            ], 404);
        }

        $report->delete();

        return response()->json([
            'success' => true,
            'message' => 'SubContractorReport deleted successfully'
        ]);
    }
}
