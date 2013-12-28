<?php

define('PHP_INT_MIN', ~PHP_INT_MAX);

/**
 *
 * @param int $val
 * @param int $min
 * @param int $max
 * @return bool
 */
function in_range($val, $min = PHP_INT_MIN, $max = PHP_INT_MAX) {
	$options = array(
			'options' => array(
					'min' => $min,
					'max' => $max
			)
	);
	return filter_var($val, FILTER_VALIDATE_INT, $options) !== FALSE;
}
