<?php

/**
 * array sort functions
 *
 * @author André
 */
class SortArrayTest extends PHPUnit_Framework_TestCase
{
    /**
     * test array_filter()
     * Filtert Elemente eines Arrays mittels einer Callback-Funktion
     *
     * array array_filter ( array $input [, callback $callback ] )
     */
    public function testArrayFilter()
    {
        // TEST 1
        // expected output array([0] => string(3) "bla", [1] => string(4) "bla2");
        // correct output array([0] => string(3) "bla", [2] => string(4) "bla2");
        // why? Because the keys from the old array will be preserved!
        // you have to remove the empty keys with another array function (later).

        $arrOrigin = array('bla', 'blub', 'bla2', 'blub2');
        $arrExpect = array(0 => 'bla', 2 => 'bla2');

        $arrNew = array_filter(
            $arrOrigin,
            function ($entry) {
                if (substr($entry, 0, 3) == 'bla') {
                    return true;
                } else {
                    return false;
                }
            }
        );

        $this->assertSame($arrExpect, $arrNew);

        // TEST 2
        // correct output array([0] => string(3) "foo", [2] => int -1);
        // same as if:
        // var_dump(array_filter($array, function($entry) {
        //  return $entry;
        // }));

        $arrOrigin = array(
            0 => 'foo',
            1 => false,
            2 => -1,
            3 => null,
            4 => ''
        );

        $arrExpect = array(
            0 => 'foo',
            2 => -1
        );

        $arrNew = array_filter($arrOrigin);

        $this->assertSame($arrExpect, $arrNew);
    }

    /**
     * test array_flip()
     * Vertauscht alle Schlüssel mit ihren zugehörigen Werten in einem Array
     *
     * array array_flip ( array $trans )
     */
    public function testArrayFlip()
    {
        // key 'deins' & key 'meins' share the same value, therefore the second key overwrites the first, leaving he entry "13 => 'deins'"
        // the function only supports valid values as keys, therefore the stdClass value cannot be used as key and will not be included in the new array
        // although the value '10' of key '14' is lower than '13': positions in the new array will remain at their old place
        // ATTENTION: The german hint "wird nicht getauscht" on php.net is incorrect, it will not be included in the output array.

        $arrOrigin = array(
            'test' => 1,
            'meins' => 13,
            'deins' => 13,
            //'obj' => new stdClass(), // -> php unit error
            14 => 10,
            29 => 'Désirée'
        );

        $arrExpect = array(
            1 => 'test',
            13 => 'deins',
            10 => 14,
            'Désirée' => 29
        );

        $arrNew = array_flip($arrOrigin);

        $this->assertSame($arrExpect, $arrNew);
    }

    /**
     * test array_multisort()
     * Sortiert mehrere oder multidimensionale Arrays
     *
     * bool array_multisort ( array &$arr [, mixed $arg = SORT_ASC [, mixed $arg = SORT_REGULAR [, mixed $... ]]] )
     */
    public function testArrayMultisort()
    {
        $arrOrigin1 = array(
            0 => 10,
            1 => "2",
            2 => "hugo",
            3 => "4",
            4 => 3,
            5 => "1anna"
        );

        $arrExpect1 = array(
            0 => "1anna",
            1 => "2",
            2 => "4",
            3 => "hugo",
            4 => 3,
            5 => 10
        );

        $arrOrigin2 = array(
            0 => 100,
            1 => "4gut8",
            2 => "fritz",
            3 => "67",
            4 => 3,
            5 => 20987
        );

        $arrExpect2 = array(
            0 => 20987,
            1 => "4gut8",
            2 => "67",
            3 => "fritz",
            4 => 3,
            5 => 100
        );

        array_multisort($arrOrigin1, $arrOrigin2);

        $this->assertSame($arrExpect1, $arrOrigin1);
        $this->assertSame($arrExpect2, $arrOrigin2);
    }

