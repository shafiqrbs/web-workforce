<?php

namespace App\Models;

use App\Traits\Active;
use App\Traits\IsDefault;
use App\Traits\Lang;
use App\Traits\Sorted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ShootingSportClub extends Model
{
    use HasFactory;

    use Lang;
    use IsDefault;
    use Active;
    use Sorted;

    protected $table = 'shooting_sport_clubs';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at'];

    public static function clubDropdown(){
        if (app()->getLocale() == 'en'){
            $array = self::where('is_active',1)->orderBy('sort_order', 'ASC')->select('id',DB::raw("CONCAT(name_en,' (',short_name_en,')' ) as name"))->pluck('name','id')->all();
        }

        if (app()->getLocale() == 'bn'){
            $array = self::where('is_active',1)->orderBy('sort_order', 'ASC')->select('id',DB::raw("CONCAT(name_bn,' (',short_name_bn,')' ) as name"))->pluck('name','id')->all();
        }

        return $array;
    }

    public static function getClubDataByID($id){
        $data = self::where('is_active',1)->where('is_default',1)->where('id',$id);
        if (app()->getLocale() == 'bn'){
            $data->select([
                'name_bn as name',
                'club_logo',
                'registration_number_bn as registration_number',
                'mobile_bn as mobile',
                'email',
                'id',
                'club_type',
                'address_bn as address',
                'district_id',
                'division_id',
                'short_name_bn as short_name',
                'about_club_bn as about_club',
            ]);
        }else{
            $data->select([
                'name_en as name',
                'club_logo',
                'registration_number_en as registration_number',
                'mobile_en as mobile',
                'email',
                'id',
                'club_type',
                'address_en as address',
                'district_id',
                'division_id',
                'short_name_en as short_name',
                'about_club_en as about_club',
            ]);
        }
        $data = $data->first();
        return $data;
    }
}
