<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserJobTitle extends Model
{
    public function jobTitle()
    {
        return $this->belongsTo('App\JobTitle', 'job_title_id', 'id');
    }
}
