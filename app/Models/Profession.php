<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use HasFactory;

    protected $table = 'professions';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = [
        'profession', 'is_default', 'is_active'
    ];


    public static function professionDropDown(){
        $array = self::where('is_active',1)->orderBy('sort_order', 'ASC')->pluck('profession','id')->all();
        return $array;
    }

    public static function getIdWiseData($id){
        $data = self::find($id);
        return $data;
    }
}
