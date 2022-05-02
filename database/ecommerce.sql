-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2022 at 07:21 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(7, 'Admin', 'admin@yahoo.com', '$2y$10$i38GamICqZN3LT0EcEoevOdjYqBDJSZK/xsJz.yppvic9bZqlVeaa', 'GH155dfWdekoHj1WIxEmhvxc7586ftgNRIYIMcc2TGp6hnsEjLR15OoiZ18J', '2022-01-31 14:01:21', '2022-01-31 14:01:21');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `city_name_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_name_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `city_name_ar`, `city_name_en`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 'القاهره', 'Cairo', 1, '2022-04-10 18:56:09', '2022-04-10 18:56:09'),
(2, 'الغربيه', 'Al-Gharbia', 1, '2022-04-10 18:56:54', '2022-04-10 18:56:54'),
(3, 'السيب', 'Al-Seeb', 2, '2022-04-10 18:57:29', '2022-04-10 18:57:29');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `name_ar`, `name_en`, `color`, `created_at`, `updated_at`) VALUES
(1, 'اسود', 'black', '#000000', '2022-04-07 16:05:01', '2022-04-07 16:05:01'),
(2, 'احمر', 'red', '#ff0000', '2022-04-07 16:07:57', '2022-04-07 16:07:57'),
(3, 'اخضر', 'green', '#1dad00', '2022-04-07 16:08:17', '2022-04-07 16:08:17'),
(4, 'ازرق', 'blue', '#001be6', '2022-04-07 16:08:46', '2022-04-07 16:09:27');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `country_name_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_name_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mob` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_name_ar`, `country_name_en`, `mob`, `code`, `currency`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'مصر', 'Egypt', 'EG', '020', 'EGP', 'countries/xtKAQpqwTZXrJNHazSvK3U1FFGmoh1msRJqJWCDW.png', '2022-04-10 18:54:50', '2022-04-10 18:54:50'),
(2, 'عمان', 'Oman', 'OM', '968', 'OMR', 'countries/FQCC4XzLFYORwPqomN0Y2wcujAT7hzYcOXEgCPNQ.png', '2022-04-10 18:55:33', '2022-04-10 18:55:33');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `department_name_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_name_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keyword` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name_ar`, `department_name_en`, `icon`, `description`, `keyword`, `parent`, `created_at`, `updated_at`) VALUES
(17, 'الكترونيات', 'electronic', NULL, 'كل ما يخص الالكترونيات', 'electronic', NULL, '2022-04-06 11:01:59', '2022-04-06 11:01:59'),
(18, 'موبايلات', 'mobiles', NULL, NULL, NULL, 17, '2022-04-06 11:02:20', '2022-04-06 11:02:20'),
(19, 'لابتوبات', 'laptops', NULL, NULL, NULL, 17, '2022-04-06 11:02:44', '2022-04-06 11:02:44'),
(20, 'هواوي', 'Huawei', NULL, NULL, NULL, 18, '2022-04-06 11:03:23', '2022-04-06 11:03:23'),
(21, 'سامسونج', 'samsung', NULL, NULL, NULL, 18, '2022-04-06 11:03:38', '2022-04-06 11:03:38'),
(22, 'ابل', 'apple', NULL, NULL, NULL, 18, '2022-04-06 11:03:49', '2022-04-06 11:03:49'),
(23, 'لينوفو', 'lenovo', NULL, NULL, NULL, 19, '2022-04-06 11:04:04', '2022-04-06 11:04:04'),
(24, 'اتش بي', 'hp', NULL, NULL, NULL, 19, '2022-04-06 11:04:16', '2022-04-06 11:04:16'),
(25, 'ديل', 'dell', NULL, NULL, NULL, 19, '2022-04-06 11:04:32', '2022-04-06 11:04:32'),
(26, 'ملابس', 'clothes', NULL, 'clothes', 'clothes', NULL, '2022-04-16 17:54:25', '2022-04-16 17:54:25'),
(27, 'رجالي', 'men', NULL, 'men', 'men', 26, '2022-04-16 17:55:17', '2022-04-16 17:55:17'),
(28, 'نسائي', 'women', NULL, 'women', 'women', 26, '2022-04-16 17:55:34', '2022-04-16 17:55:34');

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
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `relation_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `name`, `size`, `file`, `path`, `full_path`, `mime_type`, `file_type`, `relation_id`, `created_at`, `updated_at`) VALUES
(27, 'download.jpg', '7453', 'eNSiZAMvRvwpGTjOdykgg9wL7feRXlaFHdeuld6A.jpg', 'products/19', 'products/19/eNSiZAMvRvwpGTjOdykgg9wL7feRXlaFHdeuld6A.jpg', 'image/jpeg', 'product', 19, '2022-05-02 04:10:55', '2022-05-02 04:10:55'),
(28, '695.jpg', '1827156', 'vAtaKr2WeX4meYH8SnhWwNB8Rtj6mX4tBxTcoQVZ.jpg', 'products/19', 'products/19/vAtaKr2WeX4meYH8SnhWwNB8Rtj6mX4tBxTcoQVZ.jpg', 'image/jpeg', 'product', 19, '2022-05-02 04:10:57', '2022-05-02 04:10:57'),
(29, 'male.png', '27504', 'BmG91pyboGo28EAhJ8kJkf7YnCOTtOqAiCeZkOEA.png', 'products/19', 'products/19/BmG91pyboGo28EAhJ8kJkf7YnCOTtOqAiCeZkOEA.png', 'image/png', 'product', 19, '2022-05-02 04:11:00', '2022-05-02 04:11:00'),
(39, 'download.jpg', '7453', 'ykobB5fNDiqXKfdYt6roVmrcOojxh9xVYnkBv7kU', 'products/32', 'products/32/ykobB5fNDiqXKfdYt6roVmrcOojxh9xVYnkBv7kU.jpg', 'image/jpeg', 'product', 32, '2022-05-02 13:33:20', '2022-05-02 13:33:20'),
(40, '695.jpg', '1827156', '2GCG7j3XpBi8WbHMPdxL4VIePZvyUDrFuth5QvYt', 'products/32', 'products/32/2GCG7j3XpBi8WbHMPdxL4VIePZvyUDrFuth5QvYt.jpg', 'image/jpeg', 'product', 32, '2022-05-02 13:33:20', '2022-05-02 13:33:20'),
(41, 'male.png', '27504', 'FVt804IJfCn32XSYaDmI4ENSmvBiOMUBLXNJMdZU', 'products/32', 'products/32/FVt804IJfCn32XSYaDmI4ENSmvBiOMUBLXNJMdZU.png', 'image/png', 'product', 32, '2022-05-02 13:33:20', '2022-05-02 13:33:20'),
(42, 'download.jpg', '7453', 'VKDpQsObX7qvdEnN2iFaPoDnUrI44tNicm16kEg3', 'products/33', 'products/33/VKDpQsObX7qvdEnN2iFaPoDnUrI44tNicm16kEg3.jpg', 'image/jpeg', 'product', 33, '2022-05-02 13:33:49', '2022-05-02 13:33:49'),
(43, '695.jpg', '1827156', 'rziIwYTgNbmUe0PX8itgppQx3pHOVhFqosEtN0vb', 'products/33', 'products/33/rziIwYTgNbmUe0PX8itgppQx3pHOVhFqosEtN0vb.jpg', 'image/jpeg', 'product', 33, '2022-05-02 13:33:49', '2022-05-02 13:33:49'),
(44, 'male.png', '27504', 'CACo75GdecCtTQX5XoiKpDWt1ritrm4qOZ8CIQqc', 'products/33', 'products/33/CACo75GdecCtTQX5XoiKpDWt1ritrm4qOZ8CIQqc.png', 'image/png', 'product', 33, '2022-05-02 13:33:49', '2022-05-02 13:33:49'),
(45, 'icon.jpg', '7337', 'sT6Ev9LNwnBA41nThQ4KJQhCiVi4J4pK80n4iOTD.jpg', 'products/33', 'products/33/sT6Ev9LNwnBA41nThQ4KJQhCiVi4J4pK80n4iOTD.jpg', 'image/jpeg', 'product', 33, '2022-05-02 13:36:35', '2022-05-02 13:36:35'),
(46, 'download.jpg', '7453', 'HwEiCjtAmVfQNUfegw2exXFkJpTDyN9P53dWojFC', 'products/34', 'products/34/HwEiCjtAmVfQNUfegw2exXFkJpTDyN9P53dWojFC.jpg', 'image/jpeg', 'product', 34, '2022-05-02 13:37:27', '2022-05-02 13:37:27'),
(47, '695.jpg', '1827156', 'OGd6JRTg7KntGW7hK8QRAFxt0UGT5oP6Tfj6LPFm', 'products/34', 'products/34/OGd6JRTg7KntGW7hK8QRAFxt0UGT5oP6Tfj6LPFm.jpg', 'image/jpeg', 'product', 34, '2022-05-02 13:37:27', '2022-05-02 13:37:27');

