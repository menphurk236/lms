<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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