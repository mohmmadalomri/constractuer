<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class DiscountController extends Controller
{

    public function index()
    {
        $discount = Discount::all();
        return response()->json([
            'Discounts' => $discount
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

        $discounts = Discount::create($data);
        return response()->json([
            'status' => true,
            'date' => $discounts,
            'message' => 'discount Information Added Successfully',
        ]);
    }


    public function show($id)
    {
        $discount = Discount::find($id);
        if (!$discount) {
            return response()->json([
                'status' => False,
                'massage' => 'Not Found Id',
            ],502);
        }
        return response()->json([
            'status' => true,
            'date' => $discount,
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
        $discount= Discount::find($id);
        if (!$discount) {
            return response()->json([
                'status' => False,
                'massage' => 'Not Found Id',
            ],502);
        }
        $data['value'] = $request->value;
        $data['discount'] = $request->discount;
        $discount->update($data);
        return response()->json([
            'status' => true,
            'date' => $discount,
            'message' => 'discount Information Added Successfully',
        ]);
    }


    public function destroy($id)
    {
        $discount= Discount::find($id);
        if (!$discount) {
            return response()->json([
                'status' => False,
                'massage' => 'Not Found Id',
            ],502);
        }
        $discount->delete();
        return response()->json([
            'status' => true,
            'massage' => 'discount Deleted Successfully',
        ]);

    }
}
