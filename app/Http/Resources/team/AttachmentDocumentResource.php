<?php

namespace App\Http\Resources\team;

use Illuminate\Http\Resources\Json\JsonResource;

class AttachmentDocumentResource extends JsonResource
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
            'documents' => url('attachments/documents/team/'.$team__id.'/'.$this->attachment_id.'/'. $this->document),
        ];
    }
}
