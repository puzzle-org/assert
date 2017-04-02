<?php

namespace Puzzle\Assert;

trait ExampleDataProvider
{
    private function buildGenerator()
    {
        $closure = function () { yield 3; };
        
        return $closure();
    }
}
