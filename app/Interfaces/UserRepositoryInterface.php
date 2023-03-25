<?php

namespace App\Interfaces;

interface UserRepositoryInterface 
{
    public function getSuperAdmin();
    public function getAllUsers();
    public function find($id);
}