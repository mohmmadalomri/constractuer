<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Traits\ImageTrait;
use App\Models\Project;
use Illuminate\Http\Request;

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


    public function store(Request $request)
    {
        // Step 1: Validate Input Data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'describe' => 'string',
            'budget' => 'string', // Assuming a minimum of 6 characters for the password.
            'total_price' => 'integer',
            'profit' => 'string',
            'image' => '',
            'start_time' => 'date',
            'end_time' => 'date',
            'status' => 'string',
            'supervisor_id' => 'required|integer',
            'company_id' => 'required|integer',
            'client_id' => 'required|integer',
            ]);

        $project = project::create($validatedData);


        if ($request->hasfile('image')) {
            $Image_dir=$this->saveImage($request->image, 'attachments/projects/'.$project->id);
            $project->image = $Image_dir;
            $project->save();
        }
        $project->teams()->syncWithoutDetaching($request->input('team_id'));

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
        // Step 1: Validate Input Data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'describe' => 'string',
            'budget' => 'string', // Assuming a minimum of 6 characters for the password.
            'total_price' => 'integer',
            'profit' => 'string',
            'image' => '',
            'start_time' => 'date',
            'end_time' => 'date',
            'status' => 'string',
            'supervisor_id' => 'required|integer',
            'company_id' => 'required|integer',
            'client_id' => 'required|integer',
        ]);
        $project->update($validatedData);

        if ($request->hasfile('image')) {
            $this->deleteFile('projects',$id);
            $Image_dir=$this->saveImage($request->image, 'attachments/projects/'.$id);
            $project->image = $Image_dir;
            $project->save();
        }
        $project->image = url('attachments/projects/'.$project->id .'/'. $project->image);
        $project->teams()->syncWithoutDetaching($request->input('team_id'));

        return response()->json([
            'status' => true,
            'data' => $project,
            'message' => 'project Information Updated Successfully',
        ]);

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
