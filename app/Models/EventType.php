<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventType extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'event_type';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = [
        'event_type', 'is_default', 'is_active'
    ];


    public static function eventTypeDropDown(){
        $array = self::where('is_active',1)->orderBy('sort_order', 'ASC')->pluck('event_type','id')->all();
        return $array;
    }

    public static function getIdWiseData($id){
        $data = self::find($id);
        return $data;
    }
}
