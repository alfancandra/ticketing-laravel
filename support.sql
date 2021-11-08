-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2021 at 03:21 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ticketing-laravel`
--

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
(5, '2014_10_12_000000_create_users_table', 1),
(6, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(7, '2021_10_28_003243_create_tickets_table', 1),
(8, '2021_11_02_142938_create_pesans_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_pesans`
--

CREATE TABLE `ticket_pesans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pesan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_pesans`
--

INSERT INTO `ticket_pesans` (`id`, `ticket_id`, `nama`, `pesan`, `created_at`, `updated_at`) VALUES
(1, 6, 'Alfan', 'Bisa di percepat', '2021-11-02 01:21:55', '2021-11-02 01:21:55'),
(2, 5, 'Alfan', 'Sudah dikerjakan kemarin', '2021-11-02 01:27:37', '2021-11-02 01:27:37'),
(3, 3, 'Alfan', '1111', '2021-11-02 01:28:01', '2021-11-02 01:28:01'),
(4, 5, 'Alfan', 'Ditinjau ulang', '2021-11-02 01:32:28', '2021-11-02 01:32:28'),
(5, 6, 'Alfan', 'asd', '2021-11-02 02:03:33', '2021-11-02 02:03:33'),
(6, 6, 'Alfan', 'asd', '2021-11-02 02:03:34', '2021-11-02 02:03:34'),
(7, 6, 'Alfan', 'asd', '2021-11-02 02:03:36', '2021-11-02 02:03:36'),
(8, 6, 'Alfan', 'asd', '2021-11-02 02:03:37', '2021-11-02 02:03:37'),
(9, 6, 'Alfan', 'xas', '2021-11-02 02:05:02', '2021-11-02 02:05:02'),
(10, 6, 'Alfan', 'asx', '2021-11-02 02:05:03', '2021-11-02 02:05:03'),
(11, 6, 'Alfan', 'asd', '2021-11-02 02:05:18', '2021-11-02 02:05:18'),
(12, 6, 'Alfan', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos, nobis odit odio dolor adipisci dignissimos dolorem amet repellat quam quas non? Officiis neque doloremque ipsum ullam debitis et, optio aspernatur.', '2021-11-02 02:06:07', '2021-11-02 02:06:07'),
(13, 8, 'user', 'masih error', '2021-11-02 02:22:33', '2021-11-02 02:22:33'),
(14, 8, 'Alfan', 'error gimana', '2021-11-02 02:22:51', '2021-11-02 02:22:51'),
(15, 3, 'Alfan', 'Error', '2021-11-02 02:29:07', '2021-11-02 02:29:07'),
(16, 5, 'user', 'Thx', '2021-11-02 02:41:13', '2021-11-02 02:41:13'),
(17, 6, 'user', 'Coba', '2021-11-02 02:41:31', '2021-11-02 02:41:31'),
(18, 7, 'user', 'OK ... Sudah sesuai', '2021-11-02 02:57:52', '2021-11-02 02:57:52'),
(19, 6, 'user', 'bisa gak', '2021-11-02 03:00:51', '2021-11-02 03:00:51'),
(20, 6, 'Alfan', 'cek', '2021-11-02 17:37:58', '2021-11-02 17:37:58'),
(21, 4, 'Alfan', 'cek', '2021-11-02 17:49:49', '2021-11-02 17:49:49'),
(22, 11, 'user', 'Ini saya batalkan karena belum ada lampiran attachment', '2021-11-02 18:18:29', '2021-11-02 18:18:29'),
(23, 5, 'user', 'aman', '2021-11-02 20:50:39', '2021-11-02 20:50:39'),
(24, 5, 'Alfan', 'woke', '2021-11-02 20:50:55', '2021-11-02 20:50:55'),
(25, 6, 'user', 'aman', '2021-11-02 21:21:02', '2021-11-02 21:21:02'),
(26, 6, 'user', 'aa', '2021-11-02 21:21:37', '2021-11-02 21:21:37'),
(27, 13, 'Alfan', 'ini pesan', '2021-11-02 21:25:14', '2021-11-02 21:25:14'),
(28, 12, 'user', 'Sudah OK', '2021-11-03 01:22:18', '2021-11-03 01:22:18'),
(29, 14, 'user', 'OK', '2021-11-03 01:26:22', '2021-11-03 01:26:22'),
(30, 14, 'user', 'wOKe', '2021-11-03 01:26:41', '2021-11-03 01:26:41'),
(31, 13, 'user', 'test', '2021-11-03 01:27:20', '2021-11-03 01:27:20'),
(32, 14, 'user', 'OK', '2021-11-03 01:28:01', '2021-11-03 01:28:01'),
(33, 14, 'user', 'Siip', '2021-11-03 01:28:05', '2021-11-03 01:28:05'),
(34, 14, 'user', 'Juost', '2021-11-03 01:28:11', '2021-11-03 01:28:11'),
(35, 13, 'user', 't', '2021-11-03 02:36:22', '2021-11-03 02:36:22'),
(36, 13, 'user', 'a', '2021-11-03 02:36:24', '2021-11-03 02:36:24'),
(37, 13, 'user', 'e', '2021-11-03 02:36:26', '2021-11-03 02:36:26');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_tickets`
--

CREATE TABLE `ticket_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pesan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_tickets`
--

INSERT INTO `ticket_tickets` (`id`, `user_id`, `nama`, `pesan`, `image`, `status`, `created_at`, `updated_at`) VALUES
(3, 1, 'Alfan Adi Chandra', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis magni molestias iste veniam molestiae. Aut nulla repellendus itaque, molestiae quod sed praesentium voluptates incidunt aperiam sit odio dolorem esse reprehenderit.', '[\"617a0fde5ec1f_1635389406.unnamed.png\"]', 1, '2021-10-27 12:50:06', '2021-11-03 01:19:32'),
(4, 1, 'Alfan Adi Chandra', 'Error Bagian sini', '[\"617a0ffcd0618_1635389436.images.png\",\"617a0ffcd09cc_1635389436.Pengertian-localhost-Fungsi-Dan-Kelebihan-Localhost.png\",\"617a0ffcd56bb_1635389436.unnamed.png\"]', 0, '2021-10-27 12:50:36', '2021-10-28 19:13:40'),
(5, 2, 'Vincent', 'Komputer Errror', NULL, 1, '2021-10-27 13:08:15', '2021-11-01 17:58:59'),
(6, 2, 'Gilang', 'Redesign Template', NULL, 1, '2021-10-27 18:34:30', '2021-11-02 02:19:34'),
(7, 2, 'Suharjoko', 'Detail ticket - Ubah status dipindah kebawah sejajar tombol Kirim.', '[\"6180fcef42588_1635843311.Capture.JPG\"]', 1, '2021-11-02 01:55:11', '2021-11-03 02:24:53'),
(8, 2, 'Jacky', 'Icon attachment (paperclip) diletakkan disamping (akhir) kalimat (pesan) 	', '[\"6180fd9864638_1635843480.Capture.JPG\"]', 1, '2021-11-02 01:58:00', '2021-11-02 02:28:42'),
(9, 2, 'JQ', 'Bisa edit isi ticket yang telah dikirim ya..', NULL, 1, '2021-11-02 02:55:45', '2021-11-03 02:33:21'),
(10, 2, 'Suharjoko', 'Shortcut icon dan Title disesuaikan.', '[\"6181f429555b4_1635906601.Pengertian-localhost-Fungsi-Dan-Kelebihan-Localhost.png\",\"6181f3cd7117a_1635906509.images.png\",\"6181e12115453_1635901729.Capture.JPG\"]', 1, '2021-11-02 18:08:49', '2021-11-03 02:28:58'),
(11, 2, 'Jacky', 'Warna pada Action-Detail dirubah menjadi Primary (warna sama dengan Button Tambah)\r\nTujuannya agar ada variasi dalam sebaris dan berneda dengan Ticket-Dikirim', NULL, 3, '2021-11-02 18:17:10', '2021-11-03 01:52:53'),
(12, 2, 'Jacky', 'Warna pada Action-Detail dirubah menjadi Primary (warna sama dengan Button Tambah) Tujuannya agar ada variasi dalam sebaris dan berbeda dengan Ticket-Dikirim', '[\"6181e34077f5a_1635902272.Capture.JPG\"]', 1, '2021-11-02 18:17:52', '2021-11-03 02:28:02'),
(13, 2, 'Alfan Adi Chandra', 'Error ya gaes. a', '[\"618204922407d_1635910802.Pengertian-localhost-Fungsi-Dan-Kelebihan-Localhost.png\",\"6181f43cc79d7_1635906620.unnamed.png\",\"6181f438445c5_1635906616.images.png\"]', 3, '2021-11-02 19:05:16', '2021-11-03 01:34:05'),
(14, 2, 'Suharjoko', 'Edit Alert.', NULL, 1, '2021-11-03 01:25:43', '2021-11-03 02:06:48'),
(15, 2, 'Suharjoko', 'icon.', NULL, 1, '2021-11-03 01:55:30', '2021-11-03 02:08:27'),
(16, 2, 'JQ', 'Radio Button pada Pilihan Status', NULL, 1, '2021-11-03 01:55:56', '2021-11-03 02:25:13'),
(17, 2, 'JQ', 'OK..', NULL, 0, '2021-11-03 02:42:17', '2021-11-04 03:13:09');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_users`
--

CREATE TABLE `ticket_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` smallint(6) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_users`
--

INSERT INTO `ticket_users` (`id`, `name`, `username`, `password`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Alfan', 'alfancandra', '$2y$10$UX/W6ZDBBw2096RdpSj4r.v6x/h0JuaruhnT27BMdj/AgiA5QTBjS', 1, NULL, '2021-10-27 18:08:58', '2021-11-01 18:22:59'),
(2, 'user', 'user', '$2y$10$gsnT.D6SKKbqKPQO/93nqeXNOHXz3zlhgzU6Jvg/j40FRO5JVT4Nm', 0, NULL, '2021-10-28 23:03:54', '2021-11-01 18:33:46'),
(3, 'admin', 'admin', '$2y$10$6QwJLLVlGUG/DaXM9rIYCeZ5Cse09xt3UWvFZPuVKFOsxk7ZS4eWi', 1, NULL, '2021-10-28 23:17:58', '2021-10-28 23:24:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `ticket_pesans`
--
ALTER TABLE `ticket_pesans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_tickets`
--
ALTER TABLE `ticket_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_users`
--
ALTER TABLE `ticket_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ticket_users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket_pesans`
--
ALTER TABLE `ticket_pesans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `ticket_tickets`
--
ALTER TABLE `ticket_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `ticket_users`
--
ALTER TABLE `ticket_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
