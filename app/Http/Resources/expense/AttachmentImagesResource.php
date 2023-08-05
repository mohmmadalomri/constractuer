<?php

namespace App\Http\Resources\expense;

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
        $expense__id=$this->Attachment->expense_id;
        return [
            'id' => $this->id,
            'image' => url('attachments/images/expense/'.$expense__id.'/'.$this->attachment_id.'/'. $this->image_path),
        ];
    }
}
