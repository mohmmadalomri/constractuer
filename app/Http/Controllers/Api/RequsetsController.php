<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequestRequest;
use App\Http\Traits\ImageTrait;
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
    use ImageTrait;
    public function index()
    {
        $requests = RequestModel::with('client', 'team', 'company','items')->get();
        return response()->json([
            'status' => true,
            'requests' => $requests,
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
                'instruction' => 'nullable|string',
                'day' => 'nullable|string',
                'start_time' => 'nullable|string',
                'end_time' => 'nullable|string',
                'request_adress' => 'nullable|string',
                'booking_request' => 'nullable|string',
                'notes' => 'nullable|string',
                'client_id' => 'required|integer',
                'team_id' => 'required|integer',
                'company_id' => 'required|integer',
                'project_id' => 'required|integer',
                'task_id' => 'required|integer',
//                'item_id' => 'required|integer',
                'sub_total' => 'nullable',
                'service_price' => 'nullable',
                'total' => 'nullable',
                'service_details' => 'nullable',
                'status' => 'nullable|integer',
            ]);

            $newRequest=RequestModel::create($data);

            $newRequest->items()->syncWithoutDetaching($request->input('item_id'));

            if ($request->hasfile('image')) {
                $newRequest_image = $this->saveImage($request->image, 'attachments/requests/'.$newRequest->id);
                $newRequest->image = $newRequest_image;
                $newRequest->save();
            }
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
                'instruction' => 'nullable|string',
                'day' => 'nullable|string',
                'start_time' => 'nullable|string',
                'end_time' => 'nullable|string',
                'request_adress' => 'nullable|string',
                'booking_request' => 'nullable|string',
                'notes' => 'nullable|string',
                'client_id' => 'required|integer',
                'team_id' => 'required|integer',
                'company_id' => 'required|integer',
                'project_id' => 'required|integer',
                'task_id' => 'required|integer',
//                'item_id' => 'required|integer',
                'sub_total' => 'nullable',
                'service_price' => 'nullable',
                'total' => 'nullable',
                'service_details' => 'nullable',
                'status' => 'nullable|integer',
            ]);
            $newRequest->update($data);
            if ($request->hasfile('image')) {
                $this->deleteFile('requests',$id);
                $newRequest_image = $this->saveImage($request->image, 'attachments/requests/'.$newRequest->id);
                $newRequest->image = $newRequest_image;
                $newRequest->save();
            }
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
        $this->deleteFile('requests',$id);

        $requests->delete();
        return response()->json([
            'status' => true,
            'message' => 'Request Information deleted Successfully',
        ]);
    }
}
