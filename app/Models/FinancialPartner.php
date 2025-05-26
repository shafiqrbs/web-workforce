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
        'name', 'mobile', 'email', 'address', 'short_message', 'facebook_link', 'profile_image','is_active','partner_group'
    ];

    public static function getFinancialPartner(){
        $financialPartner = FinancialPartner::where('is_active',1)->orderBy('sort_order')->get()->toArray();
        return $financialPartner;
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
