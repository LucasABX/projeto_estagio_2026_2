<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titulo ?? 'HelpDesk TI') ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<header class="site-header">
    <nav class="container">
        <ul>
            <li>
                <a href="/" style="text-decoration: none; color: inherit;">
                    <strong>HelpDesk TI</strong>
                </a>
                <?= !empty($subtitulo) ? '<small style="opacity: 0.7;">| ' . htmlspecialchars($subtitulo) . '</small>' : '' ?>
            </li>
        </ul>
        <ul>
            <?php 
                $rotaAtual = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
                $isLogado = !empty($_SESSION['usuario']);
            ?>

            <?php if ($rotaAtual !== '/' && $rotaAtual !== ''): ?>
                <li>
                    <a href="/" role="button" class="outline btn-header">+ Novo Chamado</a>
                </li>
            <?php endif; ?>

            <?php if ($isLogado): ?>
                <?php if ($rotaAtual !== '/admin'): ?>
                    <li>
                        <a href="/admin" role="button" class="outline btn-header">Painel do Gestor</a>
                    </li>
                <?php endif; ?>
                <li><span class="user-badge">Olá, <?= htmlspecialchars($_SESSION['usuario']) ?></span></li>
                <li>
                    <a href="/logout" role="button" class="secondary outline btn-sair">Sair</a>
                </li>
            <?php else: ?>
                <?php if ($rotaAtual !== '/login'): ?>
                    <li>
                        <a href="/admin" role="button" class="outline btn-header">Painel do Gestor</a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
        </ul>
    </nav>
</header>