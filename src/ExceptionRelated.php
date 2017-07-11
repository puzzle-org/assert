<?php

namespace Puzzle\Assert;

trait ExceptionRelated
{
    private function assertNoExceptionNotCaught()
    {
        $this->addToAssertionCount(1);
    }
}
