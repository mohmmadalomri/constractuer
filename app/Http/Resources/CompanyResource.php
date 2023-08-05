<?php

namespace App\Http\Resources;

use App\Http\Resources\invoice\AttachmentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{

    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'link_website' => $this->link_website,
            'link_facebook' => $this->link_facebook,
            'link_twitter' => $this->link_twitter,
            'link_youtube' => $this->link_youtube,
            'link_linkedin' => $this->link_linkedin,
            'address_1' => $this->address_1,
            'address_2' => $this->address_2,
            'country' => $this->country,
            'governorate' => $this->governorate,
            'city' => $this->city,
            'zip_code' => $this->zip_code,
            'logo' => url('attachments/company/'.$this->id.'/'. $this->logo),

            'user' => $this->admin,
        ];
    }
}
