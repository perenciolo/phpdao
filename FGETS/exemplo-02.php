<?php

$file = 'azul.png';

$base64 = base64_encode(file_get_contents($file));

$fileinfo = new finfo(FILEINFO_MIME_TYPE);

$mimetype = $fileinfo->file($file);

echo 'data:'.$mimetype.';base64,'.$base64;
