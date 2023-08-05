<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Traits\ImageTrait;
use App\Models\Project;

class ProjectController extends Controller
{
    use ImageTrait;

    public function index()
    {

        $projects = Project::with('company', 'supervisor', 'client', 'teams')->get();
        $professionWithUrls = $projects->map(function ($project) {
            $project->image = url('attachments/projects/'.$project->id .'/'. $project->image);
            return $project;
        });
        return response()->json([
            'projects' => $professionWithUrls,
        ], 200);
    }


    public function store(StoreProjectRequest $request)
    {
        $project = project::create($request->all());
        $project->teams()->syncWithoutDetaching($request->input('team_id'));

        if ($request->hasfile('image')) {
            $Image_dir=$this->saveImage($request->image, 'attachments/projects/'.$project->id);
            $project->image = $Image_dir;
            $project->save();
        }
        $project->image = url('attachments/projects/'.$project->id .'/'. $project->image);
        return response()->json([
            'status' => true,
            'data' => $project,
            'message' => 'projects Information Added Successfully',
        ]);

    }


    public function show($id)
    {
        $project = Project::with('company', 'supervisor', 'client', 'teams')->find($id);
        $project->image = url('attachments/projects/'.$project->id .'/'. $project->image);
        return response()->json([
            'projects' => $project
        ]);
    }


    public function update(StoreProjectRequest $request, $id)
    {
        $project = Project::find($id);
        if (!$project){
            return response()->json([
                'status' => false,
                'message' => 'Error  Id ',
            ],502);
        }
        $data = $request->all();
        if ($project) {
            $data['name'] = $request->name ? $request->name : $project->name;
            $data['describe'] = $request->describe ? $request->describe : $project->describe;
            $data['budget'] = $request->budget ? $request->budget : $project->budget;
            $data['supervisor_id'] = $request->supervisor_id ? $request->supervisor_id : $project->supervisor_id;
            $data['start_time'] = $request->start_time ? $request->start_time : $project->start_time;
            $data['end_time'] = $request->end_time ? $request->end_time : $project->end_time;
            $project->update($data);
            if ($request->hasfile('image')) {
                $this->deleteFile('projects',$id);
                $Image_dir=$this->saveImage($request->image, 'attachments/projects/'.$id);
                $project->image = $Image_dir;
                $project->save();
            }
            $project->image = url('attachments/projects/'.$project->id .'/'. $project->image);

            return response()->json([
                'status' => true,
                'data' => $project,
                'message' => 'project Information Updated Successfully',
            ]);
        }
    }

    public function destroy($id)
    {
        $project=  Project::find($id);
        if (!$project){
            return response()->json([
                'status' => false,
                'message' => 'not found team',
            ]);
        }
        $project->teams()->detach();
        $this->deleteFile('projects',$id);
        $project->delete();
        return response()->json([
            'status' => true,
            'message' => 'project Information deleted Successfully',
        ]);
    }
}
