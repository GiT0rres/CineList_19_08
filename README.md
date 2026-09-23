# 🎬 CineList

Sistema web para cadastro e gerenciamento de filmes desenvolvido com **Laravel**, **PHP** e **MySQL**.

O CineList permite que usuários criem uma conta, façam login e gerenciem um catálogo de filmes, podendo cadastrar, editar, visualizar e excluir filmes.

## 🛠️ Tecnologias utilizadas

- Laravel 11
- PHP 8.4
- MySQL / MariaDB
- Blade
- HTML
- CSS
- JavaScript
- Vite

## 📋 Funcionalidades

- Cadastro de usuários
- Login e logout
- Autenticação por sessão
- Cadastro de filmes
- Edição de filmes
- Exclusão de filmes
- Busca por filme, diretor ou gênero
- Cadastro de múltiplos gêneros
- Controle do usuário que cadastrou cada filme

## 🗄️ Banco de dados

O banco de dados utilizado pelo CineList é o `ams_laravel_db`.

### Estrutura das tabelas

```text
┌─────────────────────┐
│       users         │
├─────────────────────┤
│ id                  │
│ display_name        │
│ email               │
│ password            │
│ created_at          │
│ updated_at          │
└──────────┬──────────┘
           │
           │ 1:N
           ▼
┌─────────────────────┐
│       movies        │
├─────────────────────┤
│ id (UUID)           │
│ user_id             │
│ created_by_name     │
│ title               │
│ director            │
│ year                │
│ genres              │
│ synopsis            │
│ poster_url          │
│ created_at          │
│ updated_at          │
└──────────┬──────────┘
           │
           │ N:N
           ▼
┌─────────────────────┐
│     movie_tag       │
├─────────────────────┤
│ id                  │
│ movie_id            │
│ tag_id              │
│ created_at          │
│ updated_at           │
└──────────┬──────────┘
           │
           │ N:1
           ▼
┌─────────────────────┐
│        tags         │
├─────────────────────┤
│ id                  │
│ name                │
│ created_at          │
│ updated_at          │
└─────────────────────┘

┌─────────────────────┐
│      profiles       │
├─────────────────────┤
│ id                  │
│ user_id             │
│ ...                 │
└─────────────────────┘


