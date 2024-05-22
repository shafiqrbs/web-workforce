<?php

namespace App;

use App;
use App\Traits\Lang;
use App\Traits\IsDefault;
use App\Traits\Active;
use App\Traits\Sorted;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{

    use Lang;
    use IsDefault;
    use Active;
    use Sorted;

    protected $table = 'testimonials';
    public $timestamps = true;
    protected $guarded = ['id'];
    //protected $dateFormat = 'U';
    protected $dates = ['created_at', 'updated_at'];

    public static function defaultTestimonials($status)
    {
        $array = Testimonial::where('user_type',$status)->isDefault()->active()->sorted()->get();
        return $array;
    }

    public static function langTestimonials($status)
    {
        $array = Testimonial::where('user_type',$status)->lang()->active()->sorted()->get();
        if ((int) count($array) === 0) {
            $array = self::defaultTestimonials($status);
        }
        return $array;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
