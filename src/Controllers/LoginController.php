<?php
    require_once __DIR__ . '/../Services/LoginService.php';
    class LoginController{
        public static function autenticar():void{
            try{
                LoginService::verificarLogin($_POST);
                $_SESSION['usuario'] = $_POST['usuario'];
                header('Location: /admin');
                exit;
            } catch (Exception $e) {
                $_SESSION['erros'] = json_decode($e->getMessage(), true) ?? ['geral' => $e->getMessage()];
                header('Location: /login');
                exit;
            }
        }

        public static function deslogar(): void{
            unset($_SESSION['usuario']);
            header('Location: /');
            exit;
        }
    }
?>