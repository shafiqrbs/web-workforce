<?php

namespace App\Models;

use App\Traits\Active;
use App\Traits\IsDefault;
use App\Traits\Sorted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    use IsDefault;
    use Active;
    use Sorted;

    protected $table = 'members';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at'];

    public function memberDesignation(){
        return $this->hasMany('App\Models\MemberJoinDesignation','member_id','id');
    }

    public static function getExecutiveCommitteeDropdown(){
        $data = self::where('committee_type','EXECUTIVE_COMMITTEE')->where('is_active',1)->orderby('sort_order','asc')->pluck('name','id')->all();
        return $data;
    }
}
