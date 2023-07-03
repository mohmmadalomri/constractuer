<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'phone' => 'array',
        'email' => 'array',
    ];

    public function job()
    {
        return $this->hasMany(Job::class, 'client_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function expense()
    {
        return $this->hasMany(Expense::class);
    }


}
