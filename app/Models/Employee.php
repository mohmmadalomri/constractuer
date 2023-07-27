<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function profession()
    {
        return  $this->belongsTo(Profession::class , 'profession_id','id');
    }

    public function WeaklySchedules()
    {
        return $this->hasMany(WeaklySchedule::class, 'employee_id');
    }
}
