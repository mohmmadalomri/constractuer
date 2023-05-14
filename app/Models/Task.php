<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'describe', 'project_id', 'team_id', 'start_time',
        'end_time', 'status'];
    public $guarded = [];
}
