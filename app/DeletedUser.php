<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeletedUser extends Model
{

    protected $table = 'deleted_users';
    protected $guarded = ['id'];

}
