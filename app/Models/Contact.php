<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'zip_code',
        'country',
        'company_id',
        'status',
        'type'
    ];

    public function actions()
    {
        return $this->hasMany(Action::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
