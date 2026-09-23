# CineList — Seeder

Projeto desenvolvido em Laravel com o objetivo de praticar a criação e utilização de **Seeders** e **Factories** para inserir dados automaticamente no banco de dados.

## 1. Objetivo

O objetivo da atividade foi criar uma estrutura de banco de dados para um sistema de filmes e utilizar o **Seeder** para gerar dados automaticamente.

Foram utilizados:

* Laravel
* PHP
* SQLite
* Eloquent ORM
* Factory
* Seeder
* UUID
* Faker

---

# 2. Instalação e configuração inicial

## 2.1 Verificação das ferramentas

Antes de iniciar o projeto, foram verificadas as ferramentas necessárias:

```bash
php -v
```

```bash
composer -V
```

```bash
php artisan --version
```

Também foi utilizado o SQLite para o banco de dados.

---

## 2.2 Criação do projeto Laravel

O projeto foi criado utilizando o Composer:

```bash
composer create-project laravel/laravel CineList_seeders
```

Depois, foi acessado o diretório do projeto:

```bash
cd CineList_seeders
```

---

## 2.3 Configuração do arquivo `.env`

O Laravel utiliza o arquivo `.env` para definir as configurações do projeto.

Para esta atividade foi utilizado o **SQLite**.

A configuração do banco foi definida para utilizar:

```env
DB_CONNECTION=sqlite
```

O banco de dados utilizado foi:

```text
database/database.sqlite
```

---

## 2.4 Criação do banco SQLite

O arquivo do banco foi criado dentro da pasta `database`:

```bash
touch database/database.sqlite
```

A estrutura ficou:

```text
database/
└── database.sqlite
```

---

## 2.5 Configuração da aplicação

Depois da criação do projeto, foram realizadas as configurações iniciais do Laravel.

Foi gerada a chave da aplicação utilizando:

```bash
php artisan key:generate
```

Também foi verificado se o projeto estava funcionando corretamente:

```bash
php artisan serve
```

O projeto poderia então ser acessado localmente pelo endereço disponibilizado pelo Laravel.

---

# 3. Estrutura do projeto

A atividade possui as seguintes partes principais:

```text
CineList_seeders/
│
├── app/
│   └── Models/
│       ├── Movie.php
│       └── User.php
│
├── database/
│   ├── factories/
│   │   ├── MovieFactory.php
│   │   └── UserFactory.php
│   │
│   ├── migrations/
│   │   ├── create_users_table.php
│   │   ├── create_profiles_table.php
│   │   ├── create_movies_table.php
│   │   ├── create_tags_table.php
│   │   └── create_movie_tag_table.php
│   │
│   └── seeders/
│       └── DatabaseSeeder.php
│
├── database_schema.sql
├── cinelist_dump.sql
├── seeder.sql
└── README.md
```

---

# 4. Criação das tabelas

Primeiramente foram criadas as migrations responsáveis pela estrutura do banco de dados.

Entre as tabelas utilizadas estão:

* `users`
* `profiles`
* `movies`
* `tags`
* `movie_tag`
* `sessions`
* `cache`

A tabela principal utilizada na atividade foi a tabela `movies`.

Ela possui campos como:

| Campo             | Tipo        | Descrição                         |
| ----------------- | ----------- | --------------------------------- |
| `id`              | UUID        | Identificador do filme            |
| `user_id`         | Foreign Key | Usuário responsável pelo cadastro |
| `created_by_name` | String      | Nome de quem criou o registro     |
| `title`           | String      | Nome do filme                     |
| `director`        | String      | Diretor                           |
| `year`            | Integer     | Ano de lançamento                 |
| `genres`          | JSON        | Gêneros do filme                  |
| `synopsis`        | Text        | Sinopse                           |
| `poster_url`      | String      | URL do pôster                     |
| `created_at`      | Timestamp   | Data de criação                   |
| `updated_at`      | Timestamp   | Data de atualização               |

---

# 5. Criação da MovieFactory

Depois das migrations, foi criada a **Factory** responsável por definir os dados que seriam gerados automaticamente.

Arquivo:

```text
database/factories/MovieFactory.php
```

A Factory utiliza o `fake()` para gerar informações automaticamente.

Exemplo:

```php
return [
    'user_id' => \App\Models\User::factory(),
    'created_by_name' => fake()->name(),
    'title' => fake()->sentence(3),
    'director' => fake()->name(),
    'year' => fake()->numberBetween(1970, 2026),
    'genres' => [fake()->randomElement([
        'Ação',
        'Aventura',
        'Comédia',
        'Drama',
        'Ficção Científica',
        'Terror',
    ])],
    'synopsis' => fake()->paragraph(),
    'poster_url' => null,
];
```

Com isso, cada filme recebe informações diferentes durante a execução do Seeder.

---

# 6. Configuração do UUID

A tabela `movies` utiliza UUID como chave primária:

```php
$table->uuid('id')->primary();
```

Por isso, o Model `Movie` foi configurado para gerar os UUIDs automaticamente.

Arquivo:

```text
app/Models/Movie.php
```

