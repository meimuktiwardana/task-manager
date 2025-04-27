-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.28-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for task_manager
CREATE DATABASE IF NOT EXISTS `task_manager` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `task_manager`;

-- Dumping structure for table task_manager.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table task_manager.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table task_manager.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table task_manager.migrations: ~8 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2025_04_26_055505_create_permission_tables', 2),
	(6, '2025_04_26_064628_create_projects_table', 3),
	(7, '2025_04_26_064628_create_tasks_table', 3),
	(8, '2025_04_26_072204_create_projects_table', 4),
	(9, '2025_04_26_072204_create_tasks_table', 4);

-- Dumping structure for table task_manager.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table task_manager.model_has_permissions: ~0 rows (approximately)

-- Dumping structure for table task_manager.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table task_manager.model_has_roles: ~4 rows (approximately)
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', 1),
	(2, 'App\\Models\\User', 1),
	(2, 'App\\Models\\User', 2),
	(2, 'App\\Models\\User', 3);

-- Dumping structure for table task_manager.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table task_manager.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table task_manager.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table task_manager.permissions: ~52 rows (approximately)
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'view_role', 'web', '2025-04-25 22:55:12', '2025-04-25 22:55:12'),
	(2, 'view_any_role', 'web', '2025-04-25 22:55:12', '2025-04-25 22:55:12'),
	(3, 'create_role', 'web', '2025-04-25 22:55:12', '2025-04-25 22:55:12'),
	(4, 'update_role', 'web', '2025-04-25 22:55:12', '2025-04-25 22:55:12'),
	(5, 'delete_role', 'web', '2025-04-25 22:55:12', '2025-04-25 22:55:12'),
	(6, 'delete_any_role', 'web', '2025-04-25 22:55:12', '2025-04-25 22:55:12'),
	(7, 'project.view', 'web', '2025-04-26 01:28:37', '2025-04-26 01:28:37'),
	(8, 'project.viewAny', 'web', '2025-04-26 01:28:37', '2025-04-26 01:28:37'),
	(9, 'project.create', 'web', '2025-04-26 01:28:37', '2025-04-26 01:28:37'),
	(10, 'project.update', 'web', '2025-04-26 01:28:37', '2025-04-26 01:28:37'),
	(11, 'project.delete', 'web', '2025-04-26 01:28:37', '2025-04-26 01:28:37'),
	(12, 'task.view', 'web', '2025-04-26 01:28:37', '2025-04-26 01:28:37'),
	(13, 'task.viewAny', 'web', '2025-04-26 01:28:37', '2025-04-26 01:28:37'),
	(14, 'task.create', 'web', '2025-04-26 01:28:37', '2025-04-26 01:28:37'),
	(15, 'task.update', 'web', '2025-04-26 01:28:37', '2025-04-26 01:28:37'),
	(16, 'task.delete', 'web', '2025-04-26 01:28:37', '2025-04-26 01:28:37'),
	(17, 'view_project', 'web', '2025-04-26 02:16:52', '2025-04-26 02:16:52'),
	(18, 'view_any_project', 'web', '2025-04-26 02:16:52', '2025-04-26 02:16:52'),
	(19, 'view_task', 'web', '2025-04-26 02:16:52', '2025-04-26 02:16:52'),
	(20, 'view_any_task', 'web', '2025-04-26 02:16:52', '2025-04-26 02:16:52'),
	(21, 'update_task', 'web', '2025-04-26 02:16:52', '2025-04-26 02:16:52'),
	(22, 'create_project', 'web', '2025-04-26 02:32:20', '2025-04-26 02:32:20'),
	(23, 'update_project', 'web', '2025-04-26 02:32:20', '2025-04-26 02:32:20'),
	(24, 'restore_project', 'web', '2025-04-26 02:32:20', '2025-04-26 02:32:20'),
	(25, 'restore_any_project', 'web', '2025-04-26 02:32:20', '2025-04-26 02:32:20'),
	(26, 'replicate_project', 'web', '2025-04-26 02:32:20', '2025-04-26 02:32:20'),
	(27, 'reorder_project', 'web', '2025-04-26 02:32:20', '2025-04-26 02:32:20'),
	(28, 'delete_project', 'web', '2025-04-26 02:32:20', '2025-04-26 02:32:20'),
	(29, 'delete_any_project', 'web', '2025-04-26 02:32:20', '2025-04-26 02:32:20'),
	(30, 'force_delete_project', 'web', '2025-04-26 02:32:20', '2025-04-26 02:32:20'),
	(31, 'force_delete_any_project', 'web', '2025-04-26 02:32:20', '2025-04-26 02:32:20'),
	(32, 'create_task', 'web', '2025-04-26 02:32:20', '2025-04-26 02:32:20'),
	(33, 'restore_task', 'web', '2025-04-26 02:32:20', '2025-04-26 02:32:20'),
	(34, 'restore_any_task', 'web', '2025-04-26 02:32:20', '2025-04-26 02:32:20'),
	(35, 'replicate_task', 'web', '2025-04-26 02:32:20', '2025-04-26 02:32:20'),
	(36, 'reorder_task', 'web', '2025-04-26 02:32:20', '2025-04-26 02:32:20'),
	(37, 'delete_task', 'web', '2025-04-26 02:32:20', '2025-04-26 02:32:20'),
	(38, 'delete_any_task', 'web', '2025-04-26 02:32:20', '2025-04-26 02:32:20'),
	(39, 'force_delete_task', 'web', '2025-04-26 02:32:20', '2025-04-26 02:32:20'),
	(40, 'force_delete_any_task', 'web', '2025-04-26 02:32:20', '2025-04-26 02:32:20'),
	(41, 'view_user', 'web', '2025-04-26 02:32:20', '2025-04-26 02:32:20'),
	(42, 'view_any_user', 'web', '2025-04-26 02:32:20', '2025-04-26 02:32:20'),
	(43, 'create_user', 'web', '2025-04-26 02:32:20', '2025-04-26 02:32:20'),
	(44, 'update_user', 'web', '2025-04-26 02:32:20', '2025-04-26 02:32:20'),
	(45, 'restore_user', 'web', '2025-04-26 02:32:20', '2025-04-26 02:32:20'),
	(46, 'restore_any_user', 'web', '2025-04-26 02:32:20', '2025-04-26 02:32:20'),
	(47, 'replicate_user', 'web', '2025-04-26 02:32:20', '2025-04-26 02:32:20'),
	(48, 'reorder_user', 'web', '2025-04-26 02:32:20', '2025-04-26 02:32:20'),
	(49, 'delete_user', 'web', '2025-04-26 02:32:20', '2025-04-26 02:32:20'),
	(50, 'delete_any_user', 'web', '2025-04-26 02:32:20', '2025-04-26 02:32:20'),
	(51, 'force_delete_user', 'web', '2025-04-26 02:32:20', '2025-04-26 02:32:20'),
	(52, 'force_delete_any_user', 'web', '2025-04-26 02:32:20', '2025-04-26 02:32:20'),
	(53, 'access_filament', 'web', '2025-04-26 03:22:57', '2025-04-26 03:22:57');

