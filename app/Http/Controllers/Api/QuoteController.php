<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\StoreQuoteRequest;
use App\Http\Requests\UpdateQuoteRequest;
use App\Http\Resources\quote\AttachmentResource;
use App\Http\Traits\ImageTrait;
use App\Models\Attachment;
use App\Models\AttachmentDocument;
use App\Models\AttachmentImage;
use App\Models\AttachmentVideo;
use App\Models\Quote;
use App\Models\User;
use App\Notifications\QuoteNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class QuoteController extends Controller
{
    use ImageTrait;

    public function index()
    {
        $quotes = Quote::all();
        return response()->json([
            'attachments'=>AttachmentResource::collection(Attachment::where('quote_id','!=',null)->get()),
            'quotes' => $quotes
        ], 200);
    }

    public function store(StoreQuoteRequest $request)
    {
        DB::beginTransaction();
        try {
            $data['title'] = $request->title;
            $data['message'] = $request->message;
            $data['subtotal'] = $request->subtotal;
            $data['offer_price_massage'] = $request->offer_price_massage;
            $data['total'] = $request->total;
            $data['date'] = $request->date;
            $data['note'] = $request->note;
            $data['status'] = $request->status;
            $data['discount_id'] = $request->discount_id;
            $data['company_id'] = $request->company_id;
            $data['client_id'] = $request->client_id;
            $data['signature_id'] = $request->signature_id;
            $data['tax_id'] = $request->tax_id;
            $quote = Quote::create($data);
            if ($request->hasfile('image')) {
                $quote_image = $this->saveImage($request->image, 'attachments/quote/'.$quote->id);
                $quote->image = $quote_image;
                $quote->save();
            }
            $quote->items()->syncWithoutDetaching($request->input('item_id'));
            $quote->paymentschedules()->syncWithoutDetaching($request->input('paymentSchedule_id'));

            $users=User::where('id','!=',auth()->user()->id)->get();
            $user_create=auth()->user()->name;
            Notification::send($users,new QuoteNotification($quote->id,$user_create,$request->title));


            #attachements
            if($request->hasfile('images')||$request->hasfile('videos')||$request->hasfile('documents')) {
                $Attachment = new Attachment();
                $Attachment->quote_id = $quote->id;
                $Attachment->save();

                // insert video
                if ($request->hasfile('videos')) {
                    foreach ($request->file('videos') as $value){
                        $video_path = $this->saveImage($value, 'attachments/videos/Quote/'.$quote->id .'/'. $Attachment->id);
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
                        $image_path = $this->saveImage($value, 'attachments/images/Quote/'.$quote->id .'/'. $Attachment->id);
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
                        $document_path = $this->saveImage($value, 'attachments/documents/Quote/'.$quote->id .'/'. $Attachment->id);
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
        $attachments= $quote->attachments()->first();
        if(!$attachments){
            return response()->json([
                'message' => 'created successfully',
                'quote' => $quote,
                'attachments'=>[],
            ], 201);
        }else{
            return response()->json([
                'message' => 'created successfully',
                'quote' => $quote,
                'attachments'=>new AttachmentResource($attachments),
            ],201);
        }
    }

    public function show($id)
    {
        $quote = Quote::find($id);
        if(!$quote){
            return response()->json([
                'status' => false,
                'message' => 'not found id',
            ],502);
        }
        $attachments= $quote->attachments()->first();
        if(!$attachments){
            return response()->json([
                'message' => 'Show by Id successfully',
                'quote' => $quote,
                'attachments'=>[],
            ], 201);
        }else{
            return response()->json([
                'message' => 'Show by Id successfully',
                'quote' => $quote,
                'attachments'=>new AttachmentResource($attachments),
            ],201);
        }
    }

    public function update(StoreQuoteRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $quote = Quote::find($id);
            if ($quote) {
                $data['title'] = $request->title;
                $data['message'] = $request->message;
                $data['subtotal'] = $request->subtotal;
                $data['offer_price_massage'] = $request->offer_price_massage;
                $data['total'] = $request->total;
                $data['date'] = $request->date;
                $data['note'] = $request->note;
                $data['status'] = $request->status;
//            $data['paymentSchedule_id'] = $request->paymentSchedule_id;
                $data['discount_id'] = $request->discount_id;
                $data['item_id'] = $request->item_id;
                $data['company_id'] = $request->company_id;
                $data['client_id'] = $request->client_id;
                $data['signature_id'] = $request->signature_id;
                $data['tax_id'] = $request->tax_id;
                $quote->update($data);

                $quote->items()->syncWithoutDetaching($request->input('item_id'));
                $quote->paymentschedules()->syncWithoutDetaching($request->input('paymentSchedule_id'));

                #attachements
                if($request->hasfile('images')||$request->hasfile('video')||$request->hasfile('documents')) {
                    $Attachment = new Attachment();
                    $Attachment->quote_id = $quote->id;
                    $Attachment->save();

                    // insert video
                    if ($request->hasfile('videos')) {
                        foreach ($request->file('videos') as $value){
                            $video_path = $this->saveImage($value, 'attachments/videos/Quote/'.$quote->id .'/'. $Attachment->id);
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
                            $image_path = $this->saveImage($value, 'attachments/images/Quote/'.$quote->id .'/'. $Attachment->id);
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
                            $document_path = $this->saveImage($value, 'attachments/documents/Quote/'.$quote->id .'/'. $Attachment->id);
                            // insert in ExpenseMedia
                            $image = new AttachmentDocument();
                            $image->attachment_id = $Attachment->id;
                            $image->document = $document_path;
                            $image->save();
                        }
                    }
                }


                if ($request->hasfile('image')) {
                    $this->deleteFile('quote', $id);
                    $quote_image = $this->saveImage($request->image, 'attachments/quote/'.$id);
                    $quote->image = $quote_image;
                    $quote->save();
                }

                DB::commit();  // insert data
                return response()->json([
                    'status' => true,
                    'date' => $quote,
                    'message' => 'Quote  Update Successfully',
                ],201);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'not found id',
                ],502);
            }
        }catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'en' => 'Error System',
                'ar' => 'يوجد خطأ بالنظام',
                'error'=>$e->getMessage()
            ],502);
        }


    }

    public function destroy($id)
    {
        $Quote = Quote::find($id);
        if (!$Quote) {
            return response()->json([
                'status' => false,
                'message' => 'not found id',
            ],502);
        }

        $id_attachment=$Quote->attachments()->first();
        if ($id_attachment){
            #Images_Delete
            $images=AttachmentImage::where('attachment_id',$id_attachment->id)->first();
            if ($images ){
                $this->deleteFile('images/Quote',$id.'/'.$id_attachment->id);
                $images->delete();
            }
            #Document_Delete
            $Documents=AttachmentDocument::where('attachment_id',$id_attachment->id)->first();
            if ($Documents){
                $this->deleteFile('documents/Quote',$id.'/'.$id_attachment->id);
                $Documents->delete();
            }

            #Video_Delete
            $videos=AttachmentVideo::where('attachment_id',$id_attachment->id)->first();
            if ($videos){
                $this->deleteFile('videos/Quote',$id.'/'.$id_attachment->id);
                $videos->delete();
            }
            $id_attachment->delete();
        }
        $this->deleteFile('quote', $id);
        $Quote->items()->detach();
        $Quote->paymentschedules()->detach();
        $Quote->delete();
        Quote::where('id', $id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'Quotes Information deleted Successfully',
        ]);

    }
}
