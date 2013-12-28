<?php

include_once 'HuffmanTree.php';
include_once 'IOException.php';

class Compressor {

	private $byteArray;
	private $fHandle;
	private $hTree;

	public function __construct($filePath) {
		$this->byteArray = count_chars(''); // Create an empty dictionnary
		$this->fHandle = fopen($filePath, 'rb');

		if ($this->fHandle === false) {
			throw new IOException("Can't open file");
		}

		if (!flock($this->fHandle, LOCK_SH)) {
			throw new IOException("Can't lock file");
		}

		while (!feof($this->fHandle)) {
			$fileContents = fread($this->fHandle, 8192);
			$tmpCharArray = count_chars($fileContents); // Count every byte
			$this->byteArray = array_map('array_sum', array_map(null, $this->byteArray, $tmpCharArray)); // Sum up with total
		}

		$this->byteArray = array_filter($this->byteArray); // Remove useless bytes
		$this->hTree = new HuffmanTree($this->byteArray); // Create the tree
	}

	public function __destruct() {
		flock($this->fHandle, LOCK_UN);
		fclose($this->fHandle);
	}

	public function __toString() {
		$resString = '';
		$codeArray = $this->hTree->getCodeArray();

		foreach ($this->byteArray as $byte => $count) {
			$mask = (preg_match('/[\x20-\x7E]/', chr($byte)) ? '%c' : '0x%02X');
			$code = $codeArray[$byte];

			$resString .= sprintf($mask, $byte) . "($count)=$code\n";
		}

		return $resString;
	}

	public function getCompressedSize() {
		$binSize = 0;
		$codeArray = $this->hTree->getCodeArray();

		foreach ($this->byteArray as $byte => $count) {
			$binSize += $count * strlen($codeArray[$byte]);
		}

		return ceil($binSize / 8);
	}

}
