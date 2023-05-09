<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;
    
    protected $fillable=[
        'client_id',
        'title',
        'day',
        'start_time',
        'end_time',
        'team_id',
        'instruction',
        'company_id'
    ];

    public $timestamps = false; 
}
