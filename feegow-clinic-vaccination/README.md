# Sistema de Gerenciamento de Vacinação para Colaboradores da Feegow

## Descrição do Projeto
Este sistema web foi desenvolvido para a Feegow Clinic com o objetivo de cadastrar e controlar os colaboradores vacinados contra a COVID-19. Ele permite o cadastro de funcionários e suas respectivas doses de vacina, além de informações detalhadas sobre cada vacina aplicada. O sistema também implementa funcionalidades de anonimização de CPF, caching de dados de vacinas e fila para geração de relatórios de funcionários não vacinados.

## Tecnologias Utilizadas
- **Backend**: PHP com Laravel
- **Frontend**: React com Tailwind CSS
- **Banco de Dados**: PostgreSQL
- **Cache**: Redis
- **Fila**: Redis
- **Containerização**: Docker

## Requisitos para Execução

### Pré-requisitos
Certifique-se de ter as seguintes tecnologias instaladas no seu ambiente de desenvolvimento:
- PHP 8.2+ (ou versão superior)
- Composer
- PostgreSQL
- Node.js
- NPM ou gerenciador de pacote de preferência
- Docker (caso queira utilizar containers)
- Extensões PHP necessárias:
  - `ctype`
  - `curl`
  - `dom`
  - `fileinfo`
  - `filter`
  - `hash`
  - `mbstring`
  - `openssl`
  - `pcre`
  - `pdo`
  - `session`
  - `tokenizer`
  - `xml`

### Instalação e Configuração

1. **Clone o repositório:**
   ```bash
   git clone https://github.com/Thivieira/feegow-challenge-covid
   cd feegow-challenge-covid
   ```

2. **Instale as dependências do PHP:**
   ```bash
   composer install
   ```

3. **Instale as dependências do Node.js:**
   ```bash
   npm install
   ```

4. **Configure o arquivo `.env` com as credenciais do banco de dados e outras variáveis de ambiente necessárias.**

5. **Execute as migrações do banco de dados:**
   ```bash
   php artisan migrate
   ```

6. **(Opcional) Caso tenha usado o Docker, suba os containers:**
   ```bash
   ./vendor/bin/sail up
   ```

7. **Inicie o servidor de desenvolvimento:**
   ```bash
   php artisan serve
   ```

8. **Inicie o servidor de frontend:**
   ```bash
   npm run dev
   ```

9. **Inicie a fila de processamento de jobs:**
   ```bash
   php artisan queue:work
   ```

### Populando o Banco de Dados
Após as migrações, execute os seeds para inserir dados de exemplo no banco de dados:
```bash
php artisan db:seed
```

### Credenciais de Acesso
Após a execução dos seeds, você pode acessar o sistema com as seguintes credenciais de usuário:
- **Email**: exemplo@gmail.com
- **Senha**: 12345678

## Funcionalidades Implementadas

### Cadastro de Funcionários
- CPF (anônimo, apenas os três primeiros dígitos são visíveis)
- Nome completo
- Data de nascimento
- Data das doses da vacina (primeira, segunda e terceira)
- Vacina aplicada
- Comorbidades

### Cadastro de Vacinas
- Nome da vacina
- Lote
- Data de validade

### Relatórios
- Relatório de funcionários não vacinados (gerado através de uma fila de processamento)
  - Exibe CPF (anônimo) e nome

### Caching
O sistema utiliza cache para dados de vacinas, melhorando a performance em consultas frequentes.

### Fila para Geração de Relatório
Foi implementada uma fila para a extração de relatórios de funcionários não vacinados. Para processar a fila, execute o seguinte comando:
```bash
php artisan queue:work
```

### Arquitetura SOLID
O código foi estruturado seguindo os princípios SOLID, garantindo maior manutenibilidade, escalabilidade e clareza no código.

### Anonimização de CPF
Para garantir a privacidade dos funcionários, apenas os três primeiros dígitos do CPF são exibidos. O restante dos números é mascarado.

## Estrutura do Código
- `app/Events`: Contém os eventos gerados pelo sistema para controle de limpeza do cache.
- `app/Jobs`: Contém o Job de gerar o relatório dos não vacinados.
- `app/Models`: Contém os modelos do sistema.
- `app/Http/Controllers`: Contém os controladores que gerenciam a lógica do aplicativo.
- `resources/views`: Contém as views do sistema.
- `resources/js`: Contém os componentes React e lógica de frontend.

## Testes
A aplicação implementa validações no lado do cliente (frontend) e no lado do servidor (backend) para garantir a integridade dos dados inseridos. A principal funcionalidade de validação é:

- **Preenchimento dos Campos Obrigatórios**: O sistema impede o envio de formulários até que todos os campos essenciais (como CPF, nome, datas de vacinação) sejam preenchidos corretamente. Essa validação é realizada tanto no frontend, proporcionando uma experiência de usuário fluida e imediata, quanto no backend, garantindo que apenas dados completos e válidos sejam persistidos no banco de dados.

## Configuração para Produção

Para configurar o sistema para um ambiente de produção, siga os passos abaixo:

1. **Mude o arquivo `.env` para produção**:
   - Renomeie ou copie o arquivo `.env.example` para `.env`.
   - Atualize as variáveis de ambiente com as credenciais do banco de dados e outras configurações necessárias para o ambiente de produção, como `APP_ENV`, `APP_DEBUG` e `APP_URL`.

2. **Compile os assets do frontend**:
   - Execute o comando para gerar os arquivos de produção do frontend:
     ```bash
     npm run build
     ```

3. **Inicie o servidor de backend**:
   - Para iniciar o servidor de desenvolvimento em um ambiente de produção, execute:
     ```bash
      php artisan serve --host=localhost --port=8000
     ```
   - **Nota**: Em produção, é recomendável usar um servidor web robusto, como Nginx ou Apache, em vez do `php artisan serve`.

## Demonstração em Vídeo

Para uma visão prática de como o sistema funciona, assista ao vídeo de demonstração abaixo. Ele oferece uma visão geral das principais funcionalidades, incluindo o cadastro de funcionários, gerenciamento de vacinas, geração de relatórios e muito mais.

[Assista ao vídeo de demonstração no Loom](https://www.loom.com/share/c33f5b763fb14f9abc91daa85458159f?sid=4ff0eed8-3d1e-41ae-aaf8-92785f9675bd)


## Dicas de Uso para Usuários

### Navegação no Sistema
- **Menu Principal**: Utilize o menu principal para acessar rapidamente as seções de cadastro de funcionários e vacinas, além de relatórios.
- **Barra de Pesquisa**: Use a barra de pesquisa para encontrar rapidamente funcionários ou vacinas específicas.

### Cadastro de Funcionários
- **Preenchimento de Dados**: Certifique-se de preencher todos os campos obrigatórios, como CPF, nome, comorbidade, datas de vacinação e vacina utilizada, para evitar erros no envio do formulário.
- **Anonimização de CPF**: Lembre-se de que o CPF será parcialmente anonimizado para proteger a privacidade dos funcionários.

### Relatórios
- **Visualização no Dashboard**: Navegue até a seção do dashboard para consultar a quantidade de cada recurso e obter um relatório sobre o número de colaboradores vacinados por tipo de vacina, incluindo aqueles que não receberam nenhuma vacinação.
- **Acesso a Relatórios**: Dirija-se à seção de relatórios para visualizar os últimos relatórios processados e gerar novos documentos utilizando o nome e CPF do colaborador não vacinado.

### Cache e Performance
- **Desempenho**: Aproveite o cache de dados de vacinas, colaboradores e estatísticas para uma experiência mais rápida ao consultar informações frequentemente acessadas.
