<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Traits\ImageTrait;
use App\Models\Attachment;
use App\Models\AttachmentDocument;
use App\Models\AttachmentImage;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        DB::beginTransaction();
        try {
        $data['name'] = $request->name;
        $data['describe'] = $request->describe;
        $data['supervisor_id'] = $request->supervisor_id;
        $data['company_id'] = $request->company_id;

//        $data['employee_id'] = $request->employee_id;
        $team = Team::create($data);
        if ($request->hasfile('photo')) {
            $team_image = $this->saveImage($request->photo, 'attachments/teams/'.$team->id);
            $team->image = $team_image;
            $team->save();
        }

        //important to update player
        if(isset($request->employee_id)) {
            $team->employees()->syncWithoutDetaching($request->employee_id);
        }
        if($request->hasfile('images')||$request->hasfile('video')||$request->hasfile('document')) {
            $Attachment = new Attachment();
            $Attachment->team_id = $team->id;
            $Attachment->save();

            // insert video
            if ($request->hasfile('video')) {
                $video_path = $this->saveImage($request->video, 'attachments/video/team/'.$team->id .'/'.$Attachment->id);
                $Attachment->video = $video_path;
                $Attachment->save();
            }

            // insert img
            if ($request->hasfile('images')) {
                foreach ($request->file('images') as $value){
                    $image_path = $this->saveImage($value, 'attachments/images/team/'.$team->id .'/'. $Attachment->id);
                    // insert in ExpenseMedia
                    $image = new AttachmentImage();
                    $image->attachment_id = $Attachment->id;
                    $image->image_path = $image_path;
                    $image->save();
                }
            }

            // insert img
            if ($request->hasfile('document')) {
                foreach ($request->file('document') as $value){
                    $document_path = $this->saveImage($value, 'attachments/documents/team/'.$team->id .'/'. $Attachment->id);
                    // insert in ExpenseMedia
                    $image = new AttachmentDocument();
                    $image->attachment_id = $Attachment->id;
                    $image->document = $document_path;
                    $image->save();
                }
            }
        }
        DB::commit();  // insert data
        }catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'en' => 'Error System',
                'ar' => 'يوجد خطأ بالنظام',
                'error'=>$e->getMessage()
            ],502);
        }

        return response()->json([
            'status' => true,
            'date' => $team,
            'message' => 'Team Added Successfully',
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
        DB::beginTransaction();
        try {
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

                #Attachements
                if($request->hasfile('images')||$request->hasfile('video')||$request->hasfile('document')) {
                    $Attachment = new Attachment();
                    $Attachment->team_id = $team->id;
                    $Attachment->save();

                    // insert video
                    if ($request->hasfile('video')) {
                        $this->deleteFile('video',$id);
                        $video_path = $this->saveImage($request->video, 'attachments/video/'.$team->id .'/'.$Attachment->id);
                        $Attachment->video = $video_path;
                        $Attachment->save();
                    }

                    // insert img
                    if ($request->hasfile('images')) {
                        foreach ($request->file('images') as $value){
                            $this->deleteFile('images',$id);
                            $image_path = $this->saveImage($value, 'attachments/images/'.$team->id .'/'. $Attachment->id);
                            // insert in ExpenseMedia
                            $image = new AttachmentImage();
                            $image->attachment_id = $Attachment->id;
                            $image->image_path = $image_path;
                            $image->save();
                        }
                    }

                    // insert img
                    if ($request->hasfile('document')) {
                        foreach ($request->file('document') as $value){
                            $this->deleteFile('documents',$id);
                            $document_path = $this->saveImage($value, 'attachments/documents/'.$team->id .'/'. $Attachment->id);
                            // insert in ExpenseMedia
                            $image = new AttachmentDocument();
                            $image->attachment_id = $Attachment->id;
                            $image->document = $document_path;
                            $image->save();
                        }
                    }
                }
                DB::commit();  // insert data

            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'not found team',
                ]);
            }
        }catch (\Exception $e){
            DB::rollback();
            return response()->json([
                'status' => false,
                'en' => 'Error System',
                'ar' => 'يوجد خطأ بالنظام',
                'error'=>$e->getMessage()
            ],502);
        }
        return response()->json([
            'status' => true,
            'date' => $team,
            'message' => 'Team  Update Successfully',
        ]);

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

        $id_attachment=$team->attachment()->first();
        if ($id_attachment){
            #Images_Delete
            $images=AttachmentImage::where('attachment_id',$id_attachment->id)->first();
            if ($images){
                $this->deleteFile('images/team',$id.'/'.$id_attachment->id);
                $images->delete();
            }
            #Document_Delete
            $Documents=AttachmentDocument::where('attachment_id',$id_attachment->id)->first();
            if ($Documents){
                $this->deleteFile('documents/team',$id.'/'.$id_attachment->id);
                $Documents->delete();
            }
            #Video_Delete
            $this->deleteFile('video/team',$id.'/'.$id_attachment->id);
            $id_attachment->delete();
        }


        $this->deleteFile('teams',$id);
        $team->employees()->detach($id);
        $team->delete();

        return response()->json([
            'status' => true,
            'message' => 'team Information deleted Successfully',
        ]);

    }
}
