<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttachmentVideo extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table='attachment_videos';

    public function Attachment()
    {
        return $this->belongsTo(Attachment::class, 'attachment_id');
    }

}
