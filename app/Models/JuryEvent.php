<?php

namespace App\Models;

use App\Traits\Active;
use App\Traits\IsDefault;
use App\Traits\Sorted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JuryEvent extends Model
{
    use HasFactory;
    use IsDefault;
    use Active;
    use Sorted;

    protected $table = 'judges_jury_event';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at'];

}
