<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tax;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class TaxController extends Controller
{

    public function index()
    {
        $Tax = Tax::all();
        return response()->json([
            'payments' => $Tax
        ]);
    }


    public function store(Request $request)
    {
        $rules = [
            "name" => "required|string|min:3",
            "ratio" => "string",
            "description" => "string",
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
        $data['ratio'] = $request->ratio;
        $data['description'] = $request->description;

        $Taxs = Tax::create($data);
        return response()->json([
            'status' => true,
            'date' => $Taxs,
            'message' => 'Tax Information Added Successfully',
        ]);
    }


    public function show($id)
    {
        $Tax = Tax::find($id);
        if (!$Tax) {
            return response()->json([
                'status' => False,
                'massage' => 'Not Found Id',
            ],502);
        }
        return response()->json([
            'status' => true,
            'date' => $Tax,
        ]);
    }


    public function update(Request $request, $id)
    {
        $rules = [
            "name" => "required|string|min:3",
            "ratio" => "string",
            "description" => "string",
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
        $Tax= Tax::find($id);
        if (!$Tax) {
            return response()->json([
                'status' => False,
                'massage' => 'Not Found Id',
            ],502);
        }
        $data['name'] = $request->name;
        $data['ratio'] = $request->ratio;
        $data['description'] = $request->description;
        $Tax->update($data);
        return response()->json([
            'status' => true,
            'date' => $Tax,
            'message' => 'Tax Information Added Successfully',
        ]);
    }


    public function destroy($id)
    {
        $Tax= Tax::find($id);
        if (!$Tax) {
            return response()->json([
                'status' => False,
                'massage' => 'Not Found Id',
            ],502);
        }
        $Tax->delete();
        return response()->json([
            'status' => true,
            'massage' => 'Tax Deleted Successfully',
        ]);

    }
}
