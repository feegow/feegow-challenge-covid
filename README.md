# Case Técnico Feegow

## Hugo Matheus

## Apresentação do problema
  Sistema feito para o teste técnico Feegow.

### Funcionários:
- CPF  (Chave única);
- Nome completo
- Data de nascimento 
- Data da primeira dose
- Data da segunda dose
- Data da terceira dose
- Vacina Aplicada
- Portador de comorbidade?

### Vacinas:
- Nome 
- Lote
- Data de validade

## Tecnologias usadas
-	PHP puro.
-	Bootstrap.
-	PostgreSQL.
-   Docker.

## Como rodar o projeto
-	Clonar o projeto;
-	Dentro do diretório do projeto rodar para criar os containers necessários:
  - `docker-compose up -d`
-   Rodar o comando abaixo para pegar o IPAddress do container
  - `docker inspect (container do postgres)` 
-   Após pegar o IPAddress, substituir na constante HOST dentro da classe src/service/Database.php
-   Entre no diretório /src e rode o seguinte comando:
  - `php iniciar.php`
-   Esse comando vai criar o database e as tabelas necessárias para o sistema.
-   Abrir http://localhost:5050/ para visualizar o pgAdmin e gerenciar o banco de dados; 
-   Abrir http://localhost:8000/ para usar o sistema;
