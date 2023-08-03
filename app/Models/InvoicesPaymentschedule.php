<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoicesPaymentschedule extends Model
{
    use HasFactory;
    protected $table='invoices_paymentschedules';
    protected $guarded=[''];

    public function invoices()
    {
        return $this->belongsToMany(Invoice::class, 'invoices_paymentschedules', 'paymentSchedule_id', 'invoice_id');
    }
}
