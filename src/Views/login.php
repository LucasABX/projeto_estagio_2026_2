<?php
    $erros = $_SESSION['erros'] ?? [];
    unset($_SESSION['erros']);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Gestão de Chamados</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>
<body>

    <nav class="container">
        <ul>
            <li><strong>HelpDesk TI</strong></li>
        </ul>
        <ul>
            <li><a href="/">Novo Chamado</a></li>
        </ul>
    </nav>

    <main class="container" style="max-width: 480px; margin-top: 3rem;">
        <article>
            <header>
                <h2>Acesso Restrito</h2>
                <p>Entre com suas credenciais de gestor.</p>
            </header>

            <form action="/login" method="POST">
                <label for="usuario">
                    Usuário
                    <input type="text" id="usuario" name="usuario" placeholder="Digite o usuário" required autofocus>
                </label>

                <?php if(!empty($erros['usuario'])): ?>
                    <small><mark> <?= htmlspecialchars($erros['usuario']) ?> </mark></small>
                <?php endif; ?>

                <label for="senha">
                    Senha
                    <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
                </label>

                <?php if(!empty($erros['senha'])): ?>
                    <small><mark> <?= htmlspecialchars($erros['senha']) ?> </mark></small>
                <?php endif; ?>

                <button type="submit">Entrar</button>
            </form>
        </article>
    </main>

</body>
</html>