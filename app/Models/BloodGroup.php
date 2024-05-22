<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;

class BloodGroup extends Model
{
    use HasFactory;

    protected $table = 'blood_groups';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at'];

    public static function bloodGroupDropDown(){
        $array = self::where('is_active',1)->orderBy('sort_order', 'ASC')->pluck('blood_group','id')->all();
        return $array;
    }
}
