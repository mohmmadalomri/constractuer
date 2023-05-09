<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'company_id',
        'profession_id',
        'hourly_salary',
        'monthly_salary',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    } 

    public function profession()
    {
        return  $this->belongsTo(Profession::class , 'profession_id','id');
    }

}
