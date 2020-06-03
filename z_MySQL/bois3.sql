-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 01, 2020 at 07:25 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bois3`
--
CREATE DATABASE IF NOT EXISTS `bois3` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bois3`;

-- --------------------------------------------------------

--
-- Table structure for table `adresses`
--

DROP TABLE IF EXISTS `adresses`;
CREATE TABLE `adresses` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `address` varchar(50) NOT NULL,
  `number` varchar(11) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `primaryAddress` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `categoryName` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `subCategory` int(10) UNSIGNED DEFAULT NULL,
  `active` tinyint(4) UNSIGNED NOT NULL DEFAULT '0',
  `image` varchar(255) DEFAULT NULL,
  `seoDescription` varchar(120) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categoryName`, `slug`, `description`, `subCategory`, `active`, `image`, `seoDescription`, `created_at`, `updated_at`) VALUES
(1, 'Bois1', 'bois1', 'Bois1', NULL, 1, NULL, 'Bois1', '2020-06-01 18:06:45', '2020-06-01 18:07:44');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `image` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `firstName`, `lastName`, `email`, `email_verified_at`, `password`, `active`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Fabio', 'Fonseca', 'fabitou@gmail.com', NULL, '$2y$10$x5vCKHhwFINamXD97NLi1OA/ARRRaPCrQH7NnM/agrdcLaRPLGm/u', 1, NULL, NULL, '2020-06-01 19:00:56', '2020-06-01 19:00:56');

-- --------------------------------------------------------

--
-- Table structure for table `configs`
--

DROP TABLE IF EXISTS `configs`;
CREATE TABLE `configs` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(150) DEFAULT NULL,
  `data_bank` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `facebook` varchar(50) DEFAULT NULL,
  `instagram` varchar(50) DEFAULT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `configs`
--

INSERT INTO `configs` (`id`, `name`, `address`, `data_bank`, `email`, `facebook`, `instagram`, `telephone`, `created_at`, `updated_at`) VALUES
(1, 'AppName', '000 rue blablabla, X0X 0X0, Québec - Qc - Canada', 'Bank, Ag: xxx, Compte: xxx', 'xxx@gmail.com', 'ddddd', 'eeee', '(123) 456-7890', '0000-00-00 00:00:00', '2020-06-01 02:41:48');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
CREATE TABLE `coupons` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(25) NOT NULL,
  `start_date` timestamp NOT NULL,
  `end_date` timestamp NOT NULL,
  `type` int(3) NOT NULL COMMENT '1 - Money, 2- Percentage',
  `value` decimal(8,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `active` tinyint(4) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `start_date`, `end_date`, `type`, `value`, `quantity`, `active`, `created_at`, `updated_at`) VALUES
(1, '12345abcde', '2020-04-01 04:00:00', '2020-05-30 04:00:00', 1, '10.00', 6, 1, '2020-05-06 06:08:56', '2020-05-20 16:35:17');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `position_id` int(10) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `firstName`, `lastName`, `email`, `password`, `role_id`, `position_id`, `active`, `email_verified_at`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 'Admin', 'Admin', 'admin@admin.com', '$2y$10$5WKm6zbN6BDjoJ50daHNAuWex9vbp18EVomS6VIyov/7vBuDM4XSq', 1, 1, 1, NULL, '2020-03-24 02:00:00', '2020-05-06 01:54:37', 'jaL6fj1QMiNdH6dKIpJwvHgFY76iPG7KpXEm8OnZZ99r4g7yiubCDXpUg3HJ');

-- --------------------------------------------------------

--
-- Table structure for table `employee_password_resets`
--

DROP TABLE IF EXISTS `employee_password_resets`;
CREATE TABLE `employee_password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee_positions`
--

DROP TABLE IF EXISTS `employee_positions`;
CREATE TABLE `employee_positions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `active` tinyint(4) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee_positions`
--

INSERT INTO `employee_positions` (`id`, `name`, `active`, `created_at`, `updated_at`) VALUES
(1, 'President', 1, '2020-05-05 20:02:15', '2020-05-05 20:06:37'),
(2, 'Vice-President', 0, '2020-05-05 20:02:27', '2020-05-05 20:02:27'),
(3, 'Director', 0, '2020-05-05 20:02:39', '2020-05-05 20:02:39'),
(4, 'Superintendent', 0, '2020-05-05 20:03:53', '2020-05-05 20:03:53'),
(5, 'Supervisor', 0, '2020-05-05 20:04:06', '2020-05-05 20:04:06'),
(6, 'Salesman', 1, '2020-05-05 20:04:56', '2020-05-05 20:07:39'),
(7, 'Cashier', 0, '2020-05-05 20:05:25', '2020-05-05 20:05:25'),
(8, 'Manager', 1, '2020-05-05 20:07:52', '2020-05-05 20:07:52');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `installment_status`
--

DROP TABLE IF EXISTS `installment_status`;
CREATE TABLE `installment_status` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `active` tinyint(4) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `installment_status`
--

INSERT INTO `installment_status` (`id`, `name`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Receiving', 1, '2020-05-06 06:44:57', '2020-05-06 06:49:14'),
(2, 'Received', 1, '2020-05-06 06:45:20', '2020-05-06 06:45:20'),
(3, 'Overdue', 1, '2020-05-06 06:45:51', '2020-05-06 06:45:51'),
(4, 'Canceled', 1, '2020-05-06 06:46:05', '2020-05-06 06:46:05');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(6, '2020_04_18_182915_create_categories_table', 2),
(7, '2020_04_19_162448_create_product_suppliers_table', 3),
(9, '2020_04_19_160808_create_employee_posts_table', 4),
(10, '2020_04_19_162839_create_payment_methods_table', 5),
(11, '2020_04_19_162920_create_shipping_methods_table', 6),
(12, '2020_04_19_162122_create_stores_table', 7),
(13, '2020_04_19_162609_create_orders_table', 8),
(15, '2020_04_19_162633_create_order_items_table', 9),
(16, '2020_04_19_162658_create_order_status_table', 10),
(17, '2020_04_19_163317_create_point_of_sales_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `status_id` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `payment_id` int(10) UNSIGNED NOT NULL,
  `shipping_id` int(10) UNSIGNED NOT NULL,
  `shipping_value` decimal(8,2) NOT NULL DEFAULT '0.00',
  `coupom_id` int(10) UNSIGNED DEFAULT NULL,
  `discount_value` decimal(8,2) DEFAULT '0.00',
  `total` decimal(8,2) NOT NULL,
  `point_of_sale_id` int(10) UNSIGNED DEFAULT '0',
  `employee_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `ip` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `client_id`, `status_id`, `payment_id`, `shipping_id`, `shipping_value`, `coupom_id`, `discount_value`, `total`, `point_of_sale_id`, `employee_id`, `ip`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, 1, 1, '5.00', NULL, '0.00', '105.00', 0, 0, NULL, '2020-06-01 19:01:34', '2020-06-01 19:01:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_installments`
