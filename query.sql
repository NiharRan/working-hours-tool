-- Adminer 4.8.1 MySQL 10.7.3-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `activities`;
CREATE TABLE `activities` (
                              `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                              `user_id` bigint(20) unsigned NOT NULL,
                              `project_id` bigint(20) unsigned NOT NULL,
                              `start_at` datetime NOT NULL,
                              `end_at` datetime DEFAULT NULL,
                              `total_hours` decimal(10,4) DEFAULT NULL,
                              `status` tinyint(1) NOT NULL DEFAULT 1,
                              `created_at` timestamp NULL DEFAULT NULL,
                              `updated_at` timestamp NULL DEFAULT NULL,
                              PRIMARY KEY (`id`),
                              KEY `activities_user_id_foreign` (`user_id`),
                              KEY `activities_project_id_foreign` (`project_id`),
                              CONSTRAINT `activities_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
                              CONSTRAINT `activities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `activities` (`id`, `user_id`, `project_id`, `start_at`, `end_at`, `total_hours`, `status`, `created_at`, `updated_at`) VALUES
                                                                                                                                        (1,	2,	3,	'2022-06-21 08:05:58',	'2022-06-21 09:40:10',	1.5667,	2,	'2022-06-21 02:05:58',	'2022-06-21 03:40:10'),
                                                                                                                                        (2,	2,	1,	'2022-06-21 09:40:24',	'2022-06-21 10:50:11',	1.1500,	2,	'2022-06-21 03:40:24',	'2022-06-21 04:50:11'),
                                                                                                                                        (3,	3,	4,	'2022-06-21 10:29:45',	'2022-06-21 10:50:23',	0.3333,	2,	'2022-06-21 04:29:45',	'2022-06-21 04:50:23');

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
                               `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                               `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
                               `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
                               `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                               `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                               `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
                               PRIMARY KEY (`id`),
                               UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
                              `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                              `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                              `batch` int(11) NOT NULL,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
                                                          (1,	'2014_10_12_000000_create_users_table',	1),
                                                          (2,	'2014_10_12_100000_create_password_resets_table',	1),
                                                          (3,	'2014_10_12_200000_add_two_factor_columns_to_users_table',	1),
                                                          (4,	'2019_08_19_000000_create_failed_jobs_table',	1),
                                                          (5,	'2019_12_14_000001_create_personal_access_tokens_table',	1),
                                                          (6,	'2022_06_20_075432_create_sessions_table',	1),
                                                          (7,	'2022_06_20_105801_create_projects_table',	2),
                                                          (8,	'2022_06_20_110029_create_activities_table',	3);

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
                                   `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                   `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                   `created_at` timestamp NULL DEFAULT NULL,
                                   KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
                                          `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                                          `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                          `tokenable_id` bigint(20) unsigned NOT NULL,
                                          `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                          `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
                                          `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                          `last_used_at` timestamp NULL DEFAULT NULL,
                                          `created_at` timestamp NULL DEFAULT NULL,
                                          `updated_at` timestamp NULL DEFAULT NULL,
                                          PRIMARY KEY (`id`),
                                          UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
                                          KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects` (
                            `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                            `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `status` tinyint(1) NOT NULL DEFAULT 1,
                            `created_at` timestamp NULL DEFAULT NULL,
                            `updated_at` timestamp NULL DEFAULT NULL,
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `projects` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
                                                                                (1,	'Demo Project',	1,	'2022-06-21 01:12:39',	'2022-06-21 01:12:39'),
                                                                                (2,	'Simple CRM',	1,	'2022-06-21 01:20:12',	'2022-06-21 01:20:12'),
                                                                                (3,	'Daily Transaction Management System',	1,	'2022-06-21 01:20:37',	'2022-06-21 01:20:37'),
                                                                                (4,	'Newsletter',	1,	'2022-06-21 01:20:49',	'2022-06-21 01:20:49'),
                                                                                (5,	'Portfolio',	1,	'2022-06-21 01:20:57',	'2022-06-21 01:20:57');

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
                            `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `user_id` bigint(20) unsigned DEFAULT NULL,
                            `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                            `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                            `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
                            `last_activity` int(11) NOT NULL,
                            PRIMARY KEY (`id`),
                            KEY `sessions_user_id_index` (`user_id`),
                            KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
    ('iSCHCJc4EgT5UtCBey8wQqmG6dGLbVuAstJK7XBz',	NULL,	'127.0.0.1',	'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36',	'YTo1OntzOjY6Il90b2tlbiI7czo0MDoieDN5bGI0dnZLSEVwVGFIZm4wNlR2b1hYRDY5Yk0xSmIxa1h2bDJsSiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMToiaHR0cDovL2hybS50ZXN0L2FkbWluL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjIxOiJodHRwOi8vaHJtLnRlc3QvbG9naW4iO31zOjU6ImxvY2FsIjtzOjI6ImVuIjt9',	1655810769);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
                         `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                         `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `email_verified_at` timestamp NULL DEFAULT NULL,
                         `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `status` tinyint(4) NOT NULL,
                         `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
                         `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `current_team_id` bigint(20) unsigned DEFAULT NULL,
                         `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `created_at` timestamp NULL DEFAULT NULL,
                         `updated_at` timestamp NULL DEFAULT NULL,
                         PRIMARY KEY (`id`),
                         UNIQUE KEY `users_email_unique` (`email`),
                         UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `role`, `status`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
                                                                                                                                                                                                                                                                                   (1,	'Akash Das',	'akashdas',	'niharranjandasmu@gmail.com',	NULL,	'$2y$10$f5pV8WDQ3CsZY1SAYiI7KONFP6Skb6M55vvYXfc8s6JsnEHspc5dK',	'admin',	1,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-06-20 01:58:32',	'2022-06-20 11:14:53'),
                                                                                                                                                                                                                                                                                   (2,	'Prokash Das',	'prokashdas',	'prokashdas@gmail.com',	NULL,	'$2y$10$HSx8RmyawNgaR/elv4SAoe9BfBLP12cJvIY13PXg8uFxZBijQ7zoy',	'user',	1,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-06-20 05:25:11',	'2022-06-20 11:15:08'),
                                                                                                                                                                                                                                                                                   (3,	'Eka Saha',	'ekasaha',	'eka@gmail.com',	NULL,	'$2y$10$lL3lHXBkHTqX75afkITPYeNs3QdHwPd7829gNwZ5anGNpDMAhbwYq',	'user',	1,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-06-20 10:27:54',	'2022-06-20 10:27:54');

-- 2022-06-22 06:11:31
