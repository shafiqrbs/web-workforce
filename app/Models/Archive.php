<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Self_;

class Archive extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'archives';
    public $timestamps = true;
    protected $guarded = ['id'];

    protected $dates = ['created_at', 'updated_at','deleted_at'];

    protected $fillable = [
        'archive_name_en','archive_name_bn', 'sub_title_en','sub_title_bn', 'archive_pdf', 'is_default', 'is_active', 'sort_order','feature_image','type','short_description'
    ];

    public static function getIdWiseData($id){
        if (app()->getLocale() == 'bn'){
            $data = self::select([
                'id', 'archive_name_bn as archive_name', 'sub_title_bn as sub_title', 'archive_pdf', 'is_default', 'is_active', 'sort_order','feature_image','type','short_description'
            ]);
        }else{
            $data = self::select([
                'id', 'archive_name_en as archive_name', 'sub_title_en as sub_title', 'archive_pdf', 'is_default', 'is_active', 'sort_order'
                ,'feature_image','type','short_description'
            ]);
        }
        $data = $data->where('id',$id)->where('is_active',1)->where('deleted_at',null)->first();
        return $data;
    }

    public static function getAllArchive(){
        if (app()->getLocale() == 'bn'){
            $data = self::select([
                'id', 'archive_name_bn as archive_name', 'sub_title_bn as sub_title', 'archive_pdf', 'is_default', 'is_active', 'sort_order','created_at'
            ]);
        }else{
            $data = self::select([
                'id', 'archive_name_en as archive_name', 'sub_title_en as sub_title', 'archive_pdf', 'is_default', 'is_active', 'sort_order','created_at'
            ]);
        }
        $data = $data->where('is_active', 1)->orderby('sort_order','asc')->paginate(10);
        return $data;
    }

    public static function getDataBySearch($keyword){
        if (app()->getLocale() == 'bn'){
            $data = self::select([
                'id', 'archive_name_bn as archive_name', 'sub_title_bn as sub_title', 'archive_pdf', 'is_default', 'is_active', 'sort_order','created_at'
            ]);
        }else{
            $data = self::select([
                'id', 'archive_name_en as archive_name', 'sub_title_en as sub_title', 'archive_pdf', 'is_default', 'is_active', 'sort_order','created_at'
            ]);
        }
        $data = $data->where('is_active', 1)->orderby('sort_order','asc');

        if (app()->getLocale() == 'bn'){
            if (!empty($keyword)){
                $data = $data->where('archive_name_bn','LIKE','%'.$keyword.'%')
                    ->orWhere('sub_title_bn','LIKE','%'.$keyword.'%')
                    ->orWhere('archive_pdf','LIKE','%'.$keyword.'%');
            }
        }
        if (app()->getLocale() == 'en'){
            if (!empty($keyword)){
                $data = $data->where('archive_name_en','LIKE','%'.$keyword.'%')
                    ->orWhere('sub_title_en','LIKE','%'.$keyword.'%')
                    ->orWhere('archive_pdf','LIKE','%'.$keyword.'%');
            }
        }

        $data = $data->paginate(10);
        return $data;
    }

    public static function getRamdomArchive(){
        $data = self::where('is_active',1)
            ->inRandomOrder()
            ->limit(5)
            ->get();
        return $data;
    }


    // TODO :: boot
    // boot() function used to insert logged user_id at 'created_by' & 'updated_by'
    public static function boot(){
        parent::boot();
        static::creating(function($query){
            if(Auth::check()){
                $query->created_by = Auth::user()->id;
            }
        });
        static::updating(function($query){
            if(Auth::check()){
                $query->updated_by = Auth::user()->id;
            }
        });
    }
}
