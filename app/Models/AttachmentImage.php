<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttachmentImage extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Attachment()
    {
        return $this->belongsTo(Attachment::class, 'attachment_id');
    }

}
