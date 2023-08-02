<?php

namespace App\Http\Resources\quote;

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
            'quote_id' =>  $this->quote_id,
//            'video'=>url('attachments/video/quote/'.$this->quote_id.'/'.$this->id.'/'.$this->video),
            'videos' =>AttachmentVideosResource::collection($this->Videos),
            'images' =>AttachmentImagesResource::collection($this->Images),
            'documents' =>AttachmentDocumentResource::collection($this->Documents)
        ];
    }
}
