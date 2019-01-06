<?php

require_once 'config'.DIRECTORY_SEPARATOR.'config.php';

// $sql = new DbConnection();

// $usuarios = $sql->select('SELECT * FROM tb_usuarios');

// echo json_encode($usuarios);

$root = new Usuario();

$root->loadById(1);

// echo $root;

$lista = json_encode(Usuario::getList());

// echo $lista;

$login = json_encode(Usuario::search('gus'));

// echo $login;

$byLoginPass = new Usuario();

$byLoginPass->login('gus', '12345');

echo $byLoginPass;
