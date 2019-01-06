<?php

$file = fopen('log.txt', 'a+');

fwrite($file, date('Y-m-d H:i:s')."\r\n");
fwrite($file, json_encode($_SERVER['HTTP_USER_AGENT'])."\r\n");

fclose($file);

echo 'ok';