--

DROP TABLE IF EXISTS `order_installments`;
CREATE TABLE `order_installments` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `number` int(10) UNSIGNED NOT NULL,
  `value` decimal(8,2) NOT NULL,
  `status_id` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `due_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_installments`
--

INSERT INTO `order_installments` (`id`, `order_id`, `number`, `value`, `status_id`, `due_date`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '105.00', 1, '2020-06-13', '2020-06-01 19:01:34', '2020-06-01 19:01:34');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, '50.00', '2020-06-01 19:01:34', '2020-06-01 19:01:34');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

DROP TABLE IF EXISTS `payment_methods`;
CREATE TABLE `payment_methods` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `active` tinyint(4) UNSIGNED NOT NULL,
  `image` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `description`, `active`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Cash', 'Cash money', 1, 'default-50x50.jpg', '2020-03-24 02:00:00', NULL),
(2, 'Tranfer', 'Interac', 1, 'default-50x50.jpg', '2020-03-24 02:00:00', NULL),
(3, 'Credit card', 'Credit card', 0, 'default-50x50.jpg', '2020-03-24 02:00:00', '2020-05-04 20:20:36');

-- --------------------------------------------------------

--
-- Table structure for table `payment_status`
--

DROP TABLE IF EXISTS `payment_status`;
CREATE TABLE `payment_status` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `active` tinyint(4) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_status`
--

INSERT INTO `payment_status` (`id`, `name`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Pending', 1, '2020-05-05 01:09:20', '2020-05-05 01:09:20'),
(2, 'Processing', 1, '2020-05-05 01:10:27', '2020-05-05 01:10:27'),
(3, 'Paid', 1, '2020-05-08 18:13:01', '2020-05-08 18:13:01'),
(4, 'Shipped', 1, '2020-05-05 01:10:42', '2020-05-05 01:10:42'),
(5, 'Delivered', 1, '2020-05-05 01:11:09', '2020-05-08 21:13:26'),
(6, 'Canceled', 1, '2020-05-05 01:11:09', '2020-05-08 21:13:26');

-- --------------------------------------------------------

--
-- Table structure for table `point_of_sales`
--

DROP TABLE IF EXISTS `point_of_sales`;
CREATE TABLE `point_of_sales` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `active` tinyint(4) UNSIGNED NOT NULL,
  `store_id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `supplier_id` int(10) UNSIGNED DEFAULT NULL,
  `productName` varchar(50) NOT NULL,
  `active` tinyint(4) UNSIGNED NOT NULL DEFAULT '0',
  `quantity` int(10) NOT NULL,
  `price` decimal(8,2) UNSIGNED NOT NULL,
  `description` varchar(500) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `seoDescription` varchar(120) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `supplier_id`, `productName`, `active`, `quantity`, `price`, `description`, `slug`, `seoDescription`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'ProductName11', 1, 98, '50.00', 'ProductName1', 'productname11', 'test', NULL, '2020-06-01 18:28:18', '2020-06-01 19:01:34');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
