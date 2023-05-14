<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable=
    [
        'first_name',
        'last_name',
        'name_company',
        'phone',
        'email',
        'link_website',
        'link_facebook',
        'link_twitter',
        'link_youtupe',
        'link_linkedin',
        'address_1',
        'address_2',
        'country',
        'governorate',
        'city',
        'zip_code',
        'company_id'
    ];

    protected $casts= [
        'phone'=>'array',
        'email'=>'array',
    ];

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
