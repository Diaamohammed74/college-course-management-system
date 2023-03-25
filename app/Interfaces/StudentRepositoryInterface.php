<?php

namespace App\Interfaces;

interface StudentRepositoryInterface 
{
    public function index();
    public function find($id);
    public function countStudents();
}