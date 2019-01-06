

<?php

spl_autoload_register(function ($class_name) {
    $dir = str_replace(DIRECTORY_SEPARATOR.basename(__DIR__), '', __DIR__).DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR;

    $filename = $dir.$class_name.'.php';

    if (file_exists($filename)) {
        require_once $filename;
    }
});
