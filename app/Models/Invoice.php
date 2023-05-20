<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'title',
        'issued_date',
        'due_date',
        'payment',
        'message',
        'subtotal',
        'discount',
        'type_discount',
        'tax_name',
        'tax_describe',
        'tax_rate',
        'total',
        'company_id',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'invoices_items', 'invoice_id', 'item_id');
    }
}
