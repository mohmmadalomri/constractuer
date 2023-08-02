<?php

namespace App\Http\Resources\invoice;

use Illuminate\Http\Resources\Json\JsonResource;

class AttachmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
//        $invoice_id=$this->Attachment->invoice_id;
        return [
            'id' => $this->id,
            'invoice_id' => $this->invoice_id,
//            'video'=>url('attachments/video/invoice/'.$this->invoice_id.'/'.$this->id.'/'.$this->video),
            'videos' =>AttachmentVideosResource::collection($this->Videos),
            'images' =>AttachmentImagesResource::collection($this->Images),
            'documents' =>AttachmentDocumentResource::collection($this->Documents)
        ];
    }
}
