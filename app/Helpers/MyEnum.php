<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class MyEnum
{

    public static function getEnumOptions($table, $column)
    {
        $type = DB::select(DB::raw("SHOW COLUMNS FROM $table WHERE Field = '$column'"))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enumValues = array();
        foreach(explode(',', $matches[1]) as $value)
        {
            $v = trim($value, "'");
            $enumValues[$v] = $v;
        }
        return $enumValues;
    }

}
