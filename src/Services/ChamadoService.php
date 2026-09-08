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

    public static function calcularUrgencia(string $criado_em, int $prazoDias, string $status):array{
        if(strtolower($status) == 'pendente'){
            $dataInicial = new DateTime($criado_em);
            $dataLimite = $dataInicial->modify("+{$prazoDias} days");
            $dataAtual = new DateTime();

            $dataLimite->setTime(0, 0, 0);
            $dataAtual->setTime(0, 0, 0);

            $diffDias = $dataAtual->diff($dataLimite);
            $intervalo = (int)$diffDias->format('%r%a');

            $urgencia['dias'] = $intervalo;

            if($intervalo < 0){
                $num = -$intervalo;
                $urgencia['texto'] = "Atrasado há {$num} dias";
                $urgencia['situacao'] = "Atrasado";
            }else if($intervalo === 0){
                $urgencia['texto'] = "Vence hoje";
                $urgencia['situacao'] = "Urgente";
            }else if($intervalo >= 1 && $intervalo <= 3){
                $urgencia['texto'] = "Vence em {$intervalo} dias";
                $urgencia['situacao'] = "No prazo";
            }else if($intervalo > 3){
                $urgencia['texto'] = "Vence em {$intervalo} dias";
                $urgencia['situacao'] = "Prazo longo";
            }

            return $urgencia;
        }else{
            return [
                'dias' => 999,
                'situacao' => "Finalizado",
                'texto' => "Chamado finalizado"
            ];
        }
    }

    public static function criarArrayUrgencia(array $chamados): array{
        $urgencia = [];
        foreach ($chamados as $chamado) {
            $urgencia[$chamado->id] = self::calcularUrgencia($chamado->criado_em, $chamado->prazoEstipulado, $chamado->status);
        }
        return $urgencia;
    }

    public static function contarPorStatus(array $chamados): array{
        $contador = [
            'pendentes' => 0,
            'confirmados' => 0,
            'cancelados' => 0
        ];

        foreach($chamados as $chamado){
            if(strtolower($chamado->status) === 'pendente'){
                $contador['pendentes']++;
            }else if(strtolower($chamado->status) === 'confirmado'){
                $contador['confirmados']++;
            }else if(strtolower($chamado->status) === 'cancelado'){
                $contador['cancelados']++;
            }
        }
        
        return $contador;
    }
}
?>