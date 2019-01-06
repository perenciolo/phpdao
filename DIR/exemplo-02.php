<?php

$dir = 'images';
$images = scandir($dir);
$data = array();

// echo '<pre>';
// var_dump($images);
// echo '</pre>';

foreach ($images as $img) {
    if (!in_array($img, array('.', '..'))) {
        $filename = $dir.DIRECTORY_SEPARATOR.$img;

        $info = pathinfo($filename);
        $info['size'] = (filesize($filename) * 0.001).'KB';
        $info['modified'] = date('Y/m/d H:i:s', filemtime($filename));
        $info['url'] = __DIR__.DIRECTORY_SEPARATOR.str_replace('\\', '/', $filename);

        array_push($data, $info);
    }
}

echo json_encode($data);
