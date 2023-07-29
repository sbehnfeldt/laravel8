<?php

namespace App\Helpers;

class Utilities
{
    // ref: https://stackoverflow.com/questions/1993721/how-to-convert-pascalcase-to-snake-case
    static public function snakify($input): string
    {
        $temp = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $input));
        return strtolower(preg_replace('/ /', '-', $temp ));
    }
}
