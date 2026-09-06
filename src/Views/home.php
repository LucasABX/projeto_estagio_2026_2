<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suporte Técnico - Abrir Chamado</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>
<body>

    <nav class="container">
        <ul>
            <li><strong>HelpDesk TI</strong></li>
        </ul>
        <ul>
            <li><a href="/">Novo Chamado</a></li>
            <li><a href="/admin">Painel do Gestor</a></li>
        </ul>
    </nav>

    <main class="container">
        <article>
            <header>
                <h2>Abertura de Chamado Técnico</h2>
                <p>Relate o defeito do equipamento para darmos andamento ao atendimento.</p>
            </header>

            <form action="/chamados" method="POST">
                <label for="cliente">
                    Nome Completo do Solicitante
                    <input type="text" id="cliente" name="cliente" placeholder="Ex: Carlos Silva" required>
                </label>

                <label for="email">
                    Email do Solicitante
                    <input type="email" id="email" name="email" placeholder="Ex: CarlosSilva@gmail.com" required>

                <div class="grid">
                    <label for="tipo">
                        Tipo de Equipamento
                        <select id="tipo" name="tipo" required>
                            <option value="" disabled selected>Selecione um aparelho...</option>
                            <option value="Desktop">Desktop / Computador</option>
                            <option value="Notebook">Notebook</option>
                            <option value="Servidor">Servidor</option>
                            <option value="Impressora">Impressora / Multifuncional</option>
                            <option value="Rede">Rede / Roteador / Switch</option>
                            <option value="Outro">Outro</option>
                        </select>
                    </label>

                    <label for="prazoEstipulado">
                        Prazo Estipulado
                        <select id="prazoEstipulado" name="prazoEstipulado">
                            <option value="1 dia">1 dia</option>
                            <option value="3 dias" selected>3 dias</option>
                            <option value="1 semana">1 semana</option>
                        </select>
                    </label>
                </div>

                <label for="descricao">
                    Descrição Detalhada do Defeito
                    <textarea id="descricao" name="descricao" rows="4" placeholder="Descreva os sintomas ou falhas apresentadas..." required></textarea>
                </label>

                <button type="submit">Registrar Chamado</button>
            </form>
        </article>
    </main>

</body>
</html>