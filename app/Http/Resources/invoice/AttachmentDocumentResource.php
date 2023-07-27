<?php

namespace App\Http\Resources\invoice;

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
        $invoice_id=$this->Attachment->invoice_id;
        return [
            'id' => $this->id,
            'documents' => url('attachments/documents/invoice/'.$invoice_id.'/'.$this->attachment_id.'/'. $this->document),
        ];
    }
}
