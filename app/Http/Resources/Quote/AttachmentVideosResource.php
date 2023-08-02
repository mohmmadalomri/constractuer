<?php

namespace App\Http\Resources\quote;

use Illuminate\Http\Resources\Json\JsonResource;

class AttachmentVideosResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        $quote_id=$this->Attachment->quote_id;
        return [
            'id' => $this->id,
            'video' => url('attachments/videos/quote/'.$quote_id.'/'.$this->attachment_id.'/'. $this->video_path),
        ];
    }
}
