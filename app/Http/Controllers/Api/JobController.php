<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StorejobRequest;
use App\Http\Requests\UpdatejobRequest;
use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{

    public function index()
    {
        $jobs = Job::all();

        return response()->json([
            'jops' => $jobs
        ], 200);
    }

    public function store(Request $request)
    {
        $data['client_id'] = $request->client_id;
        $data['title'] = $request->title;
        $data['instruction'] = $request->instruction;
        $data['start_day'] = $request->start_day;
        $data['end_day'] = $request->end_day;
        $data['start_time'] = $request->start_time;
        $data['end_time'] = $request->end_time;
        $data['subtotal'] = $request->subtotal;
        $data['arrival_window'] = $request->arrival_window;
        $data['company_id'] = $request->company_id;
        $data['project_id'] = $request->project_id;
        $data['employee_id'] = $request->employee_id;
        $data['total_value'] = $request->total_value;
        $data['total_expenses'] = $request->total_expenses;
        $data['total_salaries'] = $request->total_salaries;
        $data['in_progress'] = $request->in_progress;
        $jobs = Job::create($data);
        $jobs->items()->syncWithoutDetaching($request->input('item_id'));
        $jobs->teams()->syncWithoutDetaching($request->input('team_id'));
        return response()->json([
            'status' => true,
            'date' => $jobs,
            'message' =>'Job Information Added Successfully',
        ]);
    }

    public function show($id)
    {
        $job = Job::with(['project_id','client_id'])->find($id);
        return response()->json($job);
    }


    public function update(UpdatejobRequest $request, $id)
    {
        $job = Job::findOrFail($id);
        if ($job) {
            $data['client_id'] = $request->client_id ? $request->client_id : $job->client_id;
            $data['title'] = $request->title ? $request->title : $job->title;
            $data['instruction'] = $request->instruction ? $request->instruction : $job->instruction;
            $data['start_day'] = $request->start_day ? $request->start_day : $job->start_day;
            $data['end_day'] = $request->end_day ? $request->end_day : $job->end_day;
            $data['start_time'] = $request->start_time ? $request->start_time : $job->start_time;
            $data['end_time'] = $request->end_time ? $request->end_time : $job->end_time;
            $data['subtotal'] = $request->subtotal ? $request->subtotal : $job->subtotal;
            $data['arrival_window'] = $request->arrival_window ? $request->arrival_window : $job->arrival_window;
            $data['company_id'] = $request->company_id ? $request->company_id : $job->company_id;
            $data['project_id'] = $request->project_id ? $request->project_id : $job->project_id;
            $data['employee_id'] = $request->employee_id ? $request->employee_id : $job->employee_id;
            $data['total_value'] = $request->total_value ? $request->total_value : $job->total_value;
            $data['total_expenses'] = $request->total_expenses ? $request->total_expenses : $job->total_expenses;
            $data['total_salaries'] = $request->total_salaries ? $request->total_salaries : $job->total_salaries;
            $data['in_progress'] = $request->in_progress ? $request->in_progress : $job->in_progress;
            $job->update($data);
            $job->items()->syncWithoutDetaching($request->input('item_id'));
            $job->teams()->syncWithoutDetaching($request->input('team_id'));

        }
        return response()->json([
            'status' => true,
            'data' => $job,
            'message' => 'invoices Information Updated Successfully',
        ]);

    }

    public function destroy($id)
    {
        $Job=Job::find($id);
        $Job->items()->detach($id);
        $Job->teams()->detach($id);

        $Job->delete();
        return response()->json([
            'status' => true,
            'message' => 'job Information deleted Successfully',
        ]);
    }

}
