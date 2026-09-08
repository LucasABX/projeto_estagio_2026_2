# Decisões Técnicas e Arquiteturais

# Decisões Técnicas

## 1. Escolha da Stack: Ganhos e Perdas

* **PHP Nativo (sem framework):**
  * *O que ganhei:* Domínio total do fluxo de execução, código leve e facilidade de rodar com o servidor embutido (`php -S`) sem passos complexos de instalação.
  * *O que perdi:* Produtividade em tarefas prontas (como roteamento automático e migrations de frameworks como Laravel).

* **SQLite + RedBeanPHP:**
  * *O que ganhei:* Banco local em arquivo único sem necessidade de instalar ou rodar serviços externos (MySQL/Postgres), com criação automática de tabelas na primeira execução.
  * *O que perdi:* Recursos avançados de concorrência e escalabilidade para múltiplos acessos simultâneos de grande porte.

* **Pico.css v2:**
  * *O que ganhei:* Interface limpa, moderna e responsiva focada em tags semânticas, sem precisar configurar ferramentas de build ou Node/npm.
  * *O que perdi:* Flexibilidade para personalizações complexas de design sem recorrer a CSS complementar na mão.

---

## 2. Além do Mínimo

* **Cálculo Dinâmico de Urgência (SLA):** Cálculo em tempo real que compara a data de abertura e o prazo com a data atual, categorizando os chamados com badges visuais (`Atrasado`, `Urgente`, `No prazo`, `Prazo longo`).
* **Cards de Métricas:** Contadores no topo do painel com o total de chamados pendentes, confirmados e cancelados para facilitar a visão rápida do gestor.

---

## 3. O que decidi não fazer

* **Cadastro aberto de múltiplos usuários:** Mantido apenas o usuário administrador pré-definido.
* **Edição completa dos chamados:** O painel permite alterar apenas o status; campos como descrição e dados do solicitante são somente leitura.
* **Atualização assíncrona:** Troca de status e envio de formulários via requisições HTTP tradicionais (POST com redirect), sem JavaScript no cliente.
* **Mudança dinâmica de cores no select via JS:** Estilização de status mantida puramente no CSS, sem manipulação em tempo real.
* **Validação no frontend sem recarregamento:** Toda validação de campos obrigatórios e formato centralizada no backend via PHP.

---

## 4. Uso de Inteligência Artificial

* **O que deleguei e o que fiz à mão:**
  Deleguei a estrutura básica do HTML dos formulários, sugestões de cores e variáveis de estilo do Pico.css, além de uma revisão final de código para caçar inconsistências e detalhes que passaram despercebidos. Fiz à mão a arquitetura de pastas, fluxo de rotas, toda a lógica de negócio dos Services e Controllers, tratamento de sessões e sanitização dos dados.

* **Erro da IA e correção:**
  Ao sugerir o cálculo de prazos, a IA utilizou uma diferença simples de horas via `$diff->format('%a')`. Como a função considera blocos estritos de 24 horas a partir do minuto em que o chamado foi criado, um chamado feito no fim da tarde já alterava a contagem antes da virada do dia seguinte. Corrigi zerando o relógio de comparação (`setTime(0, 0, 0)`) para avaliar estritamente a virada de dias de calendário.

* **Decisão contra a sugestão da IA:**
  A IA sugeriu criar uma coluna `urgencia` no banco de dados para salvar o status de prazo junto com o chamado. Recusei a ideia por considerar uma má prática persistir um dado temporal altamente volátil no SQLite, preferindo manter o cálculo em memória via Service no momento em que a listagem é requisitada.