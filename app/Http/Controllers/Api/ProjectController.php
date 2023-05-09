<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $projects = Project::all();
        return response()->json([
            'projects' => $projects
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
        $request->file('image')->store('project_image', 'public');

        $projects = Project::create($request->all());
        return response()->json([
            'status' => true,
            'data' => $projects,
            'message' => 'Company Information Added Successfully',
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $projects = Project::findOrFail($request->id);
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
    public function update(UpdateProjectRequest $request, $id)
    {
//        $project = project::findOrFail($id);
        $project = Project::find($id);
        $data = $request->all();
        if ($project) {
            $data['name'] = $request->name ? $request->name : $project->name;
            $data['describe'] = $request->describe ? $request->describe : $project->describe;
            $data['budget'] = $request->budget ? $request->budget : $project->budget;
            $data['image'] = $request->image ? $request->image : $project->image;
            $data['supervisor_id'] = $request->supervisor_id ? $request->supervisor_id : $project->supervisor_id;
            $data['start_time'] = $request->start_time ? $request->start_time : $project->start_time;
            $data['end_time'] = $request->end_time ? $request->end_time : $project->end_time;
            $project->update($data);
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
        return response()->json([
            'status' => true,
            'message' => 'project Information deleted Successfully',
        ]);
    }
}
