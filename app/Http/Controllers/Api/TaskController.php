<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class TaskController extends Controller
{

    public function index()
    {

        $tasks = Task::with('project', 'team')->get();


        return response()->json([
            'tasks' => $tasks
        ], 200);
    }


    public function store(StoreTaskRequest $request)
    {
        try {
            $data['name'] = $request->name;
            $data['describe'] = $request->describe;
            $data['project_id'] = $request->project_id;
            $data['team_id'] = $request->team_id;
            $data['start_time'] = $request->start_time ? $request->start_time : Carbon::now();
            $data['end_time'] = $request->end_time ? $request->end_time : Carbon::tomorrow();
            $data['status'] = $request->status;
            $data['location'] = $request->location;
            $data['client_id'] = $request->client_id;
            $data['total_price'] = $request->total_price;
            $data['total_expenses'] = $request->total_expenses;
            $data['total_value'] = $request->total_value;

            $task = Task::create($data);

            return response()->json([
                'status' => true,
                'data' => $task,
                'message' => 'Task added successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error creating task: ' . $e->getMessage(),
            ],502);
        }


    }

    public function show($id)
    {

        $task = Task::with('project', 'team')->find($id);
        return response()->json([
            'task' => $task
        ], 200);
    }


    public function update(UpdateTaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        if ($task) {
            $data['name'] = $request->name ? $request->name : $task->name;
            $data['describe'] = $request->describe ? $request->describe : $task->describe;
            $data['project_id'] = $request->project_id ? $request->project_id : $task->project_id;
            $data['team_id'] = $request->team_id ? $request->team_id : $task->team_id;
            $data['start_time'] = $request->start_time ? $request->start_time : $task->start_time;
            $data['end_time'] = $request->end_time ? $request->end_time : $task->end_time;
            $data['status'] = $request->status ? $request->status : $task->status;

            $data['location'] = $request->location ? $request->location : $task->location;
            $data['client_id'] = $request->client_id ? $request->client_id : $task->client_id;
            $data['total_price'] = $request->total_price ? $request->total_price : $task->total_price;
            $data['total_expenses'] = $request->total_expenses ? $request->total_expenses : $task->total_expenses;
            $data['total_value'] = $request->total_value ? $request->total_value : $task->total_value;

            $task->update($data);
            return response()->json([
                'status' => true,
                'data' => $task,
                'message' => 'Task Updated Successfully',
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $Task = Task::find($id);
        if (!$Task) {
            return response()->json([
                'status' => false,
                'message' => 'not found Task',
            ],502);
        }
        $Task->delete();
        return response()->json([
            'status' => true,
            'message' => 'Task Information deleted Successfully',
        ]);
    }
}
