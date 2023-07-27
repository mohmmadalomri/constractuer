<?php

namespace App\Http\Resources\invoice;

use Illuminate\Http\Resources\Json\JsonResource;

class AttachmentImagesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        $invoice_id=$this->Attachment->invoice_id;
        return [
            'id' => $this->id,
            'image' => url('attachments/images/invoice/'.$invoice_id.'/'.$this->attachment_id.'/'. $this->image_path),
        ];
    }
}
