<?php

namespace App\Functions;

class Common
{
    public function objectToArrays($object)
    {
        return json_decode(json_encode($object), true);
    }
}
