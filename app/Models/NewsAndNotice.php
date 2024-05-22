<?php

namespace App\Models;

use App\Traits\Active;
use App\Traits\IsDefault;
use App\Traits\Sorted;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsAndNotice extends Model
{
    use HasFactory;
    use IsDefault;
    use Active;
    use Sorted;
    use Sluggable;
    use SoftDeletes;

    protected $table = 'news_and_notices';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at'];


    public function categories()
    {
        return $this->belongsToMany(NewsAndNoticeCategory::class, 'news_notice_category_join', 'news_notice_id', 'category_id');
    }

    public function createdBy(){
        return $this->belongsTo('App\Admin','created_by');
    }

    public function onBehalfBy(){
        return $this->belongsTo('App\Models\CommitteeMember','member_id');
    }

    public static function getAllNewsByType($type){
        $data = self::where('is_active',1)->where('post_type',$type)->orderby('sort_order','asc')->paginate(9);
        return $data;
    }

    public static function getDataBYId($id){
        $data = self::where('is_active',1)->where('id',$id)->first();
        return $data;
    }

    public static function getPopularNews($id,$type){
        $data = self::where('is_active',1)
                        ->where('post_type',$type)
                        ->whereNotIn('id',[$id])
                        ->orderby('sort_order','asc')
                        #->inRandomOrder()
                        ->limit(3)
                        ->get();
        return $data;
    }

    public static function getLatestNews($limit){
        $data = self::where('is_active',1)
            ->orderby('sort_order','asc')
            ->limit($limit)
            ->get();
        return $data;
    }

    public static function getLatestNotices($limit){
        $data = self::where('is_active',1)
            ->orderby('sort_order','asc')
            ->where('post_type','NOTICE')
            ->limit($limit)
            ->get();
        return $data;
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
