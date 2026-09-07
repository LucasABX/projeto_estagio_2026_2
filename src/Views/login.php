<?php
    $erros = $_SESSION['erros'] ?? [];
    unset($_SESSION['erros']);
?>

<?php 
    $titulo = 'Login - HelpDesk TI';
    $subtitulo = 'Acesso Restrito';
    require_once __DIR__ . '/header.php'; 
?>

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
<?php require_once __DIR__ . '/footer.php'; ?>