<?php

namespace App\Http\Resources\team;

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
        return [
            'id' => $this->id,
            'team_id' => $this->team_id,
            'video'=>url('attachments/video/team/'.$this->team_id.'/'.$this->id.'/'.$this->video),
            'images' =>AttachmentImagesResource::collection($this->Images),
            'documents' =>AttachmentDocumentResource::collection($this->Documents)
        ];
    }
}
