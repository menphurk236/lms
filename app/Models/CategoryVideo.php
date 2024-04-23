<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryVideo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['code', 'name', 'created_by', 'updated_by', 'created_at', 'updated_at', 'deleted_at'];

    public function getCreatedAtAttribute($value) {
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }
}
