-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 22, 2025 at 06:58 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hoisery_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_masters`
--

CREATE TABLE `account_masters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `debit_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_editable` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `deleted_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_masters`
--

INSERT INTO `account_masters` (`id`, `name`, `phone_no`, `from`, `nature`, `debit_amount`, `credit_amount`, `status`, `is_editable`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'JASHAN', '9872989720', 'Vendor', NULL, NULL, NULL, '1', '1', NULL, '2025-09-09 23:03:38', '2025-09-09 23:06:08'),
(2, 'SHIVAM', '8284946585', 'Customer', NULL, NULL, NULL, '1', '1', NULL, '2025-09-09 23:06:03', '2025-09-09 23:06:03'),
(3, 'EXPENSE', '---', 'Expense', NULL, NULL, NULL, '1', '1', NULL, '2025-09-09 23:07:25', '2025-09-09 23:07:25'),
(4, 'INCOME', '12', 'Income', NULL, NULL, NULL, '1', '1', NULL, '2025-09-09 23:07:32', '2025-09-09 23:07:32'),
(5, 'TEST', NULL, 'Vendor', NULL, NULL, NULL, '1', '1', NULL, '2025-09-11 23:44:31', '2025-09-11 23:44:31');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_by_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `status`, `created_by_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'ZARA', '1', '1', '2025-09-06 11:07:50', '2025-09-05 12:30:57', '2025-09-06 11:07:50'),
(2, 'NIKE PATTA', '1', '1', '2025-09-06 11:16:45', '2025-09-06 11:09:03', '2025-09-06 11:16:45'),
(3, 'NIKE PATTA', '1', '1', NULL, '2025-09-07 11:07:50', '2025-09-13 09:07:34'),
(4, 'U.S POLO PLAIN', '1', '1', NULL, '2025-09-07 11:32:24', '2025-09-13 07:26:38'),
(5, 'PC REGULAR - 120/130', '1', '1', NULL, '2025-09-07 12:40:11', '2025-09-09 09:58:41'),
(6, 'PC COLLAR ZIP (3)', '1', '1', NULL, '2025-09-07 13:32:58', '2025-09-07 14:01:53'),
(7, 'NS LOWER ADDIDAS (3)', '1', '1', NULL, '2025-09-07 13:41:46', '2025-09-07 14:11:40'),
(8, 'COTTON LYC - 155', '1', '1', NULL, '2025-09-07 14:26:29', '2025-09-09 09:00:38'),
(9, 'COTTON LYC - 180', '1', '1', NULL, '2025-09-08 08:43:28', '2025-09-09 09:00:57'),
(10, 'PC REGULAR - 130', '1', '1', '2025-09-09 09:58:28', '2025-09-09 09:57:11', '2025-09-09 09:58:28'),
(11, 'COTTON LYC - 190', '1', '1', NULL, '2025-09-09 10:17:02', '2025-09-09 10:17:02'),
(12, 'COTTON LYC - 165', '1', '1', NULL, '2025-09-09 12:12:04', '2025-09-09 12:12:04'),
(13, 'LINING COLLAR-130', '1', '1', NULL, '2025-09-09 12:48:42', '2025-09-09 12:48:42'),
(14, 'COTTON LYC -235', '1', '1', NULL, '2025-09-09 13:23:12', '2025-09-09 13:23:12'),
(15, 'COTTON LYC R-N', '1', '1', NULL, '2025-09-09 13:33:06', '2025-09-09 14:46:48'),
(16, 'NIKE/NF HALF-SLEVE', '1', '1', NULL, '2025-09-10 08:11:32', '2025-09-10 08:19:57'),
(17, 'COTTON LYC COLAR', '1', '1', NULL, '2025-09-10 09:33:05', '2025-09-10 09:33:05'),
(18, 'ADIDAS TEEN PATTI', '1', '1', NULL, '2025-09-11 10:35:22', '2025-09-11 10:37:16'),
(19, 'JAZZY BOX', '1', '1', NULL, '2025-09-11 11:00:33', '2025-09-11 11:00:33'),
(20, 'COTTON LYCRA', '1', '1', NULL, '2025-09-12 09:58:00', '2025-09-12 09:58:00'),
(21, 'PC', '1', '1', NULL, '2025-09-12 11:38:09', '2025-09-12 11:38:09'),
(22, 'MIX', '1', '1', NULL, '2025-09-12 11:47:41', '2025-09-12 11:47:41'),
(23, 'HALF SLEEVE', '1', '1', NULL, '2025-09-13 06:33:15', '2025-09-13 06:58:22'),
(24, 'BLAZER', '1', '1', NULL, '2025-09-13 10:02:20', '2025-09-13 10:02:20'),
(25, 'HD FELT', '1', '1', NULL, '2025-09-13 10:17:44', '2025-09-13 10:17:44'),
(26, 'TPU FAR', '1', '1', NULL, '2025-09-13 10:24:10', '2025-09-13 10:24:10'),
(27, 'HD FLUFY', '1', '1', NULL, '2025-09-13 12:05:31', '2025-09-13 12:05:31'),
(28, 'NYLON', '1', '1', NULL, '2025-09-13 13:33:43', '2025-09-13 13:33:43'),
(29, 'BLAZER 2 PIECE', '1', '1', '2025-09-13 13:48:20', '2025-09-13 13:47:16', '2025-09-13 13:48:20'),
(30, 'NIFTY', '1', '1', NULL, '2025-09-14 06:53:14', '2025-09-14 06:53:41'),
(31, 'NS', '1', '1', NULL, '2025-09-14 07:23:54', '2025-09-14 07:24:12'),
(32, 'VOLKY SAP MATTY', '1', '1', NULL, '2025-09-14 10:38:10', '2025-09-14 10:38:10'),
(33, 'LINING (COLLAR/ROUND)', '1', '1', NULL, '2025-09-14 11:19:45', '2025-09-14 11:19:45'),
(34, 'COAT PANT', '1', '1', NULL, '2025-09-15 10:54:23', '2025-09-15 10:54:23'),
(35, 'BASKET SET', '1', '1', NULL, '2025-09-15 11:03:13', '2025-09-15 11:03:13'),
(36, 'TPU FUR', '1', '1', NULL, '2025-09-16 11:44:15', '2025-09-16 11:44:15'),
(37, 'PURE GOLD', '1', '1', NULL, '2025-09-20 00:11:52', '2025-09-20 00:11:52');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_by_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `created_by_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'T-SHIRT', '1', '1', '2025-09-06 11:09:24', '2025-09-05 12:31:05', '2025-09-06 11:09:24'),
(2, 'SWEAT SHIRT(ROUND NECK)', '1', '1', '2025-09-06 11:16:28', '2025-09-06 11:10:13', '2025-09-06 11:16:28'),
(3, 'NIKE PATTA', '1', '1', '2025-09-07 11:08:23', '2025-09-07 11:08:07', '2025-09-07 11:08:23'),
(4, 'SWEAT SHIRT', '1', '1', NULL, '2025-09-07 11:08:33', '2025-09-13 08:51:01'),
(5, 'DOWN SHOULDER', '1', '1', NULL, '2025-09-07 12:40:43', '2025-09-07 12:40:43'),
(6, 'LOWER', '1', '1', NULL, '2025-09-07 13:42:20', '2025-09-07 13:42:20'),
(7, 'T-SHIRT', '1', '1', NULL, '2025-09-08 08:13:50', '2025-09-08 08:13:50'),
(8, 'JACKET', '1', '1', NULL, '2025-09-10 08:12:14', '2025-09-10 08:12:14'),
(9, 'COTTON LYC COLLAR', '1', '1', NULL, '2025-09-10 09:32:18', '2025-09-10 09:32:18'),
(10, 'HOODIE', '1', '1', NULL, '2025-09-11 10:36:23', '2025-09-11 10:36:23'),
(11, 'COLLAR T-SHIRT', '1', '1', NULL, '2025-09-12 09:58:23', '2025-09-12 09:58:23'),
(12, 'ROUND NECK', '1', '1', NULL, '2025-09-12 11:14:33', '2025-09-12 11:14:33'),
(13, 'MIX', '1', '1', NULL, '2025-09-12 11:47:52', '2025-09-12 11:47:52'),
(14, 'ONE PIECE', '1', '1', NULL, '2025-09-13 10:02:28', '2025-09-13 10:02:28'),
(15, 'F/S JACKET', '1', '1', NULL, '2025-09-13 10:18:08', '2025-09-13 10:18:08'),
(16, 'H/S JACKET', '1', '1', NULL, '2025-09-13 13:34:12', '2025-09-13 13:34:12'),
(17, 'TWO PIECE', '1', '1', NULL, '2025-09-13 13:48:01', '2025-09-13 13:48:01'),
(18, 'SHORTS', '1', '1', NULL, '2025-09-14 07:24:30', '2025-09-14 07:24:30'),
(19, 'BASKET', '1', '1', NULL, '2025-09-16 08:33:01', '2025-09-16 08:33:01'),
(20, 'SWEATER', '1', '1', NULL, '2025-09-20 00:12:08', '2025-09-20 00:12:08');

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
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `article_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `season_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `total_items` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_alert` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_alert` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size_list` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color_list` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_price_list` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `selling_price_list` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_purchase_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_sale_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_stock` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pending_stock` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_profit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actual_profit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `is_temp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `from`, `from_id`, `article_name`, `brand_id`, `category_id`, `season_id`, `total_items`, `min_alert`, `max_alert`, `size_list`, `color_list`, `purchase_price_list`, `selling_price_list`, `total_purchase_amount`, `total_sale_amount`, `total_stock`, `pending_stock`, `total_profit`, `actual_profit`, `image`, `status`, `is_temp`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Manually', '0', 'art-1', '1', '1', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '1', '0', '2025-09-07 11:13:20', '2025-09-05 12:39:11', '2025-09-07 11:13:20'),
(2, 'Manually', '0', 'patta AR-1', '2', '2', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', '2025-09-06 11:15:44', '2025-09-06 11:12:45', '2025-09-06 11:15:44'),
(3, 'Manually', '0', 'Nike sweatshirt 01 - 2025', '3', '4', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', '2025-09-07 11:30:23', '2025-09-07 11:12:41', '2025-09-07 11:30:23'),
(4, 'Manually', '0', 'Nike Sweatshirt 01- 2025', '3', '4', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', '2025-09-07 11:30:23', '2025-09-07 11:17:33', '2025-09-07 11:30:23'),
(5, 'Manually', '0', 'NP/S 01- 2025', '3', '4', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757499631-WhatsApp Image 2025-09-09 at 3.25.09 PM (1).jpeg', '1', '0', '2025-09-13 09:07:13', '2025-09-07 11:20:23', '2025-09-13 09:07:13'),
(6, 'Manually', '0', 'U/P 01 - 2025', '4', '4', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757499599-WhatsApp Image 2025-09-09 at 3.25.09 PM.jpeg', '1', '0', '2025-09-13 07:26:08', '2025-09-07 11:38:14', '2025-09-13 07:26:08'),
(7, 'Manually', '0', 'PC T/S 01 - 2025', '5', '5', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1758008308-WhatsApp Image 2025-09-16 at 1.01.15 PM.jpeg', '1', '0', NULL, '2025-09-07 12:41:44', '2025-09-16 07:38:28'),
(8, 'Manually', '0', 'PC C/Z 01 - 2025', '6', '5', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757500619-WhatsApp Image 2025-09-10 at 4.05.31 PM.jpeg', '1', '0', NULL, '2025-09-07 13:35:00', '2025-09-10 10:36:59'),
(9, 'Manually', '0', 'NS AD 01 - 2025', '7', '6', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757501557-WhatsApp Image 2025-09-10 at 4.21.28 PM.jpeg', '1', '0', NULL, '2025-09-07 13:43:00', '2025-09-10 10:52:37'),
(10, 'Manually', '0', 'PC T/S 02 - 2025', '5', '5', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1758008352-WhatsApp Image 2025-09-16 at 1.01.33 PM.jpeg', '1', '0', NULL, '2025-09-07 13:48:28', '2025-09-16 07:39:12'),
(11, 'Manually', '0', 'C/L 01 - 2025', '8', '7', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757501842-WhatsApp Image 2025-09-10 at 4.26.45 PM.jpeg', '1', '0', NULL, '2025-09-08 08:15:43', '2025-09-10 10:57:22'),
(12, 'Manually', '0', 'C/L 02 -2025', '9', '5', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', '2025-09-08 08:58:37', '2025-09-08 08:48:04', '2025-09-08 08:58:37'),
(14, 'Manually', '0', 'ART', '3', '4', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '1', '0', '2025-09-08 10:07:59', '2025-09-08 10:06:35', '2025-09-08 10:07:59'),
(15, 'Manually', '0', 'C/L 02-180-2025', '9', '7', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '1', '0', '2025-09-09 10:51:27', '2025-09-09 10:03:45', '2025-09-09 10:51:27'),
(16, 'Manually', '0', 'C/L 03-190-2025', '11', '7', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '1', '0', '2025-09-09 10:51:09', '2025-09-09 10:17:47', '2025-09-09 10:51:09'),
(17, 'Manually', '0', 'C/L 02-180-2025', '9', '5', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757501933-WhatsApp Image 2025-09-10 at 4.28.08 PM.jpeg', '1', '0', NULL, '2025-09-09 10:52:13', '2025-09-10 10:58:53'),
(18, 'Manually', '0', 'C/L 02-190-2025', '11', '7', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '1', '0', '2025-09-09 11:16:44', '2025-09-09 11:16:03', '2025-09-09 11:16:44'),
(19, 'Manually', '0', 'C/L 03-190-2025', '11', '5', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '1', '0', '2025-09-09 11:45:07', '2025-09-09 11:17:29', '2025-09-09 11:45:07'),
(20, 'Manually', '0', 'C/L 03-190-2025', '11', '5', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757502030-WhatsApp Image 2025-09-10 at 4.29.50 PM.jpeg', '1', '0', NULL, '2025-09-09 11:46:08', '2025-09-10 11:00:30'),
(21, 'Manually', '0', 'C/L 04-165-2025', '12', '7', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757502300-WhatsApp Image 2025-09-10 at 4.33.47 PM.jpeg', '1', '0', NULL, '2025-09-09 12:14:08', '2025-09-10 11:05:00'),
(22, 'Manually', '0', 'L/C - 01-130-2025', '13', '7', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757503286-WhatsApp Image 2025-09-10 at 4.50.44 PM.jpeg', '1', '0', NULL, '2025-09-09 12:49:54', '2025-09-10 11:21:26'),
(23, 'Manually', '0', 'C/L -05-180-2025', '9', '7', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', '2025-09-09 13:02:18', '2025-09-09 13:01:06', '2025-09-09 13:02:18'),
(24, 'Manually', '0', 'C/L 05-180-2025 ZARA', '9', '7', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757502328-WhatsApp Image 2025-09-10 at 4.34.11 PM.jpeg', '1', '0', NULL, '2025-09-09 13:04:05', '2025-09-10 11:05:28'),
(25, 'Manually', '0', 'C/L 06-235-2025 NIKE', '14', '5', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757502754-WhatsApp Image 2025-09-10 at 4.42.03 PM.jpeg', '1', '0', NULL, '2025-09-09 13:24:57', '2025-09-10 11:12:34'),
(26, 'Manually', '0', 'C/L 07-265-2025 H&M', '15', '5', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757502624-WhatsApp Image 2025-09-10 at 4.39.30 PM.jpeg', '1', '0', NULL, '2025-09-09 13:36:39', '2025-09-10 11:10:24'),
(27, 'Manually', '0', 'C/L 08-230-2025', '15', '5', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', '2025-09-09 13:37:47', '2025-09-09 13:37:19', '2025-09-09 13:37:47'),
(28, 'Manually', '0', 'C/L 08-270-2025 H&M', '15', '5', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757502927-WhatsApp Image 2025-09-10 at 4.44.56 PM.jpeg', '1', '0', NULL, '2025-09-09 13:43:05', '2025-09-10 11:15:27'),
(29, 'Manually', '0', 'C/L 09-260-2025 PUMA', '15', '5', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757502485-WhatsApp Image 2025-09-10 at 4.36.29 PM.jpeg', '1', '0', NULL, '2025-09-09 13:52:08', '2025-09-10 11:08:05'),
(30, 'Manually', '0', 'C/L 10-270-2025 NIKE', '15', '5', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757503455-WhatsApp Image 2025-09-10 at 4.53.38 PM.jpeg', '1', '0', NULL, '2025-09-09 14:11:26', '2025-09-10 11:24:15'),
(31, 'Manually', '0', 'C/L 11-265-2025 H&M', '15', '5', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757503169-WhatsApp Image 2025-09-10 at 4.48.56 PM.jpeg', '1', '0', NULL, '2025-09-09 14:22:06', '2025-09-10 11:19:29'),
(32, 'Manually', '0', 'C/L 12-265-2025 H&M', '15', '5', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757503591-WhatsApp Image 2025-09-10 at 4.56.05 PM.jpeg', '1', '0', NULL, '2025-09-09 14:32:31', '2025-09-10 11:26:31'),
(33, 'Manually', '0', 'C/L 13-275-2025 NIKE', '15', '5', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757505145-WhatsApp Image 2025-09-10 at 5.21.43 PM.jpeg', '1', '0', NULL, '2025-09-09 14:39:03', '2025-09-10 11:52:25'),
(34, 'Manually', '0', 'C/L 14-255-2025 U.S POLO', '15', '5', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757505266-WhatsApp Image 2025-09-10 at 5.24.02 PM.jpeg', '1', '0', NULL, '2025-09-09 14:40:32', '2025-09-10 11:54:26'),
(35, 'Manually', '0', 'C/L 15-265-2025 H&M', '15', '5', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757505177-WhatsApp Image 2025-09-10 at 5.21.44 PM.jpeg', '1', '0', NULL, '2025-09-09 14:42:41', '2025-09-10 11:52:57'),
(36, 'Manually', '0', 'C/L 16-275-2025 JORDAN', '15', '5', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757503988-WhatsApp Image 2025-09-10 at 5.02.39 PM.jpeg', '1', '0', NULL, '2025-09-09 14:43:47', '2025-09-10 11:33:08'),
(37, 'Manually', '0', 'C/L 17-215-2025 BALENCIAGA', '15', '5', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757504157-WhatsApp Image 2025-09-10 at 5.04.59 PM.jpeg', '1', '0', NULL, '2025-09-09 14:44:49', '2025-09-10 11:35:57'),
(38, 'Manually', '0', 'C/L 18-260-2025 PUMA', '15', '5', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757503798-WhatsApp Image 2025-09-10 at 4.59.25 PM.jpeg', '1', '0', NULL, '2025-09-10 07:58:25', '2025-09-10 11:29:58'),
(39, 'Manually', '0', 'C/L 19-270-2025 H&M', '15', '5', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757505406-WhatsApp Image 2025-09-10 at 5.26.12 PM.jpeg', '1', '0', NULL, '2025-09-10 08:01:04', '2025-09-10 11:56:46'),
(40, 'Manually', '0', 'N/NF 01-500-2025', '16', '8', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '1', '0', '2025-09-12 10:51:13', '2025-09-10 08:22:05', '2025-09-12 10:51:13'),
(41, 'Manually', '0', 'CL/C 01-295-2025 COACH', '17', '5', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', '2025-09-10 09:34:31', '2025-09-10 09:34:07', '2025-09-10 09:34:31'),
(42, 'Manually', '0', 'CL/C 01-295-2025 COACH', '17', '7', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '1', '0', '2025-09-12 09:05:07', '2025-09-10 09:34:54', '2025-09-12 09:05:07'),
(43, 'Manually', '0', 'CY/C 02-295-2025 U/P', '17', '7', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '1', '0', '2025-09-12 09:05:05', '2025-09-10 12:06:12', '2025-09-12 09:05:05'),
(44, 'Manually', '0', 'J/B 01-75-2025 JAZZY', '19', '7', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757589064-WhatsApp Image 2025-09-11 at 4.40.05 PM.jpeg', '1', '0', NULL, '2025-09-11 11:02:32', '2025-09-11 11:11:04'),
(45, 'Manually', '0', 'AD/TP 01-590-2025 AD', '18', '10', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757673746-WhatsApp Image 2025-09-11 at 6.35.36 PM.jpeg', '1', '0', '2025-09-13 08:59:11', '2025-09-11 13:00:09', '2025-09-13 08:59:11'),
(46, 'Manually', '0', 'CL/C 03-300-2025 GUCCI', '17', '7', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', '2025-09-12 07:13:53', '2025-09-11 13:26:07', '2025-09-12 07:13:53'),
(47, 'Manually', '0', '01-295-2025 COACH', '20', '11', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757671760-WhatsApp Image 2025-09-12 at 3.36.52 PM.jpeg', '1', '0', NULL, '2025-09-12 09:59:34', '2025-09-12 10:09:20'),
(48, 'Manually', '0', '02-295-2025 U.S POLO', '20', '11', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757673528-WhatsApp Image 2025-09-12 at 4.08.04 PM.jpeg', '1', '0', NULL, '2025-09-12 10:35:05', '2025-09-12 10:38:48'),
(49, 'Manually', '0', '01-500-2025 NIKE/NF', '16', '8', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757674389-WhatsApp Image 2025-09-12 at 4.21.07 PM.jpeg', '1', '0', NULL, '2025-09-12 10:52:22', '2025-09-12 10:53:09'),
(50, 'Manually', '0', '01-295-2025 LOEWE', '20', '7', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757675262-WhatsApp Image 2025-09-12 at 4.36.42 PM.jpeg', '1', '0', NULL, '2025-09-12 10:58:08', '2025-09-12 11:07:42'),
(51, 'Manually', '0', '04-235-2025 ADDIDAS', '20', '12', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757677505-WhatsApp Image 2025-09-12 at 4.55.09 PM.jpeg', '1', '0', NULL, '2025-09-12 11:16:47', '2025-09-12 11:45:05'),
(52, 'Manually', '0', '01-130-2025 PRO-LINE', '21', '7', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757677454-WhatsApp Image 2025-09-12 at 5.12.51 PM.jpeg', '1', '0', NULL, '2025-09-12 11:38:54', '2025-09-12 11:44:14'),
(53, 'Manually', '0', '01-200-2025', '22', '13', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757747915-WhatsApp Image 2025-09-13 at 12.47.25 PM.jpeg', '1', '0', NULL, '2025-09-12 11:49:19', '2025-09-13 07:18:35'),
(54, 'Manually', '0', '02-500-2025 adidas', '23', '8', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', '2025-09-13 06:54:43', '2025-09-13 06:36:40', '2025-09-13 06:54:43'),
(55, 'Manually', '0', '01-500-2025 mix', '23', '8', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757747028-WhatsApp Image 2025-09-13 at 12.32.49 PM.jpeg', '1', '0', NULL, '2025-09-13 06:59:48', '2025-09-13 07:03:48'),
(56, 'Manually', '0', '01-480-2025 U.S polo', '4', '4', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757749110-WhatsApp Image 2025-09-13 at 1.07.29 PM.jpeg', '1', '0', '2025-09-13 07:39:02', '2025-09-13 07:30:38', '2025-09-13 07:39:02'),
(57, 'Manually', '0', '01-480-2025 U.S polo', '4', '4', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757749214-WhatsApp Image 2025-09-13 at 1.07.29 PM.jpeg', '1', '0', '2025-09-13 07:43:28', '2025-09-13 07:39:45', '2025-09-13 07:43:28'),
(58, 'Manually', '0', '01-480-2025 U.S Polo', '4', '4', '2', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757749503-WhatsApp Image 2025-09-13 at 1.07.29 PM.jpeg', '1', '0', NULL, '2025-09-13 07:44:22', '2025-09-13 08:49:24'),
(59, 'Manually', '0', '01-590-2025 adidas', '18', '10', '2', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757754194-WhatsApp Image 2025-09-13 at 2.32.25 PM.jpeg', '1', '0', NULL, '2025-09-13 08:59:16', '2025-09-13 09:03:15'),
(60, 'Manually', '0', '01-520-2025 Nike', '3', '4', '2', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757754757-WhatsApp Image 2025-09-09 at 3.25.20 PM.jpeg', '1', '0', NULL, '2025-09-13 09:09:34', '2025-09-13 09:12:37'),
(61, 'Manually', '0', '01-500-2025 NIFTY', '24', '14', '2', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-13 10:03:26', '2025-09-13 10:06:11'),
(62, 'Manually', '0', '01-400-2025', '25', '15', '2', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-13 10:19:51', '2025-09-13 10:22:47'),
(63, 'Manually', '0', '01-600-2025', '26', '15', '2', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-13 10:24:44', '2025-09-13 10:25:27'),
(64, 'Manually', '0', '01-350-2025', '27', '15', '2', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-13 12:07:57', '2025-09-13 12:10:09'),
(65, 'Manually', '0', '02-370-2025', '25', '15', '2', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-13 12:46:19', '2025-09-13 12:47:42'),
(66, 'Manually', '0', '01-410-2025', '28', '16', '2', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-13 13:35:15', '2025-09-13 13:35:35'),
(67, 'Manually', '0', '02-600-2025', '24', '17', '2', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-14 06:55:01', '2025-09-13 13:49:45', '2025-09-14 06:55:01'),
(68, 'Manually', '0', '02-600-2025', '30', '17', '2', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-15 11:04:17', '2025-09-14 06:55:03', '2025-09-15 11:04:17'),
(69, 'Manually', '0', '01-135-2025', '31', '18', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', '2025-09-14 07:31:04', '2025-09-14 07:25:17', '2025-09-14 07:31:04'),
(70, 'Manually', '0', '02-135-2025', '31', '18', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-14 07:30:11', '2025-09-14 07:31:04'),
(71, 'Manually', '0', '03-165-2025', '31', '18', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-14 08:30:09', '2025-09-14 08:30:54'),
(72, 'Manually', '0', '04-155-2025', '31', '18', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-14 09:02:32', '2025-09-14 09:03:02'),
(73, 'Manually', '0', '01-145-2025', '32', '7', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757846769-WhatsApp Image 2025-09-14 at 4.14.09 PM.jpeg', '1', '0', NULL, '2025-09-14 10:38:54', '2025-09-14 10:46:09'),
(74, 'Manually', '0', '01-90-2025', '33', '7', '1', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1757852895-WhatsApp Image 2025-09-14 at 4.52.33 PM.jpeg', '1', '0', NULL, '2025-09-14 11:20:52', '2025-09-14 12:28:15'),
(75, 'Manually', '0', '02-600-2025', '35', '17', '2', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-15 11:04:21', '2025-09-15 11:04:42'),
(76, 'Manually', '0', '02-200-2025', '36', '6', '2', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-16 11:45:14', '2025-09-16 11:45:45'),
(77, NULL, NULL, '123-A', '3', '4', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', '2025-09-20 00:14:48', '2025-09-16 08:25:21', '2025-09-20 00:14:48'),
(78, NULL, NULL, '12312-A', '4', '4', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', '2025-09-20 00:14:48', '2025-09-16 08:31:04', '2025-09-20 00:14:48'),
(79, NULL, NULL, 'TEST-1', '3', '4', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-16 21:16:18', '2025-09-16 21:19:47'),
(80, 'Manually', '0', '2100', '37', '20', '2', NULL, '5', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-20 00:12:46', '2025-09-20 00:14:48');

-- --------------------------------------------------------

--
-- Table structure for table `item_details`
--

CREATE TABLE `item_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `season_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `max_alert` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_alert` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `article_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mutha` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `selling_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_stock` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opening_stock` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `pending_stock` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_purchse_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_sale_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `result_sale_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `result_profit_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `is_temp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_details`
--

INSERT INTO `item_details` (`id`, `from`, `from_id`, `item_id`, `brand_id`, `category_id`, `season_id`, `max_alert`, `min_alert`, `article_name`, `barcode_value`, `size`, `color`, `quantity`, `mutha`, `purchase_price`, `selling_price`, `total_stock`, `opening_stock`, `pending_stock`, `total_purchse_value`, `total_sale_value`, `result_sale_amount`, `result_profit_amount`, `status`, `is_temp`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, '1', '1', '1', '1', '50', '5', 'art-1', 'art-1-m-xxl-red', 'm-xxl', 'red', '4', NULL, '220', '250', NULL, '20', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-07 11:13:20', '2025-09-05 12:39:11', '2025-09-07 11:13:20'),
(2, NULL, NULL, '2', '2', '2', '1', NULL, NULL, 'patta AR-1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, '1', '1', '2025-09-06 11:15:44', '2025-09-06 11:12:45', '2025-09-06 11:15:44'),
(3, NULL, NULL, '3', '3', '4', '1', NULL, NULL, 'Nike sweatshirt 01 - 2025', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, '1', '1', '2025-09-08 15:26:54', '2025-09-07 11:12:41', '2025-09-07 11:12:41'),
(4, NULL, NULL, '4', '3', '4', '1', NULL, NULL, 'Nike Sweatshirt 01- 2025', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, '1', '1', '2025-09-08 15:26:56', '2025-09-07 11:17:33', '2025-09-07 11:17:33'),
(5, NULL, NULL, '5', '3', '4', '1', '50', '5', 'NP/S 01- 2025', 'NP/S 01- 2025-m-xxl-orange', 'm-xxl', 'orange', '4', '6.00', '450', '520', NULL, '24', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-13 09:07:13', '2025-09-07 11:20:23', '2025-09-13 09:07:13'),
(6, NULL, NULL, '5', '3', '4', '1', '50', '5', 'NP/S 01- 2025', 'NP/S 01- 2025-m-xxl-blue', 'm-xxl', 'blue', '6', NULL, '450', '520', NULL, '24', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-08 07:40:44', '2025-09-07 11:21:15', '2025-09-08 07:40:44'),
(7, NULL, NULL, '5', '3', '4', '1', '50', '5', 'NP/S 01- 2025', 'NP/S 01- 2025-m-xxl-neon green', 'm-xxl', 'neon green', '4', NULL, '450', '520', NULL, '16', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-08 11:00:52', '2025-09-07 11:22:40', '2025-09-08 11:00:52'),
(8, NULL, NULL, '5', '3', '4', '1', '50', '5', 'NP/S 01- 2025', 'NP/S 01- 2025-m-xxl-cream', 'm-xxl', 'cream', '4', '7.00', '450', '520', NULL, '28', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-13 09:07:13', '2025-09-07 11:22:41', '2025-09-13 09:07:13'),
(9, NULL, NULL, '5', '3', '4', '1', '50', '5', 'NP/S 01- 2025', 'NP/S 01- 2025-m-xxl-grey', 'm-xxl', 'grey', '8', NULL, '450', '520', NULL, '32', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-08 07:38:43', '2025-09-07 11:22:42', '2025-09-08 07:38:43'),
(10, NULL, NULL, '5', '3', '4', '1', '50', '5', 'NP/S 01- 2025', 'NP/S 01- 2025-m-xxl-black', 'm-xxl', 'black', '4', '7.00', '450', '520', NULL, '28', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-13 09:07:13', '2025-09-07 11:22:43', '2025-09-13 09:07:13'),
(11, NULL, NULL, '6', '4', '4', '1', '50', '5', 'U/P 01 - 2025', 'U/P 01 - 2025-m-xxl-black', 'm-xxl', 'black', '4', '8.00', '410', '480', NULL, '32', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-13 07:26:08', '2025-09-07 11:38:14', '2025-09-13 07:26:08'),
(12, NULL, NULL, '6', '4', '4', '1', '50', '5', 'U/P 01 - 2025', 'U/P 01 - 2025-m-xxl-blue', 'm-xxl', 'blue', '4', '4.00', '410', '480', NULL, '16', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-13 07:26:08', '2025-09-07 12:21:29', '2025-09-13 07:26:08'),
(13, NULL, NULL, '6', '4', '4', '1', '50', '5', 'U/P 01 - 2025', 'U/P 01 - 2025-m-xxl-drk green', 'm-xxl', 'drk green', '4', '4.00', '410', '480', NULL, '16', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-13 07:26:08', '2025-09-07 12:21:29', '2025-09-13 07:26:08'),
(14, NULL, NULL, '6', '4', '4', '1', '50', '5', 'U/P 01 - 2025', 'U/P 01 - 2025-m-xxl-wine', 'm-xxl', 'wine', '4', '4.00', '410', '480', NULL, '16', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-13 07:26:08', '2025-09-07 12:21:30', '2025-09-13 07:26:08'),
(15, NULL, NULL, '6', '4', '4', '1', '50', '5', 'U/P 01 - 2025', 'U/P 01 - 2025-m-xxl-off white', 'm-xxl', 'off white', '4', '4.00', '410', '480', NULL, '16', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-13 07:26:08', '2025-09-07 12:21:32', '2025-09-13 07:26:08'),
(16, NULL, NULL, '6', '4', '4', '1', '50', '5', 'U/P 01 - 2025', 'U/P 01 - 2025-m-xxl-cream', 'm-xxl', 'cream', '4', '4.00', '410', '480', NULL, '16', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-13 07:26:08', '2025-09-07 12:21:32', '2025-09-13 07:26:08'),
(17, NULL, NULL, '7', '5', '5', '1', '50', '5', 'PC T/S 01 - 2025', 'PC T/S 01 - 2025-m-xl', 'm-xl', 'mix-130', '3', '181.00', NULL, '130', NULL, '543', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-07 12:41:44', '2025-09-16 07:30:33'),
(18, NULL, NULL, '7', '5', '5', '1', NULL, NULL, 'PC T/S 01 - 2025', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, '1', '1', '2025-09-07 13:10:24', '2025-09-07 13:08:48', '2025-09-07 13:10:24'),
(19, NULL, NULL, '7', '5', '5', '1', NULL, NULL, 'PC T/S 01 - 2025', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, '1', '1', '2025-09-07 13:10:24', '2025-09-07 13:08:48', '2025-09-07 13:10:24'),
(20, NULL, NULL, '7', '5', '5', '1', NULL, NULL, 'PC T/S 01 - 2025', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, '1', '1', '2025-09-07 13:10:25', '2025-09-07 13:08:48', '2025-09-07 13:10:25'),
(21, NULL, NULL, '7', '5', '5', '1', NULL, NULL, 'PC T/S 01 - 2025', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, '1', '1', '2025-09-07 13:10:25', '2025-09-07 13:08:48', '2025-09-07 13:10:25'),
(22, NULL, NULL, '7', '5', '5', '1', NULL, NULL, 'PC T/S 01 - 2025', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, '1', '1', '2025-09-07 13:10:27', '2025-09-07 13:08:49', '2025-09-07 13:10:27'),
(23, NULL, NULL, '8', '6', '5', '1', '50', '5', 'PC C/Z 01 - 2025', 'PC C/Z 01 - 2025-m-xl-mix-160', 'm-xl', 'mix-160', '3', '80.00', '143', '160', NULL, '240', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-07 13:35:00', '2025-09-12 07:20:29'),
(24, NULL, NULL, '9', '7', '6', '1', '50', '5', 'NS AD 01 - 2025', 'NS AD 01 - 2025-l-xxl-mix-140', 'l-xxl', 'mix-140', '3', NULL, NULL, NULL, NULL, '69', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-07 13:43:00', '2025-09-08 12:30:08'),
(25, NULL, NULL, '10', '5', '5', '1', '50', '5', 'PC T/S 02 - 2025', 'PC T/S 02 - 2025-m-xl', 'm-xl', 'mix-120', '3', '95.00', NULL, '120', NULL, '285', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-07 13:48:28', '2025-09-16 07:30:09'),
(26, NULL, NULL, '5', '3', '4', '1', '50', '5', 'NP/S 01- 2025', 'NP/S 01- 2025-m-xxl-grey', 'm-xxl', 'grey', '4', '8.00', '450', '520', NULL, '32', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-13 09:07:13', '2025-09-08 07:39:24', '2025-09-13 09:07:13'),
(27, NULL, NULL, '11', '8', '7', '1', '50', '5', 'C/L 01 - 2025', 'C/L 01 - 2025-M-XXL', 'M-XXL', 'PINK-155', '4', '14.25', NULL, '155', NULL, '57', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-08 08:15:43', '2025-09-14 09:42:15'),
(28, NULL, NULL, '11', '8', '7', '1', '50', '5', 'C/L 01 - 2025', 'C/L 01 - 2025-M-XXL-BROWN-155', 'M-XXL', 'BROWN-155', '4', NULL, NULL, '155', NULL, '15', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-14 09:42:13', '2025-09-08 08:16:36', '2025-09-14 09:42:13'),
(29, NULL, NULL, '11', '8', '7', '1', '50', '5', 'C/L 01 - 2025', 'C/L 01 - 2025-M-XXL-GREEN-155', 'M-XXL', 'GREEN-155', '4', NULL, NULL, '155', NULL, '20', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-14 09:42:13', '2025-09-08 08:16:36', '2025-09-14 09:42:13'),
(30, NULL, NULL, '11', '8', '7', '1', '50', '5', 'C/L 01 - 2025', 'C/L 01 - 2025-M-XXL-BLACK-155', 'M-XXL', 'BLACK-155', '4', NULL, NULL, '155', NULL, '3', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-14 09:42:14', '2025-09-08 08:23:12', '2025-09-14 09:42:14'),
(31, NULL, NULL, '12', '9', '5', '1', NULL, NULL, 'C/L 02 -2025', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, '1', '1', '2025-09-08 08:58:37', '2025-09-08 08:48:04', '2025-09-08 08:58:37'),
(33, NULL, NULL, '14', '3', '4', '1', '50', '5', 'ART', 'ART-M-XXL-HIU', 'M-XXL', 'HIU', '4', NULL, '410', '480', NULL, '10', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-08 10:07:59', '2025-09-08 10:06:35', '2025-09-08 10:07:59'),
(34, NULL, NULL, '5', '3', '4', '1', '50', '5', 'NP/S 01- 2025', 'NP/S 01- 2025-M-XXL-blue', 'M-XXL', 'blue', '4', '6.00', '450', '520', NULL, '24', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-13 09:07:13', '2025-09-08 11:00:27', '2025-09-13 09:07:13'),
(35, NULL, NULL, '15', '9', '7', '1', '50', '5', 'C/L 02-180-2025', 'C/L 02-180-2025-M-XXL-MIX', 'M-XXL', 'MIX', '4', NULL, NULL, '180', NULL, '79', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-09 10:51:27', '2025-09-09 10:03:45', '2025-09-09 10:51:27'),
(36, NULL, NULL, '15', '9', '7', '1', '300', '32', 'C/L 02-180-2025', 'C/L 02-180-2025-M-XXL-BEIGE', 'M-XXL', 'BEIGE', '4', NULL, NULL, '180', NULL, '11', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-09 10:14:07', '2025-09-09 10:05:20', '2025-09-09 10:14:07'),
(37, NULL, NULL, '15', '9', '7', '1', '300', '32', 'C/L 02-180-2025', 'C/L 02-180-2025-M-XXL-BLACK', 'M-XXL', 'BLACK', '4', NULL, NULL, '180', NULL, '16', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-09 10:14:08', '2025-09-09 10:05:20', '2025-09-09 10:14:08'),
(38, NULL, NULL, '15', '9', '7', '1', '300', '32', 'C/L 02-180-2025', 'C/L 02-180-2025-M-XXL-DARK PINK', 'M-XXL', 'DARK PINK', '4', NULL, NULL, '180', NULL, '16', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-09 10:14:10', '2025-09-09 10:05:21', '2025-09-09 10:14:10'),
(39, NULL, NULL, '15', '9', '7', '1', '300', '32', 'C/L 02-180-2025', 'C/L 02-180-2025-M-XXL-COFFEE', 'M-XXL', 'COFFEE', '4', NULL, NULL, '180', NULL, '16', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-09 10:14:11', '2025-09-09 10:05:22', '2025-09-09 10:14:11'),
(40, NULL, NULL, '15', '9', '7', '1', '300', '32', 'C/L 02-180-2025', 'C/L 02-180-2025-M-XXL-GREEN', 'M-XXL', 'GREEN', '4', NULL, NULL, '180', NULL, '12', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-09 10:14:12', '2025-09-09 10:05:22', '2025-09-09 10:14:12'),
(41, NULL, NULL, '16', '11', '7', '1', '50', '5', 'C/L 03-190-2025', 'C/L 03-190-2025-M-XL-MIX-190', 'M-XL', 'MIX-190', '7', NULL, NULL, '190', NULL, '126', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-09 10:51:09', '2025-09-09 10:17:47', '2025-09-09 10:51:09'),
(42, NULL, NULL, '17', '9', '5', '1', '50', '5', 'C/L 02-180-2025', 'C/L 02-180-2025-M-XXL-MIX', 'M-XXL', 'MIX', '4', NULL, NULL, '180', NULL, '79', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-09 10:52:13', '2025-09-10 10:58:53'),
(43, NULL, NULL, '18', '11', '7', '1', '50', '5', 'C/L 02-190-2025', 'C/L 02-190-2025--', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-09 11:16:44', '2025-09-09 11:16:03', '2025-09-09 11:16:44'),
(44, NULL, NULL, '19', '11', '5', '1', '50', '5', 'C/L 03-190-2025', 'C/L 03-190-2025-M-XL-MIX-7', 'M-XL', 'MIX-7', '7', NULL, NULL, '190', NULL, '126', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-09 11:45:07', '2025-09-09 11:17:29', '2025-09-09 11:45:07'),
(45, NULL, NULL, '19', '11', '5', '1', '50', '5', 'C/L 03-190-2025', 'C/L 03-190-2025-M-XL-MIX-02', 'M-XL', 'MIX-02', '6', NULL, NULL, '190', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-09 11:42:41', '2025-09-09 11:36:53', '2025-09-09 11:42:41'),
(46, NULL, NULL, '19', '11', '5', '1', '50', '5', 'C/L 03-190-2025', 'C/L 03-190-2025-M-XL-MIX', 'M-XL', 'MIX', '5', NULL, NULL, '190', NULL, '15', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-09 11:44:40', '2025-09-09 11:38:17', '2025-09-09 11:44:40'),
(47, NULL, NULL, '19', '11', '5', '1', '50', '5', 'C/L 03-190-2025', 'C/L 03-190-2025-M-XL-MIX-3', 'M-XL', 'MIX-3', '3', NULL, NULL, '190', NULL, '96', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-09 11:45:07', '2025-09-09 11:40:08', '2025-09-09 11:45:07'),
(48, NULL, NULL, '19', '11', '5', '1', '50', '5', 'C/L 03-190-2025', 'C/L 03-190-2025-M-XL-MIX-6', 'M-XL', 'MIX-6', '6', NULL, NULL, '190', NULL, '24', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-09 11:45:07', '2025-09-09 11:43:47', '2025-09-09 11:45:07'),
(49, NULL, NULL, '20', '11', '5', '1', '50', '5', 'C/L 03-190-2025', 'C/L 03-190-2025-M-XL', 'M-XL', 'MIX-7', '7', '37.29', NULL, '190', NULL, '261', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-09 11:46:08', '2025-09-14 09:39:05'),
(50, NULL, NULL, '20', '11', '5', '1', '50', '5', 'C/L 03-190-2025', 'C/L 03-190-2025-M-XL-MIX-6', 'M-XL', 'MIX-6', '6', NULL, NULL, '190', NULL, '24', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-14 09:39:02', '2025-09-09 11:46:11', '2025-09-14 09:39:02'),
(51, NULL, NULL, '20', '11', '5', '1', '50', '5', 'C/L 03-190-2025', 'C/L 03-190-2025-M-XL-MIX-5', 'M-XL', 'MIX-5', '5', NULL, NULL, '190', NULL, '15', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-14 09:39:03', '2025-09-09 11:46:11', '2025-09-14 09:39:03'),
(52, NULL, NULL, '20', '11', '5', '1', '50', '5', 'C/L 03-190-2025', 'C/L 03-190-2025-M-XL-MIX-3', 'M-XL', 'MIX-3', '3', NULL, NULL, '190', NULL, '96', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-14 09:39:04', '2025-09-09 11:46:12', '2025-09-14 09:39:04'),
(53, NULL, NULL, '11', '8', '7', '1', NULL, NULL, 'C/L 01 - 2025', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, '1', '1', '2025-09-09 12:11:43', '2025-09-09 11:58:14', '2025-09-09 12:11:43'),
(54, NULL, NULL, '21', '12', '7', '1', '50', '5', 'C/L 04-165-2025', 'C/L 04-165-2025-M-XL-MIX', 'M-XL', 'MIX', '3', NULL, NULL, '165', NULL, '255', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-09 12:14:08', '2025-09-10 11:03:36'),
(55, NULL, NULL, '22', '13', '7', '1', '50', '5', 'L/C - 01-130-2025', 'L/C - 01-130-2025-M-XL-MIX', 'M-XL', 'MIX', '3', NULL, NULL, '130', NULL, '66', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-09 12:49:54', '2025-09-10 11:21:26'),
(56, NULL, NULL, '23', '9', '7', '1', NULL, NULL, 'C/L -05-180-2025', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, '1', '1', '2025-09-09 13:02:18', '2025-09-09 13:01:06', '2025-09-09 13:02:18'),
(57, NULL, NULL, '24', '9', '7', '1', '50', '5', 'C/L 05-180-2025 ZARA', 'C/L 05-180-2025 ZARA-M-XXL-MIX', 'M-XXL', 'MIX', '4', NULL, NULL, '180', NULL, '87', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-09 13:04:05', '2025-09-09 13:20:30'),
(58, NULL, NULL, '25', '14', '5', '1', '50', '5', 'C/L 06-235-2025 NIKE', 'C/L 06-235-2025 NIKE-L', 'L', 'MIX', '7', '3.71', NULL, '235', NULL, '26', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-09 13:24:57', '2025-09-14 09:42:40'),
(59, NULL, NULL, '25', '14', '5', '1', '50', '5', 'C/L 06-235-2025 NIKE', 'C/L 06-235-2025 NIKE-L-MIX', 'L', 'MIX', '5', NULL, NULL, '235', NULL, '5', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-14 09:42:39', '2025-09-09 13:28:03', '2025-09-14 09:42:39'),
(60, NULL, NULL, '26', '15', '5', '1', '50', '5', 'C/L 07-265-2025 H&M', 'C/L 07-265-2025 H&M-M-MIX', 'M', 'MIX', '7', NULL, NULL, '265', NULL, '14', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-09 13:36:39', '2025-09-09 14:01:18'),
(61, NULL, NULL, '27', '15', '5', '1', NULL, NULL, 'C/L 08-230-2025', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, '1', '1', '2025-09-09 13:37:47', '2025-09-09 13:37:19', '2025-09-09 13:37:47'),
(62, NULL, NULL, '26', '15', '5', '1', '50', '5', 'C/L 07-265-2025 H&M', 'C/L 07-265-2025 H&M-L-MIX', 'L', 'MIX', '7', NULL, NULL, '265', NULL, '14', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-09 13:39:34', '2025-09-09 14:01:18'),
(63, NULL, NULL, '28', '15', '5', '1', '50', '5', 'C/L 08-270-2025 H&M', 'C/L 08-270-2025 H&M-L-MIX', 'L', 'MIX', '6', NULL, NULL, '265', NULL, '16', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-09 13:43:05', '2025-09-09 13:53:03'),
(64, NULL, NULL, '28', '15', '5', '1', '50', '5', 'C/L 08-270-2025 H&M', 'C/L 08-270-2025 H&M-M-MIX', 'M', 'MIX', '6', NULL, NULL, '265', NULL, '8', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-09 13:47:50', '2025-09-09 13:53:03'),
(65, NULL, NULL, '29', '15', '5', '1', '50', '5', 'C/L 09-260-2025 PUMA', 'C/L 09-260-2025 PUMA-L-MIX', 'L', 'MIX', '7', NULL, NULL, '260', NULL, '27', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-09 13:52:08', '2025-09-09 13:53:03'),
(66, NULL, NULL, '30', '15', '5', '1', '50', '5', 'C/L 10-270-2025 NIKE', 'C/L 10-270-2025 NIKE-L', 'L', 'MIX', '4', '8.00', NULL, '270', NULL, '32', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-09 14:11:26', '2025-09-14 09:43:14'),
(67, NULL, NULL, '30', '15', '5', '1', NULL, NULL, 'C/L 10-270-2025 NIKE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, '1', '1', '2025-09-09 14:13:28', '2025-09-09 14:12:11', '2025-09-09 14:13:28'),
(68, NULL, NULL, '30', '15', '5', '1', '50', '5', 'C/L 10-270-2025 NIKE', 'C/L 10-270-2025 NIKE-M', 'M', 'MIX', '4', '11.75', NULL, '270', NULL, '47', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-09 14:13:31', '2025-09-14 09:43:14'),
(69, NULL, NULL, '30', '15', '5', '1', '50', '5', 'C/L 10-270-2025 NIKE', 'C/L 10-270-2025 NIKE-M-MIX', 'M', 'MIX', '3', NULL, NULL, '270', NULL, '3', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-14 09:43:12', '2025-09-09 14:13:31', '2025-09-14 09:43:12'),
(70, NULL, NULL, '31', '15', '5', '1', '50', '5', 'C/L 11-265-2025 H&M', 'C/L 11-265-2025 H&M-M', 'M', 'MIX', '7', '2.86', NULL, '265', NULL, '20', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-09 14:22:06', '2025-09-14 09:41:52'),
(71, NULL, NULL, '31', '15', '5', '1', '50', '5', 'C/L 11-265-2025 H&M', 'C/L 11-265-2025 H&M-M-MIX', 'M', 'MIX', '6', NULL, NULL, '265', NULL, '6', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-14 09:41:43', '2025-09-09 14:22:34', '2025-09-14 09:41:43'),
(72, NULL, NULL, '31', '15', '5', '1', '50', '5', 'C/L 11-265-2025 H&M', 'C/L 11-265-2025 H&M-L', 'L', 'MIX', '7', '1.86', NULL, '265', NULL, '13', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-09 14:23:02', '2025-09-14 09:41:52'),
(73, NULL, NULL, '31', '15', '5', '1', '50', '5', 'C/L 11-265-2025 H&M', 'C/L 11-265-2025 H&M-L-MIX', 'L', 'MIX', '6', NULL, NULL, '265', NULL, '6', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-14 09:41:51', '2025-09-09 14:23:18', '2025-09-14 09:41:51'),
(74, NULL, NULL, '32', '15', '5', '1', '50', '5', 'C/L 12-265-2025 H&M', 'C/L 12-265-2025 H&M-L', 'L', 'MIX', '7', '2.71', NULL, '265', NULL, '19', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-09 14:32:31', '2025-09-14 09:41:17'),
(75, NULL, NULL, '32', '15', '5', '1', '50', '5', 'C/L 12-265-2025 H&M', 'C/L 12-265-2025 H&M-L-MIX', 'L', 'MIX', '5', NULL, NULL, '265', NULL, '5', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-14 09:41:16', '2025-09-09 14:33:12', '2025-09-14 09:41:16'),
(76, NULL, NULL, '33', '15', '5', '1', '50', '5', 'C/L 13-275-2025 NIKE', 'C/L 13-275-2025 NIKE-L', 'L', 'MIX', '7', '1.86', NULL, '275', NULL, '13', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-09 14:39:03', '2025-09-14 09:41:01'),
(77, NULL, NULL, '33', '15', '5', '1', '50', '5', 'C/L 13-275-2025 NIKE', 'C/L 13-275-2025 NIKE-L-MIX', 'L', 'MIX', '6', NULL, NULL, '275', NULL, '6', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-14 09:40:58', '2025-09-09 14:39:21', '2025-09-14 09:40:58'),
(78, NULL, NULL, '34', '15', '5', '1', '50', '5', 'C/L 14-255-2025 U.S POLO', 'C/L 14-255-2025 U.S POLO-L', 'L', 'MIX', '7', '3.57', NULL, '275', NULL, '25', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-09 14:40:32', '2025-09-14 09:40:28'),
(79, NULL, NULL, '34', '15', '5', '1', '50', '5', 'C/L 14-255-2025 U.S POLO', 'C/L 14-255-2025 U.S POLO-L-MIX', 'L', 'MIX', '6', NULL, NULL, '275', NULL, '6', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-14 09:40:19', '2025-09-09 14:41:07', '2025-09-14 09:40:19'),
(80, NULL, NULL, '34', '15', '5', '1', '50', '5', 'C/L 14-255-2025 U.S POLO', 'C/L 14-255-2025 U.S POLO-M-MIX', 'M', 'MIX', '7', NULL, NULL, '275', NULL, '7', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-14 09:40:20', '2025-09-09 14:41:22', '2025-09-14 09:40:20'),
(81, NULL, NULL, '34', '15', '5', '1', '50', '5', 'C/L 14-255-2025 U.S POLO', 'C/L 14-255-2025 U.S POLO-M-MIX', 'M', 'MIX', '5', NULL, NULL, '275', NULL, '5', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-14 09:40:21', '2025-09-09 14:41:41', '2025-09-14 09:40:21'),
(82, NULL, NULL, '35', '15', '5', '1', '50', '5', 'C/L 15-265-2025 H&M', 'C/L 15-265-2025 H&M-L-MIX', 'L', 'MIX', '6', NULL, NULL, '265', NULL, '6', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-09 14:42:41', '2025-09-09 14:43:04'),
(83, NULL, NULL, '36', '15', '5', '1', '50', '5', 'C/L 16-275-2025 JORDAN', 'C/L 16-275-2025 JORDAN-L-MIX', 'L', 'MIX', '7', NULL, NULL, '275', NULL, '14', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-09 14:43:47', '2025-09-09 14:45:31'),
(84, NULL, NULL, '36', '15', '5', '1', NULL, NULL, 'C/L 16-275-2025 JORDAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, '1', '1', '2025-09-09 14:44:21', '2025-09-09 14:44:19', '2025-09-09 14:44:21'),
(85, NULL, NULL, '37', '15', '5', '1', '50', '5', 'C/L 17-215-2025 BALENCIAGA', 'C/L 17-215-2025 BALENCIAGA-L', 'L', 'MIX', '7', '4.86', NULL, '215', NULL, '34', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-09 14:44:49', '2025-09-14 09:39:58'),
(86, NULL, NULL, '37', '15', '5', '1', '50', '5', 'C/L 17-215-2025 BALENCIAGA', 'C/L 17-215-2025 BALENCIAGA-L-MIX', 'L', 'MIX', '6', NULL, NULL, '215', NULL, '6', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-14 09:39:56', '2025-09-09 14:45:16', '2025-09-14 09:39:56'),
(87, NULL, NULL, '38', '15', '5', '1', '50', '5', 'C/L 18-260-2025 PUMA', 'C/L 18-260-2025 PUMA-L', 'L', 'MIX', '6', '1.83', NULL, '260', NULL, '11', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-10 07:58:25', '2025-09-14 09:39:33'),
(88, NULL, NULL, '38', '15', '5', '1', '50', '5', 'C/L 18-260-2025 PUMA', 'C/L 18-260-2025 PUMA-L-MIX', 'L', 'MIX', '5', NULL, NULL, '260', NULL, '5', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-14 09:39:33', '2025-09-10 07:58:55', '2025-09-14 09:39:33'),
(89, NULL, NULL, '39', '15', '5', '1', '50', '5', 'C/L 19-270-2025 H&M', 'C/L 19-270-2025 H&M-L', 'L', 'MIX', '7', '2.57', NULL, '270', NULL, '18', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-10 08:01:04', '2025-09-12 10:28:06'),
(90, NULL, NULL, '39', '15', '5', '1', '50', '5', 'C/L 19-270-2025 H&M', 'C/L 19-270-2025 H&M-L-MIX', 'L', 'MIX', '4', NULL, NULL, '270', NULL, '4', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-12 10:27:53', '2025-09-10 08:01:16', '2025-09-12 10:27:53'),
(91, NULL, NULL, '39', '15', '5', '1', '50', '5', 'C/L 19-270-2025 H&M', 'C/L 19-270-2025 H&M-M', 'M', 'MIX', '7', '1.57', NULL, '270', NULL, '11', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-10 08:02:08', '2025-09-16 07:18:46'),
(92, NULL, NULL, '39', '15', '5', '1', '50', '5', 'C/L 19-270-2025 H&M', 'C/L 19-270-2025 H&M-M-MIX', 'M', 'MIX', '4', NULL, NULL, '270', NULL, '4', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-12 10:28:00', '2025-09-10 08:02:26', '2025-09-12 10:28:00'),
(93, NULL, NULL, '40', '16', '8', '1', '50', '5', 'N/NF 01-500-2025', 'N/NF 01-500-2025-L-XXL', 'L-XXL', 'WINE', '3', '70.00', '300', '500', NULL, '210', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-12 10:51:13', '2025-09-10 08:22:05', '2025-09-12 10:51:13'),
(94, NULL, NULL, '40', '16', '8', '1', '50', '5', 'N/NF 01-500-2025', 'N/NF 01-500-2025-L-XXL-NV/BL/GR', 'L-XXL', 'NV/BL/GR', '3', NULL, '300', '500', NULL, '126', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-12 10:27:01', '2025-09-10 08:25:18', '2025-09-12 10:27:01'),
(95, NULL, NULL, '40', '16', '8', '1', '50', '5', 'N/NF 01-500-2025', 'N/NF 01-500-2025-L-XXL-WHITE', 'L-XXL', 'WHITE', '3', NULL, '300', '500', NULL, '24', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-12 10:27:01', '2025-09-10 08:25:56', '2025-09-12 10:27:01'),
(96, NULL, NULL, '40', '16', '8', '1', '50', '5', 'N/NF 01-500-2025', 'N/NF 01-500-2025-L-XXL-LIGHT RED', 'L-XXL', 'LIGHT RED', '3', NULL, '300', '500', NULL, '9', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-12 10:27:02', '2025-09-10 08:45:07', '2025-09-12 10:27:02'),
(97, NULL, NULL, '40', '16', '8', '1', NULL, NULL, 'N/NF 01-500-2025', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, '1', '1', '2025-09-10 08:46:40', '2025-09-10 08:45:07', '2025-09-10 08:46:40'),
(98, NULL, NULL, '41', '17', '5', '1', NULL, NULL, 'CL/C 01-295-2025 COACH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, '1', '1', '2025-09-10 09:34:31', '2025-09-10 09:34:07', '2025-09-10 09:34:31'),
(99, NULL, NULL, '42', '17', '7', '1', '50', '5', 'CL/C 01-295-2025 COACH', 'CL/C 01-295-2025 COACH-L-MIX', 'L', 'MIX', '7', '4.00', '265', '295', NULL, '28', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-12 09:05:07', '2025-09-10 09:34:54', '2025-09-12 09:05:07'),
(100, NULL, NULL, '42', '17', '7', '1', '50', '5', 'CL/C 01-295-2025 COACH', 'CL/C 01-295-2025 COACH-L-MIX', 'L', 'MIX', '6', '1.00', '265', '295', NULL, '6', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-12 09:05:07', '2025-09-10 09:35:16', '2025-09-12 09:05:07'),
(101, NULL, NULL, '42', '17', '7', '1', '50', '5', 'CL/C 01-295-2025 COACH', 'CL/C 01-295-2025 COACH-M-MIX', 'M', 'MIX', '7', '5.00', '265', '295', NULL, '35', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-12 09:05:07', '2025-09-10 09:35:18', '2025-09-12 09:05:07'),
(102, NULL, NULL, '42', '17', '7', '1', '50', '5', 'CL/C 01-295-2025 COACH', 'CL/C 01-295-2025 COACH-M-MIX', 'M', 'MIX', '5', '1.00', '265', '295', NULL, '5', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-12 09:05:07', '2025-09-10 09:35:19', '2025-09-12 09:05:07'),
(103, NULL, NULL, '43', '17', '7', '1', '50', '5', 'CY/C 02-295-2025 U/P', 'CY/C 02-295-2025 U/P-L-MIX', 'L', 'MIX', '7', '3.00', NULL, '295', NULL, '21', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-12 09:05:05', '2025-09-10 12:06:12', '2025-09-12 09:05:05'),
(104, NULL, NULL, '43', '17', '7', '1', '50', '5', 'CY/C 02-295-2025 U/P', 'CY/C 02-295-2025 U/P-M-MIX', 'M', 'MIX', '7', NULL, NULL, '295', NULL, '14', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-10 12:25:34', '2025-09-10 12:06:56', '2025-09-10 12:25:34'),
(105, NULL, NULL, '43', '17', '7', '1', '50', '5', 'CY/C 02-295-2025 U/P', 'CY/C 02-295-2025 U/P-M-MIX', 'M', 'MIX', '5', NULL, NULL, '295', NULL, '5', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-10 12:25:34', '2025-09-10 12:06:56', '2025-09-10 12:25:34'),
(106, NULL, NULL, '43', '17', '7', '1', NULL, NULL, 'CY/C 02-295-2025 U/P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, '1', '1', '2025-09-10 12:07:47', '2025-09-10 12:06:57', '2025-09-10 12:07:47'),
(107, NULL, NULL, '43', '17', '7', '1', '50', '5', 'CY/C 02-295-2025 U/P', 'CY/C 02-295-2025 U/P-M-MIX', 'M', 'MIX', '7', '7.86', NULL, '295', NULL, '55', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-12 09:05:05', '2025-09-10 12:24:35', '2025-09-12 09:05:05'),
(108, NULL, NULL, '43', '17', '7', '1', '50', '5', 'CY/C 02-295-2025 U/P', 'CY/C 02-295-2025 U/P-L-MIX', 'L', 'MIX', '7', '3.00', NULL, '295', NULL, '21', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-12 08:54:45', '2025-09-10 12:24:35', '2025-09-12 08:54:45'),
(109, NULL, NULL, '44', '19', '7', '1', '50', '5', 'J/B 01-75-2025 JAZZY', 'J/B 01-75-2025 JAZZY-M-XXL-MIX', 'M-XXL', 'MIX', '3', '13.00', NULL, '75', NULL, '39', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-11 11:02:32', '2025-09-12 07:20:44'),
(110, NULL, NULL, '45', '18', '10', '1', '50', '5', 'AD/TP 01-590-2025 AD', 'AD/TP 01-590-2025 AD-M-XXL', 'M-XXL', 'BLUE', '4', '21.00', NULL, '590', NULL, '84', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-13 08:59:11', '2025-09-11 13:00:09', '2025-09-13 08:59:11'),
(111, NULL, NULL, '45', '18', '10', '1', '50', '5', 'AD/TP 01-590-2025 AD', 'AD/TP 01-590-2025 AD-M-XXL-BLACK', 'M-XXL', 'BLACK', '4', '6.00', NULL, '590', NULL, '24', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-12 10:25:58', '2025-09-11 13:00:47', '2025-09-12 10:25:58'),
(112, NULL, NULL, '45', '18', '10', '1', '50', '5', 'AD/TP 01-590-2025 AD', 'AD/TP 01-590-2025 AD-M-XXL-GREY', 'M-XXL', 'GREY', '4', '3.00', NULL, '590', NULL, '12', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-12 10:25:58', '2025-09-11 13:00:49', '2025-09-12 10:25:58'),
(113, NULL, NULL, '45', '18', '10', '1', '50', '5', 'AD/TP 01-590-2025 AD', 'AD/TP 01-590-2025 AD-M-XXL-GREEN', 'M-XXL', 'GREEN', '4', '3.00', NULL, '590', NULL, '12', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-12 10:25:59', '2025-09-11 13:00:49', '2025-09-12 10:25:59'),
(114, NULL, NULL, '45', '18', '10', '1', '50', '5', 'AD/TP 01-590-2025 AD', 'AD/TP 01-590-2025 AD-M-XXL-WHITE', 'M-XXL', 'WHITE', '4', '1.00', NULL, '590', NULL, '4', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-12 10:26:00', '2025-09-11 13:02:33', '2025-09-12 10:26:00'),
(115, NULL, NULL, '45', '18', '10', '1', '50', '5', 'AD/TP 01-590-2025 AD', 'AD/TP 01-590-2025 AD-M-XXL-WINE', 'M-XXL', 'WINE', '4', '2.00', NULL, '590', NULL, '8', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-12 10:26:01', '2025-09-11 13:02:36', '2025-09-12 10:26:01'),
(116, NULL, NULL, '45', '18', '10', '1', '50', '5', 'AD/TP 01-590-2025 AD', 'AD/TP 01-590-2025 AD-M-XXL-YELLOW', 'M-XXL', 'YELLOW', '4', '3.00', NULL, '590', NULL, '12', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-12 10:26:02', '2025-09-11 13:03:21', '2025-09-12 10:26:02'),
(117, NULL, NULL, '45', '18', '10', '1', NULL, NULL, 'AD/TP 01-590-2025 AD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, '1', '1', '2025-09-11 13:03:56', '2025-09-11 13:03:48', '2025-09-11 13:03:56'),
(118, NULL, NULL, '46', '17', '7', '1', NULL, NULL, 'CL/C 03-300-2025 GUCCI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, '1', '1', NULL, '2025-09-11 13:26:07', '2025-09-11 13:26:07'),
(119, NULL, NULL, '47', '20', '11', '1', '300', '30', '01-295-2025 COACH', '01-295-2025 COACH-L', 'L', NULL, '7', '4.00', NULL, '295', NULL, '28', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-12 09:59:34', '2025-09-12 10:36:04'),
(120, NULL, NULL, '47', '20', '11', '1', '300', '30', '01-295-2025 COACH', '01-295-2025 COACH-M', 'M', NULL, '7', '5.71', NULL, '295', NULL, '40', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-12 10:08:24', '2025-09-12 10:36:04'),
(121, NULL, NULL, '47', '20', '11', '1', NULL, NULL, '01-295-2025 COACH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, '1', '1', '2025-09-12 10:21:10', '2025-09-12 10:16:22', '2025-09-12 10:21:10'),
(122, NULL, NULL, '47', '20', '11', '1', NULL, NULL, '01-295-2025 COACH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, '1', '1', '2025-09-12 10:21:11', '2025-09-12 10:16:40', '2025-09-12 10:21:11'),
(123, NULL, NULL, '47', '20', '11', '1', NULL, NULL, '01-295-2025 COACH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, '1', '1', '2025-09-12 10:22:39', '2025-09-12 10:21:12', '2025-09-12 10:22:39'),
(124, NULL, NULL, '48', '20', '11', '1', '50', '5', '02-295-2025 U.S POLO', '02-295-2025 U.S POLO-L', 'L', NULL, '7', '3.00', NULL, '295', NULL, '21', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-12 10:35:05', '2025-09-12 10:38:48'),
(125, NULL, NULL, '48', '20', '11', '1', '50', '5', '02-295-2025 U.S POLO', '02-295-2025 U.S POLO-M', 'M', NULL, '7', '2.71', NULL, '295', NULL, '19', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-12 10:35:25', '2025-09-12 10:38:48'),
(126, NULL, NULL, '49', '16', '8', '1', '300', '30', '01-500-2025 NIKE/NF', '01-500-2025 NIKE/NF-L-XXL', 'L-XXL', NULL, '3', '70.00', '300', '500', NULL, '210', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-12 10:52:22', '2025-09-12 10:53:09'),
(127, NULL, NULL, '50', '20', '7', '1', '50', '5', '01-295-2025 LOEWE', '01-295-2025 LOEWE-L', 'L', NULL, '7', '6.86', NULL, '295', NULL, '48', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-12 10:58:08', '2025-09-12 11:07:42'),
(128, NULL, NULL, '51', '20', '12', '1', '50', '5', '04-235-2025 ADDIDAS', '04-235-2025 ADDIDAS-L', 'L', NULL, '7', '7.14', NULL, '235', NULL, '50', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-12 11:16:47', '2025-09-12 11:45:05'),
(129, NULL, NULL, '51', '20', '12', '1', '50', '5', '04-235-2025 ADDIDAS', '04-235-2025 ADDIDAS-M', 'M', NULL, '7', '3.71', NULL, '235', NULL, '26', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-12 11:18:02', '2025-09-12 11:45:05'),
(130, NULL, NULL, '52', '21', '7', '1', '50', '5', '01-130-2025 PRO-LINE', '01-130-2025 PRO-LINE-S-XXL', 'S-XXL', NULL, '8', '8.75', NULL, '130', NULL, '70', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-12 11:38:54', '2025-09-12 11:44:14'),
(131, NULL, NULL, '53', '22', '13', '1', '50', '5', '01-200-2025', '01-200-2025-MIX', 'MIX', NULL, '3', '2.00', NULL, '200', NULL, '6', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-12 11:49:19', '2025-09-12 11:49:41'),
(132, NULL, NULL, '54', '23', '8', '1', NULL, NULL, '02-500-2025 adidas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, '1', '1', '2025-09-13 06:54:43', '2025-09-13 06:36:40', '2025-09-13 06:54:43'),
(133, NULL, NULL, '55', '23', '8', '1', '50', '5', '01-500-2025 mix', '01-500-2025 mix-L-XXL', 'L-XXL', NULL, '3', '31.67', '300', '500', NULL, '95', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-13 06:59:48', '2025-09-16 08:17:37'),
(134, NULL, NULL, '56', '4', '4', '1', '50', '5', '01-480-2025 U.S polo', '01-480-2025 U.S polo-M-XXL', 'M-XXL', NULL, '4', '28.00', '410', '480', NULL, '112', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-13 07:39:02', '2025-09-13 07:30:38', '2025-09-13 07:39:02'),
(135, NULL, NULL, '57', '4', '4', '1', '300', '30', '01-480-2025 U.S polo', '01-480-2025 U.S polo-M-XXL', 'M-XXL', NULL, '4', '28.00', '410', '480', NULL, '112', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-13 07:43:28', '2025-09-13 07:39:45', '2025-09-13 07:43:28'),
(136, NULL, NULL, '58', '4', '4', '2', '50', '5', '01-480-2025 U.S Polo', '01-480-2025 U.S Polo-M-XXL', 'M-XXL', NULL, '4', '28.00', '410', '480', NULL, '112', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-13 07:44:22', '2025-09-13 08:49:24'),
(137, NULL, NULL, '59', '18', '10', '2', '50', '5', '01-590-2025 adidas', '01-590-2025 adidas-M-XXL', 'M-XXL', NULL, '4', '12.00', '520', '590', NULL, '48', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-13 08:59:16', '2025-09-13 09:30:32'),
(138, NULL, NULL, '60', '3', '4', '2', '50', '5', '01-520-2025 Nike', '01-520-2025 Nike-M-XXL', 'M-XXL', NULL, '4', '38.00', '450', '520', NULL, '152', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-13 09:09:34', '2025-09-13 09:30:18'),
(139, NULL, NULL, '61', '24', '14', '2', '50', '5', '01-500-2025 NIFTY', '01-500-2025 NIFTY-MIX', 'MIX', NULL, '1', '213.00', '315', '500', NULL, '213', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-13 10:03:26', '2025-09-13 14:09:29'),
(140, NULL, NULL, '62', '25', '15', '2', '300', '30', '01-400-2025', '01-400-2025-2-3-4', '2-3-4', NULL, '3', '65.00', NULL, '400', NULL, '195', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-13 10:19:51', '2025-09-13 10:22:47'),
(141, NULL, NULL, '63', '26', '15', '2', '50', '5', '01-600-2025', '01-600-2025-L-XXL', 'L-XXL', NULL, '3', '211.67', NULL, '600', NULL, '635', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-13 10:24:44', '2025-09-13 10:38:28'),
(142, NULL, NULL, '64', '27', '15', '2', '300', '30', '01-350-2025', '01-350-2025-L-XXL', 'L-XXL', NULL, '3', '70.00', NULL, '350', NULL, '210', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-13 12:07:57', '2025-09-13 12:10:09'),
(143, NULL, NULL, '65', '25', '15', '2', '300', '30', '02-370-2025', '02-370-2025-2-3-4', '2-3-4', NULL, '3', '43.67', NULL, '370', NULL, '131', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-13 12:46:19', '2025-09-13 12:47:42'),
(144, NULL, NULL, '66', '28', '16', '2', '300', '30', '01-410-2025', '01-410-2025-L-XXL', 'L-XXL', NULL, '3', '25.33', NULL, '410', NULL, '76', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-13 13:35:15', '2025-09-13 13:35:35'),
(145, NULL, NULL, '67', '24', '17', '2', '50', '5', '02-600-2025', '02-600-2025-MIX', 'MIX', NULL, '1', '65.00', NULL, '600', NULL, '65', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-14 06:55:01', '2025-09-13 13:49:45', '2025-09-14 06:55:01'),
(146, NULL, NULL, '68', '30', '17', '2', '50', '5', '02-600-2025', '02-600-2025-MIX', 'MIX', NULL, '1', '65.00', NULL, '600', NULL, '65', NULL, NULL, NULL, NULL, NULL, '1', '0', '2025-09-15 11:04:17', '2025-09-14 06:55:03', '2025-09-15 11:04:17'),
(147, NULL, NULL, '69', '31', '18', '1', NULL, NULL, '01-135-2025', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, '1', '1', NULL, '2025-09-14 07:25:17', '2025-09-14 07:25:17'),
(148, NULL, NULL, '70', '31', '18', '1', '50', '5', '02-135-2025', '02-135-2025-L-XXL', 'L-XXL', NULL, '3', '120.00', NULL, '135', NULL, '360', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-14 07:30:11', '2025-09-14 08:11:40'),
(149, NULL, NULL, '71', '31', '18', '1', '300', '30', '03-165-2025', '03-165-2025-L-XXL', 'L-XXL', NULL, '3', '84.00', NULL, '165', NULL, '252', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-14 08:30:09', '2025-09-14 09:03:02'),
(150, NULL, NULL, '72', '31', '18', '1', '300', '30', '04-155-2025', '04-155-2025-L-XXL', 'L-XXL', NULL, '3', '58.00', NULL, '155', NULL, '174', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-14 09:02:32', '2025-09-14 09:03:02'),
(151, NULL, NULL, '73', '32', '7', '1', '50', '5', '01-145-2025', '01-145-2025-M-XL', 'M-XL', NULL, '6', '47.00', NULL, '145', NULL, '282', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-14 10:38:54', '2025-09-14 10:39:54'),
(152, NULL, NULL, '74', '33', '7', '1', '300', '30', '01-90-2025', '01-90-2025-MIX', 'MIX', NULL, '5', '42.80', NULL, '90', NULL, '214', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-14 11:20:52', '2025-09-14 12:28:15'),
(153, NULL, NULL, '75', '35', '17', '2', '300', '30', '02-600-2025', '02-600-2025-MIX', 'MIX', NULL, '1', '65.00', NULL, '600', NULL, '65', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-15 11:04:21', '2025-09-15 11:04:42'),
(154, NULL, NULL, '76', '36', '6', '2', '50', '5', '02-200-2025', '02-200-2025-L-XXL', 'L-XXL', NULL, '3', '52.00', '100', '200', NULL, '156', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-16 11:45:14', '2025-09-20 05:50:45'),
(155, NULL, NULL, '77', '3', '4', '1', NULL, NULL, '123-A', NULL, 'M-XXL', NULL, '4', NULL, '200', '250', NULL, '0', NULL, NULL, NULL, NULL, NULL, '1', '1', NULL, '2025-09-16 08:25:21', '2025-09-16 08:25:21'),
(156, 'Purchase', '4', '78', '4', '4', '1', NULL, NULL, '12312-A', '12312-A-L', 'L', NULL, '7', '200.00', '200', '250', NULL, '1400', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-16 08:31:04', '2025-09-16 08:33:17'),
(157, 'Purchase', '4', '78', '4', '4', '1', NULL, NULL, '12312-A', '12312-A-M', 'M', NULL, '5', '40.00', '200', '250', NULL, '200', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-16 08:31:44', '2025-09-16 08:33:17'),
(158, 'Purchase', '5', '79', '3', '4', '1', NULL, NULL, 'TEST-1', 'TEST-1-S', 'S', NULL, '5', '50', '250', '350', NULL, '250', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-16 21:16:18', '2025-09-16 21:19:24'),
(159, 'Purchase', '5', '79', '3', '4', '1', NULL, NULL, 'TEST-1', 'TEST-1-M', 'M', NULL, '5', '50', '250', '350', NULL, '250', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-16 21:16:31', '2025-09-16 21:19:47'),
(160, NULL, NULL, '80', '37', '20', '2', '50', '5', '2100', '2100-L-XXL', 'L-XXL', NULL, '3', '2.00', NULL, '895', NULL, '6', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-09-20 00:12:46', '2025-09-20 00:14:48');

-- --------------------------------------------------------

--
-- Table structure for table `ledgers`
--

CREATE TABLE `ledgers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dr_cr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ledgers`
--

INSERT INTO `ledgers` (`id`, `user_id`, `from`, `from_id`, `account_id`, `payment_method_id`, `date`, `amount`, `dr_cr`, `status`, `remarks`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '1', 'Purchase Vendor', '2', '1', '0', '2025-09-15', '3000.00', 'Cr', '1', NULL, '2025-09-16 06:45:22', '2025-09-15 01:53:18', '2025-09-16 01:15:22'),
(2, NULL, 'Payment To Vendor - 2', '1', '1', '1', '2025-09-15', '1000', 'Dr', '1', NULL, '2025-09-16 06:47:35', '2025-09-15 01:53:18', '2025-09-16 01:17:35'),
(3, NULL, 'Payment To Vendor - 2', '2', '1', '2', '2025-09-15', '500', 'Dr', '1', NULL, '2025-09-15 08:02:30', '2025-09-15 01:53:18', '2025-09-15 02:32:30'),
(4, '1', 'Expense - Manually', '0', '3', '2', '2025-09-16', '250', 'Dr', '1', 'Updated', '2025-09-16 08:19:20', '2025-09-16 02:44:10', '2025-09-16 02:49:20'),
(5, '1', 'Income - Manually', '0', '4', '2', '2025-09-16', '2000', 'Cr', '1', 'Test Here Again', '2025-09-16 08:28:44', '2025-09-16 02:58:05', '2025-09-16 02:58:44'),
(6, '1', 'Sale Customer', '2', '2', '0', '2025-09-16', '2850.00', 'Dr', '1', NULL, NULL, '2025-09-16 05:44:33', '2025-09-16 08:35:41'),
(7, '1', 'Payment Recd From Customer - 2', '2', '2', '1', '2025-09-16', '2000', 'Cr', '1', NULL, NULL, '2025-09-16 05:44:33', '2025-09-16 05:44:33'),
(8, '1', 'Payment Recd From Customer - 2', '2', '2', '2', '2025-09-16', '1670', 'Cr', '1', NULL, '2025-09-16 11:35:31', '2025-09-16 05:44:33', '2025-09-16 06:05:31'),
(9, '1', 'Payment Recd From Customer - 2', '2', '2', '2', '2025-09-16', '2000', 'Cr', '1', NULL, '2025-09-16 08:28:44', '2025-09-16 05:59:12', '2025-09-16 05:59:12'),
(10, '1', 'Payment Recd From Customer - 2', '2', '2', '2', '2025-09-16', '3670', 'Cr', '1', NULL, NULL, '2025-09-16 06:05:55', '2025-09-16 06:05:55'),
(11, '1', 'Expense - Manually', '0', '3', '1', '2025-09-16', '20', 'Dr', '1', 'Actiav', NULL, '2025-09-16 08:28:16', '2025-09-16 08:28:16'),
(12, '1', 'Purchase Vendor', '4', '1', NULL, '2025-09-16', '2400.00', 'Cr', '1', NULL, NULL, '2025-09-16 08:32:34', '2025-09-16 08:32:34'),
(13, '1', 'Purchase Vendor', '5', '1', NULL, '2025-09-17', '2500.00', 'Cr', '1', NULL, NULL, '2025-09-16 21:16:51', '2025-09-16 21:16:51'),
(14, '1', 'Payment To Vendor - 5', '5', '1', '1', '2025-09-17', '2000', 'Dr', '1', NULL, NULL, '2025-09-16 21:16:51', '2025-09-16 21:16:51'),
(15, '1', 'Sale Customer', '3', '2', '0', '2025-09-17', '3500.00', 'Dr', '1', NULL, '2025-09-19 11:43:44', '2025-09-16 21:37:44', '2025-09-19 06:13:44'),
(16, '1', 'Payment Recd From Customer - 3', '3', '2', '1', '2025-09-17', '3000', 'Cr', '1', NULL, '2025-09-19 11:43:44', '2025-09-16 21:37:44', '2025-09-19 06:13:44'),
(17, '1', 'Manually', '0', '2', '1', '2025-09-11', '2000', 'Dr', '1', 'Test Here 2', NULL, '2025-09-19 10:13:35', '2025-09-19 10:23:27'),
(18, '1', 'Manually', '0', '2', '2', '2025-09-04', '50', 'Dr', '1', 'test', NULL, '2025-09-19 10:15:39', '2025-09-19 10:23:51'),
(19, '1', 'Manually', '0', '2', '1', '19-09-2025', '2', 'Dr', '1', 'Test', '2025-09-19 15:49:18', '2025-09-19 10:17:09', '2025-09-19 10:19:18'),
(20, '1', 'Manually', '0', '2', '1', '19-09-2025', '2', 'Dr', '1', 'asdasd', '2025-09-19 15:49:16', '2025-09-19 10:17:48', '2025-09-19 10:19:16'),
(21, '1', 'Manually', '0', '2', '1', '19-09-2025', '2', 'Dr', '1', 'asdasd', '2025-09-19 15:49:14', '2025-09-19 10:18:14', '2025-09-19 10:19:14');

-- --------------------------------------------------------

--
-- Table structure for table `manage_stocks`
--

CREATE TABLE `manage_stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `season_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `item_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_detail_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `in_out` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `selling_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `software_remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manage_stocks`
--

INSERT INTO `manage_stocks` (`id`, `user_id`, `from`, `from_id`, `date`, `brand_id`, `category_id`, `season_id`, `item_id`, `item_detail_id`, `quantity`, `in_out`, `selling_price`, `purchase_price`, `remarks`, `software_remarks`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Opening Stock - Master', '1', '2025-09-05 12:39:34', '1', '1', '1', '1', '1', '20', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-08 15:26:20', '2025-09-05 12:36:03', '2025-09-05 12:39:34'),
(2, NULL, 'Opening Stock - Master', '5', '2025-09-12 07:20:09', '3', '4', '1', '5', '5', '24', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-13 09:07:13', '2025-09-07 11:30:23', '2025-09-13 09:07:13'),
(3, NULL, 'Opening Stock - Master', '6', '2025-09-07 11:45:57', '3', '4', '1', '5', '6', '24', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-08 15:32:46', '2025-09-07 11:30:23', '2025-09-07 11:45:57'),
(4, NULL, 'Opening Stock - Master', '7', '2025-09-08 07:40:44', '3', '4', '1', '5', '7', '16', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-09 16:50:41', '2025-09-07 11:30:23', '2025-09-08 07:40:44'),
(5, NULL, 'Opening Stock - Master', '8', '2025-09-12 07:20:09', '3', '4', '1', '5', '8', '28', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-13 09:07:13', '2025-09-07 11:30:23', '2025-09-13 09:07:13'),
(6, NULL, 'Opening Stock - Master', '9', '2025-09-07 11:45:57', '3', '4', '1', '5', '9', '32', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-08 15:33:09', '2025-09-07 11:30:23', '2025-09-07 11:45:57'),
(7, NULL, 'Opening Stock - Master', '10', '2025-09-12 07:20:09', '3', '4', '1', '5', '10', '28', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-13 09:07:13', '2025-09-07 11:30:23', '2025-09-13 09:07:13'),
(8, NULL, 'Opening Stock - Master', '11', '2025-09-12 07:20:15', '4', '4', '1', '6', '11', '32', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-13 07:26:08', '2025-09-07 12:27:45', '2025-09-13 07:26:08'),
(9, NULL, 'Opening Stock - Master', '12', '2025-09-12 07:20:15', '4', '4', '1', '6', '12', '16', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-13 07:26:08', '2025-09-07 12:27:45', '2025-09-13 07:26:08'),
(10, NULL, 'Opening Stock - Master', '13', '2025-09-12 07:20:15', '4', '4', '1', '6', '13', '16', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-13 07:26:08', '2025-09-07 12:27:45', '2025-09-13 07:26:08'),
(11, NULL, 'Opening Stock - Master', '14', '2025-09-12 07:20:15', '4', '4', '1', '6', '14', '16', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-13 07:26:08', '2025-09-07 12:27:45', '2025-09-13 07:26:08'),
(12, NULL, 'Opening Stock - Master', '15', '2025-09-12 07:20:15', '4', '4', '1', '6', '15', '16', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-13 07:26:08', '2025-09-07 12:27:45', '2025-09-13 07:26:08'),
(13, NULL, 'Opening Stock - Master', '16', '2025-09-12 07:20:15', '4', '4', '1', '6', '16', '16', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-13 07:26:08', '2025-09-07 12:27:45', '2025-09-13 07:26:08'),
(14, '1', 'Manual', '0', '2025-09-07', '3', '4', '1', '5', '6', '0', 'Out', NULL, NULL, NULL, 'Quantity Updated', '2025-09-08 15:28:43', '2025-09-07 12:29:54', '2025-09-07 13:57:45'),
(15, NULL, 'Opening Stock - Master', '17', '2025-09-16 07:38:28', '5', '5', '1', '7', '17', '543', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-07 13:22:15', '2025-09-16 07:38:28'),
(16, NULL, 'Opening Stock - Master', '23', '2025-09-12 07:20:29', '6', '5', '1', '8', '23', '240', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-07 13:39:51', '2025-09-12 07:20:29'),
(17, NULL, 'Opening Stock - Master', '24', '2025-09-10 10:52:37', '7', '6', '1', '9', '24', '69', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-07 13:45:38', '2025-09-10 10:52:37'),
(18, NULL, 'Opening Stock - Master', '25', '2025-09-16 07:39:12', '5', '5', '1', '10', '25', '285', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-07 13:55:23', '2025-09-16 07:39:12'),
(19, NULL, 'Opening Stock - Master', '26', '2025-09-12 07:20:09', '3', '4', '1', '5', '26', '32', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-13 09:07:13', '2025-09-08 07:40:44', '2025-09-13 09:07:13'),
(20, NULL, 'Opening Stock - Master', '27', '2025-09-14 09:42:15', '8', '7', '1', '11', '27', '57', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-08 08:25:24', '2025-09-14 09:42:15'),
(21, NULL, 'Opening Stock - Master', '28', '2025-09-10 10:57:22', '8', '7', '1', '11', '28', '15', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-14 09:42:13', '2025-09-08 08:25:24', '2025-09-14 09:42:13'),
(22, NULL, 'Opening Stock - Master', '29', '2025-09-10 10:57:22', '8', '7', '1', '11', '29', '20', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-14 09:42:13', '2025-09-08 08:25:24', '2025-09-14 09:42:13'),
(23, NULL, 'Opening Stock - Master', '30', '2025-09-10 10:57:22', '8', '7', '1', '11', '30', '3', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-14 09:42:14', '2025-09-08 08:26:48', '2025-09-14 09:42:14'),
(24, NULL, 'Opening Stock - Master', '32', '2025-09-08 09:30:55', '3', '4', '1', '13', '32', '50', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-08 15:32:21', '2025-09-08 09:30:55', '2025-09-08 09:30:55'),
(25, '1', 'Manual', '0', '2025-09-08', '8', '7', '1', '11', '30', '0', 'Out', NULL, NULL, NULL, 'Quantity Updated', '2025-09-08 10:06:12', '2025-09-08 09:45:23', '2025-09-08 10:06:12'),
(26, NULL, 'Opening Stock - Master', '33', '2025-09-08 10:06:57', '3', '4', '1', '14', '33', '10', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-08 15:38:30', '2025-09-08 10:06:57', '2025-09-08 10:06:57'),
(27, '1', 'Manual', '0', '2025-09-08', '3', '4', '1', '14', '33', '10', 'Out', NULL, NULL, NULL, 'Manually Stock In', '2025-09-08 10:07:47', '2025-09-08 10:07:30', '2025-09-08 10:07:47'),
(28, '1', 'Manual', '0', '2025-09-08', '4', '4', '1', '6', '11', '24', 'In', NULL, NULL, NULL, 'Manually Stock In', '2025-09-08 10:19:38', '2025-09-08 10:19:22', '2025-09-08 10:19:38'),
(29, '1', 'Manual', '0', '2025-09-08', '3', '4', '1', '5', '5', '12', 'In', NULL, NULL, NULL, 'Manually Stock In', '2025-09-08 10:32:53', '2025-09-08 10:32:49', '2025-09-08 10:32:53'),
(30, '1', 'Manual', '0', '2025-09-08', '3', '4', '1', '5', '5', '16', 'Out', NULL, NULL, NULL, 'Manually Stock In', '2025-09-08 10:33:21', '2025-09-08 10:33:12', '2025-09-08 10:33:21'),
(31, NULL, 'Opening Stock - Master', '34', '2025-09-12 07:20:09', '3', '4', '1', '5', '34', '24', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-13 09:07:13', '2025-09-08 11:00:52', '2025-09-13 09:07:13'),
(32, NULL, 'Opening Stock - Master', '35', '2025-09-09 10:16:30', '9', '7', '1', '15', '35', '79', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-09 16:50:43', '2025-09-09 10:11:43', '2025-09-09 10:16:30'),
(33, NULL, 'Opening Stock - Master', '36', '2025-09-09 10:11:43', '9', '7', '1', '15', '36', '11', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-09 16:50:44', '2025-09-09 10:11:43', '2025-09-09 10:11:43'),
(34, NULL, 'Opening Stock - Master', '37', '2025-09-09 10:11:43', '9', '7', '1', '15', '37', '16', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-09 16:50:45', '2025-09-09 10:11:43', '2025-09-09 10:11:43'),
(35, NULL, 'Opening Stock - Master', '38', '2025-09-09 10:11:43', '9', '7', '1', '15', '38', '16', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-09 16:50:46', '2025-09-09 10:11:43', '2025-09-09 10:11:43'),
(36, NULL, 'Opening Stock - Master', '39', '2025-09-09 10:11:43', '9', '7', '1', '15', '39', '16', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-09 16:50:47', '2025-09-09 10:11:43', '2025-09-09 10:11:43'),
(37, NULL, 'Opening Stock - Master', '40', '2025-09-09 10:11:43', '9', '7', '1', '15', '40', '12', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-09 16:50:49', '2025-09-09 10:11:43', '2025-09-09 10:11:43'),
(38, NULL, 'Opening Stock - Master', '41', '2025-09-09 10:49:27', '11', '5', '1', '16', '41', '126', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-09 16:50:50', '2025-09-09 10:18:31', '2025-09-09 10:49:27'),
(39, NULL, 'Opening Stock - Master', '42', '2025-09-10 10:58:53', '9', '5', '1', '17', '42', '79', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-09 10:55:43', '2025-09-10 10:58:53'),
(40, '1', 'Manual', '0', '2025-09-09', '9', '5', '1', '17', '42', '8', 'In', NULL, NULL, NULL, 'Manually Stock In', '2025-09-09 12:23:58', '2025-09-09 10:56:43', '2025-09-09 12:23:58'),
(41, NULL, 'Opening Stock - Master', '44', '2025-09-09 11:44:40', '11', '5', '1', '19', '44', '126', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-12 15:42:35', '2025-09-09 11:20:25', '2025-09-09 11:44:40'),
(42, NULL, 'Opening Stock - Master', '46', '2025-09-09 11:42:41', '11', '5', '1', '19', '46', '15', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-12 00:00:00', '2025-09-09 11:42:41', '2025-09-09 11:42:41'),
(43, NULL, 'Opening Stock - Master', '47', '2025-09-09 11:44:40', '11', '5', '1', '19', '47', '96', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-12 00:00:00', '2025-09-09 11:42:41', '2025-09-09 11:44:40'),
(44, NULL, 'Opening Stock - Master', '48', '2025-09-09 11:44:40', '11', '5', '1', '19', '48', '24', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-12 00:00:00', '2025-09-09 11:44:40', '2025-09-09 11:44:40'),
(45, NULL, 'Opening Stock - Master', '49', '2025-09-14 09:39:05', '11', '5', '1', '20', '49', '261', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-09 11:47:57', '2025-09-14 09:39:05'),
(46, NULL, 'Opening Stock - Master', '50', '2025-09-10 11:00:30', '11', '5', '1', '20', '50', '24', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-14 09:39:02', '2025-09-09 11:47:57', '2025-09-14 09:39:02'),
(47, NULL, 'Opening Stock - Master', '51', '2025-09-10 11:00:30', '11', '5', '1', '20', '51', '15', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-14 09:39:03', '2025-09-09 11:47:57', '2025-09-14 09:39:03'),
(48, NULL, 'Opening Stock - Master', '52', '2025-09-10 11:00:30', '11', '5', '1', '20', '52', '96', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-14 09:39:04', '2025-09-09 11:47:57', '2025-09-14 09:39:04'),
(49, NULL, 'Opening Stock - Master', '54', '2025-09-10 11:05:00', '12', '7', '1', '21', '54', '255', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-09 12:18:53', '2025-09-10 11:05:00'),
(50, NULL, 'Opening Stock - Master', '55', '2025-09-10 11:21:26', '13', '7', '1', '22', '55', '66', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-09 12:51:12', '2025-09-10 11:21:26'),
(51, NULL, 'Opening Stock - Master', '57', '2025-09-10 11:05:28', '9', '7', '1', '24', '57', '87', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-09 13:05:05', '2025-09-10 11:05:28'),
(52, NULL, 'Opening Stock - Master', '58', '2025-09-14 09:42:40', '14', '5', '1', '25', '58', '26', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-09 13:26:10', '2025-09-14 09:42:40'),
(53, NULL, 'Opening Stock - Master', '59', '2025-09-10 11:12:34', '14', '5', '1', '25', '59', '5', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-14 09:42:39', '2025-09-09 13:29:05', '2025-09-14 09:42:39'),
(54, NULL, 'Opening Stock - Master', '60', '2025-09-10 11:10:24', '15', '5', '1', '26', '60', '14', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-09 13:40:50', '2025-09-10 11:10:24'),
(55, NULL, 'Opening Stock - Master', '62', '2025-09-10 11:10:24', '15', '5', '1', '26', '62', '14', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-09 13:40:50', '2025-09-10 11:10:24'),
(56, NULL, 'Opening Stock - Master', '63', '2025-09-10 11:15:27', '15', '5', '1', '28', '63', '16', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-09 13:49:26', '2025-09-10 11:15:27'),
(57, NULL, 'Opening Stock - Master', '64', '2025-09-10 11:15:27', '15', '5', '1', '28', '64', '8', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-09 13:49:26', '2025-09-10 11:15:27'),
(58, NULL, 'Opening Stock - Master', '65', '2025-09-10 11:08:05', '15', '5', '1', '29', '65', '27', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-09 13:53:03', '2025-09-10 11:08:05'),
(59, NULL, 'Opening Stock - Master', '66', '2025-09-14 09:43:14', '15', '5', '1', '30', '66', '32', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-09 14:14:43', '2025-09-14 09:43:14'),
(60, NULL, 'Opening Stock - Master', '68', '2025-09-14 09:43:14', '15', '5', '1', '30', '68', '47', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-09 14:14:43', '2025-09-14 09:43:14'),
(61, NULL, 'Opening Stock - Master', '69', '2025-09-10 11:24:15', '15', '5', '1', '30', '69', '3', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-14 09:43:12', '2025-09-09 14:14:43', '2025-09-14 09:43:12'),
(62, NULL, 'Opening Stock - Master', '70', '2025-09-14 09:41:52', '15', '5', '1', '31', '70', '20', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-09 14:23:53', '2025-09-14 09:41:52'),
(63, NULL, 'Opening Stock - Master', '71', '2025-09-10 11:19:29', '15', '5', '1', '31', '71', '6', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-14 09:41:43', '2025-09-09 14:23:53', '2025-09-14 09:41:43'),
(64, NULL, 'Opening Stock - Master', '72', '2025-09-14 09:41:52', '15', '5', '1', '31', '72', '13', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-09 14:23:53', '2025-09-14 09:41:52'),
(65, NULL, 'Opening Stock - Master', '73', '2025-09-10 11:19:29', '15', '5', '1', '31', '73', '6', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-14 09:41:51', '2025-09-09 14:23:53', '2025-09-14 09:41:51'),
(66, NULL, 'Opening Stock - Master', '74', '2025-09-14 09:41:17', '15', '5', '1', '32', '74', '19', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-09 14:33:31', '2025-09-14 09:41:17'),
(67, NULL, 'Opening Stock - Master', '75', '2025-09-10 11:26:31', '15', '5', '1', '32', '75', '5', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-14 09:41:16', '2025-09-09 14:33:31', '2025-09-14 09:41:16'),
(68, NULL, 'Opening Stock - Master', '76', '2025-09-14 09:41:01', '15', '5', '1', '33', '76', '13', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-09 14:39:59', '2025-09-14 09:41:01'),
(69, NULL, 'Opening Stock - Master', '77', '2025-09-10 11:52:25', '15', '5', '1', '33', '77', '6', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-14 09:40:58', '2025-09-09 14:39:59', '2025-09-14 09:40:58'),
(70, NULL, 'Opening Stock - Master', '78', '2025-09-14 09:40:28', '15', '5', '1', '34', '78', '25', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-09 14:42:01', '2025-09-14 09:40:28'),
(71, NULL, 'Opening Stock - Master', '79', '2025-09-10 11:54:26', '15', '5', '1', '34', '79', '6', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-14 09:40:19', '2025-09-09 14:42:01', '2025-09-14 09:40:19'),
(72, NULL, 'Opening Stock - Master', '80', '2025-09-10 11:54:26', '15', '5', '1', '34', '80', '7', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-14 09:40:20', '2025-09-09 14:42:01', '2025-09-14 09:40:20'),
(73, NULL, 'Opening Stock - Master', '81', '2025-09-10 11:54:26', '15', '5', '1', '34', '81', '5', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-14 09:40:21', '2025-09-09 14:42:01', '2025-09-14 09:40:21'),
(74, NULL, 'Opening Stock - Master', '82', '2025-09-10 11:52:57', '15', '5', '1', '35', '82', '6', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-09 14:43:04', '2025-09-10 11:52:57'),
(75, NULL, 'Opening Stock - Master', '83', '2025-09-10 11:33:08', '15', '5', '1', '36', '83', '14', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-09 14:45:31', '2025-09-10 11:33:08'),
(76, NULL, 'Opening Stock - Master', '85', '2025-09-14 09:39:58', '15', '5', '1', '37', '85', '34', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-09 14:45:31', '2025-09-14 09:39:58'),
(77, NULL, 'Opening Stock - Master', '86', '2025-09-10 11:35:57', '15', '5', '1', '37', '86', '6', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-14 09:39:56', '2025-09-09 14:45:31', '2025-09-14 09:39:56'),
(78, NULL, 'Opening Stock - Master', '87', '2025-09-14 09:39:34', '15', '5', '1', '38', '87', '11', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-10 07:59:11', '2025-09-14 09:39:34'),
(79, NULL, 'Opening Stock - Master', '88', '2025-09-10 11:29:58', '15', '5', '1', '38', '88', '5', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-14 09:39:33', '2025-09-10 07:59:11', '2025-09-14 09:39:33'),
(80, NULL, 'Opening Stock - Master', '89', '2025-09-16 07:18:46', '15', '5', '1', '39', '89', '18', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-10 08:02:45', '2025-09-16 07:18:46'),
(81, NULL, 'Opening Stock - Master', '90', '2025-09-10 11:56:46', '15', '5', '1', '39', '90', '4', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-12 10:27:53', '2025-09-10 08:02:45', '2025-09-12 10:27:53'),
(82, NULL, 'Opening Stock - Master', '91', '2025-09-16 07:18:46', '15', '5', '1', '39', '91', '11', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-10 08:02:45', '2025-09-16 07:18:46'),
(83, NULL, 'Opening Stock - Master', '92', '2025-09-10 11:56:46', '15', '5', '1', '39', '92', '4', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-12 10:28:00', '2025-09-10 08:02:45', '2025-09-12 10:28:00'),
(84, NULL, 'Opening Stock - Master', '93', '2025-09-12 10:27:27', '16', '8', '1', '40', '93', '210', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-12 10:51:13', '2025-09-10 08:47:08', '2025-09-12 10:51:13'),
(85, NULL, 'Opening Stock - Master', '94', '2025-09-11 08:11:29', '16', '8', '1', '40', '94', '126', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-12 10:27:01', '2025-09-10 08:47:08', '2025-09-12 10:27:01'),
(86, NULL, 'Opening Stock - Master', '95', '2025-09-11 08:11:29', '16', '8', '1', '40', '95', '24', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-12 10:27:01', '2025-09-10 08:47:08', '2025-09-12 10:27:01'),
(87, NULL, 'Opening Stock - Master', '96', '2025-09-11 08:11:29', '16', '8', '1', '40', '96', '9', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-12 10:27:02', '2025-09-10 08:47:08', '2025-09-12 10:27:02'),
(88, NULL, 'Opening Stock - Master', '99', '2025-09-12 07:20:57', '17', '7', '1', '42', '99', '28', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-12 09:05:07', '2025-09-10 09:36:37', '2025-09-12 09:05:07'),
(89, NULL, 'Opening Stock - Master', '100', '2025-09-12 07:20:57', '17', '7', '1', '42', '100', '6', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-12 09:05:07', '2025-09-10 09:36:37', '2025-09-12 09:05:07'),
(90, NULL, 'Opening Stock - Master', '101', '2025-09-12 07:20:57', '17', '7', '1', '42', '101', '35', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-12 09:05:07', '2025-09-10 09:36:37', '2025-09-12 09:05:07'),
(91, NULL, 'Opening Stock - Master', '102', '2025-09-12 07:20:57', '17', '7', '1', '42', '102', '5', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-12 09:05:07', '2025-09-10 09:36:37', '2025-09-12 09:05:07'),
(92, NULL, 'Opening Stock - Master', '103', '2025-09-12 09:04:03', '17', '7', '1', '43', '103', '21', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-12 09:05:05', '2025-09-10 12:11:33', '2025-09-12 09:05:05'),
(93, NULL, 'Opening Stock - Master', '104', '2025-09-10 12:20:06', '17', '7', '1', '43', '104', '14', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-12 09:05:05', '2025-09-10 12:11:33', '2025-09-12 09:05:05'),
(94, NULL, 'Opening Stock - Master', '105', '2025-09-10 12:20:06', '17', '7', '1', '43', '105', '5', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-12 09:05:05', '2025-09-10 12:11:33', '2025-09-12 09:05:05'),
(95, NULL, 'Opening Stock - Master', '107', '2025-09-12 09:04:03', '17', '7', '1', '43', '107', '55', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-12 09:05:05', '2025-09-10 12:25:34', '2025-09-12 09:05:05'),
(96, NULL, 'Opening Stock - Master', '108', '2025-09-12 07:20:36', '17', '7', '1', '43', '108', '21', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-12 08:54:45', '2025-09-10 12:25:34', '2025-09-12 08:54:45'),
(97, NULL, 'Opening Stock - Master', '109', '2025-09-12 07:20:44', '19', '7', '1', '44', '109', '39', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-11 11:05:19', '2025-09-12 07:20:44'),
(98, NULL, 'Opening Stock - Master', '110', '2025-09-12 10:42:26', '18', '10', '1', '45', '110', '84', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-13 08:59:11', '2025-09-11 13:04:30', '2025-09-13 08:59:11'),
(99, NULL, 'Opening Stock - Master', '111', '2025-09-12 07:20:01', '18', '10', '1', '45', '111', '24', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-12 10:25:58', '2025-09-11 13:04:30', '2025-09-12 10:25:58'),
(100, NULL, 'Opening Stock - Master', '112', '2025-09-12 07:20:01', '18', '10', '1', '45', '112', '12', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-12 10:25:58', '2025-09-11 13:04:30', '2025-09-12 10:25:58'),
(101, NULL, 'Opening Stock - Master', '113', '2025-09-12 07:20:01', '18', '10', '1', '45', '113', '12', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-12 10:25:59', '2025-09-11 13:04:30', '2025-09-12 10:25:59'),
(102, NULL, 'Opening Stock - Master', '114', '2025-09-12 07:20:01', '18', '10', '1', '45', '114', '4', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-12 10:26:00', '2025-09-11 13:04:30', '2025-09-12 10:26:00'),
(103, NULL, 'Opening Stock - Master', '115', '2025-09-12 07:20:01', '18', '10', '1', '45', '115', '8', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-12 10:26:01', '2025-09-11 13:04:30', '2025-09-12 10:26:01'),
(104, NULL, 'Opening Stock - Master', '116', '2025-09-12 07:20:01', '18', '10', '1', '45', '116', '12', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-12 10:26:02', '2025-09-11 13:04:30', '2025-09-12 10:26:02'),
(105, NULL, 'Opening Stock - Master', '119', '2025-09-12 10:36:04', '20', '11', '1', '47', '119', '28', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-12 10:00:41', '2025-09-12 10:36:04'),
(106, NULL, 'Opening Stock - Master', '120', '2025-09-12 10:36:04', '20', '11', '1', '47', '120', '40', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-12 10:09:20', '2025-09-12 10:36:04'),
(107, NULL, 'Opening Stock - Master', '124', '2025-09-12 10:38:48', '20', '11', '1', '48', '124', '21', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-12 10:36:04', '2025-09-12 10:38:48'),
(108, NULL, 'Opening Stock - Master', '125', '2025-09-12 10:38:48', '20', '11', '1', '48', '125', '19', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-12 10:36:04', '2025-09-12 10:38:48'),
(109, NULL, 'Opening Stock - Master', '126', '2025-09-12 10:53:09', '16', '8', '2', '49', '126', '210', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-12 10:53:09', '2025-09-12 10:53:09'),
(110, NULL, 'Opening Stock - Master', '127', '2025-09-12 11:12:40', '20', '7', '1', '50', '127', '48', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-12 11:07:42', '2025-09-12 11:12:40'),
(111, NULL, 'Opening Stock - Master', '128', '2025-09-12 11:45:05', '20', '12', '1', '51', '128', '50', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-12 11:23:27', '2025-09-12 11:45:05'),
(112, NULL, 'Opening Stock - Master', '129', '2025-09-12 11:45:05', '20', '12', '1', '51', '129', '26', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-12 11:23:27', '2025-09-12 11:45:05'),
(113, NULL, 'Opening Stock - Master', '130', '2025-09-12 11:44:14', '21', '7', '1', '52', '130', '70', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-12 11:40:49', '2025-09-12 11:44:14'),
(114, NULL, 'Opening Stock - Master', '131', '2025-09-13 07:18:35', '22', '13', '1', '53', '131', '6', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-12 11:49:41', '2025-09-13 07:18:35'),
(115, NULL, 'Opening Stock - Master', '133', '2025-09-16 13:47:44', '23', '8', '1', '55', '133', '95', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-13 07:03:48', '2025-09-16 08:17:44'),
(116, NULL, 'Opening Stock - Master', '134', '2025-09-13 07:38:47', '4', '4', '2', '56', '134', '112', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-13 07:39:02', '2025-09-13 07:38:31', '2025-09-13 07:39:02'),
(117, NULL, 'Opening Stock - Master', '135', '2025-09-13 07:40:14', '4', '4', '2', '57', '135', '112', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-13 07:43:28', '2025-09-13 07:40:14', '2025-09-13 07:43:28'),
(118, NULL, 'Opening Stock - Master', '136', '2025-09-13 09:30:42', '4', '4', '2', '58', '136', '112', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-13 07:45:03', '2025-09-13 09:30:42'),
(119, NULL, 'Opening Stock - Master', '137', '2025-09-13 09:30:32', '18', '10', '2', '59', '137', '48', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-13 09:03:15', '2025-09-13 09:30:32'),
(120, NULL, 'Opening Stock - Master', '138', '2025-09-13 09:30:18', '3', '4', '2', '60', '138', '152', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-13 09:12:37', '2025-09-13 09:30:18'),
(121, NULL, 'Opening Stock - Master', '139', '2025-09-13 14:09:29', '24', '14', '2', '61', '139', '213', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-13 10:06:11', '2025-09-13 14:09:29'),
(122, NULL, 'Opening Stock - Master', '140', '2025-09-13 10:22:47', '25', '15', '2', '62', '140', '195', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-13 10:22:47', '2025-09-13 10:22:47'),
(123, NULL, 'Opening Stock - Master', '141', '2025-09-13 11:18:54', '26', '15', '2', '63', '141', '635', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-13 10:25:27', '2025-09-13 11:18:54'),
(124, NULL, 'Opening Stock - Master', '142', '2025-09-13 12:10:09', '27', '15', '2', '64', '142', '210', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-13 12:10:09', '2025-09-13 12:10:09'),
(125, NULL, 'Opening Stock - Master', '143', '2025-09-13 12:47:42', '25', '15', '2', '65', '143', '131', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-13 12:47:42', '2025-09-13 12:47:42'),
(126, NULL, 'Opening Stock - Master', '144', '2025-09-13 13:35:35', '28', '16', '2', '66', '144', '76', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-13 13:35:35', '2025-09-13 13:35:35'),
(127, NULL, 'Opening Stock - Master', '145', '2025-09-14 06:53:57', '30', '17', '2', '67', '145', '65', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-14 06:55:01', '2025-09-13 13:50:12', '2025-09-14 06:55:01'),
(128, '1', 'Manual', '0', '2025-09-13', '9', '7', '1', '24', '57', '24', 'Out', NULL, NULL, NULL, 'Manually Stock In', NULL, '2025-09-13 14:22:04', '2025-09-13 14:22:04'),
(129, '1', 'Manual', '0', '2025-09-13', '24', '14', '2', '61', '139', '90', 'In', NULL, NULL, NULL, 'Manually Stock In', NULL, '2025-09-13 14:28:43', '2025-09-13 14:28:43'),
(130, NULL, 'Opening Stock - Master', '146', '2025-09-14 06:55:22', '30', '17', '2', '68', '146', '65', 'In', NULL, NULL, NULL, 'Master Stock In', '2025-09-15 11:04:17', '2025-09-14 06:55:22', '2025-09-15 11:04:17'),
(131, NULL, 'Opening Stock - Master', '148', '2025-09-14 08:30:54', '31', '18', '1', '70', '148', '360', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-14 07:31:04', '2025-09-14 08:30:54'),
(132, NULL, 'Opening Stock - Master', '149', '2025-09-14 09:03:02', '31', '18', '1', '71', '149', '252', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-14 08:30:54', '2025-09-14 09:03:02'),
(133, NULL, 'Opening Stock - Master', '150', '2025-09-14 09:03:02', '31', '18', '1', '72', '150', '174', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-14 09:03:02', '2025-09-14 09:03:02'),
(134, '1', 'Manual', '0', '2025-09-14', '15', '5', '1', '30', '66', '8', 'Out', NULL, NULL, NULL, 'Manually Stock In', NULL, '2025-09-14 09:23:57', '2025-09-14 09:23:57'),
(135, '1', 'Manual', '0', '2025-09-14', '15', '5', '1', '30', '68', '8', 'Out', NULL, NULL, NULL, 'Manually Stock In', NULL, '2025-09-14 09:25:00', '2025-09-14 09:25:00'),
(136, NULL, 'Opening Stock - Master', '151', '2025-09-14 10:46:09', '32', '7', '1', '73', '151', '282', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-14 10:39:54', '2025-09-14 10:46:09'),
(137, NULL, 'Opening Stock - Master', '152', '2025-09-14 12:28:15', '33', '7', '1', '74', '152', '214', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-14 12:28:15', '2025-09-14 12:28:15'),
(138, NULL, 'Opening Stock - Master', '153', '2025-09-15 11:04:42', '35', '17', '2', '75', '153', '65', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-15 11:04:42', '2025-09-15 11:04:42'),
(139, '1', 'Manual', '0', '2025-09-15', '31', '18', '1', '71', '149', '9', 'Out', NULL, NULL, NULL, 'Manually Stock In', NULL, '2025-09-16 06:22:39', '2025-09-16 06:22:39'),
(140, '1', 'Manual', '0', '2025-09-15', '31', '18', '1', '72', '150', '9', 'Out', NULL, NULL, NULL, 'Manually Stock In', NULL, '2025-09-16 06:23:20', '2025-09-16 06:23:20'),
(141, '1', 'Manual', '0', '2025-09-15', '31', '18', '1', '70', '148', '9', 'Out', NULL, NULL, NULL, 'Manually Stock In', NULL, '2025-09-16 06:23:52', '2025-09-16 06:23:52'),
(142, '1', 'Manual', '0', '2025-09-15', '31', '18', '1', '70', '148', '9', 'Out', NULL, NULL, NULL, 'Manually Stock In', NULL, '2025-09-16 06:25:15', '2025-09-16 06:25:15'),
(143, '1', 'Manual', '0', '2025-09-15', '15', '5', '1', '30', '66', '8', 'Out', NULL, NULL, NULL, 'Manually Stock In', NULL, '2025-09-16 06:48:22', '2025-09-16 06:48:22'),
(144, '1', 'Manual', '0', '2025-09-15', '15', '5', '1', '30', '68', '8', 'Out', NULL, NULL, NULL, 'Manually Stock In', NULL, '2025-09-16 06:48:34', '2025-09-16 06:48:34'),
(145, '1', 'Manual', '0', '2025-09-15', '15', '5', '1', '39', '89', '7', 'Out', NULL, NULL, NULL, 'Manually Stock In', NULL, '2025-09-16 06:49:06', '2025-09-16 06:49:06'),
(146, '1', 'Manual', '0', '2025-09-15', '15', '5', '1', '39', '91', '7', 'Out', NULL, NULL, NULL, 'Manually Stock In', '2025-09-16 07:04:55', '2025-09-16 06:49:17', '2025-09-16 07:04:55'),
(147, '1', 'Manual', '0', '2025-09-16', '5', '5', '1', '7', '17', '4', 'In', NULL, NULL, NULL, 'Manually Stock In', NULL, '2025-09-16 06:56:08', '2025-09-16 06:56:08'),
(148, '1', 'Manual', '0', '2025-09-15', '15', '5', '1', '28', '63', '6', 'Out', NULL, NULL, NULL, 'Manually Stock In', NULL, '2025-09-16 07:12:32', '2025-09-16 07:12:32'),
(149, '1', 'Manual', '0', '2025-09-15', '15', '5', '1', '28', '64', '5', 'Out', NULL, NULL, NULL, 'Manually Stock In', NULL, '2025-09-16 07:12:47', '2025-09-16 07:12:47'),
(150, '1', 'Manual', '0', '2025-09-15', '15', '5', '1', '33', '76', '7', 'Out', NULL, NULL, NULL, 'Manually Stock In', NULL, '2025-09-16 07:14:02', '2025-09-16 07:14:02'),
(151, '1', 'Manual', '0', '2025-09-15', '15', '5', '1', '36', '83', '7', 'Out', NULL, NULL, NULL, 'Manually Stock In', NULL, '2025-09-16 07:15:04', '2025-09-16 07:15:04'),
(152, '1', 'Manual', '0', '2025-09-15', '15', '5', '1', '39', '91', '7', 'Out', NULL, NULL, NULL, 'Manually Stock In', NULL, '2025-09-16 07:19:00', '2025-09-16 07:19:00'),
(153, '1', 'Manual', '0', '2025-09-15', '12', '7', '1', '21', '54', '6', 'Out', NULL, NULL, NULL, 'Manually Stock In', NULL, '2025-09-16 07:25:05', '2025-09-16 07:25:05'),
(154, '1', 'Manual', '0', '2025-09-15', '5', '5', '1', '10', '25', '18', 'Out', NULL, NULL, NULL, 'Manually Stock In', '2025-09-16 07:30:49', '2025-09-16 07:28:14', '2025-09-16 07:30:49'),
(155, '1', 'Manual', '0', '2025-09-15', '5', '5', '1', '7', '17', '18', 'Out', NULL, NULL, NULL, 'Manually Stock In', NULL, '2025-09-16 07:33:16', '2025-09-16 07:33:16'),
(156, NULL, 'Opening Stock - Master', '154', '2025-09-20 11:20:45', '36', '6', '2', '76', '154', '156', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-16 11:45:45', '2025-09-20 05:50:45'),
(157, '1', 'Manual', '0', '2025-09-16', '36', '6', '2', '76', '154', '3', 'In', NULL, NULL, NULL, 'Manually Stock In', NULL, '2025-09-16 12:32:05', '2025-09-16 12:32:05'),
(158, '1', 'Manual', '0', '2025-09-16', '24', '14', '2', '61', '139', '10', 'In', NULL, NULL, NULL, 'Manually Stock In', NULL, '2025-09-16 12:43:40', '2025-09-16 12:43:40'),
(159, '1', 'Manual', '0', '2025-09-16', '5', '5', '1', '7', '17', '20', 'In', NULL, NULL, NULL, 'Manually Stock In', '2025-09-16 12:46:14', '2025-09-16 12:45:41', '2025-09-16 12:46:14'),
(160, '1', 'Manual', '0', '2025-09-16', '24', '14', '2', '61', '139', '20', 'In', NULL, NULL, NULL, 'Manually Stock In', NULL, '2025-09-16 12:47:18', '2025-09-16 12:47:18'),
(161, NULL, 'Purchase Stock - 4', '156', '2025-09-16 14:03:17', '4', '4', '1', '78', '156', '1400', 'In', NULL, NULL, NULL, 'Purchase Stock In - 4', NULL, '2025-09-16 08:32:34', '2025-09-16 08:33:17'),
(162, NULL, 'Purchase Stock - 4', '157', '2025-09-16 14:03:17', '4', '4', '1', '78', '157', '200', 'In', NULL, NULL, NULL, 'Purchase Stock In - 4', NULL, '2025-09-16 08:32:34', '2025-09-16 08:33:17'),
(163, '1', 'Sale', '2', '2025-09-16', '36', '6', '2', '76', '154', '9', 'Out', '200', NULL, NULL, 'Sale Stock Out - 2', NULL, '2025-09-16 08:35:41', '2025-09-16 08:35:41'),
(164, '1', 'Sale', '2', '2025-09-16', '35', '17', '2', '75', '153', '1', 'Out', '600', NULL, NULL, 'Sale Stock Out - 2', NULL, '2025-09-16 08:35:41', '2025-09-16 08:35:41'),
(165, '1', 'Sale', '2', '2025-09-16', '33', '7', '1', '74', '152', '5', 'Out', '90', NULL, NULL, 'Sale Stock Out - 2', NULL, '2025-09-16 08:35:41', '2025-09-16 08:35:41'),
(166, NULL, 'Purchase Stock - 5', '158', '2025-09-17 02:49:47', '3', '4', '1', '79', '158', '250', 'In', NULL, NULL, NULL, 'Purchase Stock In - 5', NULL, '2025-09-16 21:16:51', '2025-09-16 21:19:47'),
(167, NULL, 'Purchase Stock - 5', '159', '2025-09-17 02:49:47', '3', '4', '1', '79', '159', '250', 'In', NULL, NULL, NULL, 'Purchase Stock In - 5', NULL, '2025-09-16 21:16:51', '2025-09-16 21:19:47'),
(168, '1', 'Sale', '3', '2025-09-17', '3', '4', '1', '79', '158', '5', 'Out', '350', '250', NULL, 'Sale Stock Out - 3', '2025-09-19 06:13:44', '2025-09-16 21:37:44', '2025-09-19 06:13:44'),
(169, '1', 'Sale', '3', '2025-09-17', '3', '4', '1', '79', '159', '5', 'Out', '350', '250', NULL, 'Sale Stock Out - 3', '2025-09-19 06:13:44', '2025-09-16 21:37:44', '2025-09-19 06:13:44'),
(170, NULL, 'Opening Stock - Master', '160', '2025-09-20 05:44:48', '37', '20', '2', '80', '160', '6', 'In', NULL, NULL, NULL, 'Master Stock In', NULL, '2025-09-20 00:14:48', '2025-09-20 00:14:48');

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
(5, '2025_08_18_183944_create_categories_table', 2),
(6, '2025_08_18_184053_create_brands_table', 2),
(7, '2025_08_18_185640_create_items_table', 3),
(8, '2025_08_18_185715_create_item_details_table', 3),
(9, '2025_08_18_191832_create_manage_stocks_table', 4);

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
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'CASH', '1', NULL, '2025-09-09 23:16:27', '2025-09-09 23:16:27'),
(2, 'UPI', '1', NULL, '2025-09-09 23:16:29', '2025-09-09 23:16:37'),
(4, 'DISCOUNT', '1', NULL, '2025-09-14 11:17:57', '2025-09-14 11:17:57'),
(5, 'NEFT', '1', NULL, '2025-09-14 11:18:04', '2025-09-14 11:18:04'),
(6, 'CHEQUE', '1', NULL, '2025-09-16 08:26:50', '2025-09-16 08:26:50');

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
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_items` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_quantity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_mutha` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_paid_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_purchase_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_pending_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`id`, `purchase_no`, `purchase_date`, `vendor_id`, `total_items`, `total_quantity`, `total_mutha`, `total_paid_amount`, `total_purchase_amount`, `total_pending_amount`, `payment_method`, `status`, `remarks`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'PO-01', '2025-09-15', '1', '2', '1250', '200.00', NULL, '3000.00', '1000', NULL, '1', NULL, '2025-09-16 06:45:20', '2025-09-15 01:53:11', '2025-09-16 01:15:20'),
(2, 'PO-02', '2025-09-15', '1', '2', '1250', '200.00', NULL, '3000.00', '2000', '[\"CASH\"]', '1', NULL, '2025-09-16 06:52:10', '2025-09-15 01:53:18', '2025-09-16 01:22:10'),
(3, 'PO-03', '2025-09-16', '1', '2', '900', '140.00', NULL, '2400.00', '2400', 'null', '1', NULL, '2025-09-17 02:47:31', '2025-09-16 08:31:52', '2025-09-16 21:17:31'),
(4, 'PO-04', '2025-09-16', '1', '2', '1600', '240.00', NULL, '2400.00', '2400', 'null', '1', NULL, NULL, '2025-09-16 08:32:34', '2025-09-16 08:33:17'),
(5, 'PO-05', '2025-09-17', '1', '2', '500', '100.00', NULL, '2500.00', '500', '[\"CASH\"]', '1', NULL, NULL, '2025-09-16 21:16:51', '2025-09-16 21:19:24');

-- --------------------------------------------------------

--
-- Table structure for table `sale_orders`
--

CREATE TABLE `sale_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_sale_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_quantity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_paid_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_items` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_pending_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_orders`
--

INSERT INTO `sale_orders` (`id`, `sale_no`, `sale_date`, `account_id`, `total_sale_amount`, `total_quantity`, `total_paid_amount`, `payment_method`, `total_items`, `total_pending_amount`, `status`, `remarks`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'AF-01', '2025-09-16', '2', '2850.00', '15', '0', 'null', '3', '2850', '1', NULL, '2025-09-17 03:07:51', '2025-09-16 08:35:08', '2025-09-16 21:37:51'),
(2, 'AF-02', '2025-09-16', '2', '2850.00', '15', '0', 'null', '3', '2850', '1', NULL, NULL, '2025-09-16 08:35:41', '2025-09-16 08:35:41'),
(3, 'AF-03', '2025-09-17', '2', '3500.00', '10', '3000', '[\"CASH\"]', '2', '500', '1', NULL, '2025-09-19 11:43:44', '2025-09-16 21:37:44', '2025-09-19 06:13:44');

-- --------------------------------------------------------

--
-- Table structure for table `seasons`
--

CREATE TABLE `seasons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seasons`
--

INSERT INTO `seasons` (`id`, `name`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'SUMMER', '1', NULL, '2025-09-09 02:47:29', '2025-09-09 02:47:29'),
(2, 'WINTER', '1', NULL, '2025-09-09 02:47:35', '2025-09-09 02:47:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `show_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_as` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `show_password`, `role_as`, `created_by_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Store', 'admin@store.com', '1234567890', '2025-08-18 13:09:04', '$2y$10$rYU7AEZcEi6qQL/Zz9/Xa.WrI1pTc6yo8dzQ8KsqB9YJ4Pg0aPTF.', 'admin@store.com', 'Admin', '0', 'lUh4Ev9npkIsNxX2d0Kn5xobbEGzzwyuey4EzQTOoIaPw1kmSEz52hoL8h9K', '2025-08-18 13:09:04', '2025-08-18 13:09:04');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `debit_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_masters`
--
ALTER TABLE `account_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_details`
--
ALTER TABLE `item_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ledgers`
--
ALTER TABLE `ledgers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_stocks`
--
ALTER TABLE `manage_stocks`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_orders`
--
ALTER TABLE `sale_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seasons`
--
ALTER TABLE `seasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_masters`
--
ALTER TABLE `account_masters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `item_details`
--
ALTER TABLE `item_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `ledgers`
--
ALTER TABLE `ledgers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `manage_stocks`
--
ALTER TABLE `manage_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sale_orders`
--
ALTER TABLE `sale_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `seasons`
--
ALTER TABLE `seasons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
