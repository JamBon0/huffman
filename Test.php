<?php

include_once 'Compressor.php';

$compressor = new Compressor('examples/test.bin');
$fSize = filesize('examples/test.bin');
$cSize = $compressor->getCompressedSize();

echo "$compressor\n";
echo "Filesize: $fSize bytes\n";
echo "Compressed Size: $cSize bytes\n";
echo "Ratio: " . round($cSize / $fSize * 100, 2) . "%\n";
