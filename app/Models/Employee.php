<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['code', 'name', 'email', 'phone', 'address', 'department_id' , 'created_by', 'updated_by', 'created_at', 'updated_at', 'deleted_at'];

    protected $appends = [
        'percent',
    ];

    public function getPercentAttribute()
    {
        $empVideo = $this->employeeVideos->count();
        if($empVideo == 0)
        {
            return 0;
        }
        $empVideoCompleted = $this->employeeVideos->where('timespent', '>', 0)->count();
        return $empVideoCompleted / 100;
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function mappingvideo()
    {
        return $this->belongsTo(MappingVideo::class, 'id', 'department_id')->with('video', 'department');
    }

    public function employeeVideos()
    {
        return $this->hasMany(EmployeeVideo::class, 'employee_id', 'id');
    }

}
