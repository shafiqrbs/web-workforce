<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserVideo extends Model
{

    protected $table = 'user_videos';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }


}
