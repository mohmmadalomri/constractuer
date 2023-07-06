<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\Project;
use App\Models\Task;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SearchController extends Controller
{
    public function show_client(Request $request)
    {
        try {
            $client= Client::find($request->client_id);
            if(!$client)
            {
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'Client id not found'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            return response()->json([
                'status' => true,
                'status_code'=>ResponseAlias::HTTP_OK,
                'message' => 'Client Successfully',
                'data'=>$client
            ], ResponseAlias::HTTP_OK);

        }catch (\Exception $e){
            return response()->json([
                'status' => 'Error',
                'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                'message' => 'Error id',
            ], ResponseAlias::HTTP_NOT_FOUND);
        }


    }
    public function show_company(Request $request)
    {
        try {
            $company= Company::find($request->company_id);
            if(!$company)
            {
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'Company id not found'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            return response()->json([
                'status' => true,
                'status_code'=>ResponseAlias::HTTP_OK,
                'message' => 'Company Successfully',
                'data'=>$company
            ], ResponseAlias::HTTP_OK);
        }catch (\Exception $e){
            return response()->json([
                'status' => 'Error',
                'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                'message' => 'Error id',
            ], ResponseAlias::HTTP_NOT_FOUND);
        }
    }
    public function show_invoice(Request $request)
    {
        if(isset($request->invoice_id)) {

        }
        try {
            $invoice= Invoice::find($request->invoice_id);
            if(!$invoice)
            {
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'Invoice id not found'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            return response()->json([
                'status' => true,
                'status_code'=>ResponseAlias::HTTP_OK,
                'message' => 'Invoice Successfully',
                'data'=>$invoice
            ], ResponseAlias::HTTP_OK);

        }catch (\Exception $e){
            return response()->json([
                'status' => 'Error',
                'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                'message' => 'Error id',
            ], ResponseAlias::HTTP_NOT_FOUND);
        }
    }
    public function show_project(Request $request)
    {
        try {
            $project= Project::find($request->project_id);
            if(!$project)
            {
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'Project id not found'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            return response()->json([
                'status' => true,
                'status_code'=>ResponseAlias::HTTP_OK,
                'message' => 'Project Successfully',
                'data'=>$project
            ], ResponseAlias::HTTP_OK);
        }catch (\Exception $e){
            return response()->json([
                'status' => 'Error',
                'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                'message' => 'Error id',
            ], ResponseAlias::HTTP_NOT_FOUND);
        }
    }
    public function show_task(Request $request)
    {
        try {
            $task= Task::find($request->task_id);
            if(!$task)
            {
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'Task id not found'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            return response()->json([
                'status' => true,
                'status_code'=>ResponseAlias::HTTP_OK,
                'message' => 'Task Successfully',
                'data'=>$task
            ], ResponseAlias::HTTP_OK);
        }catch (\Exception $e){
            return response()->json([
                'status' => 'Error',
                'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                'message' => 'Error id',
            ], ResponseAlias::HTTP_NOT_FOUND);
        }

    }
    public function show_employee(Request $request)
    {
        try {
            $employee= Employee::find($request->employee_id);
            if(!$employee)
            {
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'employee id not found'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            return response()->json([
                'status' => true,
                'status_code'=>ResponseAlias::HTTP_OK,
                'message' => 'employee Successfully',
                'data'=>$employee
            ], ResponseAlias::HTTP_OK);
        }catch (\Exception $e){
            return response()->json([
                'status' => 'Error',
                'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                'message' => 'Error id',
            ], ResponseAlias::HTTP_NOT_FOUND);
        }
    }
    public function show_team(Request $request)
    {
        try {
            $team= Team::find($request->team_id);
            if(!$team)
            {
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'team id not found'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            return response()->json([
                'status' => true,
                'status_code'=>ResponseAlias::HTTP_OK,
                'message' => 'team Successfully',
                'data'=>$team
            ], ResponseAlias::HTTP_OK);

        }catch (\Exception $e){
            return response()->json([
                'status' => 'Error',
                'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                'message' => 'Error id',
            ], ResponseAlias::HTTP_NOT_FOUND);
        }

    }
    public function show_expense(Request $request)
    {
        try {
            $client= Client::find($request->client_id);
            $expense= Expense::find($request->expense_id);
            if(!$expense)
            {
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'expense id not found'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            return response()->json([
                'status' => true,
                'status_code'=>ResponseAlias::HTTP_OK,
                'message' => 'expense Successfully',
                'data'=>$expense
            ], ResponseAlias::HTTP_OK);

        }catch (\Exception $e){
            return response()->json([
                'status' => 'Error',
                'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                'message' => 'Error id',
            ], ResponseAlias::HTTP_NOT_FOUND);
        }
    }

}
