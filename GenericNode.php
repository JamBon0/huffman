<?php

include_once 'AbstractNode.php';
include_once 'ByteNode.php';

/**
 *
 */
class GenericNode extends AbstractNode {

	private $subNodes;

	/**
	 *
	 */
	public function __construct() {
		$this->subNodes = array();
	}

	/**
	 *
	 * @param AbstractNode $node
	 * @throws OverflowException
	 */
	public function addSubNode(AbstractNode $node) {
		if (count($this->subNodes) >= 2) {
			throw new OverflowException('Too many sub node');
		}

		$this->subNodes[] = $node;
		//usort($this->subNodes, array('AbstractNode', 'cmpNode'));
	}

	/**
	 *
	 * @return int
	 */
	public function getCount() {
		$count = 0;

		foreach ($this->subNodes as $node) {
			$count += $node->getCount();
		}

		return $count;
	}

	/**
	 *
	 * @param int $byte
	 * @return int
	 */
	public function getCode($byte) {
		$code = null;

		for ($i = 0; isset($this->subNodes[$i]) && is_null($code); $i++) {
			$node = $this->subNodes[$i];

			if ($node instanceof GenericNode) {
				$subCode = $node->getCode($byte);

				if ($subCode !== null) { // If we have a code from this node, that's because the byte is in its subtree
					$code = $i . $subCode; // So, this node is in the code too
				}
			} elseif ($node instanceof ByteNode) {
				if ($node->getByte() === $byte) { // If we have found the byte in that node
					$code = $i; // We begin the code
				}
			}
		}

		return $code;
	}

}
