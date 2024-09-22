# Como rodar o sistema

### Requisitos
- Docker
- Docker Compose
- Make (opcional)

### Passos

- Clone o repositório
- entre na pasta do projeto
- Execute o comando `make install`
- se não tiver o make instalado ou não quiser instalar, segue os comandos:
  - `cp .env.example .env`
  - `docker-compose up -d db app`
  - `docker-compose exec app composer install`
  - `docker-compose exec app php artisan key:generate`
  - `docker-compose exec app php artisan migrate`
  - `docker-compose exec app php artisan db:seed`
  - `docker-compose up -d worker`
  - O sistema já está pronto para uso
- acesso o sistema em `http://localhost:8080`
- para desligar o sistema execute o comando `make down`

### Inicio do sistema depois de instalado
- Execute o comando `make`

# Como rodar os testes
- Execute o comando `make test`

# Como inserir funcionários em massa
- acesse o tinker com o comando `docker-compose exec app php artisan tinker`
- execute o comando `Employee::factory(100)->create();` //Use a quantidade que desejar

# Como inserir vacinas em massa
- acesse o tinker com o comando `docker-compose exec app php artisan tinker`
- execute o comando `Medicine::factory(100)->create();` //Use a quantidade que desejar
- São geradas vácinas com datas expiradas e não expiradas