<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    public $guarded = [];



    public function supervisor()
    {
        return $this->belongsTo(User::class,'supervisor_id','id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class , 'client_id');
    }

    public function company()
    {
        return $this->belongsTo(Client::class , 'client_id' ,'id');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class , 'projects_teams','project_id','team_id');
    }
    public function task(){
        return $this->hasMany(Task::class);
    }
}
