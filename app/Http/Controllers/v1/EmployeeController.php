<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\EmployeeRequests;
use App\Models\Employees;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employees::with('attendances')->get();

        return response()->json([
            'success' => true,
            'data' => $employees
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequests $request)
    {
        $validated = $request->validated();

        $employee = Employees::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Employee created successfully',
            'data' => $employee
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employees::find($id);

        if (!$employee) {
            return response()->json([
                'success' => false,
                'message' => 'Employee not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $employee
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequests $request, string $id)
    {
        $employee = Employees::find($id);

        if (!$employee) {
            return response()->json([
                'success' => false,
                'message' => 'Employee not found'
            ], 404);
        }

        $validated = $request->validated();

        $employee->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Employee updated successfully',
            'data' => $employee
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employees::find($id);

        if (!$employee) {
            return response()->json([
                'success' => false,
                'message' => 'Employee not found'
            ], 404);
        }

        $employee->delete();

        return response()->json([
            'success' => true,
            'message' => 'Employee deleted successfully'
        ]);
    }
}
