-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 26, 2021 at 07:27 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `optics`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `branch_id`, `branch_name`, `created_at`, `updated_at`) VALUES
(1, '7662740', 'Doha Branch', '2021-03-30 16:05:32', '2021-03-30 16:05:32');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `category_id`, `brand_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Addidas', '2021-03-30 16:06:36', '2021-03-30 16:06:36'),
(2, 1, 'Seiko', '2021-03-30 16:06:49', '2021-03-30 16:06:49'),
(3, 2, 'Persage', '2021-03-30 16:06:59', '2021-03-30 16:06:59');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 0, 'Sun Glasses', '2021-03-30 16:06:08', '2021-03-30 16:06:08'),
(2, 0, 'Frames', '2021-03-30 16:06:20', '2021-03-30 16:06:20');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'normal',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `english_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `local_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date NOT NULL,
  `prefered_language` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `national_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dial_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receive_notifications` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `office_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_spent` double(8,2) NOT NULL DEFAULT 0.00,
  `total_points` int(11) NOT NULL DEFAULT 0,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `moftah_club` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_id`, `customer_type`, `title`, `english_name`, `local_name`, `gender`, `birth_date`, `prefered_language`, `nationality`, `national_id`, `age`, `country`, `city`, `address`, `dial_code`, `mobile_number`, `email`, `receive_notifications`, `office_number`, `total_spent`, `total_points`, `notes`, `moftah_club`, `created_at`, `updated_at`) VALUES
(1, '854243280', 'normal', 'Her Highness', 'Mahmoud Wahba', NULL, 'Male', '2017-02-02', 'English', 'qatari', NULL, '41', 'Qatar', 'Al Ghuwayriyah', 'Ahmed, Arada', '974', '1234546t4', 'ar324@optics.com', 'Email Notifications', NULL, 0.00, 0, 'Nothing', 0, '2021-04-09 17:28:39', '2021-04-09 17:28:39'),
(2, '649545611', 'normal', 'Dr', 'Moaaz Mohamed', 'معاذ محمد', 'Male', '2005-02-11', 'English', 'qatari', '234909249', '16', 'Qatar', 'Al Ghuwayriyah', 'qatar, street 989', '974', '01030485736', 'moaaz34@gmail.com', 'Email Notifications', '23894092', 0.00, 0, 'Nothing', 0, '2021-04-10 13:29:17', '2021-04-10 13:29:17'),
(3, '108341532', 'normal', 'Dr', 'Mariem Mohamed', 'مريم محمد', 'Female', '1996-03-13', 'English', 'qatari', '354765623', '25', 'Qatar', 'Al Ghuwayriyah', 'Noser', '974', '01030572567', 'mariem45@gmail.com', 'Email Notifications', '09235', 0.00, 0, 'N', 0, '2021-04-11 09:35:47', '2021-04-11 09:35:47');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'Ameer Heba', '438631950', '2021-03-30 16:05:50', '2021-03-30 16:05:50');

-- --------------------------------------------------------

--
-- Table structure for table `glass_lenses`
--

CREATE TABLE `glass_lenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `index` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `frame_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lense_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `life_style` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_activity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lense_tech` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clarity_tech` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `glasses_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `retail_price` double(8,2) NOT NULL,
  `product_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `glass_lenses`
--

INSERT INTO `glass_lenses` (`id`, `index`, `frame_type`, `lense_type`, `life_style`, `customer_activity`, `lense_tech`, `clarity_tech`, `glasses_type`, `price`, `retail_price`, `product_id`, `description`, `amount`, `created_at`, `updated_at`) VALUES
(1, '1.5', 'HBC Frame', 'All Distance Lense', 'Normal', 'Clear / Tintable', 'HD', 'Super Invisible', 'Reading', 200.00, 400.00, '776262700', 'Loreama Normal HBC', 3, '2021-04-25 16:55:04', '2021-04-26 15:24:31'),
(2, '1.5', 'Full Frame', 'Biofocal', 'Active', 'Transition', 'HD', 'Super Invisible', 'Reading', 600.00, 650.00, '734819131', 'Loram', 24, '2021-04-25 16:55:32', '2021-04-26 15:24:32');

