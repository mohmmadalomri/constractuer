<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function client()
    {
        $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'quotes_items', 'quote_id', 'item_id');
    }

    public function company()
    {
        $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function attachments()
    {
        return $this->belongsTo(Attachment::class, 'id','quote_id');
    }
}
