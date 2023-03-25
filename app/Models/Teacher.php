<?php

namespace App\Models;

use App\Models\Group;
use App\Models\Course;
use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teacher extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'id', 
        'name', 
        'email', 
        'phone', 
        'status', 
        'designation', 
        'department_id', 
        'course_id', 
        'created_at',
        'updated_at'
    ];
    public function department(){
        return $this->belongsTo(Department::class,'department_id');
    }

    public function course(){
        return $this->belongsTo(Course::class,'course_id');
    }
    public function group(){
        return $this->hasMany(Group::class);
    }
}
