<?php

namespace App\Models;

use App\Models\Student;
use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Level extends Model
{
    use HasFactory;
    public function department(){
        return $this->belongsTo(Department::class,'department_id');
    }
    public function students(){
        return $this->hasMany(Student::class);
    }
}
