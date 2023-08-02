<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }
    public function tax()
    {
        return $this->belongsTo(Tax::class, 'tax_id', 'id');
    }

    public function signature()
    {
        return $this->belongsTo(Signature::class, 'signature_id', 'id');
    }

    public function paymentschedule()
    {
        return $this->belongsTo(Paymentschedule::class, 'paymentSchedule_id', 'id');
    }
    public function items()
    {
        return $this->belongsToMany(Item::class, 'invoices_items', 'invoice_id', 'item_id');
    }

    public function attachments()
    {
        return $this->belongsTo(Attachment::class, 'id','invoice_id');
    }
}
