-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 03, 2024 at 02:05 PM
-- Server version: 8.0.17
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bikeshopdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'นครนายก', NULL, NULL),
(2, 'กรุงเทพ', NULL, NULL),
(3, 'ชลบุรี', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'อะไหล่', NULL, NULL),
(2, 'เครื่องแต่งกาย', NULL, NULL),
(3, 'รองเท้า', NULL, NULL),
(4, 'แว่นตา', NULL, NULL),
(5, 'อุปกรณ์เสริม', NULL, NULL),
(6, 'อิเล็กทรอนิกส์', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_07_17_044658_create_category_table', 1),
(6, '2024_07_17_044660_create_branches_table', 1),
(7, '2024_07_17_044834_create_product_table', 1);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `branch_id` int(10) UNSIGNED NOT NULL,
  `price` double(8,2) DEFAULT NULL,
  `stock_qty` int(11) DEFAULT NULL,
  `image_url` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `code`, `name`, `category_id`, `branch_id`, `price`, `stock_qty`, `image_url`, `created_at`, `updated_at`) VALUES
(1, 'P001', 'Speed 900 CN FR bike', 1, 1, 7000.00, 6, 'upload/images/speed-900-cn-fr-elops-8597089.jpg', '2024-09-11 23:25:00', '2024-09-11 23:44:46'),
(2, 'P002', 'EDR AF 105 CN FR road bike', 1, 2, 37000.00, 3, 'upload/images/rode-bike-EDR-AF-105-CN-FR.jpg', '2024-09-11 23:27:53', '2024-09-11 23:45:17'),
(3, 'P003', 'touring bike Riverside RT 520 (blue)', 1, 3, 24000.00, 4, 'upload/images/touring-bike-riverside-rt-520-bl.jpg', '2024-09-11 23:30:48', '2024-09-11 23:30:48'),
(4, 'P004', 'Rockrider ST 30 Mountain Bike (White)', 1, 1, 4400.00, 2, 'upload/images/rockrider-ST-30-White.jpg', '2024-09-11 23:31:55', '2024-09-11 23:45:44'),
(5, 'P005', 'Tilt 900 Folding Bike (Glossy Aluminum)', 1, 1, 11900.00, 6, 'upload/images/tilt-900-folding-bike-lacquered.jpg', '2024-09-11 23:33:28', '2024-09-11 23:46:12'),
(6, 'P006', 'Riverside 500 bike for children', 1, 1, 4500.00, 7, 'upload/images/riverside-500-kids.jpg', '2024-09-11 23:34:16', '2024-09-11 23:34:16'),
(7, 'P007', 'Men\'s RC100 Short Sleeve Cycling Jersey', 2, 2, 500.00, 25, 'upload/images/men-s-short-sleeved-road-cycling.jpg', '2024-09-11 23:35:58', '2024-09-11 23:35:58'),
(8, 'P008', 'Women\'s ST 100 Short-Sleeve Bike Jersey (Navy)', 2, 3, 200.00, 12, 'upload/images/women-s-short-sleeved-mountain-b.jpg', '2024-09-11 23:37:20', '2024-09-11 23:37:30'),
(9, 'P009', 'Essential Men\'s Bib-Free Cycling Shorts (Black)', 2, 3, 350.00, 26, 'upload/images/essential-men-s-road-cycling-bib.jpg', '2024-09-11 23:39:13', '2024-09-11 23:39:13'),
(10, 'P010', 'Sunglasses Model ST 100 (Grey)', 4, 2, 150.00, 30, 'upload/images/st-100-mtb-sunglasses-category-3.jpg', '2024-09-11 23:42:06', '2024-09-11 23:42:06'),
(11, 'P011', 'Sunglasses type 0 lenses, Model ST 100 (Clear)', 4, 1, 150.00, 50, 'upload/images/st-100-mtb-sunglasses-category-0.jpg', '2024-09-11 23:42:52', '2024-09-11 23:42:52'),
(12, 'P012', 'Race 700 mountain bike shoes (gray)', 3, 3, 1900.00, 8, 'upload/images/mountain-bike-shoes-race-700-gre.jpg', '2024-09-11 23:50:56', '2024-09-11 23:50:56'),
(13, 'P013', 'Road 100 Cycling Shoes (Black)', 3, 2, 1800.00, 12, 'upload/images/road-cycling-shoes-road-100-blac.jpg', '2024-09-11 23:51:36', '2024-09-11 23:51:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `level`) VALUES
(2, 's6506021611017', 's6506021611017@email.kmutnb.ac.th', NULL, '$2y$10$fRN1PEdoNlAOvBlQNiT36eb7X9Vqt/5GN7WQK/OV7Vc9KsTeOk67G', NULL, '2024-09-26 00:42:02', '2024-09-26 00:42:02', 'customer'),
(3, 'gerawattt', 'gerawat12369@gmail.com', NULL, '$2y$10$tWjKukkKIkjvtttPtw815eJb88sc1D9HonUPK4ScbKvs89SxO0XBi', '4W1MvUUBKOABTxqO0KufhrLF3KRhEHAw2Koi13FxfwkyPAiaxFDyedDNSZUR', '2024-09-26 00:43:59', '2024-09-26 00:49:18', 'customer'),
(4, 'admin', 'xibomi@gmail.com', NULL, '$2y$10$Y6nf0.i5ZFNlf1wkeKC9a.XS7ke/qGU9ao.A9KMXVJVMJDIwSCvDi', NULL, '2024-10-03 06:12:41', '2024-10-03 06:12:41', 'admin'),
(5, 'user2', 'user2@gmail.com', NULL, '$2y$10$X1vdgx3BXRs4wHCyuc7FUuJOM7KwdRjn6zN5vc13aYjbK6Ag8qjAS', NULL, '2024-10-03 06:55:16', '2024-10-03 06:55:16', 'employee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_category_id_foreign` (`category_id`),
  ADD KEY `product_branch_id_foreign` (`branch_id`);

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
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`),
  ADD CONSTRAINT `product_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
