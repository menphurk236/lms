<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MappingVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'video_id', 'employee_id', 'department_id', 'created_at', 'updated_at'
    ];

    public function video()
    {
        return $this->hasOne(Video::class, 'id', 'video_id')->with('categoryvideo');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
