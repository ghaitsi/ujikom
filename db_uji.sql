-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2026 at 02:29 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_uji`
--

-- --------------------------------------------------------

--
-- Table structure for table `alat`
--

CREATE TABLE `alat` (
  `id_alat` int(10) UNSIGNED NOT NULL,
  `nama_alat` varchar(255) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `kondisi` varchar(255) DEFAULT NULL,
  `status` enum('tersedia','dipinjam','perbaikan') NOT NULL DEFAULT 'tersedia',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alat`
--

INSERT INTO `alat` (`id_alat`, `nama_alat`, `id_kategori`, `stok`, `deskripsi`, `gambar`, `kondisi`, `status`, `created_at`, `updated_at`) VALUES
(1, 'sapu', 2, 100, 'sapu aja', 'alat/IrPYDRT3W7JsbnQdvpmY7UyITt9V3eejN7ntRBvR.jpg', 'Rusak Ringan', 'tersedia', '2026-02-08 01:42:16', '2026-02-17 22:42:53'),
(2, 'laptop', 2, 10, 'ini laptop', 'alat/XhNLppqtLYxqdUuezidqxMrNju40FzFraBiwq1C3.png', 'Baik', 'tersedia', '2026-02-08 23:45:45', '2026-04-06 16:52:37'),
(5, 'tangga', 4, 10, 'tangga buat naik', 'alat/ncNlR0Sh4s107uy9yKdVnCGAojAkkxKijHXpi0LU.png', 'Baik', 'tersedia', '2026-04-07 04:23:41', '2026-04-07 04:41:06');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(10) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(2, 'baju', '2026-02-08 20:32:14', '2026-02-18 21:25:21'),
(4, 'perkakas', '2026-04-07 04:39:44', '2026-04-07 04:40:43');

-- --------------------------------------------------------

--
-- Table structure for table `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `id_log` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `aktivitas` varchar(255) NOT NULL,
  `waktu` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `log_aktivitas`
--

INSERT INTO `log_aktivitas` (`id_log`, `id_user`, `aktivitas`, `waktu`, `created_at`, `updated_at`) VALUES
(1, 6, 'Mengajukan peminjaman alat ID 2', '2026-02-11 09:46:32', NULL, NULL),
(2, 6, 'Mengajukan peminjaman alat ID 2', '2026-02-11 11:27:04', NULL, NULL),
(3, 6, 'Mengajukan peminjaman alat ID 2', '2026-02-12 01:42:03', NULL, NULL),
(4, 6, 'Mengajukan peminjaman alat ID 2', '2026-02-18 05:37:05', NULL, NULL),
(5, 6, 'Mengajukan peminjaman alat ID 1', '2026-02-18 05:37:25', NULL, NULL),
(6, 6, 'Mengembalikan alat: sapu', '2026-02-18 05:42:53', NULL, NULL),
(7, 6, 'Mengembalikan alat: laptop', '2026-02-19 05:11:36', NULL, NULL),
(8, 6, 'Mengajukan peminjaman alat ID 2', '2026-02-19 05:27:37', NULL, NULL),
(9, 6, 'Mengembalikan alat: laptop', '2026-02-19 05:29:31', NULL, NULL),
(10, 6, 'Mengajukan peminjaman alat ID 2', '2026-03-30 22:05:33', NULL, NULL),
(11, 6, 'Mengembalikan alat: laptop', '2026-03-30 22:08:49', NULL, NULL),
(12, 6, 'Mengajukan peminjaman alat ID 2', '2026-03-30 22:13:05', NULL, NULL),
(13, 6, 'Mengembalikan alat: laptop', '2026-03-30 22:15:58', NULL, NULL),
(14, 6, 'Mengajukan peminjaman alat ID 2', '2026-04-06 23:50:54', NULL, NULL),
(15, 6, 'Mengembalikan alat: laptop', '2026-04-06 23:52:37', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_02_06_013304_create_alats_table', 2),
(5, '2026_02_08_082250_create_log_aktivitas_table', 2),
(6, '2026_02_09_014509_create_kategoris_table', 3),
(7, '2026_02_09_105923_create_peminjaman_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(10) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_alat` int(10) UNSIGNED NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_rencana_kembali` date DEFAULT NULL,
  `status` enum('menunggu','disetujui','ditolak','dipinjam','selesai') NOT NULL DEFAULT 'menunggu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_user`, `id_alat`, `tanggal_pinjam`, `tanggal_rencana_kembali`, `status`, `created_at`, `updated_at`) VALUES
