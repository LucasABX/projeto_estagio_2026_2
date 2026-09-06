<?php

    require_once __DIR__ . '/../lib/db.php';

    $metodo = $_SERVER['REQUEST_METHOD'];
    $caminho = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    if($metodo === 'GET' && ($caminho === '/' || $caminho === '')){
        require_once __DIR__ . '/../src/Views/home.php';
    }else{
        http_response_code(404);
        echo "<h1>404 - Pagina nao encontrada</h1>";
    }