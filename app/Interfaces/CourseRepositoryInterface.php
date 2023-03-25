<?php

namespace App\Interfaces;
//functions
interface CourseRepositoryInterface 
{
    public function getAllCourses();
    public function getAllEnrolledCourses();
    public function index();
    public function find($id);

}