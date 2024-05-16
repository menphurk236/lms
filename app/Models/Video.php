<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Iman\Streamer\VideoStreamer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use HasFactory ,SoftDeletes;

    protected $table = 'videos';

    protected $fillable = [
        'category_video_id',
        'title',
        'video_path',
        'video_duration',
        'created_upload',
        'created_by',
        'updated_by',
    ];

    protected $appends = [
        'video_url',
    ];


    public function getVideoUrlAttribute()
    {
        if (Storage::disk('public')->exists($this->video_path)) {
            return Storage::disk('public')->url($this->video_path);
        }
        return null;
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

    public function employeeVideo()
    {
        return $this->hasOne(EmployeeVideo::class);
    }

    protected static function boot()
    {

        parent::boot();

        // updating created_by and updated_by when model is created
        static::creating(function ($model) {
            if (!$model->isDirty('created_by')) {
                $model->created_by = auth()->user()->id;
            }
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = auth()->user()->id;
            }
        });

        // updating updated_by when model is updated
        static::updating(function ($model) {
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = auth()->user()->id;
            }
        });
    }
}