-- Dumping structure for table task_manager.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table task_manager.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table task_manager.projects
CREATE TABLE IF NOT EXISTS `projects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table task_manager.projects: ~1 rows (approximately)
INSERT INTO `projects` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'Project Baru', 'Berisi deskripsi', '2025-04-26 01:34:14', '2025-04-27 03:51:35');

-- Dumping structure for table task_manager.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table task_manager.roles: ~3 rows (approximately)
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'super_admin', 'web', '2025-04-25 22:55:12', '2025-04-25 22:55:12'),
	(2, 'user', 'web', '2025-04-25 22:55:12', '2025-04-26 23:17:07');

-- Dumping structure for table task_manager.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table task_manager.role_has_permissions: ~15 rows (approximately)
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(7, 1),
	(8, 1),
	(9, 1),
	(10, 1),
	(11, 1),
	(12, 1),
	(13, 1),
	(14, 1),
	(15, 1),
	(16, 1),
	(17, 2),
	(18, 2),
	(19, 2),
	(20, 2),
	(21, 2);

-- Dumping structure for table task_manager.tasks
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `status` enum('To Do','In Progress','Done') NOT NULL DEFAULT 'To Do',
  `deadline` date NOT NULL,
  `project_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tasks_project_id_foreign` (`project_id`),
  KEY `tasks_user_id_foreign` (`user_id`),
  CONSTRAINT `tasks_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tasks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table task_manager.tasks: ~2 rows (approximately)
INSERT INTO `tasks` (`id`, `title`, `status`, `deadline`, `project_id`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 'task 1', 'In Progress', '2025-04-28', 1, 2, '2025-04-26 02:07:55', '2025-04-26 17:39:58'),
	(2, 'task 2', 'In Progress', '2025-04-29', 1, 3, '2025-04-26 21:55:18', '2025-04-26 23:20:05'),
	(3, 'task 3', 'Done', '2025-04-27', 1, 3, '2025-04-26 21:55:43', '2025-04-26 21:55:43');

-- Dumping structure for table task_manager.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table task_manager.users: ~3 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'admin@admin.com', NULL, '$2y$12$7V.QeO.8twTIq8TggfagYeKdtx2cOKvRG3bKrtQmE9u5VjYOMR22m', NULL, '2025-04-25 22:59:19', '2025-04-25 22:59:19'),
	(2, 'User', 'user@user.com', NULL, '$2y$12$V02nn2PuQ3I7TXz9QW1k3.d1tdZUZkza645XalSaFhv6hLfz7vR12', NULL, '2025-04-26 02:07:14', '2025-04-26 23:17:40'),
	(3, 'User2', 'user2@user.com', NULL, '$2y$12$V2qLWz5zCkHyt3e9V1YMu.wNSeXlpz6KOOy2jsi9EgXWLUZFynWvi', NULL, '2025-04-26 21:54:51', '2025-04-26 23:18:45');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
