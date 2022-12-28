-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2022 at 09:27 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acc_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_module_access`
--

CREATE TABLE `account_module_access` (
  `id` int(11) NOT NULL,
  `can_view` tinyint(1) NOT NULL,
  `can_create` tinyint(1) NOT NULL,
  `can_update` tinyint(1) NOT NULL,
  `can_delete` tinyint(1) NOT NULL,
  `account_type_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account_module_access`
--

INSERT INTO `account_module_access` (`id`, `can_view`, `can_create`, `can_update`, `can_delete`, `account_type_id`, `module_id`) VALUES
(1, 1, 1, 1, 1, 1, 5),
(2, 1, 1, 1, 1, 1, 6),
(3, 1, 1, 1, 1, 1, 7),
(4, 1, 1, 1, 1, 1, 8),
(5, 1, 1, 1, 1, 1, 9),
(6, 1, 1, 1, 1, 1, 10),
(7, 1, 1, 1, 1, 1, 11),
(8, 1, 1, 1, 1, 1, 12),
(9, 1, 1, 1, 1, 1, 13),
(10, 1, 1, 1, 1, 1, 14),
(11, 1, 1, 1, 1, 1, 15),
(12, 1, 1, 1, 1, 1, 16),
(13, 1, 1, 1, 1, 1, 17),
(14, 1, 1, 1, 1, 1, 18),
(15, 1, 1, 1, 1, 1, 19),
(16, 1, 1, 1, 1, 1, 20),
(17, 1, 1, 1, 1, 1, 21),
(18, 1, 1, 1, 1, 1, 22),
(19, 1, 1, 1, 1, 1, 23),
(20, 1, 1, 1, 1, 1, 24),
(21, 1, 1, 1, 1, 1, 25),
(22, 1, 1, 1, 1, 1, 26),
(23, 1, 1, 1, 1, 1, 27),
(24, 1, 1, 1, 1, 1, 28),
(25, 1, 1, 1, 1, 1, 29),
(26, 1, 1, 1, 1, 2, 5),
(27, 1, 1, 1, 1, 2, 6),
(28, 1, 1, 1, 1, 2, 7),
(29, 1, 1, 1, 1, 2, 8),
(30, 1, 1, 1, 1, 2, 9),
(31, 1, 1, 1, 1, 2, 10),
(32, 1, 1, 1, 1, 2, 11),
(33, 1, 1, 1, 1, 2, 12),
(34, 1, 1, 1, 1, 2, 13),
(35, 1, 1, 1, 1, 2, 14),
(36, 1, 1, 1, 1, 2, 15),
(37, 1, 1, 1, 1, 2, 16),
(38, 1, 1, 1, 1, 2, 17),
(39, 1, 1, 1, 1, 2, 18),
(40, 1, 1, 1, 1, 2, 19),
(41, 1, 1, 1, 1, 2, 20),
(42, 1, 1, 1, 1, 2, 21),
(43, 1, 1, 1, 1, 2, 22),
(44, 1, 1, 1, 1, 3, 6),
(45, 1, 1, 1, 1, 1, 30);

-- --------------------------------------------------------

--
-- Table structure for table `account_type`
--

CREATE TABLE `account_type` (
  `id` int(50) NOT NULL,
  `user_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account_type`
--

INSERT INTO `account_type` (`id`, `user_type`) VALUES
(1, 'ADMIN'),
(3, 'CASHIER'),
(2, 'MANAGER');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `whole_day` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  `deduction` float(11,2) NOT NULL,
  `bonus` float(11,2) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `payroll_status` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `date_updated` datetime NOT NULL,
  `status_archive_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `audit_trail`
--

