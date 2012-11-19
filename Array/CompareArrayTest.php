<?php

/**
 * compare sort functions
 *
 * @author André
 */
class CompareArrayTest extends PHPUnit_Framework_TestCase
{
    /**
     * test array_diff()
     * Compares array1 against array2 and returns the difference.
     *
     * array array_diff ( array $array1 , array $array2 [, array $... ] )
     */
    public function testArrayDiff()
    {
        $arrOrigin1 = array(
            "a" => "grün",
            "rot",
            "blau",
            "rot"
        );

        $arrOrigin2 = array(
            "b" => "grün",
            "gelb",
            "rot"
        );

        $arrExpect = array(
            1 => "blau"
        );

        $this->assertSame($arrExpect, array_diff($arrOrigin1, $arrOrigin2));
    }

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
            "gelb",
            "rot"
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
                return ($a > $b) ? 1 : -1;
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
            'blue' => 1,
            'red' => 2,
            'green' => 3,
            'purple' => 4
        );

        $arrOrigin2 = array(
            'green' => 5,
            'blue' => 6,
            'yellow' => 7,
            'cyan' => 8
        );

        $arrExpect = array(
            'red' => 2,
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

    /**
     * test array_udiff()
     * Computes the difference of arrays by using a callback function for data comparison
     * This is unlike array_diff() which uses an internal function for comparing the data.
     *
     * array array_udiff ( array $array1 , array $array2 [, array $ ... ], callable $data_compare_func )
     */
    public function testArrayUdiff()
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
            "c" => "blue"
        );

        $arrResult = array_udiff(
            $arrOrigin1,
            $arrOrigin2,
            function ($a, $b) {
                if ($a === $b) {
                    return 0;
                }
                return ($a > $b) ? 1 : -1;
            }
        );

        $this->assertSame($arrExpect, $arrResult);
    }

    /**
     * test array_udiff_assoc()
     * Computes the difference of arrays with additional index check, compares data by a callback function
     *
     * array array_udiff_assoc ( array $array1 , array $array2 [, array $ ... ], callable $data_compare_func )
     */
    public function testArrayUdiffAssoc()
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

        $arrResult = array_udiff_assoc(
            $arrOrigin1,
            $arrOrigin2,
            function ($a, $b) {
                if ($a === $b) {
                    return 0;
                }
                return ($a > $b) ? 1 : -1;
            }
        );

        $this->assertSame($arrExpect, $arrResult);
    }

    /**
     * test array_udiff_uassoc()
     * Computes the difference of arrays with additional index check, compares data and indexes by a callback function.
     *
     * array array_udiff_uassoc ( array $array1 , array $array2 [, array $ ... ], callable $data_compare_func , callable $key_compare_func )
     */
    public function testArrayUdiffUassoc()
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

        $arrResult = array_udiff_uassoc(
            $arrOrigin1,
            $arrOrigin2,
            function ($a, $b) {
                if ($a === $b) {
                    return 0;
                }
                return ($a > $b) ? 1 : -1;
            },
            function ($a, $b) {
                if ($a === $b) {
                    return 0;
                }
                return ($a > $b) ? 1 : -1;
            }
        );

        $this->assertSame($arrExpect, $arrResult);
    }

    /**
     * test array_intersect()
     * array_intersect() returns an array containing all the values of array1 that are present in all the arguments
     * Note that keys are preserved
     *
     * array array_intersect ( array $array1 , array $array2 [, array $ ... ] )
     */
    public function testArrayIntersect()
    {
        $arrOrigin1 = array(
            "a" => "green",
            "red",
            "blue"
        );

        $arrOrigin2 = array(
            "b" => "green",
            "yellow",
            "red"
        );

        $arrExpect = array(
            "a" => "green",
            "red"
        );

        $this->assertSame($arrExpect, array_intersect($arrOrigin1, $arrOrigin2));
    }

    /**
     * test array_intersect_assoc()
     * array_intersect_assoc() returns an array containing all the values of array1 that are present in all the arguments
     * Note that the keys are used in the comparison unlike in array_intersect()
     *
     * array array_intersect_assoc ( array $array1 , array $array2 [, array $ ... ] )
     */
    public function testArrayIntersectAssoc()
    {
        $arrOrigin1 = array(
            "a" => "green",
            "b" => "brown",
            "c" => "blue",
            "red"
        );

        $arrOrigin2 = array(
            "a" => "green",
            "b" => "yellow",
            "blue",
            "red"
        );

        $arrExpect = array(
            "a" => "green"
        );

        $this->assertSame($arrExpect, array_intersect_assoc($arrOrigin1, $arrOrigin2));
    }

    /**
     * test array_intersect_key()
     * array_intersect_key() returns an array containing all the entries of array1 which have keys that are present in all the arguments
     *
     * array array_intersect_key ( array $array1 , array $array2 [, array $ ... ] )
     */
    public function testArrayIntersectKey()
    {
        $arrOrigin1 = array(
            'blue' => 1,
            'red' => 2,
            'green' => 3,
            'purple' => 4
        );

        $arrOrigin2 = array(
            'green' => 5,
            'blue' => 6,
            'yellow' => 7,
            'cyan' => 8
        );

        $arrExpect = array(
            'blue' => 1,
            'green' => 3
        );

        $this->assertSame($arrExpect, array_intersect_key($arrOrigin1, $arrOrigin2));
    }

    /**
     * test array_intersect_uassoc()
     * array_intersect_uassoc() returns an array containing all the values of array1 that are present in all the arguments
     * Note that the keys are used in the comparison unlike in array_intersect()
     *
     * array array_intersect_uassoc ( array $array1 , array $array2 [, array $ ... ], callable $key_compare_func )
     */
    public function testArrayIntersectUassoc()
    {
        $arrOrigin1 = array(
            "a" => "green",
            "b" => "brown",
            "c" => "blue",
            "red"
        );

        $arrOrigin2 = array(
            "a" => "GREEN",
            "B" => "brown",
            "yellow",
            "red"
        );

        $arrExpect = array(
            "b" => "brown"
        );

        $this->assertSame($arrExpect, array_intersect_uassoc($arrOrigin1, $arrOrigin2, "strcasecmp"));
    }

    /**
     * test array_intersect_ukey()
     * array_intersect_ukey() returns an array containing all the values of array1 which have matching keys that are present in all the arguments
     *
     * array array_intersect_ukey ( array $array1 , array $array2 [, array $... ], callable $key_compare_func )
     */
    public function testArrayIntersectUkey()
    {
        $arrOrigin1 = array(
            'blue' => 1,
            'red' => 2,
            'green' => 3,
            'purple' => 4
        );

        $arrOrigin2 = array(
            'green' => 5,
            'blue' => 6,
            'yellow' => 7,
            'cyan' => 8
        );

        $arrExpect = array(
            'blue' => 1,
            'green' => 3
        );

        $arrResult = array_intersect_ukey(
            $arrOrigin1,
            $arrOrigin2,
            function ($key1, $key2) {
                if ($key1 == $key2) {
                    return 0;
                } else {
                    if ($key1 > $key2) {
                        return 1;
                    } else {
                        return -1;
                    }
                }
            }
        );

        $this->assertSame($arrExpect, $arrResult);
    }

    /**
     * test array_uintersect()
     * Computes the intersection of arrays, compares data by a callback function.
     *
     * array array_uintersect ( array $array1 , array $array2 [, array $ ... ], callable $data_compare_func )
     */
    public function testArrayUintersect()
    {
        $arrOrigin1 = array(
            "a" => "green",
            "b" => "brown",
            "c" => "blue",
            "red"
        );

        $arrOrigin2 = array(
            "a" => "GREEN",
            "B" => "brown",
            "yellow",
            "red"
        );

        $arrExpect = array(
            "a" => "green",
            "b" => "brown",
            "red"
        );

        $this->assertSame($arrExpect, array_uintersect($arrOrigin1, $arrOrigin2, "strcasecmp"));
    }

    /**
     * test array_uintersect_assoc()
     * Computes the intersection of arrays with additional index check, compares data by a callback function.
     *
     * array array_uintersect_assoc ( array $array1 , array $array2 [, array $ ... ], callable $data_compare_func )
     */
    public function testArrayUintersectAssoc()
    {
        $arrOrigin1 = array(
            "a" => "green",
            "b" => "brown",
            "c" => "blue",
            "red"
        );

        $arrOrigin2 = array(
            "a" => "GREEN",
            "B" => "brown",
            "yellow",
            "red"
        );

        $arrExpect = array(
            "a" => "green"
        );

        $this->assertSame($arrExpect, array_uintersect_assoc($arrOrigin1, $arrOrigin2, "strcasecmp"));
    }

    /**
     * test array_uintersect_uassoc()
     * Computes the intersection of arrays with additional index check,
     * compares data and indexes by a callback functions Note that the keys
     * are used in the comparison unlike in array_uintersect()
     * Both the data and the indexes are compared by using separate callback functions
     *
     * array array_uintersect_uassoc ( array $array1 , array $array2 [, array $ ... ], callable $data_compare_func , callable $key_compare_func )
     */
    public function testArrayUintersectUassoc()
    {
        $arrOrigin1 = array(
            "a" => "green",
            "b" => "brown",
            "c" => "blue",
            "red"
        );

        $arrOrigin2 = array(
            "a" => "GREEN",
            "B" => "brown",
            "yellow",
            "red"
        );

        $arrExpect = array(
            "a" => "green",
            "b" => "brown"
        );

        $this->assertSame($arrExpect, array_uintersect_uassoc($arrOrigin1, $arrOrigin2, "strcasecmp", "strcasecmp"));
    }

    /**
     * test in_array()
     * Searches haystack for needle using loose comparison unless strict is set.
     *
     * bool in_array ( mixed $needle , array $haystack [, bool $strict = FALSE ] )
     */
    public function testInArray()
    {
        $arrOrigin = array(
            "Mac",
            "NT",
            "Irix",
            "Linux"
        );

        $this->assertTrue(in_array('Irix', $arrOrigin));
        $this->assertFalse(in_array('mac', $arrOrigin));
    }
}
