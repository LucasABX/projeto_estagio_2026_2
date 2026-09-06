<?php

    require_once __DIR__ . '/../lib/db.php';

    $metodo = $_SERVER['REQUEST_METHOD'];
    $caminho = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    if($metodo === 'GET' && ($caminho === '/' || $caminho === '')){
        echo "<h1>Sistema rodando com sucesso!</h1>";
    }else{
        http_response_code(404);
        echo "<h1>404 - Pagina nao encontrada</h1>";
    }