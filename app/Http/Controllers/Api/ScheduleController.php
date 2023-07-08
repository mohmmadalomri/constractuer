<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RequestResource;
use App\Http\Resources\TakResource;
use App\Models\Job;
use App\Models\Project;
use App\Models\Task;
use App\Models\Request;

use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ScheduleController extends Controller
{
    public function show_task($id)
    {
        try {
            $task= Task::find($id);
            if(!$task)
            {
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'Task id not found'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            return response()->json([
                'status' => true,
                'status_code'=>ResponseAlias::HTTP_OK,
                'message' => 'Task Successfully',
                'data'=>new TakResource(Task::findOrFail($id))
            ], ResponseAlias::HTTP_OK);
        }catch (\Exception $e){
            return response()->json([
                'status' => 'Error',
                'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                'message' => 'Error id',
            ], ResponseAlias::HTTP_NOT_FOUND);
        }

    }

    public function show_project($id)
    {
        try {
            $Project= Project::find($id);
            if(!$Project)
            {
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'Project id not found'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            return response()->json([
                'status' => true,
                'status_code'=>ResponseAlias::HTTP_OK,
                'message' => 'Project Successfully',
                'data'=>new TakResource(Project::findOrFail($id))
            ], ResponseAlias::HTTP_OK);
        }catch (\Exception $e){
            return response()->json([
                'status' => 'Error',
                'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                'message' => 'Error id',
            ], ResponseAlias::HTTP_NOT_FOUND);
        }

    }

    public function show_request($id)
    {
        try {
            $request= Request::find($id);
            if(!$request)
            {
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'request id not found'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            return response()->json([
                'status' => true,
                'status_code'=>ResponseAlias::HTTP_OK,
                'message' => 'request Successfully',
                'data'=>new RequestResource(Request::findOrFail($id))
            ], ResponseAlias::HTTP_OK);
        }catch (\Exception $e){
            return response()->json([
                'status' => 'Error',
                'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                'message' => 'Error id',
            ], ResponseAlias::HTTP_NOT_FOUND);
        }

    }

    public function show_job($id)
    {
        try {
            $request= Job::find($id);
            if(!$request)
            {
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'request id not found'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            return response()->json([
                'status' => true,
                'status_code'=>ResponseAlias::HTTP_OK,
                'message' => 'request Successfully',
                'data'=>new RequestResource(Job::findOrFail($id))
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
