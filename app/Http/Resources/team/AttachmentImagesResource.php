<?php

namespace App\Http\Resources\team;

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
        $team__id=$this->Attachment->team_id;
        return [
            'id' => $this->id,
            'image' => url('attachments/images/team/'.$team__id.'/'.$this->attachment_id.'/'. $this->image_path),
        ];
    }
}
