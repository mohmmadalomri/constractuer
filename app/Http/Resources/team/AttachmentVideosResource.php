<?php

namespace App\Http\Resources\team;

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
        $team_id=$this->Attachment->team_id;
        return [
            'id' => $this->id,
            'video' => url('attachments/videos/team/'.$team_id.'/'.$this->attachment_id.'/'. $this->video_path),
        ];
    }
}
