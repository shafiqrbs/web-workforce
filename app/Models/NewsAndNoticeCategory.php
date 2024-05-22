<?php

namespace App\Models;

use App\Traits\Active;
use App\Traits\IsDefault;
use App\Traits\Sorted;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsAndNoticeCategory extends Model
{
    use HasFactory;
    use IsDefault;
    use Active;
    use Sorted;
    use Sluggable;

    protected $table = 'news_and_notice_categories';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at'];


    public function newsAndNotices()
    {
        return $this->belongsToMany(NewsAndNotice::class, 'news_notice_category_join', 'news_notice_id', 'category_id');
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
