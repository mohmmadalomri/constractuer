<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    public $guarded = [];

    protected $fillable=[
        'name',
        'type',
        'describe',
        'price',
        'image',
        'company_id',
    ];

}
