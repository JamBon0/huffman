<?php

class HuffmanTree {

	private $byteArray;
	private $rootNode;

	function __construct(array $byteArray) {
		if (count($byteArray) < 2) {
			throw new Exception('Byte list must have at least two elements');
		}

		$this->byteArray = $byteArray;

		foreach ($this->byteArray as $byte => $count) {
			$nodeArray[] = new ByteNode($byte, $count);
		}

		while (count($nodeArray) > 1) {
			usort($nodeArray, array('AbstractNode', 'cmpNode'));

			$tmpNode = new GenericNode();
			$tmpNode->addSubNode($nodeArray[0]);
			$tmpNode->addSubNode($nodeArray[1]);

			$nodeArray[0] = $tmpNode;
			unset($nodeArray[1]);
		}

		$this->rootNode = $nodeArray[0];
	}

	function getCodeArray() {
		$codeArray = array();

		foreach ($this->byteArray as $byte => $_) {
			$codeArray[$byte] = $this->rootNode->getCode($byte);
		}

		return $codeArray;
	}

}
