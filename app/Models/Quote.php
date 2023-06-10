<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'title',
        'message',
        'subtotal',
        'discount',
        'type_discount',
        'tax_name',
        'tax_describe',
        'tax_rate',
        'total',
        'note',
        'company_id',
    ];

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


}
