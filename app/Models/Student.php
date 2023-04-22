<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable  =  [
        'first_name' , 
        'middle_name' ,
        'last_name' ,
        'email' ,
        'mobile' ,
        'reg_no',
        'book_title',
        'book_number',
        'course_id',
        'author' 
    ];

    public function stdCourse(){

        return $this->belongsTo(Course::class, 'course_id');
    }
}
