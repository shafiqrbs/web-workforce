<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Athlete extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'athlete_users';
    public $timestamps = true;
    protected $guarded = ['id'];

    protected $dates = ['created_at', 'updated_at','deleted_at'];

    protected $fillable = [
        'user_id', 'athlete_name', 'profile_image', 'athlete_type', 'mobile', 'email', 'date_of_birth', 'age', 'gender_id', 'father_name', 'mother_name', 'address', 'height', 'weight', 'blood_group_id', 'profession_id', 'start_of_competition', 'practicing_shooter_sign', 'name_of_national_coach', 'handedness', 'place_of_birth', 'hometown', 'marital_status', 'event', 'higher_education', 'hobbies', 'parent_full_name', 'relationship', 'parent_mobile', 'parent_address','sort_order','updated_at','district_id','is_approved','athlete_id','club_id','is_present'
    ];

    public function athleteCompetition(){
        return $this->hasMany('App\Models\AthleteCompetition','athlete_id','id');
    }

    public function printAtheleteImage($width = 0, $height = 0)
    {
        $image = (string)$this->profile_image;
        $image = (!empty($image)) ? $image : 'no-no-image.gif';
        return \ImgUploader::print_image("athlete_profile/thumb/$image", $width, $height, '/admin_assets/no-image.png', $this->athlete_name);
    }

    public static function getTypeWiseAthlete($type){
        $athleteData = self::where('is_active',1)->where('is_approved',1)->where('athlete_type',$type)->orderBy('sort_order')->select([
            'id','athlete_name','athlete_type','profile_image'
        ])->get()->toArray();
        return $athleteData;
    }

    public static function getIdWiseAthlete($id){
        $athleteData = self::with('athleteCompetition')->where('is_approved',1)->where('is_active',1)->where('id',$id)->first();
        return $athleteData;
    }

    public static function getRelatedAthlets($id,$type,$isPresent){
        $data = self::where('is_active',1)->where('is_approved',1)->where('athlete_type',$type)->where('is_present',$isPresent)->orderBy('sort_order')->get()->except($id);
        return $data;
    }

    public static function getAllPresentAthlets(){
        $data = self::where('is_active',1)->where('is_approved',1)->where('is_present',1)->orderBy('sort_order')->get();
        return $data;
    }

    public static function getAllFormerAthlets(){
        $data = self::where('is_active',1)->where('is_approved',1)->where('is_present',0)->orderBy('sort_order')->get();
        return $data;
    }
}
