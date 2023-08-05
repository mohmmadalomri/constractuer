<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }


    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'expense_id');
    }
}
