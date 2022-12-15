# Case Técnico Feegow
## _Cadastro e controle dos seus colaboradores que foram vacinados contra a COVID-19_
Esse projeto foi desenvolvido pensando nas tecnologias abordadas na primeira conversa.
Foi desenvolvido um painel para gerenciar os funcionários ou as vacinas, utilizando certas tecnologia para esse case. São elas:
- Laravel
- Docker
- Bootstrap

## Características
- CRUD funcionários
- CRUD Vacina

## Instalação
- O projeto requer docker v4+ para rodar

No arquivo src/.env iremos informar os dados de acesso para o banco
- Fazer a troca do DB_HOST pelo ipv4 exemplo (192.168.0.59)
```sh
DB_CONNECTION=mysql
DB_HOST=IPV4_DA_SUA_MAQUINA
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=laravel
```

Execute o comando pelo terminal na pasta RAIZ do projeto.

```sh
docker-compose up -d
```

Acesse a pasta src e execute o comando

```sh
composer install
```

Assim que terminar permaneça em src e rode esse comando
```sh
php artisan migrate
```

Após esses comandos as tabelas serão criadas e as dependências baixadas

#### Banco de dados
![ER](https://i.imgur.com/mMwfdD2.png "ER")

| Url | Server | login | senha |
| -----  | ------|  ------| ------ |
| http://localhost:8181 | mysql | laravel | laravel |

Após acessar o banco iremos rodar os seguintes inserts na aba SQL do phpMyAdmin


```sh
INSERT INTO `funcionarios` (`vacinaAplicada_id`, `vacinaAplicada`, `nomeCompleto`, `cpf`, `portadorComorbidade`, `dataNascimento`, `dataPrimeiraDose`, `dataSegundaDose`, `dataTerceiraDose`, `created_at`, `updated_at`) VALUES
(5, 1, 'João batista', '339.173.430-29', 0, '2022-05-13', '2022-12-15', NULL, NULL, '2022-12-15 07:35:35', '2022-12-15 07:35:35'),
(6, 1, 'Simão', '769.606.650-19', 1, '2021-06-03', '2022-08-12', '2022-11-09', NULL, '2022-12-15 07:37:37', '2022-12-15 07:37:37'),
(7, 1, 'Matheus', '111.648.160-04', 1, '2021-11-11', '2022-10-06', '2022-11-02', '2022-12-12', '2022-12-15 07:38:28', '2022-12-15 07:38:28');
```
```sh
INSERT INTO `vacinas` ( `nome`, `lote`, `dataValidade`, `created_at`, `updated_at`) VALUES
('Pfizer', 26539, '2023-06-03', NULL, NULL),
('Coronavac', 26539, '2023-03-14', NULL, NULL),
('Oxford', 26539, '2023-11-25', NULL, NULL);
```

E pronto, agora é só acessar localhost:8000

## Bibliotecas

Biblioteca utilizada no projeto

| Biblioteca | README |
| ------ | ------ |
| pt-br-validator: Validações brasileiras para Laravel | [https://github.com/LaravelLegends/pt-br-validator#readme][PlDb] |
