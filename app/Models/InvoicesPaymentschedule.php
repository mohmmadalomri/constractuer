<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoicesPaymentschedule extends Model
{
    use HasFactory;
    protected $table='invoices_paymentschedule';
    protected $guarded=[''];
}