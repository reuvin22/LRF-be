<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\TransportationExpenseRequests;
use App\Models\TransportationExpenses;
use Illuminate\Http\Request;

class TransportationExpenseController extends Controller
{
    /**
     * Display a listing of all transportation expenses.
     */
    public function index()
    {
        $expenses = TransportationExpenses::all();

        return response()->json([
            'message' => 'Transportation expenses retrieved successfully',
            'data' => $expenses
        ]);
    }

    /**
     * Store a newly created transportation expense.
     */
    public function store(TransportationExpenseRequests $request)
    {
        $validated = $request->validated();

        if (isset($validated['expenses']) && is_array($validated['expenses'])) {
            $created = [];
            foreach ($validated['expenses'] as $expenseData) {
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

    /**
     * Display the specified transportation expense.
     */
    public function show(string $id)
    {
        $expense = TransportationExpenses::findOrFail($id);

        return response()->json([
            'message' => 'Transportation expense retrieved successfully',
            'data' => $expense
        ]);
    }

    /**
     * Update the specified transportation expense(s).
     */
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

    /**
     * Remove the specified transportation expense(s).
     */
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
}
