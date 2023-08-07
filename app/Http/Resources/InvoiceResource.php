<?php

namespace App\Http\Resources;

use App\Http\Resources\invoice\AttachmentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{

    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'title' => $this->title,
            'issued_date' => $this->issued_date,
            'due_date' => $this->due_date,
            'payment' => $this->payment,
            'message' => $this->message,
            'subtotal' => $this->subtotal,
            'payment_due' => $this->payment_due,
            'total' => $this->total,
            'status' => $this->status,
            'payment_type' => $this->payment_type,
            'paymentschedules' => $this->paymentschedules,
            'company' => $this->company,
            'client' => $this->client,
            'signature' => $this->signature,
            'tax' => $this->tax,
            'items' => $this->items,
            'attachments'=>AttachmentResource::collection($this->attachments),

        ];
    }
}
