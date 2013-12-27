<?php

include 'AbstractNode.php';
include 'GenericNode.php';
include 'ByteNode.php';
include 'HuffmanTree.php';
include 'Compressor.php';

$compressor = new Compressor('test.bin');
echo "$compressor\n";

$fSize = filesize('test.bin');
$cSize = $compressor->getCompressedSize();
echo "Filesize: $fSize bytes\n";
echo "Compressed Size: $cSize bytes\n";
echo "Ratio: " . round($cSize / $fSize * 100, 2) . "%\n";