-- --------------------------------------------------------

--
-- Table structure for table `malls`
--

CREATE TABLE `malls` (
  `id` int(10) UNSIGNED NOT NULL,
  `name_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int(10) UNSIGNED NOT NULL,
  `facebook` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(10,8) DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `malls`
--

INSERT INTO `malls` (`id`, `name_ar`, `name_en`, `contact_name`, `email`, `phone`, `country_id`, `facebook`, `twitter`, `website`, `address`, `latitude`, `longitude`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'كارفور مصر', 'carfor egypt', 'admin', 'admin@carfor.com', '01153225410', 1, NULL, NULL, NULL, NULL, '30.80453492', '31.02282655', 'malls/LVxNM490p0KwMNw2P7rlOONdQT2EhqyO8SvxZrag.jpg', '2022-04-20 00:57:19', '2022-04-20 00:57:19'),
(5, 'سيتي سنتر', 'city center', 'City', 'admin@phpzag.com', '01141521054', 2, NULL, NULL, NULL, NULL, '23.60010976', '58.24877691', 'malls/gwMOXK2cRD95UIHOSOITIOOZh5qjhZaowv3HkY2m.png', '2022-04-20 01:01:19', '2022-04-20 01:01:19');

-- --------------------------------------------------------

--
-- Table structure for table `mall_products`
--

CREATE TABLE `mall_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `mall_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mall_products`
--

INSERT INTO `mall_products` (`id`, `product_id`, `mall_id`, `created_at`, `updated_at`) VALUES
(25, 19, 1, '2022-05-02 04:11:22', '2022-05-02 04:11:22'),
(26, 19, 5, '2022-05-02 04:11:22', '2022-05-02 04:11:22'),
(37, 32, 1, '2022-05-02 13:33:41', '2022-05-02 13:33:41'),
(38, 32, 5, '2022-05-02 13:33:41', '2022-05-02 13:33:41'),
(43, 33, 1, '2022-05-02 13:37:07', '2022-05-02 13:37:07'),
(61, 34, 1, '2022-05-02 15:13:31', '2022-05-02 15:13:31'),
(62, 34, 5, '2022-05-02 15:13:31', '2022-05-02 15:13:31');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturers`
--

CREATE TABLE `manufacturers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(10,8) DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manufacturers`
--

INSERT INTO `manufacturers` (`id`, `name_ar`, `name_en`, `contact_name`, `email`, `phone`, `facebook`, `twitter`, `website`, `address`, `latitude`, `longitude`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'مصنع ابل', 'apple factory', 'apple admin', 'apple@yahoo.com', '01061003405', NULL, NULL, NULL, 'السادس من اكتوبر , مصر', '29.96718239', '30.93358946', 'manufacturers/T4Bv1Gt1xPntkdjlfc6iUa2lWBxVcGvldi6g8ZSO.jpg', '2022-04-20 09:56:20', '2022-04-20 09:56:20');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2022_01_17_201034_create_admins_table', 1),
(5, '2022_01_30_182035_create_settings_table', 2),
(6, '2022_01_31_213642_create_files_table', 3),
(10, '2022_03_06_144549_create_cities_table', 4),
(11, '2022_03_07_144550_create_states_table', 5),
(13, '2022_04_02_212431_create_departments_table', 6),
(14, '2022_04_05_135950_create_trade_marks_table', 7),
(17, '2022_04_05_184237_create_manufacturers_table', 8),
(18, '2022_04_07_134223_create_shipping_companies_table', 9),
(19, '2022_04_07_161414_create_malls_table', 10),
(20, '2022_04_07_174557_create_colors_table', 11),
(21, '2022_04_08_172912_create_sizes_table', 12),
(22, '2022_04_08_234526_create_weights_table', 13),
(23, '2022_02_06_144548_create_countries_table', 14),
(25, '2022_04_09_125101_create_products_table', 15),
(29, '2022_04_30_193559_create_product_other_data_table', 16),
(30, '2022_04_30_234428_create_mall_products_table', 16),
(31, '2022_05_02_161235_create_product_related_table', 17);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@yahoo.com', '$2y$10$GQYILz9WXZDjJucfVlpeOO3IdpCqm6O0bwsreLe4K2y7Af1INr/K6', '2022-02-04 17:21:48'),
('admin@yahoo.com', '668f47181577051a51cbd1f32d0c1490e56b63d21ac1365d3382ef98103881f2', '2022-02-04 17:21:48');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` int(10) UNSIGNED DEFAULT NULL,
  `trade_mark_id` int(10) UNSIGNED DEFAULT NULL,
  `manufacture_id` int(10) UNSIGNED DEFAULT NULL,
  `color_id` int(10) UNSIGNED DEFAULT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size_id` int(10) UNSIGNED DEFAULT NULL,
  `weight` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight_id` int(10) UNSIGNED DEFAULT NULL,
  `currency_id` int(10) UNSIGNED DEFAULT NULL,
  `price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `stock` int(11) NOT NULL DEFAULT '0',
  `start_at` date DEFAULT NULL,
  `end_at` date DEFAULT NULL,
  `offer_price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `offer_start_at` date DEFAULT NULL,
  `offer_end_at` date DEFAULT NULL,
  `reason` longtext COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','refused','active') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `photo`, `department_id`, `trade_mark_id`, `manufacture_id`, `color_id`, `size`, `size_id`, `weight`, `weight_id`, `currency_id`, `price`, `stock`, `start_at`, `end_at`, `offer_price`, `offer_start_at`, `offer_end_at`, `reason`, `status`, `created_at`, `updated_at`) VALUES
(19, 'test', 'test', 'products/19/hHENOsbu9XAkyjimoqLnXtD2RyzZ7nBloG6nNxAh.jpg', 17, 4, 1, 2, '20', 3, '1', 1, NULL, '15000.00', 20, '2022-05-01', '2022-05-24', '0.00', NULL, NULL, '', 'active', '2022-05-02 04:10:25', '2022-05-02 05:49:21'),
(32, 'test for product', 'test', 'products/32/9CrFa8qP82zdIz3BDJs6GcwYzrd97zmuIcJeIiRq.jpg', 17, 4, 1, 2, '20', 3, '1', 1, NULL, '15000.00', 20, '2022-05-01', '2022-05-24', '0.00', NULL, NULL, '', 'active', '2022-05-02 04:05:25', '2022-05-02 13:33:41'),
(33, 'the product test title', 'test', 'products/33/OF2TKVGlkPyUvbgCUlWlwH9T3R7FPveFJ2eryDBn.jpg', 17, 4, 1, 2, '20', 3, '1', 1, NULL, '15000.00', 20, '2022-05-01', '2022-05-24', '0.00', NULL, NULL, '', 'active', '2022-05-02 04:05:25', '2022-05-02 13:37:07'),
(34, 'the test title edit', 'description', 'products/34/cPBiEri2qj8H2cFE4MRUJr7Cz0iurOw0x0pRVhxt.jpg', 19, 4, 1, 4, '20', 3, '1', 1, NULL, '10000.00', 30, '2022-05-01', '2022-05-24', '0.00', NULL, NULL, '', 'active', '2022-05-02 04:05:25', '2022-05-02 15:13:31');

-- --------------------------------------------------------

--
-- Table structure for table `product_other_data`
--

CREATE TABLE `product_other_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `data_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_other_data`
--

INSERT INTO `product_other_data` (`id`, `data_key`, `data_value`, `product_id`, `created_at`, `updated_at`) VALUES
(34, 'sada', 'dsdasd', 19, '2022-05-02 04:11:22', '2022-05-02 04:11:22'),
(35, 'asdasd', 'dasdasd', 19, '2022-05-02 04:11:22', '2022-05-02 04:11:22'),
(44, 'sada', 'dsdasd', 32, '2022-05-02 13:33:41', '2022-05-02 13:33:41'),
(45, 'asdasd', 'dasdasd', 32, '2022-05-02 13:33:41', '2022-05-02 13:33:41'),
(50, 'sada', 'dsdasd', 33, '2022-05-02 13:37:07', '2022-05-02 13:37:07'),
(60, 'sada', 'dsdasd', 34, '2022-05-02 15:13:31', '2022-05-02 15:13:31');

-- --------------------------------------------------------

--
-- Table structure for table `product_related`
--

CREATE TABLE `product_related` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `related_product` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_related`
--

INSERT INTO `product_related` (`id`, `product_id`, `related_product`, `created_at`, `updated_at`) VALUES
(11, 34, 19, '2022-05-02 15:13:31', '2022-05-02 15:13:31'),
(12, 34, 33, '2022-05-02 15:13:31', '2022-05-02 15:13:31'),
(13, 34, 32, '2022-05-02 15:13:31', '2022-05-02 15:13:31');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sitename_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sitename_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_lang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ar',
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `keywords` longtext COLLATE utf8mb4_unicode_ci,
  `status` enum('open','close') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `message_maintenance` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `sitename_ar`, `sitename_en`, `logo`, `icon`, `email`, `main_lang`, `description`, `keywords`, `status`, `message_maintenance`, `created_at`, `updated_at`) VALUES
