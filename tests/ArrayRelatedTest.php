<?php

namespace Puzzle\Assert;

class ArrayRelatedTest extends \PHPUnit_Framework_TestCase
{
    use ArrayRelated;

    /**
     * @dataProvider providerTestSuccessAssertSameArrayExceptOrder
     */
    public function testSuccess($array)
    {
        $this->assertSameArrayExceptOrder([0, '2', 'trois', 4], $array);
    }

    public function providerTestSuccessAssertSameArrayExceptOrder()
    {
        return [
            'exactly same' => [[0, '2', 'trois', 4]],
        ];
    }

    /**
     * @dataProvider providerTestFailAssertSameArrayExceptOrder
     * @expectedException \PHPUnit_Framework_ExpectationFailedException
     */
    public function testFailAssertSameArrayExceptOrder($array)
    {
        $this->assertSameArrayExceptOrder([0, '2', 'trois', 4, 4, 4], $array);
    }

    public function providerTestFailAssertSameArrayExceptOrder()
    {
        return [
            'different' => [[0, 2, 3 ,4, 4, 4]],
            'duplicate trick' => [[0, 2, 'trois' ,2, 0, 4]],
            'missing value' => [[0, '2', 'trois', 4, 4]],
            'different value' =>[[0, '2', 'trois', 4, 4, 5]],
            'extra value' =>[[0, '2', 'trois', 4, 4, 4, 5]],
            'empty' =>[[]],
            'same size but all different' => [[7, 8, 'neuf', 10, 42, 51]],
            'different type' => [[0, 2, 'trois', 4, 4, 4]],
            'all string' => [['0', '2', 'trois', '4', '4', '4']],
            'cast' => [[false, '2', 'trois', '4', '4', 4.0]],
        ];
    }

    /**
     * @dataProvider providerTestSuccessAssertSameKeysAndValuesExceptOrder
     */
    public function testSuccessAssertSameKeysAndValuesExceptOrder($array)
    {
       $this->assertSameKeysAndValuesExceptOrder([
           'pony' => 42,
           42 => 'pony',
           '421' => 'unicorn',
           'pizza' => 42,
           'burger' => 51,
           'beef' => 51,
       ], $array);
    }

    public function providerTestSuccessAssertSameKeysAndValuesExceptOrder()
    {
        return [
            'exactly the same' => [[
                'pony' => 42,
                42 => 'pony',
                '421' => 'unicorn',
                'pizza' => 42,
                'burger' => 51,
                'beef' => 51,
            ]],
            'same array but different order' => [[
                'pony' => 42,
                '421' => 'unicorn',
                42 => 'pony',
                'burger' => 51,
                'pizza' => 42,
                'beef' => 51,
            ]],
        ];
    }

    /**
     * @dataProvider providerTestFailAssertSameKeysAndValuesExceptOrder
     * @expectedException \PHPUnit_Framework_ExpectationFailedException
     */
    public function testFailAssertSameKeysAndValuesExceptOrder($array)
    {
       $this->assertSameKeysAndValuesExceptOrder([
           'pony' => 42,
           42 => 'pony',
           '421' => 'unicorn',
           'pizza' => 42,
           'burger' => 51,
           'beef' => 51,
       ], $array);
    }

    public function providerTestFailAssertSameKeysAndValuesExceptOrder()
    {
        return [
            'one key differs' => [[
                'pony' => 42,
                42 => 'pony',
                '421' => 'unicorn',
                'pizzzzzza' => 42,
                'burger' => 51,
                'beef' => 51,
            ]],
            'one value differs' => [[
                'pony' => 42,
                42 => 'pony',
                '421' => 'NOT A unicorn',
                'pizza' => 42,
                'burger' => 51,
                'beef' => 51,
            ]],
            'extra key' => [[
                'pony' => 42,
                42 => 'pony',
                '421' => 'unicorn',
                'pizza' => 42,
                'burger' => 51,
                'beef' => 51,
                'EXTRA' => 42,
            ]],
        ];
    }

    /**
     * @expectedException \PHPUnit_Framework_ExpectationFailedException
     */
    public function testMultiDimArrays()
    {
        $obj = new \stdClass();

        $this->assertSameArrayExceptOrder(
            [
                '2',
                3,
                [1 , 2, 3],
                false,
                $obj,
            ],
            [
                $obj,
                [3, 2, 1],
                3,
                false,
                '2',
            ]
        );
    }

    /**
     * @dataProvider providerTestSuccessHasKeys
     */
    public function testSuccessHasKeys(array $keys)
    {
        $array = array_fill_keys(['a', 'b', 'c', 'd'], 0);

        $this->assertHasKeys($keys, $array);
    }

    public function providerTestSuccessHasKeys()
    {
        return [
            [['a']],
            [['b']],
            [['c']],
            [['d']],
            [['b','a',]],
            [['c','a',]],
            [['d','a',]],
            [['a','b',]],
            [['c','b',]],
            [['d','b',]],
            [['a','c',]],
            [['b','c',]],
            [['d','c',]],
            [['a','d',]],
            [['b','d',]],
            [['c','d',]],
            [['a','b','c']],
            [['a','b','d']],
            [['a','c','b']],
            [['a','c','d']],
            [['a','d','b']],
            [['a','d','c']],
            [['b','a','c']],
            [['b','a','d']],
            [['b','c','a']],
            [['b','c','d']],
            [['b','d','a']],
            [['b','d','c']],
            [['c','a','b']],
            [['c','a','d']],
            [['c','b','a']],
            [['c','b','d']],
            [['c','d','a']],
            [['c','d','b']],
            [['d','a','b']],
            [['d','a','c']],
            [['d','b','a']],
            [['d','b','c']],
            [['d','c','a']],
            [['d','c','b']],
        ];
    }

    /**
     * @dataProvider providerTestFailHasKeys
     * @expectedException \PHPUnit_Framework_ExpectationFailedException
     */
    public function testFailHasKeys(array $keys)
    {
        $array = array_fill_keys(['a', 'b', 'c', 'd'], 0);

        $this->assertHasKeys($keys, $array);
    }

    public function providerTestFailHasKeys()
    {
        return [
            [['e']],
            [['f']],
            [['a', 'e']],
            [['d', 'f']],
            [['d', 'z', 'a']],
            [['y', 'a', 'c']],
            [['r', 't', 'b', 'f']],
        ];
    }
}
