<?php

class ByteNode extends AbstractNode {

	private $byte;
	private $count;

	function __construct($byte, $count) {
		$this->byte = $byte;
		$this->count = $count;
	}

	function getCount() {
		return $this->count;
	}

	function getByte() {
		return $this->byte;
	}

}
