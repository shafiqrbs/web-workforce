<?php

namespace App\Models;

use App\Cms;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Banner extends Model
{
    use HasFactory;

    protected $table = 'banners';
    public $timestamps = true;
    protected $guarded = ['id'];

    protected $dates = ['created_at', 'updated_at','deleted_at'];

    protected $fillable = [
        'banner_title', 'page_slug', 'banner_image', 'is_default', 'is_active', 'sort_order'
    ];

    public static function getPageWiseBannerInfo($pageSlug){
        $data = self::where('is_active',1)->where('page_slug',$pageSlug)->first();
        return $data;
    }

    public static function getBannerSlug(){
        $slug = Cms::where('is_active',1)->join('cms_content','cms.id','=','cms_content.page_id')
            ->pluck('cms_content.page_title','cms.page_slug')
            ->all();
        $slug['gallery'] = 'Gallery';
        $slug['Member-details'] = 'Member Details';
        $slug['event'] = 'Event';
        $slug['pistol-athlete'] = 'Pistol Athlete';
        $slug['rifle-athlete'] = 'Rifle Athlete';
        $slug['short-athlete'] = 'Short Gun Athlete';
        $slug['handicapped-athlete'] = 'Handicapped Athlete';
        $slug['archive'] = 'Archive';
        $slug['financial-partner'] = 'Financial Partner';
        $slug['club'] = 'Club';
        $slug['registration'] = 'Registration';
        $slug['login'] = 'Login';
        $slug['faq'] = 'FAQ';
        $slug['executive-committee'] = 'Executive Committee';
        $slug['sub-committee'] = 'Sub Committee';
        $slug['camp-commandant-coach'] = 'Camp Commandant Coach';
        $slug['office-administration'] = 'Office Administration';
        $slug['news'] = 'News';
        $slug['notices'] = 'Notices';
        $slug['judges-jury'] = __('messages.Judges_Jury');
        $slug['judges-jury-details'] = __('messages.Judges_Jury_details');
        $slug['arms'] = __('messages.Arms');
        ksort($slug);
        return $slug;
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