CREATE TABLE `audit_trail` (
  `id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `data` varchar(255) NOT NULL,
  `date_log` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_type`
--

CREATE TABLE `category_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_type`
--

INSERT INTO `category_type` (`id`, `name`) VALUES
(2, 'Bottle'),
(5, 'Caps'),
(1, 'Container'),
(4, 'Filter'),
(10, 'For Refill'),
(7, 'Others'),
(3, 'Seal'),
(6, 'Sticker');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `contact_number1` varchar(20) DEFAULT NULL,
  `contact_number2` varchar(50) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `balance` float(11,2) DEFAULT NULL,
  `status_archive_id` int(11) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_name`, `address`, `contact_number1`, `contact_number2`, `note`, `balance`, `status_archive_id`, `created_by`, `created_at`) VALUES
(1, 'Lorenzo', 'Sta.Cruz St.', '09892829485', '09223232222112', 'tabing jollibee', 0.00, 1, '1', '2022-11-27 14:48:29'),
(2, 'Stephen Smith', 'Curry St., Brgy. San Lorenzo', '09992829375', '09284573431', '', 0.00, 1, '1', '2022-11-27 01:38:32'),
(3, 'Test Name', 'Test ', '1234', '1234', 'Test note', 0.00, 1, '6', '2022-11-30 02:28:56'),
(4, 'CN', 'ADDRESS', '1234', '1234', 'Test note', 400.00, 1, '6', '2022-11-30 02:34:48'),
(5, 'Test', 'Test ', '1234', '1234', 'Test note', 0.00, 1, '6', '2022-11-30 02:35:11'),
(6, 'Jerwinsonn Raphael Quijano', 'B7 L7 Sta.Ana St., Villa Ligaya Subd., Brgy. Dela ', '2', '2', '2', 0.00, 1, '1', '2022-12-11 03:41:02'),
(7, 'Dylan Angelo', 'Sto. Nino St., Brgy. San Isidro', '0989988899', '0937485758', '', 0.00, 1, '1', '2022-12-12 23:59:28'),
(9, '', '', '', '', '', 0.00, 1, '1', '2022-12-14 21:39:05'),
(10, 'Jessica Soho', 'Lapu-lapu St., Brgy. Tagbili, Antipolo City', '09992829375', '09283948989', 'Green gate, unang kanan sa dulo.', 325.50, 1, '1', '2022-12-16 22:36:12'),
(12, 'Jonathan Almaranza', 'Celly Boulevard St., Brgy. Sta. Rosa', '09288883949', '09002739485', '', 0.00, 1, '1', '2022-12-23 00:19:11');

-- --------------------------------------------------------

--
-- Table structure for table `deliver_price`
--

CREATE TABLE `deliver_price` (
  `id` int(11) NOT NULL,
  `service` varchar(255) NOT NULL,
  `price` float(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deliver_price`
--

INSERT INTO `deliver_price` (`id`, `service`, `price`) VALUES
(1, 'Delivery', 10.00),
(2, 'Pick Up', 15.00);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `middle_name` varchar(20) NOT NULL,
  `position_id` varchar(255) NOT NULL,
  `daily_rate` float(11,2) DEFAULT NULL,
  `date_of_birth` date NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `contact_number` int(50) NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `date_updated` datetime NOT NULL,
  `status_archive_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `last_name`, `first_name`, `middle_name`, `position_id`, `daily_rate`, `date_of_birth`, `email_address`, `contact_number`, `added_by`, `date_created`, `updated_by`, `date_updated`, `status_archive_id`) VALUES
(1, 'Smith', 'Edward', 'Cruz', '1', 0.00, '2022-11-19', 'EdwardSmith123@gmail.com', 1234567891, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1),
(2, 'Tabudol', 'Sack', 'Brin', '2', 0.00, '2022-11-19', 'Zack123budol@gmail.com', 987654321, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1),
(3, 'Santos', 'Nikolas', 'Anderas', '1', 0.00, '2022-11-19', 'Nikols123@gmail.com', 987987981, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1),
(4, 'tate', 'andrew', 'sandoval', '1', 0.00, '2022-11-19', 'andrewtate90@gmail.com', 1231231231, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1),
(5, 'Go', 'Mario', 'Lee', '2', 0.00, '2022-11-19', 'MarioGo98@gmail.com', 982332981, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1),
(6, 'Gutierrez', 'Nick', 'Banco', '2', 0.00, '2022-11-19', 'BancoNick@gmail.com', 987234529, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1),
(7, 'Ponte', 'Joseph', 'Cruz', '1', 0.00, '2022-11-19', 'SephSeph98@gmail.com', 987654388, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1),
(8, 'Nino', 'Oliver', 'Marinao', '2', 0.00, '2022-11-19', 'NinoOliver25@gmail.com', 234123532, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1),
(9, 'Ribs', 'Michael', 'Andrian', '1', 0.00, '2022-11-19', 'Michael23@gmail.com', 2147483647, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1),
(10, 'Sol', 'Mario', 'France', '1', 0.00, '2022-11-19', 'SolMario@gmail.com', 2147483647, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1),
(11, 'Talier', 'Francis', 'Winnie', '1', 0.00, '2022-11-19', 'FrancieT@gmail.com', 2147483647, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1),
(12, 'Sunaida', 'Ivan', 'Tabino', '1', 0.00, '2022-11-19', 'Ivanniav@gmail.com', 2147483647, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1),
(13, 'Goli', 'Ligo', 'Amer', '1', 0.00, '2022-11-19', 'Amerrgoli21@gmail.com', 2147483647, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1),
(14, 'Nats', 'Sebastian', 'Anthony', '1', 0.00, '2022-11-19', 'Sebsant@gmail.com', 2147483647, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1),
(16, 'LN1', 'FN1', 'MN1', '2', 200.00, '2022-11-03', 'test123@gmail.com', 12345678, 6, '2022-11-30 19:42:59', 0, '0000-00-00 00:00:00', 1),
(17, 'TEST 1', 'TEST 1', 'TEST 1', '4', 200.00, '2000-01-01', 'test@gmail.com', 123456789, 6, '2022-11-30 20:41:45', 0, '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(11) NOT NULL,
  `expense_type_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `amount` float(11,2) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `date_updated` datetime NOT NULL,
  `is_editable` int(11) NOT NULL,
  `status_archive_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`id`, `expense_type_id`, `date`, `amount`, `description`, `added_by`, `date_created`, `updated_by`, `date_updated`, `is_editable`, `status_archive_id`) VALUES
(2, 4, '2022-11-15', 2000.00, 'Trust me, this is really a zoan fruit', 6, '2022-11-30 23:51:10', 6, '2022-11-30 23:51:35', 1, 1),
(3, 4, '2022-11-28', 1000.00, 'Test', 6, '2022-12-01 00:11:14', 6, '2022-12-01 00:11:14', 1, 1),
(4, 3, '2022-11-28', 123.00, '123', 6, '2022-12-01 00:11:36', 6, '2022-12-01 00:11:36', 1, 1),
(5, 4, '2022-12-28', 5000.00, 'Purchased inventory items for item id: 6, quantity: 1000', 6, '2022-12-28 02:54:44', 6, '2022-12-28 02:54:44', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `expense_type`
--

CREATE TABLE `expense_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expense_type`
--

INSERT INTO `expense_type` (`id`, `name`) VALUES
(1, 'Salary'),
(2, 'Utilities'),
(3, 'Maintenance'),
(4, 'Other Expenses');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_item`
--

CREATE TABLE `inventory_item` (
  `id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `category_by_id` int(11) NOT NULL,
  `reorder_level` int(11) NOT NULL,
  `pos_item_id` int(11) NOT NULL,
  `selling_price_item` float(11,2) NOT NULL,
  `alkaline_price` float(11,2) NOT NULL,
  `mineral_price` float(11,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `status_archive_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(255) NOT NULL,
  `updated_by_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_item`
--

INSERT INTO `inventory_item` (`id`, `item_name`, `category_by_id`, `reorder_level`, `pos_item_id`, `selling_price_item`, `alkaline_price`, `mineral_price`, `image`, `created_at`, `status_archive_id`, `updated_at`, `created_by`, `updated_by_id`) VALUES
(1, 'Round - 5 Gallons', 1, 10, 1, 0.00, 220.00, 215.00, '77fce6b86eef912efb10429092fa2273.jfif', '2022-12-01 16:42:17', 1, '2022-12-06 22:26:56', '1', 1),
(2, 'Slim - 2.5 Gallons', 1, 5, 1, 0.00, 135.00, 130.00, '2faff09308079c871c09df8025884578.jfif', '2022-12-01 16:50:42', 1, '2022-12-06 22:27:30', '1', 1),
(3, 'Cap with Inner Plug for Round', 5, 10, 1, 10.00, 0.00, 0.00, '205c32cdfc286f5863a216eb6e99f2fe.jfif', '2022-12-01 16:53:13', 1, '2022-12-01 21:33:58', '1', 1),
(4, 'Slim - 5 Gallons', 1, 10, 1, 0.00, 220.00, 215.00, '5_gallon_slim_plastic_container_1568794578_4c2e969d0_progressive.jfif', '2022-12-01 17:08:57', 1, '2022-12-06 22:28:07', '1', 1),
(5, 'Faucet Seal', 3, 10, 2, 0.00, 0.00, 0.00, 'c215d9deaf3d1b0a7ff97d90bb16c087.jpg', '2022-12-01 17:12:41', 1, '2022-12-01 18:45:14', '1', 1),
(6, '1 Liter', 2, 20, 1, 0.00, 15.00, 12.00, '504350773.jpg', '2022-12-01 17:13:44', 1, '2022-12-06 22:28:28', '1', 1),
(7, 'Faucet - Push Down', 7, 10, 1, 25.00, 0.00, 0.00, '4d7a42f744a6bc863b8c6e13924b1bea.jfif', '2022-12-01 17:19:44', 1, '2022-12-06 19:14:19', '1', 1),
(8, ' Big Mouth Cap for Slim', 5, 10, 1, 10.00, 0.00, 0.00, '653512388a9235cd5ba921a5d2a9d595.jfif', '2022-12-01 17:46:09', 1, '2022-12-01 21:32:26', '1', 1),
(9, '500 ml', 2, 10, 1, 0.00, 10.00, 8.00, '504350773.jpg', '2022-12-01 17:46:52', 1, '2022-12-06 22:29:28', '1', 1),
(10, '350 ml', 2, 10, 1, 0.00, 7.00, 5.00, '504350773.jpg', '2022-12-01 18:30:39', 1, '2022-12-06 22:30:22', '1', 1),
(11, '6 Liters', 2, 10, 1, 0.00, 45.00, 40.00, 'Screenshot 2022-11-28 145335.png', '2022-12-01 18:43:10', 1, '2022-12-06 22:30:48', '1', 1),
(12, 'Closed Cap Seal for Round', 3, 10, 2, 0.00, 0.00, 0.00, '139bf86befd4ce5e7a041c9538d2f9b7.jfif', '2022-12-01 18:44:12', 1, '2022-12-01 21:34:59', '1', 1),
(13, 'Open Cap Seal for Round', 3, 10, 2, 0.00, 0.00, 0.00, 'c215d9deaf3d1b0a7ff97d90bb16c087.jpg', '2022-12-01 18:44:51', 1, '2022-12-01 21:34:51', '1', 1),
(14, 'Small Cap for Slim', 5, 10, 1, 5.00, 0.00, 0.00, '4b59df78ae3706129cc7f752252765d0.jfif', '2022-12-01 21:31:23', 1, '0000-00-00 00:00:00', '1', 0),
(15, '1.5 Liters', 10, 0, 1, 0.00, 12.00, 8.00, '504350773.jpg', '2022-12-01 22:12:20', 1, '2022-12-22 23:00:56', '1', 1),
(16, 'Faucet - Rotatable', 7, 5, 1, 25.00, 0.00, 0.00, 'Screenshot 2022-12-04 223707.png', '2022-12-04 22:40:23', 1, '2022-12-06 19:11:42', '1', 1),
(17, 'Ice Tube', 7, 5, 1, 10.00, 0.00, 0.00, '1000_F_350366345_8Jh0duvK9Q6yVPniIr1GO1VYoCovZASX.jpg', '2022-12-04 22:42:30', 1, '2022-12-05 00:07:20', '1', 1),
(18, 'Small Cap Seal', 3, 5, 2, 0.00, 0.00, 0.00, 'Screenshot 2022-12-07 155001.png', '2022-12-07 15:50:21', 1, '0000-00-00 00:00:00', '1', 0),
(29, 'Slim - 5 Gallons with Cap and Faucet', 1, 2, 2, 0.00, 0.00, 0.00, '', '2022-12-07 16:01:56', 1, '0000-00-00 00:00:00', '1', 0),
(36, 'gweq', 5, 22, 1, 222.00, 222.00, 222.00, '', '2022-12-19 21:46:45', 2, '0000-00-00 00:00:00', '1', 0),
(38, '5 Gallons', 10, 0, 1, 0.00, 35.00, 30.00, '5_gallon_slim_plastic_container_1568794578_4c2e969d0_progressive.jfif', '2022-12-19 21:53:51', 1, '2022-12-22 22:55:12', '1', 1),
(39, 'Test', 2, 1, 1, 12.00, 12.00, 12.00, '', '2022-12-27 23:12:08', 1, '2022-12-27 23:12:08', '6', 6);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_log`
--

CREATE TABLE `inventory_log` (
  `id` int(11) NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `details` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_stock`
--

CREATE TABLE `inventory_stock` (
  `id` int(11) NOT NULL,
  `item_name_id` int(11) NOT NULL,
  `in_going` int(11) NOT NULL,
  `out_going` int(11) NOT NULL,
  `on_hand` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_stock`
--

INSERT INTO `inventory_stock` (`id`, `item_name_id`, `in_going`, `out_going`, `on_hand`) VALUES
(1, 6, 0, 0, 0),
(2, 2, 0, 0, 0),
(3, 39, 0, 0, 0),
(4, 1, 0, 0, 0),
(5, 4, 0, 0, 0),
(6, 29, 0, 0, 0),
(7, 9, 0, 0, 0),
(8, 10, 0, 0, 0),
(9, 11, 0, 0, 0),
(10, 5, 0, 0, 0),
(11, 12, 0, 0, 0),
(12, 13, 0, 0, 0),
(13, 18, 0, 0, 0),
(14, 3, 0, 0, 0),
(15, 8, 0, 0, 0),
(16, 14, 0, 0, 0),
(17, 36, 0, 0, 0),
(18, 7, 0, 0, 0),
(19, 16, 0, 0, 0),
(20, 17, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `login_history`
--

CREATE TABLE `login_history` (
  `id` int(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `activity` varchar(255) DEFAULT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `name`) VALUES
(24, 'ACCOUNT-ACCOUNT_TYPE'),
(25, 'ACCOUNT-USER_ACCOUNT'),
(3, 'CHANGE_PASSWORD'),
(4, 'CODE_VERIFICATION'),
(18, 'CUSTOMER'),
(5, 'DASHBOARD'),
(21, 'EMPLOYEE-ATTENDANCE'),
(22, 'EMPLOYEE-LIST'),
(23, 'EXPENSE'),
(2, 'FORGOT_PASSWORD'),
(20, 'INVENTORY-ITEM'),
(19, 'INVENTORY-STOCKS'),
(1, 'LOGIN'),
(15, 'MONITORING-CUSTOMER_BALANCE'),
(13, 'MONITORING-DELIVERY_PICKUP'),
(17, 'MONITORING-ITEM_HISTORY'),
(30, 'MONITORING-POINT_OF_SALES_TRANSACTION'),
(14, 'MONITORING-RETURN_CONTAINER'),
(16, 'MONITORING-SCHEDULING'),
(6, 'POS'),
(11, 'REPORTS-ATTENDANCE'),
(8, 'REPORTS-DELIVERY_WALKIN'),
(12, 'REPORTS-EXPENSE'),
(9, 'REPORTS-INVENTORY'),
(10, 'REPORTS-ITEM_ISSUE'),
(7, 'REPORTS-SALES'),
(28, 'SETTINGS-ARCHIVES'),
(29, 'SETTINGS-BACKUP_RESTORE'),
(27, 'SETTINGS-DATA_LOGS'),
(26, 'SETTINGS-HELP');

-- --------------------------------------------------------

--
-- Table structure for table `payment_option`
--

CREATE TABLE `payment_option` (
  `id` int(50) NOT NULL,
  `option_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_option`
--

INSERT INTO `payment_option` (`id`, `option_name`) VALUES
(1, 'Cash On Delivery'),
(3, 'GCash'),
(2, 'Onsite');

-- --------------------------------------------------------

--
-- Table structure for table `position_type`
--

CREATE TABLE `position_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `position_type`
--

INSERT INTO `position_type` (`id`, `name`) VALUES
(1, 'Frontliner'),
(2, 'Delivery Boy'),
(3, 'Helper'),
(4, 'Manager');

-- --------------------------------------------------------

--
-- Table structure for table `pos_item`
--

CREATE TABLE `pos_item` (
  `id` int(11) NOT NULL,
  `pos_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pos_item`
--

INSERT INTO `pos_item` (`id`, `pos_type`) VALUES
(1, 'Yes'),
(2, 'No');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status_name`) VALUES
(1, 'New'),
(2, 'Ongoing Pickup'),
(3, 'Ongoing Delivery'),
(4, 'Paid'),
(5, 'Unpaid');

-- --------------------------------------------------------

--
-- Table structure for table `status_archive`
--

CREATE TABLE `status_archive` (
  `id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status_archive`
--

INSERT INTO `status_archive` (`id`, `status`) VALUES
(1, 'active'),
(2, 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(50) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `contact_number` bigint(100) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier`, `contact_number`, `address`) VALUES
(1, 'Aquastar', 9239029092, '111 C. Lawis St., Brgy. San Isidro, Antipolo City');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `uuid` varchar(50) NOT NULL,
  `customer_name_id` int(11) NOT NULL,
  `service_type` varchar(255) NOT NULL,
  `total_amount` float(11,2) NOT NULL,
  `payment_option` int(11) NOT NULL,
  `note` varchar(255) NOT NULL,
  `status_id` int(11) NOT NULL,
  `created_by_id` int(11) NOT NULL,
  `updated_by_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at_date` date NOT NULL DEFAULT current_timestamp(),
  `created_at_time` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `uuid`, `customer_name_id`, `service_type`, `total_amount`, `payment_option`, `note`, `status_id`, `created_by_id`, `updated_by_id`, `updated_at`, `created_at_date`, `created_at_time`) VALUES
(105, '63abcccfc39779.12892746', 0, 'Walk In', 120.00, 1, '', 1, 6, 6, '2022-12-28 12:57:51', '2022-12-28', '12:57:51'),
(106, '63abccf65b4b17.08669844', 0, 'Walk In', 1200.00, 1, '', 1, 6, 6, '2022-12-28 12:58:30', '2022-12-28', '12:58:30'),
(107, '63abcd3ed13407.16147320', 10, 'Walk In', 1200.00, 1, '', 0, 6, 6, '2022-12-28 14:48:51', '2022-12-28', '12:59:42'),
(108, '63abcd6d5251a7.06711961', 1, 'Walk In', 2400.00, 1, '', 0, 6, 0, '2022-12-28 13:00:42', '2022-12-28', '13:00:29'),
(109, '63abce4a681640.32895925', 10, 'Walk In', 350.00, 1, '', 0, 6, 6, '2022-12-28 13:04:10', '2022-12-28', '13:04:10'),
(110, '63abf9aa8cc234.16453602', 4, 'Walk In', 1200.00, 1, '', 1, 6, 6, '2022-12-28 16:09:14', '2022-12-28', '16:09:14');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_history`
--

CREATE TABLE `transaction_history` (
  `id` int(11) NOT NULL,
  `transaction_uuid` varchar(50) NOT NULL,
  `amount_tendered` float(11,2) NOT NULL,
  `customer_change` float(11,2) NOT NULL,
  `remaining_balance` float(11,2) NOT NULL,
  `previous_balance` float(11,2) NOT NULL,
  `unpaid_amount` float(11,2) NOT NULL,
  `created_by_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_history`
--

INSERT INTO `transaction_history` (`id`, `transaction_uuid`, `amount_tendered`, `customer_change`, `remaining_balance`, `previous_balance`, `unpaid_amount`, `created_by_id`, `created_at`) VALUES
(41, '63abcccfc39779.12892746', 1000.00, 880.00, 0.00, 0.00, 0.00, 6, '2022-12-28 12:57:51'),
(42, '63abccf65b4b17.08669844', 1200.00, 0.00, 0.00, 0.00, 0.00, 6, '2022-12-28 12:58:30'),
(43, '63abcd3ed13407.16147320', 500.00, 0.00, 0.00, 0.00, 700.00, 6, '2022-12-28 12:59:42'),
(44, '63abcd6d5251a7.06711961', 400.00, 0.00, 0.00, 0.00, 2000.00, 6, '2022-12-28 13:00:29'),
(45, '63abcd6d5251a7.06711961', 1000.00, 0.00, 0.00, 0.00, 1000.00, 0, '2022-12-28 13:00:42'),
(46, '63abce4a681640.32895925', 150.00, 0.00, 0.00, 0.00, 200.00, 6, '2022-12-28 13:04:10'),
(47, '63abcd3ed13407.16147320', 400.00, 0.00, 0.00, 0.00, 300.00, 6, '2022-12-28 14:16:38'),
(48, '63abcd3ed13407.16147320', 100.00, 0.00, 0.00, 0.00, 200.00, 6, '2022-12-28 14:48:51'),
(49, '63abf9aa8cc234.16453602', 0.00, 0.00, 400.00, 1600.00, 0.00, 6, '2022-12-28 16:09:14');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_process`
--

CREATE TABLE `transaction_process` (
  `id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `water_type` varchar(255) DEFAULT NULL,
  `category_type` varchar(255) NOT NULL,
  `quantity` int(50) NOT NULL,
  `price` float(11,2) NOT NULL,
  `total_price` float(11,2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_process`
--

INSERT INTO `transaction_process` (`id`, `item_name`, `water_type`, `category_type`, `quantity`, `price`, `total_price`, `user_id`, `transaction_id`) VALUES
(257, '1.5 Liters', 'Alkaline', 'For Refill', 10, 12.00, 120.00, 6, '63abcccfc39779.12892746'),
(258, '1.5 Liters', 'Alkaline', 'For Refill', 100, 12.00, 1200.00, 6, '63abccf65b4b17.08669844'),
(259, '1.5 Liters', 'Alkaline', 'For Refill', 100, 12.00, 1200.00, 6, '63abcd3ed13407.16147320'),
(260, '1.5 Liters', 'Alkaline', 'For Refill', 200, 12.00, 2400.00, 6, '63abcd6d5251a7.06711961'),
(261, '5 Gallons', 'Alkaline', 'For Refill', 10, 35.00, 350.00, 6, '63abce4a681640.32895925'),
(262, '1.5 Liters', 'Alkaline', 'For Refill', 100, 12.00, 1200.00, 6, '63abf9aa8cc234.16453602');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `account_type_id` int(11) NOT NULL,
  `code` mediumint(50) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status_archive_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `last_name`, `first_name`, `middle_name`, `email`, `password`, `contact_number`, `account_type_id`, `code`, `profile_image`, `created_at`, `status_archive_id`) VALUES
(1, 'Quijano', 'Jerwinsonn', 'Ragasa', 'rapquijano04@gmail.com', '$2y$10$J1xO3JUJkX/UzKafqZU73OPzkUy0jyZjWRaFUeonxsMaQa6.hMjkO', '09560984209', 1, 0, 'Picture4.jpg', '2022-11-16 21:48:25', 1),
(2, 'Diaz', 'Janry', 'Franco', 'janrydiaz1401@gmail.com', '$2y$10$ptotyRzbZxa0G76Y9wI4R.AF90CYUDijv33qGZnJWDumUE5K.1eae', '09557488018', 1, 0, 'Picture2.jpg', '2022-11-16 21:48:25', 1),
(3, 'Fernandez', 'Hazel Ann', 'Dezena', 'azeannfernandez@gmail.com', '$2y$10$yAjqs00PxqTRNWSHXcdUEOJBgKfefqG96uBW5dIrFWrI5xmHKipE6', '09204933920', 1, 0, 'Picture1.jpg', '2022-11-16 21:48:25', 1),
(4, 'Charvet', 'David Emmanuel', 'Javier', 'deybidsu@gmail.com', '$2y$10$ISBQByEVphgK.0u0FQdDzu1NOF6vCTTTOzoeKVnQnrMHFrZepir4O', '09908998888', 1, 0, 'Picture3.jpg', '2022-11-16 21:48:25', 1),
(5, 'Tagulinao', 'Ricardo', NULL, 'tagswater00@gmail.com', '$2y$10$4ubDa1UpSrYE3s10bOfa5uFFd1EncDdGDB0nFg2wkXKelGseePh.u', '09239029092', 1, NULL, NULL, '2022-11-24 02:15:41', 1),
(6, 'Test', 'Test', 'Test', 'test@gmail.com', '$2y$10$XFSKy5tnAQZ0e7ZL6kdChOGrmoWJyJ1HUwQwU3HhBGul9lHiUFqbi', '09991234567', 1, 0, NULL, '2022-11-24 02:15:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_session`
--

CREATE TABLE `user_session` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `session_key` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_session`
--

INSERT INTO `user_session` (`id`, `user_id`, `session_key`, `status`) VALUES
(49, 6, 'bab721488a6c191d6126', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `water_type`
--

CREATE TABLE `water_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `water_type`
--

INSERT INTO `water_type` (`id`, `name`) VALUES
(1, 'Alkaline'),
(2, 'Mineral');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_module_access`
--
ALTER TABLE `account_module_access`
  ADD PRIMARY KEY (`id`),
  ADD KEY `access_account_type_id` (`account_type_id`),
  ADD KEY `access_module_id` (`module_id`);

--
-- Indexes for table `account_type`
--
ALTER TABLE `account_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_type` (`user_type`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audit_trail`
--
ALTER TABLE `audit_trail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_type`
--
ALTER TABLE `category_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_type_name_index` (`name`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customer_name` (`customer_name`),
  ADD KEY `status_customers_constraint` (`status_archive_id`);

--
-- Indexes for table `deliver_price`
--
ALTER TABLE `deliver_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_type`
--
ALTER TABLE `expense_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_item`
--
ALTER TABLE `inventory_item`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `inventory_item_name_index` (`item_name`),
  ADD UNIQUE KEY `item_name` (`item_name`),
  ADD KEY `status_inventory_item_constraint` (`status_archive_id`),
  ADD KEY `categoryType` (`category_by_id`),
  ADD KEY `pos_item_id` (`pos_item_id`);

--
-- Indexes for table `inventory_log`
--
ALTER TABLE `inventory_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_stock`
--
ALTER TABLE `inventory_stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_name_id_constraint` (`item_name_id`);

--
-- Indexes for table `login_history`
--
ALTER TABLE `login_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_constraint` (`user_id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `module_name_index` (`name`);

--
-- Indexes for table `payment_option`
--
ALTER TABLE `payment_option`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `option` (`option_name`);

--
-- Indexes for table `pos_item`
--
ALTER TABLE `pos_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_archive`
--
ALTER TABLE `status_archive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_history`
--
ALTER TABLE `transaction_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_process`
--
ALTER TABLE `transaction_process`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`) USING BTREE,
  ADD KEY `users_account_type_id` (`account_type_id`);

--
-- Indexes for table `user_session`
--
ALTER TABLE `user_session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `water_type`
--
ALTER TABLE `water_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `water_type_name_index` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_module_access`
--
ALTER TABLE `account_module_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `account_type`
--
ALTER TABLE `account_type`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `audit_trail`
--
ALTER TABLE `audit_trail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=754;

--
-- AUTO_INCREMENT for table `category_type`
--
ALTER TABLE `category_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `deliver_price`
--
ALTER TABLE `deliver_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `expense_type`
--
ALTER TABLE `expense_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inventory_item`
--
ALTER TABLE `inventory_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `inventory_log`
--
ALTER TABLE `inventory_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `inventory_stock`
--
ALTER TABLE `inventory_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `login_history`
--
ALTER TABLE `login_history`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `payment_option`
--
ALTER TABLE `payment_option`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pos_item`
--
ALTER TABLE `pos_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `status_archive`
--
ALTER TABLE `status_archive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `transaction_history`
--
ALTER TABLE `transaction_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `transaction_process`
--
ALTER TABLE `transaction_process`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=263;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_session`
--
ALTER TABLE `user_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `water_type`
--
ALTER TABLE `water_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_module_access`
--
ALTER TABLE `account_module_access`
  ADD CONSTRAINT `access_account_type_id` FOREIGN KEY (`account_type_id`) REFERENCES `account_type` (`id`),
  ADD CONSTRAINT `access_module_id` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`);

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `status_customers_constraint` FOREIGN KEY (`status_archive_id`) REFERENCES `status_archive` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory_item`
--
ALTER TABLE `inventory_item`
  ADD CONSTRAINT `categoryType` FOREIGN KEY (`category_by_id`) REFERENCES `category_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pos_item_id` FOREIGN KEY (`pos_item_id`) REFERENCES `pos_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `status_inventory_item_constraint` FOREIGN KEY (`status_archive_id`) REFERENCES `status_archive` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory_stock`
--
ALTER TABLE `inventory_stock`
  ADD CONSTRAINT `item_name_id_constraint` FOREIGN KEY (`item_name_id`) REFERENCES `inventory_item` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
