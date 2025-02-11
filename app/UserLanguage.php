<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLanguage extends Model
{
    public function language()
    {
        return $this->belongsTo('App\Language', 'language_id', 'id');
    }
}
