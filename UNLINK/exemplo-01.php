<?php

$dir = 'files';

if (!is_dir($dir)) {
    mkdir($dir);
}

$file = fopen($dir.DIRECTORY_SEPARATOR.'test.txt', 'w+');
fclose($file);

foreach (scandir($dir) as $item) {
    if (!in_array($item, array('.', '..'))) {
        unlink($dir.DIRECTORY_SEPARATOR.$item);
    }
}

echo 'ok';
