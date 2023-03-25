<?php

namespace App\Models;

use App\Models\Group;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=[
        'id',
        'name',
        'description',
        'full_mark',
        'credit_hours',
        'department_id',
        'created_at',
        'updated_at' ,
    ];
    public function student(){
        return $this->belongsToMany(Student::class,'course_enroll','course_id','student_id');
    }
    public function group(){
        return $this->hasMany(Group::class);
    }
    public function teacher(){
        return $this->hasMany(Teacher::class);
    }
    public function department(){
        return $this->belongsTo(Department::class,'department_id');
    }

}
