<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;
    protected $guarded=[''];
    public function Images()
    {
        return $this->hasMany(AttachmentImage::class, 'attachment_id');
    }
    public function Documents()
    {
        return $this->hasMany(AttachmentDocument::class, 'attachment_id');
    }
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
}
