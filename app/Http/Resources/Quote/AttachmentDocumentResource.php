<?php

namespace App\Http\Resources\quote;

use Illuminate\Http\Resources\Json\JsonResource;

class AttachmentDocumentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function   toArray($request): array
    {
        $quote__id=$this->Attachment->quote_id;
        return [
            'id' => $this->id,
            'documents' => url('attachments/documents/quote/'.$quote__id.'/'.$this->attachment_id.'/'. $this->document),
        ];
    }
}
