<?php

namespace App\Models;

use App\Http\Requests\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class VisitorCount extends Model
{
    use HasFactory;

    protected $table = 'visitor_counts';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at'];

    public static function visitorDataInsert(){
        $input['user_ip_address']=request()->ip();
        $input['user_agent']=request()->userAgent();
        if ($input){
//            $ipExists = VisitorCount::where('user_ip_address',$input['user_ip_address'])->get();
//            if (!$ipExists){
//            if (Request::is('/')){
//            $totalVisitor = Route::getFacadeRoot()->current()->uri();
//                VisitorCount::create($input);
//            }
//            }


            /*if (Route::getFacadeRoot()->current()->uri() == '/'){
                VisitorCount::create($input);
            }*/
        }
        $totalVisitor = VisitorCount::all()->count();
        return $totalVisitor;
    }
}