    /**
     * test array_reverse()
     * Liefert ein Array mit umgekehrter Reihenfolge der Elemente
     *
     * array array_reverse ( array $array [, bool $preserve_keys = false ] )
     */
    public function testArrayReverse()
    {
        // TEST 1

        $arrOrigin = array(
            0 => 'hugo',
            1 => 'berta',
            '2' => 'fritz',
            '30' => 'franz',
            4 => 'sissi'
        );

        $arrExpect = array(
            0 => 'sissi',
            1 => 'franz',
            2 => 'fritz',
            3 => 'berta',
            4 => 'hugo'
        );

        $arrNew = array_reverse($arrOrigin);

        $this->assertSame($arrExpect, $arrNew);

        // TEST 2

        $arrOrigin = array(
            0 => 'hugo',
            1 => 'berta',
            '2' => 'fritz',
            '30' => 'franz',
            4 => 'sissi'
        );

        $arrExpect = array(
            4 => 'sissi',
            '30' => 'franz',
            '2' => 'fritz',
            1 => 'berta',
            0 => 'hugo'
        );

        $arrNew = array_reverse($arrOrigin, true);

        $this->assertSame($arrExpect, $arrNew);

        // TEST 3

        $arrOrigin = array(
            'php',
            4.0,
            array(
                'grün',
                'rot'
            )
        );

        $arrExpect = array(
            array(
                'grün',
                'rot'
            ),
            4.0,
            'php'
        );

        $arrNew = array_reverse($arrOrigin);

        $this->assertSame($arrExpect, $arrNew);
    }

    /**
     * test asort()
     * Sortiert ein Array und erhält die Index-Assoziation
     *
     * bool asort ( array &$array [, int $sort_flags = SORT_REGULAR ] )
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
     * Sortiert ein Array in umgekehrter Reihenfolge und erhält die Index-Assoziation
     *
     * bool arsort ( array &$array [, int $sort_flags = SORT_REGULAR ] )
     */
    public function testArsort()
    {
        $arrOrigin = array('a' => 0, 'b' => 2, 'c' => 1);
        $arrExpect = array('b' => 2, 'c' => 1, 'a' => 0);

        arsort($arrOrigin);

        $this->assertSame($arrExpect, $arrOrigin);
    }

    /**
     * test ksort()
     * Sortiert ein Array nach Schlüsseln
     *
     * bool ksort ( array &$array [, int $sort_flags = SORT_REGULAR ] )
     */
    public function testKsort()
    {
        $arrOrigin = array('b' => 0, 'c' => 2, 'a' => 1);
        $arrExpect = array('a' => 1, 'b' => 0, 'c' => 2);

        ksort($arrOrigin);

        $this->assertSame($arrExpect, $arrOrigin);
    }

    /**
     * test krsort()
     * Sortiert ein Array nach Schlüsseln in umgekehrter Reihenfolge
     *
     * bool krsort ( array &$array [, int $sort_flags = SORT_REGULAR ] )
     */
    public function testKrsort()
    {
        $arrOrigin = array('b' => 0, 'c' => 2, 'a' => 1);
        $arrExpect = array('c' => 2, 'b' => 0, 'a' => 1);

        krsort($arrOrigin);

        $this->assertSame($arrExpect, $arrOrigin);
    }

    /**
     * test natcasesort()
     * Sortiert ein Array in "natürlicher Reihenfolge", Groß/Kleinschreibung wird ignoriert
     *
     * bool natcasesort ( array &$array )
     */
    public function testNatcasesort()
    {
        $arrOrigin = array('IMG0.png', 'img12.png', 'img10.png', 'Img2.png', 'img1.png', 'IMG3.png');
        $arrExpect = array(
            0 => 'IMG0.png',
            4 => 'img1.png',
            3 => 'Img2.png',
            5 => 'IMG3.png',
            2 => 'img10.png',
            1 => 'img12.png'
        );

        natcasesort($arrOrigin);

        $this->assertSame($arrExpect, $arrOrigin);
    }

