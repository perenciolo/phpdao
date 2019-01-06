<?php

require_once 'config'.DIRECTORY_SEPARATOR.'config.php';

// $sql = new DbConnection();

// $usuarios = $sql->select('SELECT * FROM tb_usuarios');

// echo json_encode($usuarios);

// $root = new Usuario();

// $root->loadById(1);

// echo $root;

// $lista = Usuario::getList();

// echo $lista;

// $login = Usuario::search('gus');

// echo $login;

// $byLoginPass = new Usuario();

// $byLoginPass->login('gus', '12345');

// echo $byLoginPass;

$aluno = new Usuario('puta', '5994471ABB01112AFCC18159F6CC74B4F511B99806DA59B3CAF5A9C173CACFC5');
// $aluno = new Usuario('rola', '4A0916EE9AE469D6B2DCF196B89FECF88664EB65DD9FA5E69C7C1F14F8F85F8C');

$aluno->insert();

echo $aluno;
