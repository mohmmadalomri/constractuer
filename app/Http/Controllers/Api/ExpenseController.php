<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExpenseResource;
use App\Http\Traits\ImageTrait;
use App\Models\Attachment;
use App\Models\AttachmentDocument;
use App\Models\AttachmentImage;
use App\Models\AttachmentVideo;
use Illuminate\Http\Request;
use App\Models\Expense;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    use ImageTrait;

    public function index()
    {
        return response()->json([
            'status'=>true,
            'Expenses' => ExpenseResource::collection(Expense::get())
        ]);
    }

    public function show($id)
    {
        $expense = Expense::with('client')->find($id);
        if (!$expense){
            return response()->json([
                'status' => false,
                'message' => 'not found id',
            ],502);
        }
        return response()->json([
            'status' => true,
            'expense' => new ExpenseResource(Expense::find($id))
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $data['title'] = $request->title;
            $data['accounting_code'] = $request->accounting_code;
            $data['describe'] = $request->describe;
            $data['date'] = $request->date;
            $data['time'] = $request->time;
            $data['value'] = $request->value;
            $data['status'] = $request->status;
            $data['address'] = $request->address;
            $data['job_title'] = $request->job_title;
            $data['in_progress'] = $request->in_progress;
            $data['total_expenses'] = $request->total_expenses;
            $data['total_salary_paid'] = $request->total_salary_paid;
            $data['project_id'] = $request->project_id;
            $data['task_id'] = $request->task_id;
            $data['company_id'] = $request->company_id;
            $data['client_id'] = $request->client_id;
            $data['team_id'] = $request->team_id;
            $data['job_id'] = $request->job_id;
            $data['employee_id'] = $request->employee_id;
            $expense = Expense::create($data);
            if ($request->hasfile('image')) {
                $expense_image = $this->saveImage($request->image, 'attachments/expense/'.$expense->id);
                $expense->image = $expense_image;
                $expense->save();
            }

            if($request->hasfile('images')||$request->hasfile('videos')||$request->hasfile('documents')) {
                $Attachment = new Attachment();
                $Attachment->expense_id = $expense->id;
                $Attachment->save();

                // insert video
                if ($request->hasfile('videos')) {
                    foreach ($request->file('videos') as $value){
                        $video_path = $this->saveImage($value, 'attachments/videos/expense/'.$expense->id .'/'. $Attachment->id);
                        // insert in ExpenseMedia
                        $image = new AttachmentVideo();
                        $image->attachment_id = $Attachment->id;
                        $image->video_path = $video_path;
                        $image->save();
                    }
                }
                // insert img
                if ($request->hasfile('images')) {
                    foreach ($request->file('images') as $value){
                        $image_path = $this->saveImage($value, 'attachments/images/expense/'.$expense->id .'/'. $Attachment->id);
                        // insert in ExpenseMedia
                        $image = new AttachmentImage();
                        $image->attachment_id = $Attachment->id;
                        $image->image_path = $image_path;
                        $image->save();
                    }
                }

                // insert img
                if ($request->hasfile('documents')) {
                    foreach ($request->file('documents') as $value){
                        $document_path = $this->saveImage($value, 'attachments/documents/expense/'.$expense->id .'/'. $Attachment->id);
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
            'massage' => 'expense add successfully',
            'expense' => new ExpenseResource(Expense::find($expense->id))
        ],201);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $expense = Expense::find($id);
            if (!$expense){
                return response()->json([
                    'status' => false,
                    'message' => 'not found id',
                ],502);
            }

            $data['title'] = $request->title;
            $data['accounting_code'] = $request->accounting_code;
            $data['describe'] = $request->describe;
            $data['date'] = $request->date;
            $data['time'] = $request->time;
            $data['value'] = $request->value;
            $data['status'] = $request->status;
            $data['address'] = $request->address;
            $data['job_title'] = $request->job_title;
            $data['in_progress'] = $request->in_progress;
            $data['total_expenses'] = $request->total_expenses;
            $data['total_salary_paid'] = $request->total_salary_paid;
            $data['project_id'] = $request->project_id;
            $data['task_id'] = $request->task_id;
            $data['company_id'] = $request->company_id;
            $data['client_id'] = $request->client_id;
            $data['team_id'] = $request->team_id;
            $data['job_id'] = $request->job_id;
            $data['employee_id'] = $request->employee_id;
            $expense->update($data);

            if($request->hasfile('images')||$request->hasfile('videos')||$request->hasfile('documents')) {
                $Attachment = new Attachment();
                $Attachment->expense_id = $expense->id;
                $Attachment->save();

                // insert video
                if ($request->hasfile('videos')) {
                    foreach ($request->file('videos') as $value){
                        $video_path = $this->saveImage($value, 'attachments/videos/expense/'.$expense->id .'/'. $Attachment->id);
                        // insert in ExpenseMedia
                        $image = new AttachmentVideo();
                        $image->attachment_id = $Attachment->id;
                        $image->video_path = $video_path;
                        $image->save();
                    }
                }
                // insert img
                if ($request->hasfile('images')) {
                    foreach ($request->file('images') as $value){
                        $image_path = $this->saveImage($value, 'attachments/images/expense/'.$expense->id .'/'. $Attachment->id);
                        // insert in ExpenseMedia
                        $image = new AttachmentImage();
                        $image->attachment_id = $Attachment->id;
                        $image->image_path = $image_path;
                        $image->save();
                    }
                }

                // insert img
                if ($request->hasfile('documents')) {
                    foreach ($request->file('documents') as $value){
                        $document_path = $this->saveImage($value, 'attachments/documents/expense/'.$expense->id .'/'. $Attachment->id);
                        // insert in ExpenseMedia
                        $image = new AttachmentDocument();
                        $image->attachment_id = $Attachment->id;
                        $image->document = $document_path;
                        $image->save();
                    }
                }
            }

            if ($request->hasfile('image')) {
                $this->deleteFile('expense', $id);
                $expense_image = $this->saveImage($request->image, 'attachments/expense/'.$id);
                $expense->image = $expense_image;
                $expense->save();
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
                'massage' => 'expense updated successfully',
                'expense' => new ExpenseResource(Expense::find($id))
            ]);
    }

    public function destroy($id)
    {
        $expense = Expense::find($id);
        if (!$expense){
            return response()->json([
                'status' => false,
                'message' => 'not found id',
            ],502);
        }

        $id_attachment=$expense->attachments()->first();

        if ($id_attachment){
            #Images_Delete
            $images=AttachmentImage::where('attachment_id',$id_attachment->id)->first();
            if ($images){
                $this->deleteFile('images/expense',$id.'/'.$id_attachment->id);
                $images->delete();
            }
            #Document_Delete
            $Documents=AttachmentDocument::where('attachment_id',$id_attachment->id)->first();
            if ($Documents){
                $this->deleteFile('documents/expense',$id.'/'.$id_attachment->id);
                $Documents->delete();
            }
            #Video_Delete
            $videos=AttachmentVideo::where('attachment_id',$id_attachment->id)->first();
            if ($videos){
                $this->deleteFile('videos/expense',$id.'/'.$id_attachment->id);
                $videos->delete();
            }

            $id_attachment->delete();
        }

        $this->deleteFile('expense', $id);
        $expense->delete();
        return response()->json([
            'status' => true,
            'message' => 'Expense Information deleted Successfully',
        ]);
    }
}
