<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequestRequest;
use App\Models\RequestModel;
use App\Models\User;
use App\Notifications\RequestNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class RequsetsController extends Controller
{

    public function index()
    {
        $requests = RequestModel::with('client', 'team', 'company','items')->get();
        return response()->json([
            'status' => true,
            'requests' => $requests,
//            'Items' => RequestModel::with('items')->get()
        ]);
    }

    public function show($id)
    {
        try {
            $request = RequestModel::with('client', 'team', 'company','items')->find($id);
         }catch (\Exception $exception){
            return response()->json([
            'message' => 'Error System',
            'status' => false,
            'error' => $exception->validator->errors()->toArray()
            ],404);
         }
        return response()->json([
            'status' => true,
            'request' => $request
        ]);
    }

    public function store(Request $request)
    {
        try {
            $data=$request->validate([
                'title' => 'string',
                'instruction' => 'string',
                'day' => 'string',
                'start_time' => 'string',
                'end_time' => 'string',
                'request_adress' => 'string',
                'booking_request' => 'string',
                'notes' => 'string',
                'client_id' => 'required|integer',
                'team_id' => 'required|integer',
                'company_id' => 'required|integer',
                'project_id' => 'required|integer',
                'task_id' => 'required|integer',
//                'item_id' => 'required|integer',
                'service_price' => '',
                'status' => 'integer',
            ]);
            $newRequest=RequestModel::create($data);
            $newRequest->items()->syncWithoutDetaching($request->input('item_id'));

//        $dates = $request->input('booking_request');
//        foreach ($dates as $date) {
//            Booking_date::create([
//                'request_id' => $requestId,
//                'date' => $date,
//            ]);
//        }

            #notification
//        $users=User::where('id','!=',auth()->user()->id)->get();
//        $user_create=auth()->user()->name;
//        Notification::send($users,new RequestNotification($newRequest->id,$user_create,$request->title));

        }catch (ValidationException $exception) {
            // Validation failed, return error response with validation errors
            return response()->json([
                'message' => 'Validation failed.',
                'status' => false,
                'errors' => $exception->validator->getMessageBag(),
            ], 422);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Error storing the request.',
                'status' => false,
                'error' => $exception->getMessage(),
            ], 500); // HTTP status code 500 indicates Internal Server Error
        }

        return response()->json([
            'status' => true,
            'date' => $newRequest,
            'message' => 'Request Information Added Successfully',
        ],201);

    }


    public function update(Request $request, $id)
    {
        try {
            $newRequest = RequestModel::findOrFail($id);
            $data=$request->validate([
                'title' => 'string',
                'instruction' => 'string',
                'day' => 'string',
                'start_time' => 'string',
                'end_time' => 'string',
                'request_adress' => 'string',
                'booking_request' => 'string',
                'notes' => 'string',
                'client_id' => 'integer',
                'team_id' => 'integer',
                'company_id' => 'integer',
                'project_id' => 'integer',
                'task_id' => 'integer',
                'service_price' => '',
                'status' => 'integer',
            ]);
            $newRequest->update($data);

        }catch (ValidationException $exception) {
            // Validation failed, return error response with validation errors
            return response()->json([
                'message' => 'Validation failed.',
                'status' => false,
                'errors' => $exception->validator->getMessageBag(),
            ], 422);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Error storing the request.',
                'status' => false,
                'error' => $exception->getMessage(),
            ], 500); // HTTP status code 500 indicates Internal Server Error
        }

        return response()->json([
            'status' => true,
            'date' => $newRequest,
            'message' => 'Request Information updated Successfully',
        ]);
    }


    public function destroy($id)
    {
        $requests=RequestModel::find($id);
        $requests->items()->detach($id);
        $requests->delete();
        return response()->json([
            'status' => true,
            'message' => 'Request Information deleted Successfully',
        ]);
    }
}
