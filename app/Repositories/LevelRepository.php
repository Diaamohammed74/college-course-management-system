<?php

namespace App\Repositories;

use App\Models\Level;
use App\Interfaces\LevelRepositoryInterface;
// return 

class LevelRepository implements LevelRepositoryInterface 
{

    public function getAllLevels(){
        return Level::select('id','name')->get();
    }

}

