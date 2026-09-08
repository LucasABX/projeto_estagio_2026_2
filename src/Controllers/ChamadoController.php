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

        public static function listaAdmin(){
            $chamados = ChamadoService::listarTodos();
            $urgencias = ChamadoService::criarArrayUrgencia($chamados);
            $contadores = ChamadoService::contarPorStatus($chamados);
            require_once __DIR__ . '/../Views/admin.php';
        }

        public static function atualizarStatus(): void{
            if(empty($_SESSION['usuario'])){
                header('Location: /login');
                exit;
            }
        
            $id = (int)($_POST['id'] ?? -1);
            $status = trim($_POST['status'] ?? '');
        
            $statusValidos = ['pendente', 'confirmado', 'cancelado'];
            if($id > 0 && in_array(strtolower($status), $statusValidos)){
                ChamadoService::alterarStatus($id, $status);
            }
        
            header('Location: /admin');
            exit;
        }
    }
?>