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

    public function items()
    {
        return $this->belongsToMany(Item::class, 'invoices_items', 'invoice_id', 'item_id');
    }
    public function paymentschedules()
    {
        return $this->belongsToMany(InvoicesPaymentschedule::class, 'invoices_paymentschedules', 'invoice_id', 'paymentSchedule_id');
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'invoice_id');
    }
}
