<?php

namespace App\Http\Resources;

use App\Http\Resources\team\AttachmentResource;
use App\Models\Attachment;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
{

    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'photo' => url('attachments/teams/'.$this->id.'/'.$this->image),
            'describe' => $this->describe,
            'company' => $this->company,
            'supervisor' => $this->supervisor,
            'employees' => $this->employees,
            'attachments'=>AttachmentResource::collection($this->attachments),
        ];
    }
}
