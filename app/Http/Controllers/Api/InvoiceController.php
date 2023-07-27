<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Resources\invoice\AttachmentResource;
use App\Http\Traits\ImageTrait;
use App\Models\Attachment;
use App\Models\AttachmentDocument;
use App\Models\AttachmentImage;
use App\Models\Invoice;
use App\Models\User;
use App\Notifications\InvoiceNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class InvoiceController extends Controller
{
    use ImageTrait;

    public function index()
    {
        $invoices = Invoice::with('client', 'items','company','tax','signature','paymentschedule')->get();
        return response()->json([
            'attachments'=>AttachmentResource::collection(Attachment::where('invoice_id','!=',null)->get()),
            'invoices' => $invoices,
        ]);
    }

    public function store(StoreInvoiceRequest $request)
    {
        DB::beginTransaction();
        try {
            $data['title'] = $request->title;
            $data['issued_date'] = $request->issued_date;
            $data['due_date'] = $request->due_date;
            $data['payment'] = $request->payment;
            $data['message'] = $request->message;
            $data['subtotal'] = $request->subtotal;
            $data['total'] = $request->total;
            $data['payment_due'] = $request->payment_due;
            $data['status'] = $request->status;
            $data['tax_id'] = $request->tax_id;
            $data['paymentSchedule_id'] = $request->paymentSchedule_id;
            $data['signature_id'] = $request->signature_id;
            $data['request_id'] = $request->request_id;
            $data['company_id'] = $request->company_id;
            $data['discount_id'] = $request->discount_id;
            $data['client_id'] = $request->client_id;

            $invoices = Invoice::create($data);
            if ($request->hasfile('image')) {
                $invoices_image = $this->saveImage($request->image, 'attachments/invoices/'.$invoices->id);
                $invoices->image = $invoices_image;
                $invoices->save();
            }

            $users=User::where('id','!=',auth()->user()->id)->get();
            $user_create=auth()->user()->name;
            Notification::send($users,new InvoiceNotification($invoices->id,$user_create,$request->title));

            if($request->hasfile('images')||$request->hasfile('video')||$request->hasfile('documents')) {
                $Attachment = new Attachment();
                $Attachment->invoice_id = $invoices->id;
                $Attachment->save();

                // insert video
                if ($request->hasfile('video')) {
                    $video_path = $this->saveImage($request->video, 'attachments/video/invoice/'.$invoices->id .'/'.$Attachment->id);
                    $Attachment->video = $video_path;
                    $Attachment->save();
                }

                // insert img
                if ($request->hasfile('images')) {
                    foreach ($request->file('images') as $value){
                        $image_path = $this->saveImage($value, 'attachments/images/invoice/'.$invoices->id .'/'. $Attachment->id);
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
                        $document_path = $this->saveImage($value, 'attachments/documents/invoice/'.$invoices->id .'/'. $Attachment->id);
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

        $attachments= $invoices->attachments()->first();
        if(!$attachments){
            return response()->json([
                'message' => 'created successfully',
                'invoices' => $invoices,
                'attachments'=>[],
            ], 201);
        }else{
            return response()->json([
                'message' => 'created successfully',
                'invoices' => $invoices,
                'attachments'=>new AttachmentResource($attachments),
            ],201);
        }




    }


    public function update(StoreInvoiceRequest $request, $id)
    {
        $invoices = Invoice::find($id);
        if ($invoices) {
            $data['title'] = $request->title;
            $data['issued_date'] = $request->issued_date;
            $data['due_date'] = $request->due_date;
            $data['payment'] = $request->payment;
            $data['message'] = $request->message;
            $data['subtotal'] = $request->subtotal;
            $data['total'] = $request->total;
            $data['payment_due'] = $request->payment_due;
            $data['status'] = $request->status;
            $data['tax_id'] = $request->tax_id;
            $data['paymentSchedule_id'] = $request->paymentSchedule_id;
            $data['signature_id'] = $request->signature_id;
            $data['request_id'] = $request->request_id;
            $data['company_id'] = $request->company_id;
            $data['discount_id'] = $request->discount_id;
            $data['client_id'] = $request->client_id;

            $invoices->update($data);
            if ($request->hasfile('image')) {
                $this->deleteFile('invoices',$id);
                $invoices_image = $this->saveImage($request->image, 'attachments/invoices/'.$id);
                $invoices->image = $invoices_image;
                $invoices->save();
            }
            return response()->json([
                'status' => true,
                'data' => $invoices,
                'message' => 'Invoices Information Updated Successfully',
            ]);
        }else{
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Not Found Id',
            ],502);
        }
    }

    public function show($id)
    {
        $invoice = Invoice::with('client','items')->find($id);
        if (!$invoice) {
            return response()->json([
                'status' => false,
                'message' => 'not found id',
            ],502);
        }
        $attachments= $invoice->attachments()->first();
        if(!$attachments){
            return response()->json([
                'message' => 'Show by Id successfully',
                'invoice' => $invoice,
                'attachments'=>[],
            ], 201);
        }else{
            return response()->json([
                'message' => 'Show by Id successfully',
                'invoice' => $invoice,
                'attachments'=>new AttachmentResource($attachments),
            ],201);
        }

    }

    public function destroy($id)
    {
        $invoice = Invoice::find($id);
        if (!$invoice) {
            return response()->json([
                'status' => false,
                'message' => 'not found id',
            ],502);
        }
        $id_attachment=$invoice->attachments()->first();
        if ($id_attachment){
            #Images_Delete
            $images=AttachmentImage::where('attachment_id',$id_attachment->id)->first();
            if ($images){
                $this->deleteFile('images/invoice',$id.'/'.$id_attachment->id);
                $images->delete();
            }
            #Document_Delete
            $Documents=AttachmentDocument::where('attachment_id',$id_attachment->id)->first();
            if ($Documents){
                $this->deleteFile('documents/invoice',$id.'/'.$id_attachment->id);
                $Documents->delete();
            }
            #Video_Delete
            $this->deleteFile('video/invoice',$id.'/'.$id_attachment->id);
            $id_attachment->delete();
        }
        $this->deleteFile('invoices', $id);
        $invoice->delete();
        Invoice::where('id', $id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'Invoices Information deleted Successfully',
        ]);
    }

}
