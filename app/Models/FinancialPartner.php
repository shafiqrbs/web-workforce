<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class FinancialPartner extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'financial_partners';
    public $timestamps = true;
    protected $guarded = ['id'];

    protected $dates = ['created_at', 'updated_at','deleted_at'];

    protected $fillable = [
        'name', 'mobile','male','female','latitude','longitude', 'email', 'address', 'short_message', 'facebook_link', 'profile_image','is_active','partner_group'
    ];

    public static function getFinancialPartner(){
        $financialPartner = FinancialPartner::where('is_active',1)->orderBy('sort_order')->get()->toArray();
        return $financialPartner;
    }

    public static function getFinancialPartnerByType($slug){
        $factories = FinancialPartner::where('is_active',1)->where('partner_group',$slug)->orderBy('sort_order')->get()->toArray();
        return $factories;
    }

    public static function getAchievement(){
        $totals = FinancialPartner::where('is_active', 1)
            ->selectRaw('SUM(male) as total_male, SUM(female) as total_female')
            ->first();

        $financialPartnerGroup = FinancialPartner::where('is_active', 1)
            ->whereNotNull('partner_group')
            ->select('partner_group', \DB::raw('COUNT(*) as total'))
            ->groupBy('partner_group')
            ->get()
            ->toArray();
        return ['totals'=>$totals,'financialPartnerGroup'=>$financialPartnerGroup];
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
