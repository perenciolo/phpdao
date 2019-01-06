<?php

require_once str_replace(DIRECTORY_SEPARATOR.basename(__DIR__), '', __DIR__).DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php';

$sql = new DbConnection();
$results = $sql->select('SELECT * FROM tb_usuarios ORDER BY login');

$headers = array();

foreach ($results[0] as $key => $value) {
    array_push($headers, $key);
}

$file = fopen('usuarios.csv', 'w+');

fwrite($file, implode(',', $headers)."\r\n");

foreach ($results as $row) {
    $data = array();

    foreach ($row as $key => $value) {
        array_push($data, $value);
    } // columns

    fwrite($file, implode(',', $data)."\r\n");
} // rows

fclose($file);

echo 'ok';
