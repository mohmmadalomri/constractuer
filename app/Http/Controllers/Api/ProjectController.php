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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {

        $projects = Project::with('company', 'supervisor', 'client', 'teams')->get();

        return response()->json([
            'projects' => $projects,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreProjectRequest $request)
    {
        $Project = Project::create($request->all());
        if ($request->hasfile('image')) {
            $Image_dir=$this->saveImage($request->image, 'attachments/projects/'.$Project->id);
            $Project->image = $Image_dir;
            $Project->save();
        }
        return response()->json([
            'status' => true,
            'data' => $Project,
            'message' => 'projects Information Added Successfully',
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $projects = Project::with('company', 'supervisor', 'client', 'teams')->find($id);
        return response()->json([
            'projects' => $projects
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
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
            return response()->json([
                'status' => true,
                'data' => $project,
                'message' => 'project Information Updated Successfully',
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
        Project::find($id)->delete();
        $this->deleteFile('projects',$id);

        return response()->json([
            'status' => true,
            'message' => 'project Information deleted Successfully',
        ]);
    }
}
