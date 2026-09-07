<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Gestão - HelpDesk TI</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>
<body>

    <nav class="container">
        <ul>
            <li><strong>HelpDesk TI</strong> - Painel do Gestor</li>
        </ul>
        <ul>
            <li><span>Olá, <?= htmlspecialchars($_SESSION['usuario'] ?? 'Admin') ?></span></li>
            <li><a href="/logout" role="button" class="secondary outline">Sair</a></li>
        </ul>
    </nav>

    <main class="container">
        <header>
            <h2>Chamados Registrados</h2>
            <p>Gerencie as solicitações recebidas da equipe.</p>
        </header>

        <figure>
            <table role="grid">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Solicitante</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Prazo</th>
                        <th scope="col">Abertura</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($chamados)): ?>
                        <tr>
                            <td colspan="8" style="text-align: center;">Nenhum chamado registrado até o momento.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($chamados as $chamado) : ?>
                            <tr>
                                <th scope="row"> <?= $chamado->id ?> </th>
                                <td> <?= htmlspecialchars($chamado->cliente) ?> </td>
                                <td> <?= htmlspecialchars($chamado->email) ?> </td>
                                <td> <?= htmlspecialchars($chamado->tipo) ?> </td>
                                <td> <?= htmlspecialchars($chamado->descricao) ?> </td>
                                <td> 
                                    <?php
                                        if($chamado->prazoEstipulado == 1){
                                            echo "1 dia";
                                        }elseif($chamado->prazoEstipulado == 3){
                                            echo "3 dias";
                                        }elseif ($chamado->prazoEstipulado == 7) {
                                            echo "1 semana";
                                        }
                                    ?>    
                                </td>
                                <td> <?= date('d/m/Y H:i', strtotime($chamado->criado_em)) ?> </td>

                                <?php
                                    $statusCor = match(strtolower($chamado->status)) {
                                        'confirmado' => 'background-color: #198754; color: #ffffff; border-color: #198754;',
                                        'cancelado'  => 'background-color: #dc3545; color: #ffffff; border-color: #dc3545;',
                                        default      => 'background-color: #d39e00; color: #000000; border-color: #d39e00;',
                                    };
                                ?>

                                <td>
                                    <form action="/chamados/status" method="POST" onsubmit="return confirm('Confirmar alteração de status?');" style="display: flex; gap: 0.5rem; margin: 0;">
                                        <input type="hidden" name="id" value="<?= $chamado->id ?>">
                                        <select name="status" style="margin: 0; padding: 0.25rem 0.6rem; font-size: 0.85rem; font-weight: bold; width: auto; <?= $statusCor ?>">
                                            <option value="pendente" <?= strtolower($chamado->status) === 'pendente' ? 'selected' : '' ?> style="background: #2b3035; color: #fff;">Pendente</option>
                                            <option value="confirmado" <?= strtolower($chamado->status) === 'confirmado' ? 'selected' : '' ?> style="background: #2b3035; color: #fff;">Confirmado</option>
                                            <option value="cancelado" <?= strtolower($chamado->status) === 'cancelado' ? 'selected' : '' ?> style="background: #2b3035; color: #fff;">Cancelado</option>
                                        </select>
                                </td>
                                <td>
                                        <button type="submit" class="outline" style="margin: 0; padding: 0.2rem 0.5rem; font-size: 0.8rem;">OK</button>
                                    </form>
                                </td>
                                
                                
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </figure>
    </main>

</body>
</html>