<?php

include_once 'AbstractNode.php';
include_once 'Functions.php';

/**
 *
 */
class ByteNode extends AbstractNode {

	private $byte;
	private $count;

	/**
	 *
	 * @param int $byte
	 * @param int $count
	 * @throws InvalidArgumentException
	 */
	public function __construct($byte, $count) {
		if (!in_range($byte, 0, 255)) {
			throw new InvalidArgumentException('Invalid byte value');
		}

		if (!in_range($count, 0)) {
			throw new InvalidArgumentException('Invalid count value');
		}

		$this->byte = $byte;
		$this->count = $count;
	}

	/**
	 *
	 * @return int
	 */
	public function getByte() {
		return $this->byte;
	}

	/**
	 *
	 * @return int
	 */
	public function getCount() {
		return $this->count;
	}

}
