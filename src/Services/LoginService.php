<?php
    class LoginService{
        public static function verificarLogin(array $dados){
            $usuario = trim($dados['usuario'] ?? '');
            $senha = trim($dados['senha'] ?? '');

            $usuarioEncontrado = null;

            if(!empty($usuario)){
                $usuarioEncontrado = R::findOne('usuario', 'login = ?', [$usuario]);
            }

            $erros = [];

            if(empty($usuario)){
                $erros['usuario'] = "O usuário é obrigatório";
            }elseif($usuarioEncontrado === null){
                $erros['usuario'] = "Usuário não encontrado";
            }

            if(empty($senha)){
                $erros['senha'] = "A senha é obrigatória";
            }elseif($usuarioEncontrado !== null && $usuarioEncontrado->senha !== $senha){
                $erros['senha'] = "Senha incorreta";
            }

            if(!empty($erros)){
                throw new Exception(json_encode($erros));
            }
        }

        public static function inicializarAdm(){
            if(R::count('usuario') === 0){
                $admin = R::dispense('usuario');
                $admin->login = 'admin';
                $admin->senha = 'admin123';
                R::store($admin);
            }
        }
    }
?>