<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExpenseResource;
use App\Http\Resources\InvoiceResource;
use App\Http\Resources\RequestResource;
use App\Http\Resources\TakResource;
use App\Models\Invoice;
use App\Models\Job;
use App\Models\Project;
use App\Models\Expense;
use App\Models\Request;

use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class TimesheetController extends Controller
{
    public function show_expense($id)
    {
        try {
            $qoute= Expense::find($id);
            if(!$qoute)
            {
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'Expense id not found'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            return response()->json([
                'status' => true,
                'status_code'=>ResponseAlias::HTTP_OK,
                'message' => 'Expense Successfully',
                'data'=>new ExpenseResource(Expense::findOrFail($id))
            ], ResponseAlias::HTTP_OK);
        }catch (\Exception $e){
            return response()->json([
                'status' => 'Error',
                'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                'message' => 'Error id',
            ], ResponseAlias::HTTP_NOT_FOUND);
        }

    }
    public function show_invoice($id)
    {
        try {
            $Invoice= Invoice::find($id);
            if(!$Invoice)
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
                'data'=>new InvoiceResource(Invoice::findOrFail($id))
            ], ResponseAlias::HTTP_OK);
        }catch (\Exception $e){
            return response()->json([
                'status' => 'Error',
                'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                'message' => 'Error id',
            ], ResponseAlias::HTTP_NOT_FOUND);
        }

    }
    public function show_qoute($id)
    {
        try {
            $qoute= Invoice::find($id);
            if(!$qoute)
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
                'data'=>new InvoiceResource(Invoice::findOrFail($id))
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
