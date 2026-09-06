<?php
class ChamadoService{
    public static function criarChamado(array $dados):int{
        $cliente = trim($dados['cliente'] ?? '');
        $email = trim($dados['email'] ?? '');
        $tipo = trim($dados['tipo'] ?? '');
        $prazoEstipulado = trim($dados['prazoEstipulado'] ?? '');
        $descricao = trim($dados['descricao'] ?? '');

        if(empty($cliente)){
            throw new Exception("O nome do solicitante é obrigatório.");
        }

        if(empty($email)){
            throw new Exception("O email do solicitante é obrigatório.");
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            throw new Exception("O formato do email é inválido");
        }

        if(empty($tipo)){
            throw new Exception("Selecione um tipo de equipamento válido.");
        }

        if(empty($prazoEstipulado)){
            throw new Exception("O prazo estipulado é obrigatório");
        }

        if(empty($descricao)){
            throw new Exception("A descrição do defeito é obrigatória.");
        }

        $chamado = R::dispense('chamado');
        $chamado->cliente = $cliente;
        $chamado->email = $email;
        $chamado->tipo = $tipo;
        if($prazoEstipulado == "1 dia"){
            $chamado->prazoEstipulado = 1;
        }elseif($prazoEstipulado == "3 dias"){
            $chamado->prazoEstipulado = 3;
        }elseif ($prazoEstipulado == "1 semana") {
            $chamado->prazoEstipulado = 7;
        }
        $chamado->descricao = $descricao;
        $chamado->status = 'Pendente';
        $chamado->criadoEm = date('Y-m-d H:i:s');

        return R::store($chamado);
    }
}
?>