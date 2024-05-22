<?php

namespace App\Models;

use App\Traits\Active;
use App\Traits\IsDefault;
use App\Traits\Sorted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jury extends Model
{
    use HasFactory;
    use IsDefault;
    use Active;
    use Sorted;

    protected $table = 'judges_jury';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at'];

    public function juryEvent(){
        return $this->hasMany('App\Models\JuryEvent','jury_id','id');
    }

    public static function getJury(){
        if (app()->getLocale() == 'bn'){
            $data = self::select([
                'id','name_bn as name', 'mobile_bn as mobile', 'email', 'issf_license_no_bn as issf_license_no', 'license_valid_date', 'date_of_birth', 'jury_class', 'address_bn as address', 'remark_bn as remark', 'profile_image', 'e_signature', 'is_rifle', 'is_pistol', 'is_short_gun', 'is_running_target', 'is_electronic_target', 'sort_order'
            ]);
        }else{
            $data = self::select([
                'id','name_en as name', 'mobile_en as mobile', 'email', 'issf_license_no_en as issf_license_no', 'license_valid_date', 'date_of_birth', 'jury_class', 'address_en as address', 'remark_en as remark', 'profile_image', 'e_signature', 'is_rifle', 'is_pistol', 'is_short_gun', 'is_running_target', 'is_electronic_target','sort_order'
            ]);
        }
        $data = $data->where('is_active',1)->where('deleted_at',null)->get();
        return $data;
    }

}