-- --------------------------------------------------------

--
-- Table structure for table `glass_models`
--

CREATE TABLE `glass_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `model_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `glass_models`
--

INSERT INTO `glass_models` (`id`, `category_id`, `brand_id`, `model_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'ADD002', '2021-03-30 16:07:27', '2021-03-30 16:07:27'),
(2, 1, 1, 'ADD034', '2021-03-30 16:07:39', '2021-03-30 16:07:39'),
(3, 1, 2, 'SX007RJ', '2021-03-30 16:07:54', '2021-03-30 16:07:54'),
(4, 2, 3, 'PSG098', '2021-03-30 16:08:09', '2021-03-30 16:08:09'),
(5, 2, 3, 'PERS00XRJ', '2021-04-09 15:12:03', '2021-04-09 15:12:03');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_code` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pickup_date` date NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_way` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paied` double(8,2) NOT NULL,
  `remaining` double(8,2) NOT NULL,
  `total` double(8,2) NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tray_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_reason` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_value` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_code`, `customer_id`, `doctor_id`, `user_id`, `pickup_date`, `status`, `payment_way`, `paied`, `remaining`, `total`, `notes`, `tray_number`, `return_reason`, `discount_type`, `discount_value`, `created_at`, `updated_at`) VALUES
(1, 184657940, 108341532, 438631950, 1, '2021-05-08', 'pending', 'Cash', 400.00, 1000.00, 1400.00, NULL, NULL, NULL, 'fixed', NULL, '2021-04-26 15:24:31', '2021-04-26 15:24:31');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `net` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_items`
--

INSERT INTO `invoice_items` (`id`, `invoice_id`, `product_id`, `quantity`, `price`, `net`, `tax`, `total`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, 776262700, '1', '200', '200', '0', '200', 'lens', '2021-04-26 15:24:31', '2021-04-26 15:24:31'),
(2, 1, 734819131, '1', '600', '600', '0', '600', 'lens', '2021-04-26 15:24:32', '2021-04-26 15:24:32'),
(3, 1, 122211222, '1', '500', '500', '0', '600', 'product', '2021-04-26 15:24:32', '2021-04-26 15:24:32');

-- --------------------------------------------------------

--
-- Table structure for table `lenses`
--

CREATE TABLE `lenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `doctor_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visit_date` date NOT NULL,
  `sph_right_sign` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sph_right_value` double(8,2) NOT NULL,
  `cyl_right_sign` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cyl_right_value` double(8,2) NOT NULL,
  `axis_right` double(8,2) NOT NULL,
  `addition_right` double(8,2) NOT NULL,
  `pd_right` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sph_left_sign` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sph_left_value` double(8,2) NOT NULL,
  `cyl_left_sign` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cyl_left_value` double(8,2) NOT NULL,
  `axis_left` double(8,2) NOT NULL,
  `addition_left` double(8,2) NOT NULL,
  `pd_left` double(8,2) NOT NULL,
  `right_diagnosis` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `left_diagnosis` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `glasses` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lenses`
--

