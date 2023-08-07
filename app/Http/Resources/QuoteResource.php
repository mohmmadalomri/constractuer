<?php

namespace App\Http\Resources;

use App\Http\Resources\invoice\AttachmentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class QuoteResource extends JsonResource
{

    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'title' => $this->title,
            'offer_price_massage' => $this->offer_price_massage,
            'total' => $this->total,
            'message' => $this->message,
            'date' => $this->date,
            'note' => $this->note,
            'status' => $this->status,
            'payment_type' => $this->payment_type,
            'paymentschedules' => $this->paymentschedules,
            'company' => $this->company,
            'client' => $this->client,
            'discount' => $this->discount,
            'tax' => $this->tax,
            'signature' => $this->signature,
            'items' => $this->items,
            'attachments'=>AttachmentResource::collection($this->attachments),

        ];
    }
}
