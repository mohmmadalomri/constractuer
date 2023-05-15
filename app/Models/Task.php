<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'describe', 'project_id', 'team_id', 'start_time',
        'end_time', 'status','location'];
    public $guarded = [];

    public function project(){
        return $this->belongsTo(Project::class,'project_id','id');
    }


    public function team(){
        return $this->belongsTo(Team::class);
    }

}