INSERT INTO `lenses` (`id`, `customer_id`, `doctor_id`, `invoice_id`, `visit_date`, `sph_right_sign`, `sph_right_value`, `cyl_right_sign`, `cyl_right_value`, `axis_right`, `addition_right`, `pd_right`, `sph_left_sign`, `sph_left_value`, `cyl_left_sign`, `cyl_left_value`, `axis_left`, `addition_left`, `pd_left`, `right_diagnosis`, `left_diagnosis`, `glasses`, `created_at`, `updated_at`) VALUES
(1, '210541270', '438631950', '1', '2021-04-04', '-', 0.75, '+', 4.50, 3.00, 0.75, '4', '+', 0.75, '+', 4.25, 7.00, 0.25, 4.00, '[\"2\",\"4\"]', '[\"1\"]', 'Distance', '2021-04-04 15:53:06', '2021-04-04 15:53:06'),
(2, '210541270', '438631950', '1', '2021-04-07', '+', 0.75, '+', 0.75, 3.00, 0.50, '2', '+', 0.75, '+', 1.25, 7.00, 1.00, 4.00, '[\"1\"]', '[\"1\"]', 'Distance', '2021-04-07 07:07:47', '2021-04-07 07:07:47'),
(3, '210541270', '438631950', '1', '2021-04-09', '+', 0.50, '+', 1.00, 4.00, 0.75, '-4', '+', 0.75, '+', 1.50, 3.00, 0.75, 2.00, '[\"1\"]', '[\"2\"]', 'Distance', '2021-04-09 15:44:44', '2021-04-09 15:44:44');

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
(3, '2021_02_06_083203_laratrust_setup_tables', 1),
(5, '2021_02_17_164149_create_categories_table', 1),
(7, '2021_02_19_142206_create_branches_table', 1),
(8, '2021_02_25_110252_create_brands_table', 1),
(9, '2021_02_25_131853_create_glass_models_table', 1),
(10, '2021_03_12_190359_doctors', 1),
(16, '2021_03_30_174128_lenses', 2),
(20, '2021_02_08_173948_create_customers_table', 5),
(30, '2021_03_19_224548_create_invoice_items_table', 9),
(33, '2021_04_18_015924_payments', 11),
(35, '2021_02_19_141833_create_products_table', 13),
(36, '2021_04_01_151628_create_glass_lenses_table', 14),
(38, '2021_03_19_222219_create_invoices_table', 15);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration_date` date NOT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payed_amount` double(8,2) NOT NULL,
  `exchange_rate` int(11) NOT NULL,
  `local_payment` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `invoice_id`, `type`, `bank`, `card_number`, `expiration_date`, `currency`, `payed_amount`, `exchange_rate`, `local_payment`, `created_at`, `updated_at`) VALUES
(1, 7, 'Cash', 'Al Ahly', '340593534', '2021-04-20', 'QAR', 720.00, 1, NULL, '2021-04-18 00:37:42', '2021-04-18 00:37:42'),
(2, 8, 'Cash', 'Al Ahly', '340593534', '2021-04-20', 'QAR', 720.00, 1, NULL, '2021-04-18 00:39:16', '2021-04-18 00:39:16'),
(3, 9, 'Cash', 'Al Ahly', '340593534', '2021-04-20', 'QAR', 720.00, 1, NULL, '2021-04-18 00:39:21', '2021-04-18 00:39:21'),
(4, 1, 'Cash', 'Ahly', '4309580495209', '2021-04-30', 'QAR', 960.00, 1, NULL, '2021-04-19 19:10:58', '2021-04-19 19:10:58'),
(5, 2, 'Cash', 'Ahly', '4309580495209', '2021-04-30', 'QAR', 960.00, 1, NULL, '2021-04-19 19:11:03', '2021-04-19 19:11:03'),
(6, 3, 'Cash', 'Alahly', '48953489439', '2021-04-27', 'QAR', 160.00, 1, NULL, '2021-04-19 19:31:42', '2021-04-19 19:31:42'),
(7, 1, 'Cash', 'CIB', '2378942894289', '2021-05-07', 'QAR', 0.00, 1, 0.00, '2021-04-25 21:33:40', '2021-04-25 21:33:40'),
(8, 2, 'Cash', 'NBK', '3459309500', '2021-04-29', 'QAR', 0.00, 1, 0.00, '2021-04-25 22:55:18', '2021-04-25 22:55:18'),
(9, 3, 'Cash', 'Ahly', '349005694', '2021-05-07', 'QAR', 0.00, 1, 0.00, '2021-04-25 23:00:51', '2021-04-25 23:00:51'),
(10, 4, 'Cash', 'Ahly', '349005694', '2021-05-07', 'QAR', 0.00, 1, 0.00, '2021-04-25 23:01:06', '2021-04-25 23:01:06'),
(11, 5, 'Cash', 'Ahly', '349005694', '2021-05-07', 'QAR', 0.00, 1, 0.00, '2021-04-25 23:01:22', '2021-04-25 23:01:22'),
(12, 6, 'Cash', 'Ahly', '349005694', '2021-05-07', 'QAR', 0.00, 1, 0.00, '2021-04-25 23:01:33', '2021-04-25 23:01:33'),
(13, 7, 'Cash', 'Ahly', '349005694', '2021-05-07', 'QAR', 0.00, 1, 0.00, '2021-04-25 23:01:45', '2021-04-25 23:01:45'),
(14, 8, 'Cash', 'Ahly', '2594092040', '2021-05-08', 'QAR', 0.00, 1, 0.00, '2021-04-25 23:02:25', '2021-04-25 23:02:25'),
(15, 9, 'Cash', 'CIB', '44565776878', '2021-05-08', 'QAR', 0.00, 1, 0.00, '2021-04-25 23:06:14', '2021-04-25 23:06:14'),
(16, 1, 'Cash', 'Ahly', '340953094508', '2025-12-26', 'QAR', 0.00, 1, 0.00, '2021-04-26 15:24:31', '2021-04-26 15:24:31');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'create_users', 'Create Users', 'Create Users', '2021-03-30 16:00:45', '2021-03-30 16:00:45'),
(2, 'read_users', 'Read Users', 'Read Users', '2021-03-30 16:00:45', '2021-03-30 16:00:45'),
(3, 'update_users', 'Update Users', 'Update Users', '2021-03-30 16:00:45', '2021-03-30 16:00:45'),
(4, 'delete_users', 'Delete Users', 'Delete Users', '2021-03-30 16:00:45', '2021-03-30 16:00:45');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

