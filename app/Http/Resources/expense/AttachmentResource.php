<?php

namespace App\Http\Resources\expense;

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
            'expense_id' => $this->expense_id,
            'videos' =>AttachmentVideosResource::collection($this->Videos),
            'images' =>AttachmentImagesResource::collection($this->Images),
            'documents' =>AttachmentDocumentResource::collection($this->Documents)
        ];
    }
}
