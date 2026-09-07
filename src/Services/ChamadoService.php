<?php
class ChamadoService{
    public static function criarChamado(array $dados):int{
        $cliente = trim($dados['cliente'] ?? '');
        $email = trim($dados['email'] ?? '');
        $tipo = trim($dados['tipo'] ?? '');
        $prazoEstipulado = trim($dados['prazoEstipulado'] ?? '');
        $descricao = trim($dados['descricao'] ?? '');

        $erros = [];

        if(empty($cliente)){
            $erros['cliente'] = "O nome do solicitante é obrigatório.";
        }

        if(empty($email)){
            $erros['email'] = "O email do solicitante é obrigatório.";
        }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $erros['email'] = "O formato do email é inválido";
        }

        if(empty($tipo)){
            $erros['tipo'] = "Selecione um tipo de equipamento válido.";
        }

        if(empty($prazoEstipulado)){
            $erros['prazoEstipulado'] = "O prazo estipulado é obrigatório";
        }

        if(empty($descricao)){
            $erros['descricao'] = "A descrição do defeito é obrigatória.";
        }

        if(!empty($erros)){
            throw new Exception(json_encode($erros));
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
        $chamado->criado_em = date('Y-m-d H:i:s');

        return R::store($chamado);
    }

    public static function listarTodos():array{
        Return R::findAll('chamado', 'ORDER BY criado_em DESC');
    }

    public static function alterarStatus(int $id, String $status){
        $chamado = R::load('chamado', $id);
        if($chamado->id > 0){
            $chamado->status = $status;
            R::store($chamado);
        }
    }
}
?>