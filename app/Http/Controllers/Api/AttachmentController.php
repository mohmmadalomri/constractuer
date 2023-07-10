<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\ImageTrait;
use App\Models\Attachment;
use App\Models\AttachmentDocument;
use App\Models\AttachmentImage;
use App\Models\Invoice;
use App\Models\Quote;
use App\Models\Team;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AttachmentController extends Controller
{
use ImageTrait;
    public function index()
    {
        $Attachment = Attachment::all();
        return response()->json([
            'attachments' => $Attachment
        ]);
    }


    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $rules = [
//            "images" => "required|string|min:3",
//            "documents" => "string",
//            "description" => "string",
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $response = new JsonResponse([
                    'data' => [],
                    'message' => 'Validation Error',
                    'errors' => $validator->messages()->all(),
                ], ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
                throw new ValidationException($validator, $response);
            }
            if(isset($request->team_id)) {
//                $Team = Team::find($request->team_id);
//                if(!$Team)
//                {
//                    return response()->json([
//                        'status' => 'Error',
//                        'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
//                        'message' => 'Team id id not found'
//                    ], ResponseAlias::HTTP_NOT_FOUND);
//                }
                $Attachment = new Attachment();
                $Attachment->team_id = $request->team_id;
                $Attachment->name = $request->name;
                $Attachment->save();
                // insert video
                if ($request->hasfile('video')) {
                    $video_path = $this->saveImage($request->video, 'attachments/video/'.$Attachment->id);
                    $Attachment->video = $video_path;
                    $Attachment->save();
                }
                // insert img
                if ($request->hasfile('images')) {
                    foreach ($request->file('images') as $value){
                        $image_path = $this->saveImage($value, 'attachments/images/' . $Attachment->id);
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
                        $document_path = $this->saveImage($value, 'attachments/documents/' . $Attachment->id);
                        // insert in ExpenseMedia
                        $image = new AttachmentDocument();
                        $image->attachment_id = $Attachment->id;
                        $image->document = $document_path;
                        $image->save();
                    }
                }
            }
            if(isset($request->invoice_id)) {
                $Invoice = Invoice::find($request->invoice_id);
                if(!$Invoice)
                {
                    return response()->json([
                        'status' => 'Error',
                        'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                        'message' => 'Invoice id id not found'
                    ], ResponseAlias::HTTP_NOT_FOUND);
                }
                $Attachment = new Attachment();
                $Attachment->invoice_id = $request->invoice_id;
                $Attachment->name = $request->name;
                $Attachment->save();
                // insert video
                if ($request->hasfile('video')) {
                    $video_path = $this->saveImage($request->video, 'attachments/video/'.$Attachment->id);
                    $Attachment->video = $video_path;
                    $Attachment->save();
                }

                // insert img
                if ($request->hasfile('images')) {
                    foreach ($request->file('images') as $value){
                        $image_path = $this->saveImage($value, 'attachments/images/' . $Attachment->id);
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
                        $document_path = $this->saveImage($value, 'attachments/documents/' . $Attachment->id);
                        // insert in ExpenseMedia
                        $image = new AttachmentDocument();
                        $image->attachment_id = $Attachment->id;
                        $image->document = $document_path;
                        $image->save();
                    }
                }
            }
            if(isset($request->quote_id)) {
                $quote = Quote::find($request->quote_id);
                if(!$quote)
                {
                    return response()->json([
                        'status' => 'Error',
                        'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                        'message' => 'Invoice id id not found'
                    ], ResponseAlias::HTTP_NOT_FOUND);
                }
                $Attachment = new Attachment();
                $Attachment->quote_id = $request->quote_id;
                $Attachment->name = $request->name;
                $Attachment->save();
                // insert video
                if ($request->hasfile('video')) {
                    $video_path = $this->saveImage($request->video, 'attachments/video/'.$Attachment->id);
                    $Attachment->video = $video_path;
                    $Attachment->save();
                }

                // insert img
                if ($request->hasfile('images')) {
                    foreach ($request->file('images') as $value){
                        $image_path = $this->saveImage($value, 'attachments/images/' . $Attachment->id);
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
                        $document_path = $this->saveImage($value, 'attachments/documents/' . $Attachment->id);
                        // insert in ExpenseMedia
                        $image = new AttachmentDocument();
                        $image->attachment_id = $Attachment->id;
                        $image->document = $document_path;
                        $image->save();
                    }
                }
            }
            DB::commit();  // insert data
            return response()->json([
                'status' => true,
//                'date' => $Attachment,
                'message' => 'Attachment Information Added Successfully',
            ]);
        }catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function show($id)
    {
        $Attachment = Attachment::find($id);
        if (!$Attachment) {
            return response()->json([
                'status' => False,
                'massage' => 'Not Found Id',
            ],502);
        }
        return response()->json([
            'status' => true,
            'date' => $Attachment,
        ]);
    }
######################################################???????????????????
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $rules = [
//            "images" => "required|string|min:3",
//            "documents" => "string",
//            "description" => "string",
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $response = new JsonResponse([
                    'data' => [],
                    'message' => 'Validation Error',
                    'errors' => $validator->messages()->all(),
                ], ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
                throw new ValidationException($validator, $response);
            }
            $Attachment= Attachment::find($id);
            if (!$Attachment) {
                return response()->json([
                    'status' => False,
                    'massage' => 'Not Found Id',
                ],502);
            }
            $Attachment->name = $request->name;
            $Attachment->save();
//            return $Attachment->name;

            // insert video
            if ($request->hasfile('video')) {
                $this->deleteFile('video',$id);
                $video_path = $this->saveImage($request->video, 'attachments/video/'.$Attachment->id);
                $Attachment->video = $video_path;

                $Attachment->save();
            }

            // insert img
            if ($request->hasfile('images')) {
                foreach ($request->file('images') as $value){
                    $images=AttachmentImage::where('attachment_id',$id);
                    if ($images){
                        $this->deleteFile('images',$id);
                        $images->delete();
                    }
                    $image_path = $this->saveImage($value, 'attachments/images/' . $Attachment->id);
                    // insert in ExpenseMedia
                    $image = new AttachmentImage();
                    $image->attachment_id = $Attachment->id;
                    $image->image_path = $image_path;
                    $image->save();
                }
            }

            // insert img
            if ($request->hasfile('document')) {
                $Document=AttachmentDocument::where('attachment_id',$id);
                if ($Document){
                    $this->deleteFile('documents',$id);
                    $Document->delete();
                }
                foreach ($request->file('document') as $value){
                    $document_path = $this->saveImage($value, 'attachments/documents/' . $Attachment->id);
                    // insert in ExpenseMedia
                    $image = new AttachmentDocument();
                    $image->attachment_id = $Attachment->id;
                    $image->document = $document_path;
                    $image->save();
                }
            }

            DB::commit();
            return response()->json([
                'status' => true,
                'date' => $Attachment,
                'message' => 'Attachment Information updated Successfully',
            ]);
        }catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy($id)

    {
        try {
            $Attachment= Attachment::find($id);
            if (!$Attachment) {
                return response()->json([
                    'status' => False,
                    'massage' => 'Not Found Id',
                ],502);
            }
            if ($Attachment->video)
            {
                $this->deleteFile('video',$id);
            }

            $images=AttachmentImage::where('attachment_id',$id);
            if ($images){
                $this->deleteFile('images',$id);
                $images->delete();
            }

            $Document=AttachmentDocument::where('attachment_id',$id);
            if ($Document){
                $this->deleteFile('documents',$id);
                $Document->delete();
            }

            $Attachment->delete();

            return response()->json([
                'status' => true,
                'message' => 'Attachment Deleted Successfully',
            ]);
        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


}
