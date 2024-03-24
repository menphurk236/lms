<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'email', 'phone', 'address', 'department_id' , 'created_by', 'updated_by', 'created_at', 'updated_at'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function mappingvideo()
    {
        return $this->belongsTo(MappingVideo::class, 'id', 'department_id')->with('video', 'department');
    }

}
