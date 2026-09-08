# Decisões Técnicas e Arquiteturais

## 1. Tema e Stack

* **Tema:** HelpDesk de TI voltado para manutenção de equipamentos (computadores, notebooks etc).
* **PHP Nativo + MVC Simples:** Estruturação em MVC sem frameworks para demonstrar separação de responsabilidades (rotas, controllers, services e views) com código limpo.
* **SQLite + RedBeanPHP:** Persistência simples via arquivo local, sem dependência de serviços externos de banco ou migrations manuais.
* **Pico.css v2:** Interface responsiva e tema dark com classes semânticas, sem necessidade de ferramentas de build.

---

## 2. Além do Mínimo

* **Cálculo Dinâmico de Urgência:** Cálculo em tempo de execução que cruza data de abertura, prazo e data atual para exibir se o chamado está no prazo ou está atrasado.
* **Motivo:** Facilita a triagem visual imediata do gestor sem persistir um dado volátil no banco de dados.

---

## 3. O que decidi NÃO fazer

* **Cadastro aberto de múltiplos usuários:** Mantido apenas o usuário administrador pré-definido.
* **Edição completa dos chamados:** O painel permite alterar apenas o status; campos como descrição e dados do solicitante são somente leitura.
* **Atualização assíncrona:** Troca de status e envio de formulários via requisições HTTP tradicionais (POST com redirect), sem JavaScript no cliente.
* **Mudança dinâmica de cores no select via JS:** Estilização de status mantida puramente no CSS, sem manipulação em tempo real.
* **Validação no frontend sem recarregamento:** Toda validação de campos obrigatórios e formato centralizada no backend via PHP.

---

## 4. Uso de Inteligência Artificial

* **O que deleguei e o que fiz à mão:**
  Deleguei a estrutura base inicial do HTML e consultas de sintaxe da biblioteca padrão do PHP. Fiz à mão a arquitetura de pastas, o fluxo de rotas, o controle de sessão, a sanitização dos dados e as regras de negócio nos Services e Controllers.

* **Erro da IA e correção:**
  Ao implementar o cálculo de urgência, a IA sugeriu inicialmente uma diferença simples de horas via `diff()->format('%a')`. Como o PHP padrão operava em UTC e a função considera apenas intervalos cheios de 24 horas, um chamado criado à tarde registrava horário adiantado em relação a Brasília e marcava um dia a menos de prazo. Identifiquei o erro pela divergência de horários na tela, corrigi definindo o fuso global `America/Sao_Paulo` no ponto de entrada e zerei os relógios das datas (`setTime(0, 0, 0)`) para comparar estritamente dias civis de calendário.

* **Decisão contra a sugestão da IA:**
  A IA sugeriu criar uma coluna `urgencia` no banco de dados para salvar o status de prazo junto com o chamado. Recusei a ideia por considerar uma má prática persistir um dado temporal altamente volátil no SQLite, preferindo manter o cálculo em memória via Service no momento em que a listagem é requisitada.