<?php
    date_default_timezone_set('America/Sao_Paulo');
    session_start();
    require_once __DIR__ . '/../lib/db.php';

    $metodo = $_SERVER['REQUEST_METHOD'];
    $caminho = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    if($metodo === 'GET' && ($caminho === '/' || $caminho === '')){
        require_once __DIR__ . '/../src/Views/home.php';
    }else if($metodo === 'POST' && $caminho === '/chamados'){
        require_once __DIR__ . '/../src/Controllers/ChamadoController.php';
        ChamadoController::salvar();
    }else if($metodo === 'GET' && $caminho === '/login'){
        require_once __DIR__ . '/../src/Views/login.php';
    }else if($metodo === 'POST' && $caminho === '/login'){
        require_once __DIR__ . '/../src/Controllers/LoginController.php';
        LoginController::autenticar();
    }else if ($metodo === 'GET' && $caminho === '/logout') {
        require_once __DIR__ . '/../src/Controllers/LoginController.php';
        LoginController::deslogar();
    }else if($metodo === 'GET' && $caminho === '/admin'){
        if(empty($_SESSION['usuario'])){
            header('Location: /login');
            exit;
        }
        require_once __DIR__ . '/../src/Controllers/ChamadoController.php';
        ChamadoController::listaAdmin();
    }else if($metodo === 'POST' && $caminho === '/chamados/status'){
        require_once __DIR__ . '/../src/Controllers/ChamadoController.php';
        ChamadoController::atualizarStatus();
    }else{
        http_response_code(404);
        echo "<h1>404 - Pagina nao encontrada</h1>";
    }