<?php
    $erros = $_SESSION['erros'] ?? [];
    $dadosForm = $_SESSION['dadosFormulario'] ?? [];
    unset($_SESSION['erros'], $_SESSION['dadosFormulario']);
?>

<?php 
    $titulo = 'Abertura de Chamado - HelpDesk TI';
    require_once __DIR__ . '/header.php'; 
?>
    <main class="container">
        <article>
            <header>
                <h2>Abertura de Chamado Técnico</h2>
                <p>Relate o defeito do equipamento para darmos andamento ao atendimento.</p>
            </header>

            <?php if (!empty($_GET['sucesso'])): ?>
            <article>
                <ins><strong>Sucesso:</strong> Chamado registrado com sucesso! Nossa equipe técnica já foi notificada.</ins>
            </article>
            <?php endif; ?>

            <form action="/chamados" method="POST">
                <label for="cliente">
                    Nome Completo do Solicitante
                    <input type="text" id="cliente" name="cliente" 
                           value="<?= htmlspecialchars($dadosForm['cliente'] ?? '') ?>" 
                           placeholder="Ex: Carlos Silva" required>
                </label>
                <?php if(!empty($erros['cliente'])): ?>
                <small><mark><?= htmlspecialchars($erros['cliente']) ?></mark></small>
                <?php endif; ?>

                <label for="email">
                    Email do Solicitante
                    <input type="email" id="email" name="email" 
                           value="<?= htmlspecialchars($dadosForm['email'] ?? '') ?>" 
                           placeholder="Ex: CarlosSilva@gmail.com" required>
                </label>
                <?php if(!empty($erros['email'])): ?>
                <small><mark><?= htmlspecialchars($erros['email']) ?></mark></small>
                <?php endif; ?>

                <div class="grid">
                    <div>
                        <label for="tipo">
                            Tipo de Equipamento
                            <select id="tipo" name="tipo" required>
                                <option value="" disabled <?= empty($dadosForm['tipo']) ? 'selected' : '' ?>>Selecione um aparelho...</option>
                                <option value="Desktop" <?= ($dadosForm['tipo'] ?? '') === 'Desktop' ? 'selected' : '' ?>>Desktop / Computador</option>
                                <option value="Notebook" <?= ($dadosForm['tipo'] ?? '') === 'Notebook' ? 'selected' : '' ?>>Notebook</option>
                                <option value="Servidor" <?= ($dadosForm['tipo'] ?? '') === 'Servidor' ? 'selected' : '' ?>>Servidor</option>
                                <option value="Impressora" <?= ($dadosForm['tipo'] ?? '') === 'Impressora' ? 'selected' : '' ?>>Impressora / Multifuncional</option>
                                <option value="Rede" <?= ($dadosForm['tipo'] ?? '') === 'Rede' ? 'selected' : '' ?>>Rede / Roteador / Switch</option>
                                <option value="Outro" <?= ($dadosForm['tipo'] ?? '') === 'Outro' ? 'selected' : '' ?>>Outro</option>
                            </select>
                        </label>
                        <?php if(!empty($erros['tipo'])): ?>
                        <small><mark><?= htmlspecialchars($erros['tipo']) ?></mark></small>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label for="prazoEstipulado">
                            Prazo Estipulado
                            <select id="prazoEstipulado" name="prazoEstipulado">
                                <option value="1 dia" <?= ($dadosForm['prazoEstipulado'] ?? '') === '1 dia' ? 'selected' : '' ?>>1 dia</option>
                                <option value="3 dias" <?= ($dadosForm['prazoEstipulado'] ?? '3 dias') === '3 dias' ? 'selected' : '' ?>>3 dias</option>
                                <option value="1 semana" <?= ($dadosForm['prazoEstipulado'] ?? '') === '1 semana' ? 'selected' : '' ?>>1 semana</option>
                            </select>
                        </label>
                        <?php if(!empty($erros['prazoEstipulado'])): ?>
                        <small><mark><?= htmlspecialchars($erros['prazoEstipulado']) ?></mark></small>
                        <?php endif; ?>
                    </div>
                </div>

                <label for="descricao">
                    Descrição Detalhada do Defeito
                    <textarea id="descricao" name="descricao" rows="4" 
                              placeholder="Descreva os sintomas ou falhas apresentadas..." required><?= htmlspecialchars($dadosForm['descricao'] ?? '') ?></textarea>
                </label>
                <?php if(!empty($erros['descricao'])): ?>
                <small><mark><?= htmlspecialchars($erros['descricao']) ?></mark></small>
                <?php endif; ?>

                <button type="submit">Registrar Chamado</button>
            </form>
        </article>
    </main>
<?php require_once __DIR__ . '/footer.php'; ?>