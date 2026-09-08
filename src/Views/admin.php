<?php 
    $titulo = 'Painel de Gestão - HelpDesk TI';
    $subtitulo = 'Painel do Gestor';
    require_once __DIR__ . '/header.php'; 
?>

    <main class="dashboard-container">
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
                        <th scope="col">Urgência</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($chamados)): ?>
                        <tr>
                            <td colspan="9" style="text-align: center;">Nenhum chamado registrado até o momento.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($chamados as $chamado) : ?>
                            <tr>
                                <th scope="row"> <?= $chamado->id ?> </th>
                                <td> <?= htmlspecialchars($chamado->cliente) ?> </td>
                                <td> <?= htmlspecialchars($chamado->email) ?> </td>
                                <td> <?= htmlspecialchars($chamado->tipo) ?> </td>
                                <td class="col-desc" title="<?= htmlspecialchars($chamado->descricao) ?>">
                                    <?= htmlspecialchars($chamado->descricao) ?>
                                </td>
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

                                <td> <?= $urgencias[$chamado->id]['texto'] ?> </td>

                                <?php
                                    $statusClasse = match(strtolower($chamado->status)) {
                                        'confirmado' => 'status-confirmado',
                                        'cancelado'  => 'status-cancelado',
                                        default      => 'status-pendente',
                                    };
                                ?>

                                <td>
                                    <select name="status" form="form-status-<?= $chamado->id ?>" class="status-select <?= $statusClasse ?>">
                                        <option value="pendente" <?= strtolower($chamado->status) === 'pendente' ? 'selected' : '' ?>>Pendente</option>
                                        <option value="confirmado" <?= strtolower($chamado->status) === 'confirmado' ? 'selected' : '' ?>>Confirmado</option>
                                        <option value="cancelado" <?= strtolower($chamado->status) === 'cancelado' ? 'selected' : '' ?>>Cancelado</option>
                                    </select>
                                </td>

                                <td>
                                    <form id="form-status-<?= $chamado->id ?>" action="/chamados/status" method="POST" style="margin: 0;">
                                        <input type="hidden" name="id" value="<?= $chamado->id ?>">
                                        <button type="submit" class="outline btn-status-ok">OK</button>
                                    </form>
                                </td>
                                
                                
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </figure>
    </main>
<?php require_once __DIR__ . '/footer.php'; ?>