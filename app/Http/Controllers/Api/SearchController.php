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

            if (isset($request->name)){
                $client_search = Client::whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%'.$request->name.'%'])->get();
                return response()->json([
                    'status' => true,
                    'status_code'=>ResponseAlias::HTTP_OK,
                    'message' => 'Client Successfully',
                    'data'=>$client_search
                ], ResponseAlias::HTTP_OK);
            }
            if (isset($request->address)){
                $client_search = Client::whereRaw("CONCAT(address_1, ' ', address_2) LIKE ?", ['%'.$request->address.'%'])->get();
                return response()->json([
                    'status' => true,
                    'status_code'=>ResponseAlias::HTTP_OK,
                    'message' => 'Client Successfully',
                    'data'=>$client_search
                ], ResponseAlias::HTTP_OK);
            }

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
            if (isset($request->name)){
                $client_search = Company::whereRaw("name LIKE ?", ['%'.$request->name.'%'])->get();
                return response()->json([
                    'status' => true,
                    'status_code'=>ResponseAlias::HTTP_OK,
                    'message' => 'Company Successfully',
                    'data'=>$client_search
                ], ResponseAlias::HTTP_OK);
            }
            if (isset($request->address)){
                $client_search = Company::whereRaw("CONCAT(address_1, ' ', address_2) LIKE ?", ['%'.$request->address.'%'])->get();
                return response()->json([
                    'status' => true,
                    'status_code'=>ResponseAlias::HTTP_OK,
                    'message' => 'Company Successfully',
                    'data'=>$client_search
                ], ResponseAlias::HTTP_OK);
            }
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
        try {
            if (isset($request->title)){
                $client_search = Invoice::whereRaw("title LIKE ?", ['%'.$request->title.'%'])->get();
                return response()->json([
                    'status' => true,
                    'status_code'=>ResponseAlias::HTTP_OK,
                    'message' => 'Company Successfully',
                    'data'=>$client_search
                ], ResponseAlias::HTTP_OK);
            }
//            if (isset($request->address)){
//                $client_search = Invoice::whereRaw("CONCAT(address_1, ' ', address_2) LIKE ?", ['%'.$request->address.'%'])->get();
//                return response()->json([
//                    'status' => true,
//                    'status_code'=>ResponseAlias::HTTP_OK,
//                    'message' => 'Invoice Successfully',
//                    'data'=>$client_search
//                ], ResponseAlias::HTTP_OK);
//            }
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
            if (isset($request->name)){
                $client_search = Project::whereRaw("name LIKE ?", ['%'.$request->name.'%'])->get();
                return response()->json([
                    'status' => true,
                    'status_code'=>ResponseAlias::HTTP_OK,
                    'message' => 'Company Successfully',
                    'data'=>$client_search
                ], ResponseAlias::HTTP_OK);
            }
            if (isset($request->date)) {
                $client_search = Project::where(function ($query) use ($request) {
                    $query->whereDate('start_time', '<=', $request->date)
                        ->whereDate('end_time', '>=', $request->date);
                })->get();

                return response()->json([
                    'status' => true,
                    'status_code' => ResponseAlias::HTTP_OK,
                    'message' => 'Companies Successfully',
                    'data' => $client_search
                ], ResponseAlias::HTTP_OK);
            }

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
            if (isset($request->name)){
                $client_search = Task::whereRaw("name LIKE ?", ['%'.$request->name.'%'])->get();
                return response()->json([
                    'status' => true,
                    'status_code'=>ResponseAlias::HTTP_OK,
                    'message' => 'Task Successfully',
                    'data'=>$client_search
                ], ResponseAlias::HTTP_OK);
            }
            if (isset($request->date)) {
                $client_search = Task::where(function ($query) use ($request) {
                    $query->whereDate('start_time', '<=', $request->date)
                        ->whereDate('end_time', '>=', $request->date);
                })->get();

                return response()->json([
                    'status' => true,
                    'status_code' => ResponseAlias::HTTP_OK,
                    'message' => 'Task Successfully',
                    'data' => $client_search
                ], ResponseAlias::HTTP_OK);
            }

            if (isset($request->address)){
                $client_search = Task::whereRaw("location LIKE ?", ['%'.$request->address.'%'])->get();
                return response()->json([
                    'status' => true,
                    'status_code'=>ResponseAlias::HTTP_OK,
                    'message' => 'Task Successfully',
                    'data'=>$client_search
                ], ResponseAlias::HTTP_OK);
                }

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
            if (isset($request->name)){
                $client_search = Employee::whereRaw("name LIKE ?", ['%'.$request->name.'%'])->get();
                return response()->json([
                    'status' => true,
                    'status_code'=>ResponseAlias::HTTP_OK,
                    'message' => 'Employee Successfully',
                    'data'=>$client_search
                ], ResponseAlias::HTTP_OK);
            }

            if (isset($request->phone)){
                $client_search = Employee::whereRaw("phone LIKE ?", ['%'.$request->phone.'%'])->get();
                return response()->json([
                    'status' => true,
                    'status_code'=>ResponseAlias::HTTP_OK,
                    'message' => 'Employee Successfully',
                    'data'=>$client_search
                ], ResponseAlias::HTTP_OK);
            }
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
            if (isset($request->name)){
                $client_search = Team::whereRaw("name LIKE ?", ['%'.$request->name.'%'])->get();
                return response()->json([
                    'status' => true,
                    'status_code'=>ResponseAlias::HTTP_OK,
                    'message' => 'Team Successfully',
                    'data'=>$client_search
                ], ResponseAlias::HTTP_OK);
            }
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
            if (isset($request->title)){
                $client_search = Expense::whereRaw("title LIKE ?", ['%'.$request->title.'%'])->get();
                return response()->json([
                    'status' => true,
                    'status_code'=>ResponseAlias::HTTP_OK,
                    'message' => 'Expense Successfully',
                    'data'=>$client_search
                ], ResponseAlias::HTTP_OK);
            }
            if (isset($request->address)){
                $client_search = Expense::whereRaw("address LIKE ?", ['%'.$request->address.'%'])->get();
                return response()->json([
                    'status' => true,
                    'status_code'=>ResponseAlias::HTTP_OK,
                    'message' => 'Expense Successfully',
                    'data'=>$client_search
                ], ResponseAlias::HTTP_OK);
            }
        }catch (\Exception $e){
            return response()->json([
                'status' => 'Error',
                'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                'message' => 'Error id',
            ], ResponseAlias::HTTP_NOT_FOUND);
        }
    }

}
