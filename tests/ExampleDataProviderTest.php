<?php

namespace Puzzle\Assert;

class ExampleDataProviderTest extends \PHPUnit_Framework_TestCase
{
    use ExampleDataProvider;
    
    public function testBuildGenerator()
    {
        $this->assertTrue($this->buildGenerator() instanceof \Generator);
    }
}
