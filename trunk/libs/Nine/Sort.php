<?php
/**
 * LICENSE
 * 
 * [license information]
 * 
 * @category   Nine
 * @copyright  Copyright (c) 2011 9fw.org
 * @license    http://license.9fw.org
 * @version    v 1.0 2009-04-15
 * 
 */
class Nine_Sort {
	/*
	 * Sort array data with key and value
	 * @example
	 * $tmp = array('ca'=>1,'cb'=>2,'ce'=>1,'pa'=>2,'pe'=>1);
	 * // Standard asort
	 * asort($tmp);
	 * print_r($tmp);
	 * // Sort value ASC, key ASC
	 * aksort($tmp);
	 * print_r($tmp);
	 * 
	 * //Sort value DESC, key ASC
	 * aksort($tmp,true);
	 * print_r($tmp);
	 * 
	 * //Sort value DESC, key DESC
	 * aksort($tmp,true,true);
	 * print_r($tmp);
	 */
	public static function akSort(&$array, $valrev = false, $keyrev = false) {
		if ($valrev) {
			arsort ( $array );
		} else {
			asort ( $array );
		}
		$vals = array_count_values ( $array );
		$i = 0;
		foreach ( $vals as $val => $num ) {
			$first = array_splice ( $array, 0, $i );
			$tmp = array_splice ( $array, 0, $num );
			if ($keyrev) {
				krsort ( $tmp );
			} else {
				ksort ( $tmp );
			}
			$array = array_merge ( $first, $tmp, $array );
			unset ( $tmp );
			$i = $num;
		}
	}
	/*
	 * Sort by colmn assocc in array
	 * @return array
	 * @example
	 * $t = array(array('a'=>'asdf','d'=>'zdf'),array('a'='sdfad','d'=>'sdf'))
	 * $array = Nine_Sort::sortByCol($t, 'a');
	 * 
	 */
	public static function sortByCol($array, $col)
	{
			
	}
}