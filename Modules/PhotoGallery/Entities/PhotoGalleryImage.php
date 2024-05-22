<?php

namespace Modules\PhotoGallery\Entities;

use App\Traits\Active;
use App\Traits\IsDefault;
use App\Traits\Sorted;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PhotoGalleryImage extends Model
{
    use HasFactory;
    use IsDefault;
    use Active;
    use Sorted;

    protected $table = 'photo_gallery_images';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\PhotoGallery\Database\factories\PhotoGalleryImageFactory::new();
    }

    public function photoGallery(){
        return $this->belongsTo(PhotoGallery::class,'photo_gallery_id','id');
    }
}