CREATE TABLE `permission_user` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `product_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `retail_price` double(8,2) NOT NULL,
  `tax` double(8,2) NOT NULL,
  `total` double(8,2) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT 0,
  `discount_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_value` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `branch_id`, `brand_id`, `model_id`, `product_id`, `color`, `size`, `description`, `price`, `retail_price`, `tax`, `total`, `amount`, `discount_type`, `discount_value`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, '122211222', '0045', '0052', 'Loreama Ipsum Addidas', 500.00, 600.00, 0.00, 600.00, 23, 'fixed', 0.00, NULL, '2021-04-26 15:24:32'),
(2, 1, 1, 2, 3, '122211201', '0034', '0054', 'Seiko SX00RJ Sun', 600.00, 899.00, 0.00, 899.00, 75, 'fixed', 0.00, '2021-04-25 17:05:47', '2021-04-25 22:55:18');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'super_admin', 'Super Admin', 'Super Admin', '2021-03-30 16:00:45', '2021-03-30 16:00:45'),
(2, 'admin', 'Admin', 'Admin', '2021-03-30 16:00:45', '2021-03-30 16:00:45');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`, `user_type`) VALUES
(1, 1, 'App\\User'),
(2, 2, 'App\\User'),
(2, 3, 'App\\User');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.jpg',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `image`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'super', 'admin', 'super_admin@optics.com', 'default.jpg', NULL, '$2y$10$7QuZGjWxCuRExwMS.RJBYej9YY8yHwPVjlh6RNkulG7Ardpa7R4uW', NULL, '2021-03-30 16:00:45', '2021-03-30 16:00:45'),
(2, 'Ahmed', 'Abo Elfadle', 'ara45@gmail.com', 'Q1N2P2sKfHBBXhuObNo1ClyzIQ6K6YxX2APP8TAa.png', NULL, '$2y$10$s/vE2ZnZoF3X7vFeXkPUwOsjCeeP7U4fnvpu660a3PxSQicg5lJoa', NULL, '2021-04-10 11:30:22', '2021-04-10 11:30:22'),
(3, 'Ahmed', 'Abo Elfadle', 'ara4455@gmail.com', 'default.jpg', NULL, '$2y$10$.xK6fjMFzTj2hLgk2vC7De3rIkMp1UTGNWy1C50QdAZ6JkmVT2OQC', NULL, '2021-04-10 11:31:02', '2021-04-10 11:31:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
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
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `glass_lenses`
--
ALTER TABLE `glass_lenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `glass_models`
--
ALTER TABLE `glass_models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lenses`
--
ALTER TABLE `lenses`
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
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`user_id`,`permission_id`,`user_type`),
  ADD KEY `permission_user_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

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
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `glass_lenses`
--
ALTER TABLE `glass_lenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `glass_models`
--
ALTER TABLE `glass_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lenses`
--
ALTER TABLE `lenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
