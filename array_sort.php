<?php
/* ARRAY FILTER W/ CALLBACK */
$oldArray = array('bla', 'blub', 'bla2', 'blub2');
$newArray = array_filter($oldArray, function ($entry) {
	if (substr($entry, 0, 3) == 'bla') {
		return true;
	}
	else
	{
		return false;
	}
});
var_dump($newArray);
// expected output array([0] => string(3) "bla", [1] => string(4) "bla2");
// correct output array([0] => string(3) "bla", [2] => string(4) "bla2");
// why? Because the keys from the old array will be preserved!
// you have to remove the empty keys with another array function (later).

/* ARRAY FILTER W/O CALLBACK */
$array = array(
	0 => 'foo',
	1 => false,
	2 => -1,
	3 => null,
	4 => ''
);

var_dump(array_filter($array));
// correct output array([0] => string(3) "foo", [2] => int -1);
// same as if:
// var_dump(array_filter($array, function($entry) {
//	 return $entry;
// }));


/* ARRAY FLIP */
$trans = array(
	'test' => 1,
	'meins' => 13,
	'deins' => 13,
	'obj' => new stdClass(),
	14 => 10,
	29 => 'Désirée'
);

var_dump(array_flip($trans));
/* expected output
 * array(
 * 	1 => 'test',
 * 	10 => 14,
 * 	13 => 'deins',
 * 	'obj' => stdClass(),
 * 	'Désirée' => 29
 * )
 *
 * correct output
 * WARNING
 * array(
 * 	1 => 'test',
 * 	13 => 'deins',
 * 	10 => 14,
 * 	'Désirée' => 29
 * )
 * why? key 'deins' & key 'meins' share the same value, therefore the second key overwrites the first, leaving he entry "13 => 'deins'"
 * the function only supports valid values as keys, therefore the stdClass value cannot be used as key and will not be included in the new array
 * although the value '10' of key '14' is lower than '13': positions in the new array will remain at their old place
 * ATTENTION: The german hint "wird nicht getauscht" on php.net is incorrect, it will not be included in the output array.
 */


/* ARRAY REVERSE */
$arrayToReverse = array(
	0 => 'hugo',
	1 => 'berta',
	'2' => 'fritz',
	'30' => 'franz',
	4 => 'sissi'
);

var_dump(array_reverse($arrayToReverse));
var_dump(array_reverse($arrayToReverse,true));