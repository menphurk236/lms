<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeVideo extends Model
{
    use HasFactory;

    protected $table = 'employee_videos';

    protected $fillable = [
        'employee_id',
        'video_id',
        'timespent'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id')->with('categoryvideo');
    }
}