(1, 'نسيم - مستحضرات تجميل', 'Naseem Cosmetics', 'settings/zNYGTYgvUOO2n0hb7WUpDlpfGC0r5torv0qvVh2w.jpg', 'settings/SyrtloE2y06hzd5FdCPZkqgerXcg7ybs8GCimCvI.png', 'info@naseem.com', 'en', 'This Is E-Commerce System', 'ecommerce,shop,system,naseem,cosmetics,cosmetic', 'open', 'Now Site In Maintenance Try Again Later', NULL, '2022-04-05 17:11:10');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_companies`
--

CREATE TABLE `shipping_companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(10,8) DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_companies`
--

INSERT INTO `shipping_companies` (`id`, `name_ar`, `name_en`, `user_id`, `phone`, `facebook`, `twitter`, `website`, `address`, `latitude`, `longitude`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'Kalia Houston', 'Lynn Boyd', 1, '01153225410', NULL, NULL, 'https://www.wepywicoz.us', NULL, '30.10446029', '29.04458475', 'companies/5lC2RkfaRaKqCKCddgRe8647kyLaGm0w2qqeAPmG.png', '2022-04-07 12:20:52', '2022-04-07 12:23:43');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_public` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `name_ar`, `name_en`, `is_public`, `department_id`, `created_at`, `updated_at`) VALUES
(1, 'بوصه', 'inches', 'yes', 17, '2022-04-08 16:06:13', '2022-04-16 02:17:54'),
(2, 'ملم', 'mm', 'yes', 17, '2022-04-16 16:11:54', '2022-04-16 16:11:54'),
(3, 'سم', 'sm', 'yes', 17, '2022-04-16 16:12:13', '2022-04-16 16:12:13'),
(4, 'متر', 'meter', 'yes', 17, '2022-04-16 16:12:54', '2022-04-16 16:12:54'),
(6, 'تجربه لديل', 'dell test', 'no', 25, '2022-04-16 18:01:54', '2022-04-16 18:01:54'),
(7, 'تجربه لاتش بي', 'hp test', 'yes', 24, '2022-04-16 20:13:16', '2022-04-16 20:13:16'),
(8, 'لارج', 'lg', 'yes', 26, '2022-04-20 09:57:11', '2022-04-20 09:57:11'),
(9, 'صغير', 'small', 'yes', 26, '2022-04-20 09:57:35', '2022-04-20 09:57:35');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(10) UNSIGNED NOT NULL,
  `state_name_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state_name_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` int(10) UNSIGNED NOT NULL,
  `country_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `state_name_ar`, `state_name_en`, `city_id`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 'طنطا', 'tanta', 2, 1, '2022-04-10 18:58:12', '2022-04-10 18:58:12'),
(2, 'الخوض', 'alkhoud', 3, 2, '2022-04-10 18:58:30', '2022-04-10 18:58:30');

-- --------------------------------------------------------

--
-- Table structure for table `trade_marks`
--

CREATE TABLE `trade_marks` (
  `id` int(10) UNSIGNED NOT NULL,
  `name_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trade_marks`
--

INSERT INTO `trade_marks` (`id`, `name_ar`, `name_en`, `logo`, `created_at`, `updated_at`) VALUES
(4, 'ابل', 'apple', 'trademarks/gqTlZlq8DuIZ4K4ymPa9oNsCUz44MHJudJG4IPE4.png', '2022-04-06 10:59:04', '2022-04-06 10:59:04'),
(5, 'سامسونج', 'samsung', 'trademarks/uLIeUViZnUOCn7ci6K6LkPCExnrm0wVqzr3SPsmZ.jpg', '2022-04-06 10:59:21', '2022-04-06 10:59:21'),
(6, 'هواوي', 'Huawei', 'trademarks/DbG95XuKsiibO98JHlV3OdGY3w3XJf3W5fWnDGuH.png', '2022-04-06 11:00:51', '2022-04-06 11:00:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('user','vendor','company') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mohamed Ibrahiem', 'mohamed@yahoo.com', '$2y$10$yeuwwO2e2JpW.aT/aJIMMOJbnySG2biMvgNiEPLRVmH4tUOSlX.cq', 'company', NULL, '2022-01-30 11:35:24', '2022-01-30 11:35:24'),
(2, 'ahmed ali', 'ahmed@yahoo.com', '$2y$10$ZFAOuYrvmEfZImTExzUKzu5WbuzLD8ZqHSsMY5or8VBoTEUD0aE.q', 'vendor', NULL, '2022-01-30 11:35:41', '2022-01-30 11:35:41'),
(3, 'test user', 'test@yahoo.com', '$2y$10$V1Jj7UU/ekGeKHrML40sIutdhMIg/8mSZi3g2BCQeVK.1sPHCzC.K', 'user', NULL, '2022-01-30 11:35:57', '2022-01-30 11:35:57'),
(4, 'new user', 'user@yahoo.com', '$2y$10$nIKcf1c0gs6zbpP3YdzMcuVLQ.GviOw1rPSr3wOBZctqjH83RBrSC', 'user', NULL, '2022-01-30 13:57:12', '2022-01-30 13:57:12');

-- --------------------------------------------------------

--
-- Table structure for table `weights`
--

CREATE TABLE `weights` (
  `id` int(10) UNSIGNED NOT NULL,
  `name_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `weights`
