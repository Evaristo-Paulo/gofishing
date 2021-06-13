<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ocupation extends Model
{
    public function people()
    {
        return $this->belongsTo(People::class);
    }
}
