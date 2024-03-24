<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'created_by', 'updated_by', 'created_at', 'updated_at'
    ];


    public function user()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}
