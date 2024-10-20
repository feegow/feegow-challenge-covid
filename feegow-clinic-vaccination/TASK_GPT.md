# Sistema de Gerenciamento de Vacinação

## Funcionalidades Principais

### CRUD de Colaboradores

- Criar, ler, atualizar e deletar informações dos funcionários
- Campos: CPF, nome completo, data de nascimento, datas de doses, vacina aplicada, comorbidades

### CRUD de Vacinas

- Criar, ler, atualizar e deletar vacinas no sistema
- Campos: nome da vacina, lote, data de validade

### Visualização de Vacinação

- Interface (tabela ou dashboard) mostrando funcionários e suas vacinas
- Exibir: funcionários, vacinas aplicadas, datas e doses

### Relatório de Não Vacinados

- Gerar CSV com dados dos funcionários não vacinados
- Executar de maneira assíncrona usando fila (queue)

## Requisitos Técnicos

1. **Anonimização do CPF**

   - Exibir apenas os três primeiros dígitos (ex: "123.xxx.xxx-xx")
   - Implementar no frontend ou backend

2. **Caching para dados de vacinas**

   - Usar Redis ou memcached
   - Verificar cache antes de consultar o banco de dados

3. **Aplicação de SOLID**

   - Implementar os cinco princípios SOLID
   - Usar frameworks como Laravel ou criar classes bem estruturadas

4. **Fila para extração do relatório**

   - Usar Laravel Queue, RabbitMQ ou Beanstalkd
   - Processar relatórios de forma assíncrona

5. **Validação no cliente e servidor**

   - Cliente: JavaScript ou Tailwind com Alpine.js
   - Servidor: Validação no PHP (Laravel facilita este processo)

6. **Usabilidade e tratamento de exceções**

   - Interface intuitiva com feedbacks visuais
   - Tratar erros adequadamente, exibindo mensagens amigáveis

7. **Normalização do Banco de Dados**

   - Aplicar terceira forma normal (3NF)
   - Evitar dados duplicados ou redundantes

8. **Utilização de Docker**
   - Fornecer Dockerfile e docker-compose.yml
   - Configurar aplicação, banco de dados e serviços necessários

## Conclusão

Estas tarefas visam tornar o sistema eficiente, escalável e fácil de manter, atendendo às exigências de um desenvolvedor sênior.
