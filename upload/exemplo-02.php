<?php

$link = 'https://images.ctfassets.net/o59xlnp87tr5/Xu49VLbm80ey028O0OEQS/d3bf7a323309ac3620add095d7074adc/web_554731690.jpg?w=360&h=240&fit=fill';

$content = file_get_contents($link);

$parse = parse_url($link);

$basename = basename($parse['path']);

$file = fopen($basename, 'w+');

fwrite($file, $content);
fclose($file);

echo '<img src="'.$basename.'"/>';