    /**
     * test natsort()
     * Sortiert ein Array in "natürlicher Reihenfolge"
     *
     * bool natsort ( array &$array )
     */
    public function testNatsort()
    {
        $arrOrigin = array('IMG0.png', 'img12.png', 'img10.png', 'Img2.png', 'img1.png', 'IMG3.png');
        $arrExpect = array(
            0 => 'IMG0.png',
            5 => 'IMG3.png',
            3 => 'Img2.png',
            4 => 'img1.png',
            2 => 'img10.png',
            1 => 'img12.png'
        );

        natsort($arrOrigin);

        $this->assertSame($arrExpect, $arrOrigin);
    }

    /**
     * test sort()
     * Sortiert ein Array
     *
     * bool sort ( array &$array [, int $sort_flags = SORT_REGULAR ] )
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
     * Sortiert ein Array in umgekehrter Reihenfolge
     *
     * bool rsort ( array &$array [, int $sort_flags = SORT_REGULAR ] )
     */
    public function testRsort()
    {
        $arrOrigin = array(0, 2, 1);
        $arrExpect = array(2, 1, 0);

        rsort($arrOrigin);

        $this->assertSame($arrExpect, $arrOrigin);
    }

    /**
     * test shuffle()
     * Mischt die Elemente eines Arrays
     *
     * bool shuffle ( array &$array )
     */
    public function testShuffle()
    {
        $arrOrigin = array('b' => 0, 'c' => 2, 'a' => 1);
        $arrExpect = array('b' => 0, 'c' => 2, 'a' => 1);

        $this->assertNotSame($arrExpect, shuffle($arrOrigin));
    }

    /**
     * test uasort()
     * Sortiert ein Array mittels einer benutzerdefinierten Vergleichsfunktion und behält Indexassoziationen bei
     *
     * bool uasort ( array &$array , callable $cmp_function )
     */
    public function testUasort()
    {
        $arrOrigin = array(0 => 13, 1 => 40, 2 => 5, 3 => 23, 4 => 19, 5 => 100, 6 => 80);
        $arrExpect = array(2 => 5, 0 => 13, 4 => 19, 3 => 23, 1 => 40, 6 => 80, 5 => 100);

        uasort(
            $arrOrigin,
            function ($a, $b) {
                if ($a > $b) {
                    return true;
                } else {
                    return false;
                }
            }
        );

        $this->assertSame($arrExpect, $arrOrigin);
    }

    /**
     * test uksort()
     * Sortiert ein Array nach Schlüsseln mittels einer benutzerdefinierten Vergleichsfunktion
     *
     * bool uksort ( array &$array , callable $cmp_function )
     */
    public function testUksort()
    {
        $arrOrigin = array('c' => 1, 'a' => 'test', 'b' => 'lol');
        $arrExpect = array('a' => 'test', 'b' => 'lol', 'c' => 1);

        uksort(
            $arrOrigin,
            function ($a, $b) {
                if ($a > $b) {
                    return true;
                } else {
                    return false;
                }
            }
        );

        $this->assertSame($arrExpect, $arrOrigin);
    }

    /**
     * test usort()
     * Sortiert ein Array nach Werten mittels einer benutzerdefinierten Vergleichsfunktion
     *
     * bool usort ( array &$array , callable $cmp_function )
     */
    public function testUsort()
    {
        $arrOrigin = array(0 => 13, 1 => 40, 2 => 5, 3 => 23, 4 => 19, 5 => 100, 6 => 80);
        $arrExpect = array(0 => 5, 1 => 13, 2 => 19, 3 => 23, 4 => 40, 5 => 80, 6 => 100);

        usort(
            $arrOrigin,
            function ($a, $b) {
                if ($a > $b) {
                    return true;
                } else {
                    return false;
                }
            }
        );

        $this->assertSame($arrExpect, $arrOrigin);
    }
}
