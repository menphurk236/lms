<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Iman\Streamer\VideoStreamer;
use Illuminate\Support\Facades\Storage;

class Video extends Model
{
    use HasFactory;

    protected $table = 'videos';

    protected $fillable = [
        'category_video_id',
        'title',
        'video_path',
        'video_duration',
        'created_upload'
    ];

    protected $appends = [
        'video_url',
    ];


    public function getVideoUrlAttribute()
    {
        if($this->video_path == null) {
            return null;
        }
        if (Storage::disk('public')->exists($this->video_path)) {
            return Storage::disk('public')->url($this->video_path);
        }
        return Storage::url($this->video_path);
    }


    public function categoryvideo()
    {
        return $this->hasOne(Categoryvideo::class, 'id', 'category_video_id');
    }

    public function mappingvideo()
    {
        return $this->hasMany(MappingVideo::class);
    }


    public function user()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}
