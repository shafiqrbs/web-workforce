<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Self_;

class Event extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'events';
    public $timestamps = true;
    protected $guarded = ['id'];

    protected $dates = ['created_at', 'updated_at','deleted_at'];

    protected $fillable = [
         'event_name','event_type','number_of_club','number_of_athlete','number_of_official','event_message','match_schedule_message','event_image','match_schedule_pdf','is_default','is_active','sort_order','start_date','end_date','month','event_type_id','location','participant'
    ];

    public static function getAllEvent(){
        $data = self::where('is_active',1)->orderBy('sort_order')->get()->toArray();
        return $data;
    }

    public static function getIdWiseData($id){
        $event = self::findOrFail($id);
        return $event;
    }

    public static function getTopEvent(){
        $data = self::where('is_active',1)->orderBy("sort_order","asc")->first();
        return $data?$data:null;
    }

    public static function getAllEventExceptTop($topID){
        $data = self::where('events.is_active',1)
            ->select([
                'events.*','event_type.event_type'
            ])
            ->leftjoin('event_type','event_type.id','=','events.event_type_id')
            ->orderby('events.sort_order','asc')
            ->get()
            ->except($topID);
//        $data = self::where('is_active',1)->whereNotIn('id',[$topID])->orderby('sort_order','asc')->skip(0)->take(4)->get();
        return $data;
    }

    public static function getRelatedEventExceptTop($topID){
        $data = self::where('is_active',1)->whereNotIn('id',[$topID])->orderby('sort_order','asc')->skip(0)->take(4)->get();
        return $data;
    }

    public static function getLatestEvent($limit){
        $data = self::where('is_active',1)
            ->orderby('sort_order','asc')
            ->limit($limit)
            ->get();
        return $data;
    }

    public static function getEventDropdown(){
        $data = self::where('is_active',1)->pluck('event_name','id')->all();
        return $data;
    }

    public static function getCalanderEvent($year,$eventType){
        $eventData = [];
        $events = Event::where('events.is_active',1)->whereNotNull(['events.start_date','events.month'])
            ->join('event_type','event_type.id','=','events.event_type_id')
            ->select(
                ['events.event_name','events.start_date','events.end_date','events.month','events.id','event_type.event_type','events.location','events.participant']
            )
            ->whereYear('events.start_date',$year)
            ->whereIn('events.event_type_id', $eventType)
            ->get()
            ->toArray();
        foreach ($events as $event){
            $eventData[$event['month']][] = $event;
        }
        return $eventData;
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
