<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function clients()
    {
        $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function companies()
    {
        $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'items_jobs', 'job_id', 'item_id');
    }
    public function teams()
    {
        return $this->belongsToMany(Team::class, 'jobs_teams', 'job_id', 'team_id');
    }




    public function projects()
    {
        return $this->hasMany(Project::class);
    }
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }


}
