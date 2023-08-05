<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function Company()
    {
        return $this->belongsTo(Company::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'expense_id');
    }
}
