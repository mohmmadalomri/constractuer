<?php

namespace App\Http\Resources\expense;

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
        $expense__id=$this->Attachment->expense_id;
        return [
            'id' => $this->id,
            'documents' => url('attachments/documents/expense/'.$expense__id.'/'.$this->attachment_id.'/'. $this->document),
        ];
    }
}
