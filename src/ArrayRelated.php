<?php

namespace Puzzle\Assert;

trait ArrayRelated
{
    private function assertSameArrayExceptOrder(array $expectedArray, array $array, $message = '')
    {
        $this->assertCount(count($expectedArray), $array, $message);
        
        $expected = $this->cloneArray($expectedArray);
        
        foreach($array as $value)
        {
            $index = array_search($value, $expected, true);
            $this->assertNotFalse($index, $message);
            
            unset($expected[$index]);
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
    
    private function cloneArray(array $array)
    {
        $clone = [];
        
        foreach($array as $key => $value)
        {
            if(is_object($value))
            {
                $value = clone $value;
            }
            elseif(is_array($value))
            {
                $value = $this->cloneArray($value);
            }
            
            $clone[$key] = $value;
        }
        
        return $clone;
    }
}
