<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class DepositController extends Controller
{

    public function index()
    {
        $deposit = Deposit::all();
        return response()->json([
            'Deposits' => $deposit
        ]);
    }


    public function store(Request $request)
    {
        $rules = [
            "value" => "string",
            "discount" => "required|in:fixed,variable"
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $response = new JsonResponse([
                'data' => [],
                'message' => 'Validation Error',
                'errors' => $validator->messages()->all(),
            ], ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
            throw new ValidationException($validator, $response);
        }
        $data['value'] = $request->value;
        $data['discount'] = $request->discount;

        $deposits = Deposit::create($data);
        return response()->json([
            'status' => true,
            'date' => $deposits,
            'message' => 'deposit Information Added Successfully',
        ]);
    }


    public function show($id)
    {
        $deposit = Deposit::find($id);
        if (!$deposit) {
            return response()->json([
                'status' => False,
                'massage' => 'Not Found Id',
            ],502);
        }
        return response()->json([
            'status' => true,
            'date' => $deposit,
        ]);
    }


    public function update(Request $request, $id)
    {

        $rules = [
            "value" => "string",
            "discount" => "required|in:fixed,variable"
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $response = new JsonResponse([
                'data' => [],
                'message' => 'Validation Error',
                'errors' => $validator->messages()->all(),
            ], ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
            throw new ValidationException($validator, $response);
        }
        $deposit= Deposit::find($id);
        if (!$deposit) {
            return response()->json([
                'status' => False,
                'massage' => 'Not Found Id',
            ],502);
        }
        $data['value'] = $request->value;
        $data['discount'] = $request->discount;
        $deposit->update($data);
        return response()->json([
            'status' => true,
            'date' => $deposit,
            'message' => 'deposit Information Added Successfully',
        ]);
    }


    public function destroy($id)
    {
        $deposit= Deposit::find($id);
        if (!$deposit) {
            return response()->json([
                'status' => False,
                'massage' => 'Not Found Id',
            ],502);
        }
        $deposit->delete();
        return response()->json([
            'status' => true,
            'massage' => 'deposit Deleted Successfully',
        ]);

    }
}
