<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable   =   ['school_id', 'code', 'name'];

    public function schools(){

        return $this->belongsTo(School::class, 'school_id');
    }

    public function course(){

        return $this->hasMany(Course::class);
    }
}
