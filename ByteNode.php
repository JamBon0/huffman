<?php

include_once 'AbstractNode.php';

function in_range($val, $min = -PHP_INT_MAX, $max = PHP_INT_MAX) {
	return filter_var($val, FILTER_VALIDATE_INT, array('options' => array('min' => $min, 'max' => $max))) !== FALSE;
}

class ByteNode extends AbstractNode {

	private $byte;
	private $count;

	public function __construct($byte, $count) {
		if (!in_range($byte, 0, 255)) {
			throw new RangeException('Invalid byte value');
		}

		if (!in_range($count, 0)) {
			throw new RangeException('Invalid count value');
		}

		$this->byte = $byte;
		$this->count = $count;
	}

	public function getCount() {
		return $this->count;
	}

	public function getByte() {
		return $this->byte;
	}

}