CREATE TABLE `product_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `imageName` varchar(150) NOT NULL,
  `widget` int(10) UNSIGNED DEFAULT NULL COMMENT '1 - Cart / 2 - Carrousel / 3 - ?  ',
  `active` tinyint(4) UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `imageName`, `widget`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 'photo1.png', NULL, 1, '2020-06-01 18:36:24', '2020-06-01 18:36:24');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Access to all administration areas', '2020-03-24 02:00:00', '2020-05-05 20:10:42'),
(2, 'Manager', 'Manager', '2020-03-24 02:00:00', NULL),
(3, 'Staff', 'Staff', '2020-03-24 02:00:00', '2020-04-11 01:26:31');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_methods`
--

DROP TABLE IF EXISTS `shipping_methods`;
CREATE TABLE `shipping_methods` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `active` tinyint(4) UNSIGNED NOT NULL,
  `cost` decimal(8,2) NOT NULL,
  `image` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shipping_methods`
--

INSERT INTO `shipping_methods` (`id`, `name`, `description`, `active`, `cost`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Delivery', 'Delivery description...', 1, '5.00', 'default-50x50.jpg', '2020-03-24 02:00:00', NULL),
(2, 'Pickup', 'Pickup description...', 1, '0.00', 'default-50x50.jpg', '2020-03-24 02:00:00', NULL),
(3, 'Canada Post', 'Canada Post description...', 0, '10.00', 'default-50x50.jpg', '2020-03-24 02:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

DROP TABLE IF EXISTS `stocks`;
CREATE TABLE `stocks` (
  `id` int(10) UNSIGNED NOT NULL,
  `supplier_id` int(10) UNSIGNED DEFAULT NULL,
  `payment_method_id` int(10) UNSIGNED NOT NULL,
  `payment_status_id` int(10) UNSIGNED DEFAULT '1',
  `total` decimal(8,2) NOT NULL,
  `store_id` int(10) UNSIGNED DEFAULT '1',
  `employee_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `stock_items`
--

DROP TABLE IF EXISTS `stock_items`;
CREATE TABLE `stock_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `stock_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` decimal(8,2) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

DROP TABLE IF EXISTS `stores`;
CREATE TABLE `stores` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `active` tinyint(3) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `name`, `description`, `active`, `created_at`, `updated_at`) VALUES
(0, 'Site Web', 'Site web', 1, '2020-05-04 22:36:34', '2020-05-04 22:39:18');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `contact_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tel_number` varchar(15) NOT NULL,
  `cel_number` varchar(15) NOT NULL,
  `description` varchar(255) NOT NULL,
  `active` tinyint(4) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `telephones`
--

DROP TABLE IF EXISTS `telephones`;
CREATE TABLE `telephones` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `number` varchar(15) NOT NULL,
  `primaryTelephone` tinyint(4) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wish_list`
--

DROP TABLE IF EXISTS `wish_list`;
CREATE TABLE `wish_list` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `sending_status` tinyint(4) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wish_list`
--

INSERT INTO `wish_list` (`id`, `product_id`, `name`, `email`, `sending_status`, `created_at`, `updated_at`) VALUES
(1, 1, 'test', 'fabitou@gmail.com', 0, '2020-05-05 00:13:12', '2020-05-05 00:19:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adresses`
--
ALTER TABLE `adresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `address_client_id_fk` (`client_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `configs`
--
ALTER TABLE `configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_email_unique` (`email`),
  ADD KEY `employees_position_id_fk` (`position_id`),
  ADD KEY `employees_role_id_fk` (`role_id`);

