<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserJobType extends Model
{
    public function jobType()
    {
        return $this->belongsTo('App\JobType', 'job_type_id', 'id');
    }
}
