<?php

namespace App\Http\Resources\expense;

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
        $expense_id=$this->Attachment->expense_id;
        return [
            'id' => $this->id,
            'video' => url('attachments/videos/expense/'.$expense_id.'/'.$this->attachment_id.'/'. $this->video_path),
        ];
    }
}