--
-- Indexes for table `employee_password_resets`
--
ALTER TABLE `employee_password_resets`
  ADD KEY `employee_password_resets_email_index` (`email`);

--
-- Indexes for table `employee_positions`
--
ALTER TABLE `employee_positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `installment_status`
--
ALTER TABLE `installment_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_client_id_fk` (`client_id`),
  ADD KEY `orders_status_id_fk` (`status_id`),
  ADD KEY `orders_payment_id_fk` (`payment_id`),
  ADD KEY `orders_shipping_id_fk` (`shipping_id`);

--
-- Indexes for table `order_installments`
--
ALTER TABLE `order_installments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_installments_orders_id_fk` (`order_id`),
  ADD KEY `orders_installments_status_id_fk` (`status_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_fk` (`order_id`),
  ADD KEY `order_items_product_id_fk` (`product_id`);

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
-- Indexes for table `payment_status`
--
ALTER TABLE `payment_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `point_of_sales`
--
ALTER TABLE `point_of_sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `point_of_sale_store_id_fk` (`store_id`),
  ADD KEY `point_of_sale_employee_id` (`employee_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_fk` (`category_id`),
  ADD KEY `products_supplier_id_fk` (`supplier_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_product_id_fk` (`product_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_methods`
--
ALTER TABLE `shipping_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stocks_payment_method_id_fk` (`payment_method_id`),
  ADD KEY `stocks_payment_status_id_fk` (`payment_status_id`),
  ADD KEY `stocks_store_id_fk` (`store_id`);

--
-- Indexes for table `stock_items`
--
ALTER TABLE `stock_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_items_stock_id_fk` (`stock_id`),
  ADD KEY `stock_items_product_id_fk` (`product_id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `telephones`
--
ALTER TABLE `telephones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `telephone_client_id_fk` (`client_id`);

--
-- Indexes for table `wish_list`
--
ALTER TABLE `wish_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adresses`
--
ALTER TABLE `adresses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `configs`
--
ALTER TABLE `configs`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee_positions`
--
ALTER TABLE `employee_positions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `installment_status`
--
ALTER TABLE `installment_status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_installments`
--
ALTER TABLE `order_installments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment_status`
--
ALTER TABLE `payment_status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `point_of_sales`
--
ALTER TABLE `point_of_sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shipping_methods`
--
ALTER TABLE `shipping_methods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_items`
--
ALTER TABLE `stock_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `telephones`
--
ALTER TABLE `telephones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `wish_list`
--
ALTER TABLE `wish_list`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adresses`
--
ALTER TABLE `adresses`
  ADD CONSTRAINT `address_client_id_fk` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_position_id_fk` FOREIGN KEY (`position_id`) REFERENCES `employee_positions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `employees_role_id_fk` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_client_id_fk` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `orders_payment_id_fk` FOREIGN KEY (`payment_id`) REFERENCES `payment_methods` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `orders_shipping_id_fk` FOREIGN KEY (`shipping_id`) REFERENCES `shipping_methods` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `orders_status_id_fk` FOREIGN KEY (`status_id`) REFERENCES `payment_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order_installments`
--
ALTER TABLE `order_installments`
  ADD CONSTRAINT `orders_installments_orders_id_fk` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `orders_installments_status_id_fk` FOREIGN KEY (`status_id`) REFERENCES `payment_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_fk` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `order_items_product_id_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `point_of_sales`
--
ALTER TABLE `point_of_sales`
  ADD CONSTRAINT `point_of_sale_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `point_of_sale_store_id_fk` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_fk` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `products_supplier_id_fk` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `products_product_id_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_payment_method_id_fk` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `stocks_payment_status_id_fk` FOREIGN KEY (`payment_status_id`) REFERENCES `payment_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `stocks_store_id_fk` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `stock_items`
--
ALTER TABLE `stock_items`
  ADD CONSTRAINT `stock_items_product_id_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `stock_items_stock_id_fk` FOREIGN KEY (`stock_id`) REFERENCES `stocks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `telephones`
--
ALTER TABLE `telephones`
  ADD CONSTRAINT `telephone_client_id_fk` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
