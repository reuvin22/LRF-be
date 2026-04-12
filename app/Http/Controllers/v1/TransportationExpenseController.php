<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\TransportationExpenseRequests;
use App\Models\TransportationExpenses;
use Illuminate\Http\Request;

class TransportationExpenseController extends Controller
{
    public function index(Request $request)
    {
        $attendanceId = $request->attendance_id;

        $expenses = TransportationExpenses::where('attendance_id', $attendanceId)
            ->get();

        return response()->json([
            'message' => 'Work dates retrieved successfully',
            'data' => $expenses
        ]);
    }

    public function store(TransportationExpenseRequests $request)
    {
        $validated = $request->validated();
        if (array_is_list($validated)) {
            $created = [];

            foreach ($validated as $expenseData) {
                $created[] = TransportationExpenses::create($expenseData);
            }

            return response()->json([
                'message' => 'Transportation expenses created successfully',
                'data' => $created
            ], 201);
        }

        $expense = TransportationExpenses::create($validated);

        return response()->json([
            'message' => 'Transportation expense created successfully',
            'data' => $expense
        ], 201);
    }

    public function show(string $id)
    {
        $expense = TransportationExpenses::findOrFail($id);

        return response()->json([
            'message' => 'Transportation expense retrieved successfully',
            'data' => $expense
        ]);
    }

    public function update(TransportationExpenseRequests $request, $id = null)
    {
        $validated = $request->validated();
        $ids = $id ? explode(',', $id) : ($validated['ids'] ?? []);

        $updatedExpenses = [];
        foreach ($ids as $expenseId) {
            $expense = TransportationExpenses::findOrFail($expenseId);
            $expense->update($validated);
            $updatedExpenses[] = $expense;
        }

        return response()->json([
            'message' => 'Transportation expense(s) updated successfully',
            'data' => $updatedExpenses
        ]);
    }

    public function destroy(Request $request, $id = null)
    {
        $ids = $id ? explode(',', $id) : $request->input('ids', []);

        foreach ($ids as $expenseId) {
            $expense = TransportationExpenses::findOrFail($expenseId);
            $expense->delete();
        }

        return response()->json([
            'message' => 'Transportation expense(s) deleted successfully'
        ]);
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);

        if (!is_array($ids) || empty($ids)) {
            return response()->json(['message' => 'No IDs provided'], 400);
        }

        TransportationExpenses::whereIn('id', $ids)->delete();

        return response()->json([
            'message' => 'Transportation expenses deleted successfully'
        ]);
    }
}
