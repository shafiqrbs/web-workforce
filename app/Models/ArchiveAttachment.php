<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Self_;

class ArchiveAttachment extends Model
{
    use HasFactory;

    protected $table = 'archive_attachment';
    public $timestamps = true;
    protected $guarded = ['id'];

    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = [
        'archive_id', 'caption', 'attachment'
    ];
}
