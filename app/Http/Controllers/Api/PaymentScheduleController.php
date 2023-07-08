<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Paymentschedule;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class PaymentScheduleController extends Controller
{

    public function index()
    {
        $Payment = Paymentschedule::all();
        return response()->json([
            'payments' => $Payment
        ]);
    }


    public function store(Request $request)
    {
        $rules = [
            "name" => "required|string|min:3",
            "value" => "string",
            "receive_date" => "date",
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
        $data['name'] = $request->name;
        $data['value'] = $request->value;
        $data['receive_date'] = $request->receive_date;
        $data['discount'] = $request->discount;

        $Payments = Paymentschedule::create($data);
        return response()->json([
            'status' => true,
            'date' => $Payments,
            'message' => 'Payment Information Added Successfully',
        ]);
    }


    public function show($id)
    {
        $Payment = Paymentschedule::find($id);
        if (!$Payment) {
            return response()->json([
                'status' => False,
                'massage' => 'Not Found Id',
            ],502);
        }
        return response()->json([
            'status' => true,
            'date' => $Payment,
        ]);
    }


    public function update(Request $request, $id)
    {

        $rules = [
            "name" => "required|string|min:3",
            "value" => "string",
            "receive_date" => "date",
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
        $Payment= Paymentschedule::find($id);
        if (!$Payment) {
            return response()->json([
                'status' => False,
                'massage' => 'Not Found Id',
            ],502);
        }
        $data['name'] = $request->name;
        $data['value'] = $request->value;
        $data['receive_date'] = $request->receive_date;
        $data['discount'] = $request->discount;
        $Payment->update($data);
        return response()->json([
            'status' => true,
            'date' => $Payment,
            'message' => 'Payment Information Added Successfully',
        ]);
    }


    public function destroy($id)
    {
        $Payment= Paymentschedule::find($id);
        if (!$Payment) {
            return response()->json([
                'status' => False,
                'massage' => 'Not Found Id',
            ],502);
        }
            $Payment->delete();
            return response()->json([
                'status' => true,
                'massage' => 'Payment Deleted Successfully',
            ]);

    }
}
