<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{

    protected $fillable = [
        'name',
        'bi',
        'birthday',
        'photo',
        'phone',
        'adress',
        'active',
        'gender_id',
        'ocupation_id'
    ];

    public function gender()
    {
        return $this->hasOne(Gender::class);
    }

    public function ocupation()
    {
        return $this->hasOne(Ocupation::class);
    }

    
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
