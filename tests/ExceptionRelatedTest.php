<?php

namespace Puzzle\Assert;

class ExceptionRelatedTest extends \PHPUnit_Framework_TestCase
{
    use ExceptionRelated;

    public function testSuccess()
    {
        $this->assertNoExceptionNotCaught();
    }
}
