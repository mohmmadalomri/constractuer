<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequestRequest;
use App\Http\Requests\UpdateRequestRequest;
use App\Models\Booking_date;
use App\Models\Request;


class RequsetsController extends Controller
{

    public function index()
    {
        $requests = Request::with('client', 'team', 'company')->get();
        return response()->json([
            'requests' => $requests
        ], 200);
    }

    public function show($id)
    {
        $request = Request::with('client', 'team', 'company')->find($id);
        return response()->json([
            'request' => $request
        ], 200);
    }

    public function store(StoreRequestRequest $request)
    {
        $requestData = $request->all();
        $newRequest = Request::create($requestData);
        $requestId = $newRequest->id;

        $dates = $request->input('dates');
        foreach ($dates as $date) {
            Booking_date::create([
                'request_id' => $requestId,
                'date' => $date,
            ]);
        }
        return response()->json([
            'status' => true,
            'date' => $newRequest,
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


            $data['project_id'] = $request->project_id ? $request->project_id : $requests->project_id;
            $data['task_id'] = $request->task_id ? $request->task_id : $requests->task_id;
            $data['address'] = $request->address ? $request->address : $requests->address;
            $data['notices'] = $request->notices ? $request->notices : $requests->notices;
            $data['item_id'] = $request->item_id ? $request->item_id : $requests->item_id;
            $data['service_price'] = $request->service_price ? $request->service_price : $requests->service_price;


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
