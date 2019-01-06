<?php

function trataName($name)
{
    if (!$name) {
        throw new Exception('Nenhum nome foi informado', 407);
    }
    echo ucfirst($name).'<br>';
}

try {
    trataName('joao');
    trataName('');
} catch (Exception $e) {
    echo json_encode(array(
    'message' => $e->getMessage(),
    'line' => $e->getLine(),
    'file' => $e->getFile(),
    'code' => $e->getCode(),
  ));
} finally {
    echo '<br>';
    echo 'Foda-se';
}
