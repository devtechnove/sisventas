<?php

namespace Modules\Expense\Http\Controllers;

use Modules\Expense\DataTables\ExpenseCategoriesDataTable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Expense\Entities\ExpenseCategory;

class ExpenseCategoriesController extends Controller
{

    public function index(ExpenseCategoriesDataTable $dataTable) {
        abort_if(Gate::denies('access_expense_categories'), 403);

        return $dataTable->render('expense::categories.index');
    }

    public function store(Request $request) {
        abort_if(Gate::denies('access_expense_categories'), 403);

        $request->validate([
            'category_name' => 'required|string|max:255|unique:expense_categories,category_name',
            'category_description' => 'nullable|string|max:1000'
        ]);

        ExpenseCategory::create([
            'category_name' => $request->category_name,
            'empresa_id'    => \Auth::user()->empresa_id,
            'category_description' => $request->category_description
        ]);

         toast('Categoría de gasto creada!', 'success');


        return redirect()->route('expense-categories.index');
    }


    public function edit(ExpenseCategory $expenseCategory) {
        abort_if(Gate::denies('access_expense_categories'), 403);

        return view('expense::categories.edit', compact('expenseCategory'));
    }


    public function update(Request $request, ExpenseCategory $expenseCategory) {
        abort_if(Gate::denies('access_expense_categories'), 403);

        $request->validate([
            'category_name' => 'required|string|max:255|unique:expense_categories,category_name,' . $expenseCategory->id,
            'category_description' => 'nullable|string|max:1000'
        ]);

        $expenseCategory->update([
            'category_name' => $request->category_name,
            'empresa_id'    => \Auth::user()->empresa_id,
            'category_description' => $request->category_description
        ]);

       toast('Categoría de gasto actualizada!', 'success');

        return redirect()->route('expense-categories.index');
    }


    public function destroy(ExpenseCategory $expenseCategory) {
        abort_if(Gate::denies('access_expense_categories'), 403);

        if ($expenseCategory->expenses()->isNotEmpty()) {
            return back()->withErrors('Can\'t delete beacuse there are expenses associated with this category.');
        }

        $expenseCategory->delete();

        toast('Categoría de gasto eliminada!', 'success');

        return redirect()->route('expense-categories.index');
    }
}
