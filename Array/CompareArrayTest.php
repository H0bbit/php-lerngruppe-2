<?php

/**
 * compare sort functions
 *
 * @author André
 */
class CompareArrayTest extends PHPUnit_Framework_TestCase
{
    /**
     * test array_diff_assoc()
     * Computes the difference of arrays with additional index check
     *
     * array array_diff_assoc ( array $array1 , array $array2 [, array $... ] )
     */
    public function testArrayDiffAssoc()
    {
        $arrOrigin1 = array(
            "a" => "gruen",
            "b" => "braun",
            "c" => "blau",
            "rot"
        );
        $arrOrigin2 = array(
            "a" => "gruen",
            "gelb", "rot"
        );

        $arrExpect = array(
            "b" => "braun",
            "c" => "blau",
            "rot"
        );

        $this->assertSame($arrExpect, array_diff_assoc($arrOrigin1, $arrOrigin2));
    }

    /**
     * test array_diff_key()
     * Computes the difference of arrays using keys for comparison
     *
     * array array_diff_key ( array $array1 , array $array2 [, array $... ] )
     */
    public function testArrayDiffKey()
    {
        $arrOrigin1 = array(
            'blau' => 1,
            'rot' => 2,
            'grün' => 3,
            'violett' => 4
        );

        $arrOrigin2 = array(
            'grün' => 5,
            'blau' => 6,
            'gelb' => 7,
            'türkis' => 8
        );

        $arrExpect = array(
            'rot' => 2,
            'violett' => 4
        );

        $this->assertSame($arrExpect, array_diff_key($arrOrigin1, $arrOrigin2));
    }

    /**
     * test array_diff_uassoc()
     * Computes the difference of arrays with additional index check which is performed by a user supplied callback function
     *
     * array array_diff_uassoc ( array $array1 , array $array2 [, array $... ], callable $key_compare_func )
     */
    public function testArrayDiffUassoc()
    {
        $arrOrigin1 = array(
            "a" => "green",
            "b" => "brown",
            "c" => "blue",
            "red"
        );

        $arrOrigin2 = array(
            "a" => "green",
            "yellow",
            "red"
        );

        $arrExpect = array(
            "b" => "brown",
            "c" => "blue",
            "red"
        );

        $arrResult = array_diff_uassoc(
            $arrOrigin1,
            $arrOrigin2,
            function ($a, $b) {
                if ($a === $b) {
                    return 0;
                }
                return ($a > $b)? 1:-1;
            }
        );

        $this->assertSame($arrExpect, $arrResult);
    }

    /**
     * test array_diff_ukey()
     * Computes the difference of arrays using a callback function on the keys for comparison
     *
     * array array_diff_ukey ( array $array1 , array $array2 [, array $ ... ], callable $key_compare_func )
     */
    public function testArrayDiffUkey()
    {
        $arrOrigin1 = array(
            'blue'  => 1,
            'red'  => 2,
            'green'  => 3,
            'purple' => 4
        );

        $arrOrigin2 = array(
            'green' => 5,
            'blue' => 6,
            'yellow' => 7,
            'cyan'   => 8
        );

        $arrExpect = array(
            'red'  => 2,
            'purple' => 4
        );

        $arrResult = array_diff_ukey(
            $arrOrigin1,
            $arrOrigin2,
            function ($key1, $key2) {
                if ($key1 == $key2) {
                    return 0;
                } elseif ($key1 > $key2) {
                    return 1;
                } else {
                    return -1;
                }
            }
        );

        $this->assertSame($arrExpect, $arrResult);
    }

    public function testArrayDiff()
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testArrayIntersectAssoc()
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testArrayIntersectKey()
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testArrayIntersectUassoc()
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testArrayIntersectUkey()
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testArrayIntersect()
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testArrayUdiffAssoc()
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testArrayUdiffUassoc()
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testArrayUdiff()
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testArrayUintersectAssoc()
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testArrayUintersectUassoc()
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testArrayUintersect()
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testInArray()
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }
}
