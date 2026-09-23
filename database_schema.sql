-- ---------------------------------------------------------------------
-- database_schema.sql
-- Schema MySQL do CineList, pronto para importar/visualizar no
-- MySQL Workbench Community (Database > Reverse Engineer, ou
-- rode este arquivo direto em Server > Data Import / query editor).
--
-- Equivale ao par de migrations Postgres/Supabase original:
--   supabase/migrations/*_..._b6eee918...sql  (profiles + movies + RLS)
-- Diferenças de conversão Postgres -> MySQL:
--   * UUID gen_random_uuid()      -> CHAR(36), gerado no Laravel (HasUuids)
--   * auth.users (Supabase Auth)  -> tabela `users` própria do Laravel
--   * public.profiles.display_name -> incorporado em `users.display_name`
--   * TEXT[] genres                -> coluna JSON
--   * Row Level Security (RLS)     -> reforçado na aplicação (Sanctum + MoviePolicy)
-- ---------------------------------------------------------------------

SET FOREIGN_KEY_CHECKS = 0;
SET NAMES utf8mb4;

CREATE DATABASE IF NOT EXISTS `cinelist_db`
  DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `cinelist_db`;

--
-- Controle interno das migrations do Laravel
--
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- users (substitui auth.users + public.profiles)
--
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `display_name` varchar(255) NOT NULL DEFAULT 'Usuário',
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- movies (equivalente a public.movies)
--
CREATE TABLE `movies` (
  `id` char(36) NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_by_name` varchar(255) NOT NULL DEFAULT 'Usuário',
  `title` varchar(255) NOT NULL,
  `director` varchar(255) NOT NULL DEFAULT '',
  `year` smallint unsigned DEFAULT NULL,
  `genres` json NOT NULL,
  `synopsis` text NOT NULL,
  `poster_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `movies_user_id_index` (`user_id`),
  CONSTRAINT `movies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- sessions (autenticacao via sessao, SESSION_DRIVER=database opcional;
-- com SESSION_DRIVER=file esta tabela nao e necessaria)
--
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` longtext NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
