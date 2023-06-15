<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'title',
        'instruction',
        'start_day',
        'end_day',
        'start_time',
        'end_time',
        'subtotal',
        'arrival_window',
        'company_id','team_id'
    ];

    public function clients()
    {
        $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function companys()
    {
        $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'jobs_items', 'job_id', 'item_id');
    }


    public function teams()
    {
        return $this->belongsToMany(Team::class, 'jobs_teams', 'jobs_id', 'team_id');
    }


}
