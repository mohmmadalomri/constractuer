<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Traits\ImageTrait;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TeamController extends Controller
{
    use ImageTrait;

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

//        $data['employee_id'] = $request->employee_id;
        $team = Team::create($data);
        if ($request->hasfile('image')) {
            $team_image = $this->saveImage($request->image, 'attachments/teams/'.$team->id);
            $team->image = $team_image;
            $team->save();
        }

        //important to update player
        if(isset($request->employee_id)) {
            $team->employees()->syncWithoutDetaching($request->employee_id);
        }

        return response()->json([
            'status' => true,
            'date' => $team,
            'message' => 'Team  Added Successfully',
        ]);


    }

    public function show($id)
    {
        $team = Team::with('supervisor', 'projects')->find($id);
        if (!$team) {
            return response()->json([
                'status' => false,
                'message' => 'not found team',
            ]);
        }
        return response()->json([
            'status' => true,
            'team' => $team
        ], 200);
    }


    public function update(Request $request, $id)
    {
        $team = Team::find($id);
        if ($team) {
            $data['name'] = $request->name ? $request->name : $team->name;
            $data['describe'] = $request->describe ? $request->describe : $team->describe;
            $data['supervisor_id'] = $request->supervisor_id ? $request->supervisor_id : $team->supervisor_id;
            $data['company_id'] = $request->company_id ? $request->company_id : $team->company_id;

            $team->update($data);
            if ($request->hasfile('image')) {
                $this->deleteFile('teams',$id);
                $team_image = $this->saveImage($request->image, 'attachments/teams/'.$team->id);
                $team->image = $team_image;
                $team->save();
            }

            //important to update player
            if(isset($request->employee_id)) {
                $team->employees()->sync($request->employee_id);
            }
            return response()->json([
                'status' => true,
                'date' => $team,
                'message' => 'Team  Update Successfully',
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'not found team',
            ]);
        }
    }


    public function destroy($id)
    {
        $team = Team::find($id);
        if (!$team) {
            return response()->json([
                'status' => false,
                'message' => 'not found team',
            ]);
        }
        $this->deleteFile('teams',$id);
//        $team->employees()->detach($id);
        $team->delete();

        return response()->json([
            'status' => true,
            'message' => 'team Information deleted Successfully',
        ]);

    }
}
