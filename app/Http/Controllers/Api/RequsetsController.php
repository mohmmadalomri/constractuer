<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequestRequest;
use App\Http\Requests\UpdateRequestRequest;
use App\Models\Request;


class RequsetsController extends Controller
{

    public function index()
    {
        $requests = Request::all();
        return response()->json([
            'requests' => $requests
        ], 200);
    }

    public function show($id)
    {
        $request = Request::find($id);
        return response()->json([
            'request' => $request
        ], 200);
    }

    public function store(StoreRequestRequest $request)
    {
        $requests = Request::create($request->all());
        return response()->json([
            'status' => true,
            'date' => $requests,
            'message' => 'Request Information Added Successfully',
        ]);

    }


    public function update(UpdateRequestRequest $request, $id)
    {
        $requests = Request::findOrFail($id);
        if ($requests) {
            $data['day'] = $request->day ? $request->day : $requests->day;
            $data['start_time'] = $request->start_time ? $request->start_time : $requests->start_time;
            $data['end_time'] = $request->end_time ? $request->end_time : $requests->end_time;
            $data['team_id'] = $request->team_id ? $request->team_id : $requests->team_id;
            $data['subtotal'] = $request->subtotal ? $request->subtotal : $requests->subtotal;
            $data['instruction'] = $request->instruction ? $request->instruction : $requests->instruction;

            $requests->update($data);
            return response()->json([
                'status' => true,
                'data' => $requests,
                'message' => 'Request Information Updated Successfully',
            ]);
        }
    }


    public function destroy($id)
    {
        Request::find($id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'Request Information deleted Successfully',
        ]);
    }
}
