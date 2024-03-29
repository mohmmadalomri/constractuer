<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::with('client')->get();
        return response()->json([
            'expenses' => $expenses,
            'status' => true
        ], 200);
    }

    public function show($id)
    {
        $expense = Expense::with('clint')->find($id);
        return response()->json([
            'status' => true,
            'expense' => $expense
        ], 200);
    }

    public function store(Request $request)
    {
        $expense = Expense::create($request->all());
        return response()->json([
            'status' => true,
            'massage' => 'expense add successfully',
            'expense' => $expense
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $expense = Expense::find($id);
        if ($expense) {
            $data['title'] = $request->title ? $request->title : $expense->title;
            $data['describe'] = $request->describe ? $request->typdescribee : $expense->describe;
            $data['date'] = $request->date ? $request->date : $expense->date;
            // $data['total'] = $request->total ? $request->total : $expense->total ;
            $data['client_id'] = $request->client_id ? $request->client_id : $expense->client_id;


            $data['address'] = $request->address ? $request->address : $expense->address;
            $data['job_title'] = $request->job_title ? $request->job_title : $expense->job_title;
            $data['in_progress'] = $request->in_progress ? $request->in_progress : $expense->in_progress;


            $expense->update($data);
            return response()->json([
                'status' => true,
                'massage' => 'expense updated successfully',
                'expense' => $expense
            ], 200);
        }
    }

    public function destroy($id)
    {
        Expense::find($id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'Expense Information deleted Successfully',
        ]);
    }
}
