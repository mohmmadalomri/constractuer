<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\ImageTrait;
use Illuminate\Http\Request;
use App\Models\Expense;

class ExpenseController extends Controller
{
    use ImageTrait;
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
        $expense = Expense::with('client')->find($id);
        if (!$expense){
            return response()->json([
                'status' => false,
                'message' => 'not found id',
            ],502);
        }
        return response()->json([
            'status' => true,
            'expense' => $expense
        ], 200);
    }

    public function store(Request $request)
    {
        $data['title'] = $request->title;
        $data['accounting_code'] = $request->accounting_code;
        $data['describe'] = $request->describe;
        $data['date'] = $request->date;
        $data['value'] = $request->value;
        $data['status'] = $request->status;
        $data['address'] = $request->address;
        $data['job_title'] = $request->job_title;
        $data['in_progress'] = $request->in_progress;
        $data['project_id'] = $request->project_id;
        $data['task_id'] = $request->task_id;
        $data['company_id'] = $request->company_id;
        $data['client_id'] = $request->client_id;
        $data['team_id'] = $request->team_id;
        $data['job_id'] = $request->job_id;
        $data['employee_id'] = $request->employee_id;
        $expense = Expense::create($data);
        if ($request->hasfile('image')) {
            $expense_image = $this->saveImage($request->image, 'attachments/expense/'.$expense->id);
            $expense->image = $expense_image;
            $expense->save();
        }
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
            $data['title'] = $request->title;
            $data['accounting_code'] = $request->accounting_code;
            $data['describe'] = $request->describe;
            $data['date'] = $request->date;
            $data['value'] = $request->value;
            $data['status'] = $request->status;
            $data['address'] = $request->address;
            $data['job_title'] = $request->job_title;
            $data['in_progress'] = $request->in_progress;
            $data['project_id'] = $request->project_id;
            $data['task_id'] = $request->task_id;
            $data['company_id'] = $request->company_id;
            $data['client_id'] = $request->client_id;
            $data['team_id'] = $request->team_id;
            $data['job_id'] = $request->job_id;
            $data['employee_id'] = $request->employee_id;
            $expense->update($data);
            if ($request->hasfile('image')) {
                $this->deleteFile('expense', $id);
                $expense_image = $this->saveImage($request->image, 'attachments/expense/'.$id);
                $expense->image = $expense_image;
                $expense->save();
            }
            return response()->json([
                'status' => true,
                'massage' => 'expense updated successfully',
                'expense' => $expense
            ], 200);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'not found id',
            ],502);
        }
    }

    public function destroy($id)
    {
        $expense = Expense::find($id);
        if (!$expense){
            return response()->json([
                'status' => false,
                'message' => 'not found id',
            ],502);
        }
        $this->deleteFile('expense', $id);
        $expense->delete();
        return response()->json([
            'status' => true,
            'message' => 'Expense Information deleted Successfully',
        ]);
    }
}
