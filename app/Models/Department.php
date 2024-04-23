<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'created_by', 'updated_by', 'created_at', 'updated_at', 'deleted_at'
    ];

    public function mappingvideo()
    {
        return $this->hasMany(MappingVideo::class);
    }


    public function user()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function getCreatedAtAttribute($value) {
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }
}
