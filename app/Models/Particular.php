<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Particular extends Model
{
    public function particular()
    {
        return $this->hasMany(Particular::class);
    }
}
