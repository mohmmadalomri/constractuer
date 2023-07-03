<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeamRequest;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TeamController extends Controller
{

    public function index()
    {
        $teams = Team::with('supervisor', 'projects')->get();
        return response()->json([
            'teams' => $teams
        ], 200);
    }


    public function store(StoreTeamRequest $request)
    {
        $data['name'] = $request->name;
        $data['describe'] = $request->describe;
        $data['supervisor_id'] = $request->supervisor_id;
        $data['company_id'] = $request->company_id;

        $data['employee_id'] = $request->employee_id;

        $image = $request->file('image');
        $data['image'] = $this->images($image, null);
        $team = Team::create($data);
        return response()->json([
            'status' => true,
            'date' => $team,
            'message' => 'Team  Added Successfully',
        ]);


    }

    public function show($id)
    {
        $team = Team::with('supervisor', 'projects')->find($id);
        return response()->json([
            'team' => $team
        ], 200);
    }


    public function update(Request $request, $id)
    {
        $team = Team::findOrFail($id);
        if ($team) {
            $data['name'] = $request->name ? $request->name : $team->name;
            $data['describe'] = $request->describe ? $request->describe : $team->describe;
            $data['supervisor_id'] = $request->supervisor_id ? $request->supervisor_id : $team->supervisor_id;
            $data['company_id'] = $request->company_id ? $request->company_id : $team->company_id;

            $data['employee_id'] = $request->employee_id ? $request->employee_id : $team->employee_id;


            if ($request->hasFile('image')) {

                $oldimage = $team->image;
                $image = $request->file('image');
                $data['image'] = $this->images($image, $oldimage);

            }
            $team->update($data);
            return response()->json([
                'status' => true,
                'date' => $team,
                'message' => 'Team  Update Successfully',
            ]);
        }
    }


    public function destroy($id)
    {
        Team::find($id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'Team deleted Successfully',
        ]);
    }
}