--

INSERT INTO `weights` (`id`, `name_ar`, `name_en`, `created_at`, `updated_at`) VALUES
(1, 'كيلو جرام', 'kilo gram', '2022-04-08 21:52:11', '2022-04-08 21:52:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cities_city_name_ar_unique` (`city_name_ar`),
  ADD UNIQUE KEY `cities_city_name_en_unique` (`city_name_en`),
  ADD KEY `cities_country_id_foreign` (`country_id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `colors_name_ar_unique` (`name_ar`),
  ADD UNIQUE KEY `colors_name_en_unique` (`name_en`),
  ADD UNIQUE KEY `colors_color_unique` (`color`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `countries_country_name_ar_unique` (`country_name_ar`),
  ADD UNIQUE KEY `countries_country_name_en_unique` (`country_name_en`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_department_name_ar_unique` (`department_name_ar`),
  ADD UNIQUE KEY `departments_department_name_en_unique` (`department_name_en`),
  ADD KEY `departments_parent_foreign` (`parent`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `malls`
--
ALTER TABLE `malls`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `malls_name_ar_unique` (`name_ar`),
  ADD UNIQUE KEY `malls_name_en_unique` (`name_en`),
  ADD UNIQUE KEY `malls_contact_name_unique` (`contact_name`),
  ADD UNIQUE KEY `malls_email_unique` (`email`),
  ADD UNIQUE KEY `malls_phone_unique` (`phone`),
  ADD KEY `malls_country_id_foreign` (`country_id`);

--
-- Indexes for table `mall_products`
--
ALTER TABLE `mall_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mall_products_product_id_foreign` (`product_id`),
  ADD KEY `mall_products_mall_id_foreign` (`mall_id`);

--
-- Indexes for table `manufacturers`
--
ALTER TABLE `manufacturers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `manufacturers_name_ar_unique` (`name_ar`),
  ADD UNIQUE KEY `manufacturers_name_en_unique` (`name_en`),
  ADD UNIQUE KEY `manufacturers_contact_name_unique` (`contact_name`),
  ADD UNIQUE KEY `manufacturers_email_unique` (`email`),
  ADD UNIQUE KEY `manufacturers_phone_unique` (`phone`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_department_id_foreign` (`department_id`),
  ADD KEY `products_trade_mark_id_foreign` (`trade_mark_id`),
  ADD KEY `products_manufacture_id_foreign` (`manufacture_id`),
  ADD KEY `products_color_id_foreign` (`color_id`),
  ADD KEY `products_size_id_foreign` (`size_id`),
  ADD KEY `products_weight_id_foreign` (`weight_id`),
  ADD KEY `products_currency_id_foreign` (`currency_id`);

--
-- Indexes for table `product_other_data`
--
ALTER TABLE `product_other_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_other_data_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_related`
--
ALTER TABLE `product_related`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_related_product_id_foreign` (`product_id`),
  ADD KEY `product_related_related_product_foreign` (`related_product`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_companies`
--
ALTER TABLE `shipping_companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shipping_companies_name_ar_unique` (`name_ar`),
  ADD UNIQUE KEY `shipping_companies_name_en_unique` (`name_en`),
  ADD UNIQUE KEY `shipping_companies_phone_unique` (`phone`),
  ADD KEY `shipping_companies_user_id_foreign` (`user_id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sizes_name_ar_unique` (`name_ar`),
  ADD UNIQUE KEY `sizes_name_en_unique` (`name_en`),
  ADD KEY `sizes_department_id_foreign` (`department_id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `states_state_name_ar_unique` (`state_name_ar`),
  ADD UNIQUE KEY `states_state_name_en_unique` (`state_name_en`),
  ADD KEY `states_city_id_foreign` (`city_id`),
  ADD KEY `states_country_id_foreign` (`country_id`);

--
-- Indexes for table `trade_marks`
--
ALTER TABLE `trade_marks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `trade_marks_name_ar_unique` (`name_ar`),
  ADD UNIQUE KEY `trade_marks_name_en_unique` (`name_en`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `weights`
--
ALTER TABLE `weights`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `weights_name_ar_unique` (`name_ar`),
  ADD UNIQUE KEY `weights_name_en_unique` (`name_en`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `malls`
--
ALTER TABLE `malls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mall_products`
--
ALTER TABLE `mall_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `manufacturers`
--
ALTER TABLE `manufacturers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `product_other_data`
--
ALTER TABLE `product_other_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `product_related`
--
ALTER TABLE `product_related`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shipping_companies`
--
ALTER TABLE `shipping_companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trade_marks`
--
ALTER TABLE `trade_marks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `weights`
--
ALTER TABLE `weights`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_parent_foreign` FOREIGN KEY (`parent`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `malls`
--
ALTER TABLE `malls`
  ADD CONSTRAINT `malls_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mall_products`
--
ALTER TABLE `mall_products`
  ADD CONSTRAINT `mall_products_mall_id_foreign` FOREIGN KEY (`mall_id`) REFERENCES `malls` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mall_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `countries` (`id`),
  ADD CONSTRAINT `products_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_manufacture_id_foreign` FOREIGN KEY (`manufacture_id`) REFERENCES `manufacturers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_trade_mark_id_foreign` FOREIGN KEY (`trade_mark_id`) REFERENCES `trade_marks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_weight_id_foreign` FOREIGN KEY (`weight_id`) REFERENCES `weights` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_other_data`
--
ALTER TABLE `product_other_data`
  ADD CONSTRAINT `product_other_data_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_related`
--
ALTER TABLE `product_related`
  ADD CONSTRAINT `product_related_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_related_related_product_foreign` FOREIGN KEY (`related_product`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shipping_companies`
--
ALTER TABLE `shipping_companies`
  ADD CONSTRAINT `shipping_companies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sizes`
--
ALTER TABLE `sizes`
  ADD CONSTRAINT `sizes_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `states`
--
ALTER TABLE `states`
  ADD CONSTRAINT `states_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `states_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
