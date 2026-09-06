<?php
    require_once __DIR__ . '/../Services/ChamadoService.php';
    class ChamadoController{
        public static function salvar():void{
            try{
                ChamadoService::criarChamado($_POST);
                header('Location: /?sucesso=1');
                exit;
            }catch(Exception $e){
                $_SESSION['dadosFormulario'] = $_POST;
                $_SESSION['erros'] = json_decode($e->getMessage(), true) ?? ['geral' => $e->getMessage()];
                header('Location: /');
                exit;
            }
        }
    }
?>