<?php

namespace App\Api\Foundation\Transformers;

abstract class Transformer
{
    public function transformCollect(array $map)
    {
        return array_map([$this, 'transform'], $map);
    }

    abstract public function transform($map);
}
