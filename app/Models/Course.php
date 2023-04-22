<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable  =  [

        'department_id' , 
        'code',
        'name'
    ];

    public function dept(){

        return $this->belongsTo(Department::class, 'department_id');
    }

    public function courseStd(){

        return $this->hasMany(Student::class, 'id');
    }
 }
