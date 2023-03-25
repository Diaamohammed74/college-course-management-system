<?php

namespace App\Models;
use App\Models\Level;

use App\Models\Department;
use App\Models\Student_Progress;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=[
        'id', 
        'name', 
        'email', 
        'phone', 
        'image', 
        'status', 
        'department_id', 
        'level_id', 
        'created_at', 
        'updated_at'
    ];
    public function student_progress(){
        return $this->belongsTo(Student_Progress::class);
    }
    public function level(){
        return $this->belongsTo(Level::class,'level_id');
    }
    public function department(){
        return $this->belongsTo(Department::class,'department_id');
    }
    public function course(){
        return $this->belongsToMany(Course::class,'course_enroll','student_id','course_id')->withPivot('course_grade');
    }
    public function group(){
        return $this->belongsToMany(Group::class,'group_enroll','group_id','student_id');
    }

}
