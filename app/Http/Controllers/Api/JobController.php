<?php

namespace App\Http\Controllers\API;
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
        return response()->json($jobs);
    }

    public function store(StorejobRequest $request)
    {

        $data['client_id'] =$request->client_id;
        $data['title'] = $request->title;
        $data['instruction'] = $request->instruction;
        $data['start_day'] = $request->start_day;
        $data['end_day'] = $request->end_day;
        $data['start_time'] = $request->start_time;
        $data['end_time'] = $request->end_time;
        $data['subtotal'] = $request->subtotal;
        $data['arrival_window'] = $request->arrival_window;
        $data['company_id'] = $request->company_id;


            $jobs=Job::create($data);
            return response()->json([
                'status'=>true,
                'date' =>$jobs,
                'message' => 'invoices Information Added Successfully',
            ]);
    }

    public function show(Request $request)
    {
        $job = Job::findOrFail($request->id);
        return response()->json($job);
    }


    public function update(UpdatejobRequest $request, $id)
    {
        $job = Job::findOrFail($id);
        if($job){

            $data['client_id']  = $request->client_id ? $request->client_id : $job->client_id;
            $data['title']  = $request->title ? $request->title : $job->title;
            $data['instruction']  = $request->instruction ? $request->instruction : $job->instruction;
            $data['start_day']  = $request->start_day ? $request->start_day : $job->start_day;
            $data['end_day']  = $request->end_day ? $request->end_day : $job->end_day;
            $data['start_time']  = $request->start_time ? $request->start_time : $job->start_time;
            $data['end_time']  = $request->end_time ? $request->end_time : $job->end_time;
            $data['subtotal']  = $request->subtotal ? $request->subtotal : $job->subtotal;
            $data['arrival_window']  = $request->arrival_window ? $request->arrival_window : $job->arrival_window;
            $data['company_id']  = $request->company_id ? $request->company_id : $job->company_id;

            $job->update($data);
            return response()->json([
                'status'=>true,
                'data' => $job,
                'message' => 'invoices Information Updated Successfully',
            ]);
            
        }

            
        }

    public function destroy($id)
    {
        Job::find($id)->delete();
        return response()->json([
        'status'=>true,
        'message' => 'job Information deleted Successfully',
        ]);
    }
    
}