<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AthleteCompetition extends Model
{
    use HasFactory;
    protected $table = 'athlete_competitions';
    public $timestamps = true;
    protected $guarded = ['id'];

    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = [
        'athlete_id', 'competition_name', 'competition_date', 'event', 'score', 'position', 'is_active', 'sort_order'
    ];
}
