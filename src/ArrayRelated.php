<?php

namespace Puzzle\Assert;

trait ArrayRelated
{
    private function assertSameArrayExceptOrder(array $expectedArray, array $array, $message = '')
    {
        $this->assertCount(count($expectedArray), $array, $message);

        foreach($array as $value)
        {
            $index = array_search($value, $expectedArray, true);
            $this->assertNotFalse($index, $message);

            unset($expectedArray[$index]);
        }
    }

    private function assertSameKeysAndValuesExceptOrder(array $expectedArray, array $array, $message = '')
    {
        $this->assertCount(count($expectedArray), $array, $message);

        foreach($expectedArray as $key => $value)
        {
            $this->assertArrayHasKey($key, $array, $message);
            $this->assertSame($value, $array[$key], $message);
        }
    }

    private function assertHasKeys(array $expectedKeys, array $array, $message = '')
    {
        foreach($expectedKeys as $key)
        {
            $this->assertArrayHasKey($key, $array, $message);
        }
    }
}
