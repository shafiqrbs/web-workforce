<?php

namespace App;

use App;
use App\Traits\Lang;
use App\Traits\IsDefault;
use App\Traits\Active;
use App\Traits\Sorted;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{

    use Lang;
    use IsDefault;
    use Active;
    use Sorted;

    protected $table = 'sliders';
    public $timestamps = true;
    protected $guarded = ['id'];
    //protected $dateFormat = 'U';
    protected $dates = ['created_at', 'updated_at'];
	
	public static function defaultSliders()
    {
        $array = Slider::isDefault()->active()->sorted()->limit(5)->get();
        return $array;
    }

    public static function langSliders()
    {
//        $array = Slider::lang()->active()->sorted()->limit(5)->get();
        $array = Slider::where('is_active',1)->orderBy('sort_order','asc')->get();
        /*if ((int) count($array) === 0) {
            $array = self::defaultSliders();
        }*/
        return $array;
    }
}
