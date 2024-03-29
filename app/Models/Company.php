<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public $guarded = [];



    protected $casts = [
        'email' => 'array',
        'phone' => 'array'
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function professions()
    {
        return $this->hasMany(Profession::class, 'company_id', 'id');
    }

    public function jop()
    {
        return $this->hasMany(Job::class, 'company_id', 'id');
    }


}
