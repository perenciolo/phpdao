<?php

require_once 'config'.DIRECTORY_SEPARATOR.'config.php';

$sql = new DbConnection();

$usuarios = $sql->select('SELECT * FROM tb_usuarios');

echo json_encode($usuarios);
