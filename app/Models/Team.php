<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'describe',
        'image',
        'supervisor_id',
        'company_id',
    ];

    public $guarded = [];

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id', 'id');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'projects_teams', 'team_id', 'project_id');
    }

    public function task()
    {
        $this->hasMany(Task::class);
    }

}