Foi utilizado:

```php
use Illuminate\Database\Eloquent\Concerns\HasUuids;
```

E no Model:

```php
use HasFactory, HasUuids;
```

Também foi definido:

```php
public $incrementing = false;

protected $keyType = 'string';
```

Dessa forma, os registros de filmes recebem automaticamente identificadores no formato UUID.

Exemplo de ID gerado:

```text
a2d0f097-36f9-40ee-881c-dbc41c43ff79
```

---

# 7. Criação do DatabaseSeeder

O Seeder principal está localizado em:

```text
database/seeders/DatabaseSeeder.php
```

Ele é responsável por executar as Factories e criar os registros no banco.

Através dele foram gerados usuários e filmes para testar o funcionamento do sistema.

A ideia principal é utilizar o Seeder para não precisar cadastrar cada registro manualmente.

---

# 8. Executando as migrations

Depois da configuração das tabelas, foi executado:

```bash
php artisan migrate:fresh
```

Esse comando remove as tabelas existentes e cria novamente toda a estrutura do banco de dados utilizando as migrations.

Resultado:

```text
INFO  Preparing database.

INFO  Running migrations.
```

---

# 9. Executando o Seeder

Depois que as tabelas foram criadas, foi executado:

```bash
php artisan db:seed
```

Resultado:

```text
INFO  Seeding database.
```

Com isso, os dados definidos pelas Factories foram inseridos automaticamente no banco.

---

# 10. Dados gerados

Após a execução do Seeder, foram criados registros de usuários e filmes.

Exemplo de dados presentes na tabela `movies`:

| Campo      | Exemplo                                |
| ---------- | -------------------------------------- |
| ID         | `a2d0f097-36f9-40ee-881c-dbc41c43ff79` |
| Usuário    | Usuário gerado pela Factory            |
| Criado por | Nome gerado pelo Faker                 |
| Título     | Título gerado pelo Faker               |
| Diretor    | Nome gerado pelo Faker                 |
| Ano        | Ano entre 1970 e 2026                  |
| Gênero     | Ação, Drama, Terror etc.               |
| Sinopse    | Texto gerado pelo Faker                |
| Pôster     | `null`                                 |

Os dados são gerados automaticamente utilizando o Faker disponibilizado pelo Laravel.

---

# 11. Verificação dos dados

Para verificar se os dados foram realmente inseridos, foi utilizado o Tinker:

```bash
php artisan tinker
```

Dentro do Tinker:

```php
App\Models\Movie::count();
```

Também foi possível consultar os filmes:

```php
App\Models\Movie::all();
```

Dessa forma foi possível verificar os registros criados pelo Seeder.

---

# 12. Geração do arquivo SQL

Depois da execução do Seeder, foi criado um arquivo contendo a estrutura e os dados do banco.

Para isso foi utilizado o SQLite:

```bash
sqlite3 database/database.sqlite .dump > seeder.sql
```

O arquivo gerado foi:

```text
seeder.sql
```

Esse arquivo contém:

* estrutura das tabelas;
* registros dos usuários;
* registros dos filmes;
* tags;
* relacionamentos;
* demais dados presentes no banco no momento da exportação.

Também foram mantidos no projeto os arquivos:

```text
database_schema.sql
cinelist_dump.sql
seeder.sql
```

---

# 13. Resultado

Ao final da atividade, foi possível:

* Instalar e configurar um projeto Laravel;
* Configurar o SQLite;
* Criar as migrations do banco;
* Criar a Factory de filmes;
* Configurar a geração de UUID;
* Criar e configurar o Seeder;
* Gerar usuários automaticamente;
* Gerar filmes automaticamente;
* Inserir os dados no SQLite;
* Verificar os registros utilizando o Tinker;
* Exportar o banco para um arquivo `.sql`.

---

# 14. Comandos utilizados

Os principais comandos utilizados durante a atividade foram:

```bash
composer create-project laravel/laravel CineList_seeders
```

```bash
cd CineList_seeders
```

```bash
php artisan key:generate
```

```bash
php artisan migrate:fresh
```

```bash
php artisan db:seed
```

```bash
php artisan tinker
```

```bash
sqlite3 database/database.sqlite .dump > seeder.sql
```

---

# 15. Arquivos importantes

### Seeder

```text
database/seeders/DatabaseSeeder.php
```

Responsável pela execução da população do banco.

### Factory

```text
database/factories/MovieFactory.php
```

Responsável por definir os dados dos filmes.

### Model

```text
app/Models/Movie.php
```

Responsável pela representação da tabela `movies` e pela configuração dos UUIDs.

### SQL

```text
seeder.sql
```

Arquivo contendo o dump do banco com os dados gerados.

---

# 16. Conclusão

A atividade permitiu entender como utilizar **Seeders e Factories no Laravel** para gerar dados automaticamente.

Com o Seeder, foi possível popular o banco de dados de forma rápida, evitando a necessidade de cadastrar cada filme manualmente.

O uso do Faker também permitiu gerar diferentes informações para os registros, facilitando os testes do sistema CineList.
