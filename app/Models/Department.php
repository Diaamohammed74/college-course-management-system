<?php

namespace App\Models;

use App\Models\User;
use App\Models\Level;
use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;
    protected $fillable=[
        'id', 
        'name', 
        'department_head', 
        'created_at', 
        'updated_at'
    ];
    public function course(){
        return $this->hasMany(Course::class);
    }
    public function student(){
        return $this->hasMany(Student::class);
    }
    public function level(){
        return $this->hasMany(Level::class);
    }
    public function teacher(){
        return $this->hasMany(Teacher::class);
    }
    public function user(){
        return $this->belongsTo(User::class,'department_head');
    }

}

