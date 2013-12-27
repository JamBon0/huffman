<?php

class Compressor {

	private $byteArray;
	private $hTree;

	function __construct($filePath) {
		$byteArray = count_chars(''); // Create an empty dictionnary
		$fh = fopen($filePath, 'rb');

		if (!flock($fh, LOCK_EX)) {
			throw new Exception("Can't lock file");
		}

		while (!feof($fh)) {
			$fileContents = fread($fh, 8192);
			$tmpCharArray = count_chars($fileContents); // Count every byte
			$byteArray = array_map('array_sum', array_map(null, $byteArray, $tmpCharArray)); // Sum up with total
		}

		flock($fh, LOCK_UN);
		fclose($fh);
		$this->byteArray = array_filter($byteArray); // Remove useless bytes
		$this->hTree = new HuffmanTree($this->byteArray); // Create the tree
	}

	function getCompressedSize() {
		$binSize = 0;
		$codeArray = $this->hTree->getCodeArray();

		foreach ($this->byteArray as $byte => $count) {
			$binSize += $count * strlen($codeArray[$byte]);
		}

		return ceil($binSize / 8);
	}

	function __toString() {
		$resString = '';
		$codeArray = $this->hTree->getCodeArray();

		foreach ($this->byteArray as $byte => $count) {
			$mask = (preg_match('/[\x20-\x7E]/', chr($byte)) ? '%c' : '0x%02X');
			$code = $codeArray[$byte];

			$resString .= sprintf($mask, $byte) . "($count)=$code\n";
		}

		return $resString;
	}

}
