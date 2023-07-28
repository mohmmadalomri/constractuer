<?php

namespace App\Http\Resources\quote;

use Illuminate\Http\Resources\Json\JsonResource;

class AttachmentImagesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function  toArray($request): array
    {
        $quote__id=$this->Attachment->quote_id;
        return [
            'id' => $this->id,
            'image' => url('attachments/images/quote/'.$quote__id.'/'.$this->attachment_id.'/'. $this->image_path),
        ];
    }
}
