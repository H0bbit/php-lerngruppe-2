<?php

/**
 * array sort functions
 */
class SortArrayTest extends PHPUnit_Framework_TestCase
{
    /**
     * test sort()
     */
    public function testSort()
    {
        $arrOrigin = array(0, 2, 1);
        $arrExpect = array(0, 1, 2);

        sort($arrOrigin);

        $this->assertSame($arrExpect, $arrOrigin);
    }

    /**
     * test rsort()
     */
    public function testRsort()
    {
        $arrOrigin = array(0, 2, 1);
        $arrExpect = array(2, 1, 0);

        rsort($arrOrigin);

        $this->assertSame($arrExpect, $arrOrigin);
    }

    /**
     * test asort()
     */
    public function testAsort()
    {
        $arrOrigin = array('a' => 0, 'b' => 2, 'c' => 1);
        $arrExpect = array('a' => 0, 'c' => 1, 'b' => 2);

        asort($arrOrigin);

        $this->assertSame($arrExpect, $arrOrigin);
    }

    /**
     * test arsort()
     */
    public function testArsort()
    {
        $arrOrigin = array('a' => 0, 'b' => 2, 'c' => 1);
        $arrExpect = array('b' => 2, 'c' => 1, 'a' => 0);

        arsort($arrOrigin);

        $this->assertSame($arrExpect, $arrOrigin);
    }
}
