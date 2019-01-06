<?php

$data = array(
  'empresa' => 'Blackowl Solutions',
);

setcookie('NOME_DO_COOKIE', json_encode($data), time() + 3600);
