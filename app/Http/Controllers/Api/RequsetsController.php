<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequestRequest;
use App\Http\Requests\UpdateRequestRequest;
use App\Models\Booking_date;
use App\Models\Request;
use App\Models\User;
use App\Notifications\RequestNotification;
use Illuminate\Support\Facades\Notification;


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
//        return $request;
        $requestData = $request->all();
        $newRequest = Request::create($requestData);
        $requestId = $newRequest->id;

//        $dates = $request->input('booking_request');
//        foreach ($dates as $date) {
//            Booking_date::create([
//                'request_id' => $requestId,
//                'date' => $date,
//            ]);
//        }

        $users=User::where('id','!=',auth()->user()->id)->get();
        $user_create=auth()->user()->name;
        Notification::send($users,new RequestNotification($newRequest->id,$user_create,$request->title));


        return response()->json([
            'status' => true,
            'date' => $newRequest,
            'message' => 'Request Information Added Successfully',
        ]);

    }


    public function update(StoreRequestRequest $request, $id)
    {
        $requests = Request::findOrFail($id);
        if ($requests) {
            $data['title'] = $request->title ? $request->title : $requests->title;
            $data['start_time'] = $request->start_time ? $request->start_time : $requests->start_time;
            $data['end_time'] = $request->end_time ? $request->end_time : $requests->end_time;
            $data['team_id'] = $request->team_id ? $request->team_id : $requests->team_id;
            $data['day'] = $request->day ? $request->day : $requests->day;
            $data['status'] = $request->status ? $request->status : $requests->status;
            $data['project_id'] = $request->project_id ? $request->project_id : $requests->project_id;
            $data['task_id'] = $request->task_id ? $request->task_id : $requests->task_id;
//            $data['booking_request'] = $request->booking_request ? $request->booking_request : $requests->booking_request;
            $data['notes'] = $request->notes ? $request->notes : $requests->notes;
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
