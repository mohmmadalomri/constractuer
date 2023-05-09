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
        $teams =Team::all();
        return response()->json($teams);
    }


    public function store(StoreTeamRequest $request)
    {
        $data['name'] = $request->name ;
        $data['describe'] = $request->describe ;
        $data['supervisor_id'] = $request->supervisor_id ;
        $data['company_id'] = $request->company_id ;

        $team = Team::create($data);
        return response()->json([
            'status'=>true,
            'date' =>$team,
            'message' => 'Team  Added Successfully',
        ]);


    }

    public function show(Request $request)
    {
        $team = Team::findOrFail($request->id);
        return response()->json($team);
    }


    public function update(Request $request, $id)
    {
            $team = Team::findOrFail($id);
            if($team)
            {
                $data['name'] = $request->name ? $request->name : $team->name;
                $data['describe'] = $request->describe ? $request->describe : $team->describe ;
                $data['supervisor_id'] = $request->supervisor_id ? $request->supervisor_id : $team->supervisor_id;
                $data['company_id'] = $request->company_id ? $request->company_id : $team->company_id  ;

                if ($request->file('image'))
                {
                    if ($team->image != '')
                    {
                        if (File::exists('storage/team_image/' . $team->image))
                        {
                            unlink('storage/team_image/' . $team->image);
                        }
                        $team_image = $request->file('image')->store('team_image','public');
                        $data['image']  =$team_image;
                    }

                }
                $team->update($data);
                return response()->json([
                    'status'=>true,
                    'date' =>$team,
                    'message' => 'Team  Update Successfully',
                ]);
            }
    }


    public function destroy($id)
    {
        Team::find($id)->delete();
        return response()->json([
            'status'=>true,
            'message' => 'Team deleted Successfully',
        ]);
    }
}