(18, 6, 2, '2026-02-19', '2026-02-26', 'selesai', '2026-02-18 22:27:37', '2026-02-18 22:29:31'),
(19, 6, 2, '2026-03-30', '2026-04-06', 'selesai', '2026-03-30 15:05:33', '2026-03-30 15:08:49'),
(20, 6, 2, '2026-03-30', '2026-03-30', 'selesai', '2026-03-30 15:13:05', '2026-03-30 15:15:58'),
(21, 6, 2, '2026-04-06', '2026-04-06', 'selesai', '2026-04-06 16:50:54', '2026-04-06 16:52:36');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Oi0W3lK98ZDO3bs2USg0FkKXnDRYPqCMgrXuZ6Gb', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoialB5UjNoTTV1b1ZscmhLb1BaaERFTUxyRVU2akZQMjlpTkJabFFWQyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi91c2Vycy9jcmVhdGUiO3M6NToicm91dGUiO3M6MTg6ImFkbWluLnVzZXJzLmNyZWF0ZSI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1770514637);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','petugas','peminjam') NOT NULL DEFAULT 'peminjam',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin', NULL, '$2y$12$set8aVSjaTgKvMxp6IOFnOHR08u42g7vH0badRQjOYKj8NcIYziX2', NULL, '2026-02-03 04:42:24', '2026-02-03 04:42:24'),
(2, 'Petugas', 'petugas@gmail.com', 'petugas', NULL, '$2y$12$y3S7MWNioT0GLhrRvN6bu.i9rlU2eU2w6YkRNhsB4FNbBzHqHuWMm', NULL, '2026-02-03 04:42:24', '2026-02-03 04:42:24'),
(3, 'loyd', 'loydazzuka@gmail.com', 'admin', NULL, '$2y$12$onsx2Jq72cBCeAdxELO87uqNlxZy5YbCFvcf4mEukxL6eq/weP7s2', NULL, '2026-02-03 16:48:39', '2026-02-08 00:18:31'),
(4, 'Xhyr', 'Xhyr@gmail.com', 'admin', NULL, '$2y$12$vQ2t6uf/RbkCKCjuLK8dLOiX.wu3vXu78cCGJrUiHZkAZgwHlKIrG', NULL, '2026-02-08 00:54:29', '2026-02-08 00:54:29'),
(5, 'bahlil', 'bahlil@gmail.com', 'admin', NULL, '$2y$12$cvqQIafsUBEU3SQlSpKgs.TnyacD3becy3CXWz5pXO8CQZ.4xSd9m', NULL, '2026-02-08 01:16:27', '2026-02-08 01:16:27'),
(6, 'alya', 'alya@gmail.com', 'peminjam', NULL, '$2y$12$s.AezHm9oxdog0pnFj68geYd46UmsEmy2DulPQWz8ECYXaa3WqCKS', NULL, '2026-02-09 05:21:52', '2026-02-09 05:21:52'),
(7, 'test', 'test@gmail.com', 'petugas', NULL, '$2y$12$x8SBX5VyIOwZpDqo/YmDDOCyitBApHu9BQyYyYsCf79BN5MnR6I2y', NULL, '2026-02-11 18:51:30', '2026-02-11 18:51:30'),
(8, 'elicia', 'elicia@gmail.com', 'peminjam', NULL, '$2y$12$OD6vB8C/vVMrYrm8CNCKi.ax1/dI.gg5veSWa5uVixU2C7tWrITOe', NULL, '2026-03-31 23:35:44', '2026-03-31 23:35:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alat`
--
ALTER TABLE `alat`
  ADD PRIMARY KEY (`id_alat`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `log_aktivitas_id_user_index` (`id_user`),
  ADD KEY `log_aktivitas_waktu_index` (`waktu`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `peminjaman_id_user_foreign` (`id_user`),
  ADD KEY `peminjaman_id_alat_foreign` (`id_alat`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alat`
--
ALTER TABLE `alat`
  MODIFY `id_alat` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  MODIFY `id_log` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD CONSTRAINT `log_aktivitas_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_id_alat_foreign` FOREIGN KEY (`id_alat`) REFERENCES `alat` (`id_alat`) ON DELETE CASCADE,
  ADD CONSTRAINT `peminjaman_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
