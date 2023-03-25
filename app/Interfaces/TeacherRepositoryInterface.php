<?php

namespace App\Interfaces;

interface TeacherRepositoryInterface 
{
    public function index();
    public function find($id);
}