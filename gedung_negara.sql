-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2020 at 07:02 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gedung_negara`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gedung`
--

CREATE TABLE `gedung` (
  `id` int(11) NOT NULL,
  `id_gedung_kategori` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bujur_timur` double DEFAULT NULL,
  `lintang_selatan` double DEFAULT NULL,
  `legalitas` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipe_milik` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alas_hak` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `luas_lahan` double DEFAULT NULL,
  `jumlah_lantai` int(11) DEFAULT NULL,
  `luas` double DEFAULT NULL,
  `tinggi` double DEFAULT NULL,
  `kelas_tinggi` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kompleks` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kepadatan` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permanensi` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `risk_bakar` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `penangkal` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `struktur_bawah` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `struktur_bangunan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `struktur_atap` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kode_provinsi` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kode_kabupaten` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kode_kecamatan` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kode_kelurahan` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gedung_ketegori`
--

CREATE TABLE `gedung_ketegori` (
  `id` int(11) NOT NULL,
  `nama` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kerusakan`
--

CREATE TABLE `kerusakan` (
  `id` int(11) NOT NULL,
  `id_gedung` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `detail_json` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kerusakan_detail`
--

CREATE TABLE `kerusakan_detail` (
  `id` int(11) NOT NULL,
  `id_kerusakan` int(11) NOT NULL,
  `id_komponen` int(11) NOT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `id_komponen_opsi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kerusakan_klasifikasi`
--

CREATE TABLE `kerusakan_klasifikasi` (
  `id` int(11) NOT NULL,
  `id_kerusakan_detail` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL DEFAULT 0,
  `tingkat_kerusakan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kerusakan_surveyor`
--

CREATE TABLE `kerusakan_surveyor` (
  `id` int(11) NOT NULL,
  `id_kerusakan` int(11) NOT NULL,
  `id_user` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `komponen`
--

CREATE TABLE `komponen` (
  `id` int(11) NOT NULL,
  `nama` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `bobot` int(11) DEFAULT NULL,
  `id_satuan` int(11) DEFAULT NULL,
  `id_parent` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `komponen`
--

INSERT INTO `komponen` (`id`, `nama`, `bobot`, `id_satuan`, `id_parent`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'tes1', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'tes2', NULL, 2, NULL, NULL, NULL, NULL),
(8, 'tes3', NULL, 2, NULL, NULL, NULL, NULL),
(9, 'tes4', NULL, 2, NULL, NULL, NULL, NULL),
(10, 'tes11', NULL, 2, 1, NULL, NULL, NULL),
(11, 'tes12', NULL, 2, 1, NULL, NULL, NULL),
(12, 'tes13', NULL, 2, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `komponen_opsi`
--

CREATE TABLE `komponen_opsi` (
  `id` int(11) NOT NULL,
  `opsi` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `nilai` int(11) NOT NULL DEFAULT 0 COMMENT 'persentase',
  `id_komponen` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `delete_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_10_07_101331_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id` int(11) NOT NULL,
  `nama` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id`, `nama`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'estimasi', NULL, NULL, NULL),
(2, '%', NULL, NULL, NULL),
(3, 'unit', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gedung`
--
ALTER TABLE `gedung`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_gedung_kategori_idx` (`id_gedung_kategori`);

--
-- Indexes for table `gedung_ketegori`
--
ALTER TABLE `gedung_ketegori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kerusakan`
--
ALTER TABLE `kerusakan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kerusakan_gedung_idx` (`id_gedung`);

--
-- Indexes for table `kerusakan_detail`
--
ALTER TABLE `kerusakan_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kerusakan_detail_kerusakan_idx` (`id_kerusakan`),
  ADD KEY `fk_kerusakan_detail_komponen_idx` (`id_komponen`),
  ADD KEY `fk_kerusakan_detail_komponen_opsi_idx` (`id_komponen_opsi`);

--
-- Indexes for table `kerusakan_klasifikasi`
--
ALTER TABLE `kerusakan_klasifikasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kerusakan_klasifikasi_k_detail_idx` (`id_kerusakan_detail`);

--
-- Indexes for table `kerusakan_surveyor`
--
ALTER TABLE `kerusakan_surveyor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kerusakan_surveyor_kerusakan_idx` (`id_kerusakan`);

--
-- Indexes for table `komponen`
--
ALTER TABLE `komponen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kompoenen_parent_idx` (`id_parent`),
  ADD KEY `fk_kompoenen_satuan_idx` (`id_satuan`);

--
-- Indexes for table `komponen_opsi`
--
ALTER TABLE `komponen_opsi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_komponen_opsi_komponen_idx` (`id_komponen`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gedung`
--
ALTER TABLE `gedung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gedung_ketegori`
--
ALTER TABLE `gedung_ketegori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kerusakan`
--
ALTER TABLE `kerusakan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kerusakan_detail`
--
ALTER TABLE `kerusakan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kerusakan_klasifikasi`
--
ALTER TABLE `kerusakan_klasifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kerusakan_surveyor`
--
ALTER TABLE `kerusakan_surveyor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `komponen`
--
ALTER TABLE `komponen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `komponen_opsi`
--
ALTER TABLE `komponen_opsi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gedung`
--
ALTER TABLE `gedung`
  ADD CONSTRAINT `fk_gedung_kategori` FOREIGN KEY (`id_gedung_kategori`) REFERENCES `gedung_ketegori` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `kerusakan`
--
ALTER TABLE `kerusakan`
  ADD CONSTRAINT `fk_kerusakan_gedung` FOREIGN KEY (`id_gedung`) REFERENCES `gedung` (`id`);

--
-- Constraints for table `kerusakan_detail`
--
ALTER TABLE `kerusakan_detail`
  ADD CONSTRAINT `fk_kerusakan_detail_kerusakan` FOREIGN KEY (`id_kerusakan`) REFERENCES `kerusakan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_kerusakan_detail_komponen` FOREIGN KEY (`id_komponen`) REFERENCES `komponen` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_kerusakan_detail_komponen_opsi` FOREIGN KEY (`id_komponen_opsi`) REFERENCES `komponen_opsi` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `kerusakan_klasifikasi`
--
ALTER TABLE `kerusakan_klasifikasi`
  ADD CONSTRAINT `fk_kerusakan_klasifikasi_k_detail` FOREIGN KEY (`id_kerusakan_detail`) REFERENCES `kerusakan_detail` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kerusakan_surveyor`
--
ALTER TABLE `kerusakan_surveyor`
  ADD CONSTRAINT `fk_kerusakan_surveyor_kerusakan` FOREIGN KEY (`id_kerusakan`) REFERENCES `kerusakan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `komponen`
--
ALTER TABLE `komponen`
  ADD CONSTRAINT `fk_kompoenen_parent` FOREIGN KEY (`id_parent`) REFERENCES `komponen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_kompoenen_satuan` FOREIGN KEY (`id_satuan`) REFERENCES `satuan` (`id`);

--
-- Constraints for table `komponen_opsi`
--
ALTER TABLE `komponen_opsi`
  ADD CONSTRAINT `fk_komponen_opsi_komponen` FOREIGN KEY (`id_komponen`) REFERENCES `komponen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
