<?php

$filename = 'usuarios.csv';

if (file_exists($filename)) {
    $file = fopen($filename, 'r');

    $headers = explode(',', fgets($file));

    $data = array();

    while ($rowData = fgets($file)) {
        $row = explode(',', $rowData);
        $line = array();

        for ($i = 0; $i < count($headers); ++$i) {
            $line[$headers[$i]] = $row[$i];
        }

        array_push($data, $line);
    }

    fclose($file);

    echo json_encode($data);
}
