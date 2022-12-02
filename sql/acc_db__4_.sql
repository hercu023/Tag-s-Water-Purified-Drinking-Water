-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2022 at 05:21 PM
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
    (1, 1, 1, 1, 0, 3, 2);

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
                              `date` datetime NOT NULL,
                              `time_in` time NOT NULL,
                              `time_out` time NOT NULL,
                              `deduction` float(11,2) NOT NULL,
  `bonus` float(11,2) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `payroll_status` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `date_updated` datetime NOT NULL
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
                                                                                                                                                                         (4, 'CN', 'ADDRESS', '1234', '1234', 'Test note', 0.00, 1, '6', '2022-11-30 02:34:48'),
                                                                                                                                                                         (5, 'Test', 'Test ', '1234', '1234', 'Test note', 0.00, 1, '6', '2022-11-30 02:35:11');

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
                                                                                                                                                                                                                                            (2, 'Tabudol', 'Sack', 'Brin', '1', 0.00, '2022-11-19', 'Zack123budol@gmail.com', 987654321, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1),
                                                                                                                                                                                                                                            (3, 'Santos', 'Nikolas', 'Anderas', '1', 0.00, '2022-11-19', 'Nikols123@gmail.com', 987987981, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1),
                                                                                                                                                                                                                                            (4, 'tate', 'andrew', 'sandoval', '1', 0.00, '2022-11-19', 'andrewtate90@gmail.com', 1231231231, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1),
                                                                                                                                                                                                                                            (5, 'Go', 'Mario', 'Lee', '1', 0.00, '2022-11-19', 'MarioGo98@gmail.com', 982332981, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1),
                                                                                                                                                                                                                                            (6, 'Gutierrez', 'Nick', 'Banco', '1', 0.00, '2022-11-19', 'BancoNick@gmail.com', 987234529, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1),
                                                                                                                                                                                                                                            (7, 'Ponte', 'Joseph', 'Cruz', '1', 0.00, '2022-11-19', 'SephSeph98@gmail.com', 987654388, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1),
                                                                                                                                                                                                                                            (8, 'Nino', 'Oliver', 'Marinao', '1', 0.00, '2022-11-19', 'NinoOliver25@gmail.com', 234123532, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1),
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
                                                                                                                                                                                   (4, 3, '2022-11-28', 123.00, '123', 6, '2022-12-01 00:11:36', 6, '2022-12-01 00:11:36', 1, 1);

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
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
                             `id` int(11) NOT NULL,
                             `category_item_id` int(11) NOT NULL,
                             `original_stocks` int(11) NOT NULL,
                             `remaining_stocks` int(11) NOT NULL,
                             `supplier_id` int(11) NOT NULL,
                             `supplier_price` float(11,2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by_id` int(11) NOT NULL,
  `updated_by_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_item`
--

CREATE TABLE `inventory_item` (
                                  `id` int(11) NOT NULL,
                                  `item_name` varchar(255) NOT NULL,
                                  `category_by_id` int(11) NOT NULL,
                                  `reorder_level` int(11) NOT NULL,
                                  `pos_item` varchar(50) NOT NULL,
                                  `selling_price_item` float(11,2) NOT NULL,
  `alkaline_refill_price` float(11,2) NOT NULL,
  `mineral_refill_price` float(11,2) NOT NULL,
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

INSERT INTO `inventory_item` (`id`, `item_name`, `category_by_id`, `reorder_level`, `pos_item`, `selling_price_item`, `alkaline_refill_price`, `mineral_refill_price`, `image`, `created_at`, `status_archive_id`, `updated_at`, `created_by`, `updated_by_id`) VALUES
                                                                                                                                                                                                                                                                    (1, 'Slim - 5 Gallons', 1, 111, 'Yes', 185.00, 35.00, 30.00, '77fce6b86eef912efb10429092fa2273.jfif', '2022-11-28 07:46:10', 1, '2022-11-28 22:30:05', '1', 6),
                                                                                                                                                                                                                                                                    (2, 'Round - 5 Gallons', 1, 10, 'Yes', 185.00, 35.00, 30.00, '5_gallon_slim_plastic_container_1568794578_4c2e969d0_progressive.jfif', '2022-11-28 07:48:50', 1, '0000-00-00 00:00:00', '1', 0),
                                                                                                                                                                                                                                                                    (3, 'Slim - 2.5 Gallons', 5, 5, 'Yes', 130.00, 20.00, 15.00, '2faff09308079c871c09df8025884578.jfif', '2022-11-28 07:49:28', 1, '0000-00-00 00:00:00', '1', 0),
                                                                                                                                                                                                                                                                    (4, '6 Liter', 2, 10, 'Yes', 60.00, 16.00, 10.00, 'Screenshot 2022-11-28 145335.png', '2022-11-28 07:53:53', 1, '0000-00-00 00:00:00', '1', 0),
                                                                                                                                                                                                                                                                    (5, '1 Liter', 2, 20, 'Yes', 15.00, 8.00, 6.00, '504350773.jpg', '2022-11-28 07:54:50', 1, '0000-00-00 00:00:00', '1', 0),
                                                                                                                                                                                                                                                                    (6, '500 ml', 2, 20, 'Yes', 15.00, 5.00, 3.00, '504350773.jpg', '2022-11-28 07:55:23', 1, '0000-00-00 00:00:00', '1', 0),
                                                                                                                                                                                                                                                                    (7, '350 ml', 2, 15, 'Yes', 10.00, 5.00, 3.00, '504350773.jpg', '2022-11-28 07:59:48', 1, '0000-00-00 00:00:00', '1', 0),
                                                                                                                                                                                                                                                                    (8, 'Test', 3, 1, 'Yes', 1.00, 1.00, 1.00, '504350773.jpg', '2022-11-28 01:13:30', 1, '0000-00-00 00:00:00', '1', 0),
                                                                                                                                                                                                                                                                    (10, 'Test 2', 1, 2, 'Yes', 1.00, 1.00, 1.00, '77fce6b86eef912efb10429092fa2273.jfif', '2022-11-28 22:10:44', 1, '0000-00-00 00:00:00', '1', 0),
                                                                                                                                                                                                                                                                    (11, 'Test 3', 5, 121, 'Yes', 1.00, 1.00, 1.00, '504350773.jpg', '2022-11-28 22:17:48', 1, '2022-11-28 23:40:45', '6', 6),
                                                                                                                                                                                                                                                                    (12, 'Test 4', 4, 123, 'Yes', 123.00, 123.00, 123.00, '2faff09308079c871c09df8025884578.jfif', '2022-11-28 22:27:21', 1, '0000-00-00 00:00:00', '6', 0),
                                                                                                                                                                                                                                                                    (13, 'Test 5', 5, 1, 'Yes', 1.00, 1.00, 1.00, '2faff09308079c871c09df8025884578.jfif', '2022-11-28 23:37:26', 1, '0000-00-00 00:00:00', '6', 0),
                                                                                                                                                                                                                                                                    (14, 'Test 11', 2, 1, 'No', 1.00, 1.00, 1.00, '77fce6b86eef912efb10429092fa2273.jfif', '2022-11-28 23:46:28', 1, '0000-00-00 00:00:00', '6', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_log`
--

CREATE TABLE `inventory_log` (
                                 `id` int(11) NOT NULL,
                                 `inventory_id` int(11) NOT NULL,
                                 `details` varchar(255) NOT NULL,
                                 `created_at` datetime NOT NULL DEFAULT current_timestamp(),
                                 `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
                                 `created_by` varchar(255) NOT NULL,
                                 `updated_by` varchar(255) NOT NULL,
                                 `action` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
                                        (19, 'ACCOUNT'),
                                        (3, 'CHANGE_PASSWORD'),
                                        (4, 'CODE_VERIFICATION'),
                                        (5, 'CUSTOMER'),
                                        (6, 'DASHBOARD'),
                                        (7, 'EMPLOYEE'),
                                        (21, 'EXPENSE'),
                                        (2, 'FORGOT_PASSWORD'),
                                        (10, 'INVENTORY'),
                                        (1, 'LOGIN'),
                                        (8, 'MONITORING'),
                                        (9, 'POS'),
                                        (11, 'REPORTS-ATTENDANCE'),
                                        (12, 'REPORTS-DATA_LOGS'),
                                        (13, 'REPORTS-DELIVERY_WALKIN'),
                                        (14, 'REPORTS-EXPENSE'),
                                        (15, 'REPORTS-INVENTORY'),
                                        (16, 'REPORTS-ITEM_ISSUE'),
                                        (17, 'REPORTS_SALES'),
                                        (18, 'SETTINGS'),
                                        (20, 'SETTINGS-ARCHIVE');

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
                               `customer_id` int(11) NOT NULL,
                               `inventory_id` int(11) DEFAULT NULL,
                               `category_type_id` int(11) DEFAULT NULL,
                               `water_type_id` int(11) NOT NULL,
                               `water_service` enum('Refill','New') NOT NULL,
                               `service_type` enum('Walk In','Delivery') NOT NULL,
                               `refill_price` float(11,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_amount` float(11,2) NOT NULL,
  `customer_change` float(11,2) NOT NULL,
  `amount_tendered` float(11,2) NOT NULL,
  `payment_option_id` int(11) NOT NULL,
  `is_pick_up` tinyint(1) NOT NULL,
  `status_id` int(11) NOT NULL,
  `created_by_id` int(11) NOT NULL,
  `updated_by_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
                                                                                                                                                                                                    (1, 'Quijano', 'Jerwinsonn', 'Ragasa', 'rapquijano04@gmail.com', '$2y$10$I8wRCPHKUEpPcGqbTA2TSOE94ouosokyWyrFZ2U4NA5NTxnXKmgJy', '09560984209', 1, 1, 'Picture4.jpg', '2022-11-16 21:48:25', 1),
                                                                                                                                                                                                    (2, 'Diaz', 'Janry', 'Franco', 'janrydiaz1401@gmail.com', '$2y$10$ptotyRzbZxa0G76Y9wI4R.AF90CYUDijv33qGZnJWDumUE5K.1eae', '09557488018', 1, 0, 'Picture2.jpg', '2022-11-16 21:48:25', 1),
                                                                                                                                                                                                    (3, 'Fernandez', 'Hazel Ann', 'Dezena', 'azeannfernandez@gmail.com', '$2y$10$yAjqs00PxqTRNWSHXcdUEOJBgKfefqG96uBW5dIrFWrI5xmHKipE6', '09204933920', 1, 0, 'Picture1.jpg', '2022-11-16 21:48:25', 1),
                                                                                                                                                                                                    (4, 'Charvet', 'David Emmanuel', 'Javier', 'deybidsu@gmail.com', '$2y$10$ISBQByEVphgK.0u0FQdDzu1NOF6vCTTTOzoeKVnQnrMHFrZepir4O', '09908998888', 3, 0, 'Picture3.jpg', '2022-11-16 21:48:25', 1),
                                                                                                                                                                                                    (5, 'Tagulinao', 'Ricardo', NULL, 'tagswater00@gmail.com', '$2y$10$4ubDa1UpSrYE3s10bOfa5uFFd1EncDdGDB0nFg2wkXKelGseePh.u', '09239029092', 1, NULL, NULL, '2022-11-24 02:15:41', 2),
                                                                                                                                                                                                    (6, 'Test', 'Test', 'Test', 'test@gmail.com', '$2y$10$9WaDbgOFQQBG.3L1rM/5leS/M6DU8YqK3Z6O/n0YamfpcM8WqmD5u', '09991234567', 1, 0, NULL, '2022-11-24 02:15:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_session`
--

CREATE TABLE `user_session` (
                                `id` int(11) NOT NULL,
                                `user_id` int(11) NOT NULL,
                                `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
    ADD PRIMARY KEY (`id`),
  ADD KEY `category_item_id_constraint` (`category_item_id`),
  ADD KEY `supplier_id_constraint` (`supplier_id`);

--
-- Indexes for table `inventory_item`
--
ALTER TABLE `inventory_item`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `inventory_item_name_index` (`item_name`),
  ADD UNIQUE KEY `item_name` (`item_name`),
  ADD KEY `status_inventory_item_constraint` (`status_archive_id`);

--
-- Indexes for table `inventory_log`
--
ALTER TABLE `inventory_log`
    ADD PRIMARY KEY (`id`),
  ADD KEY `inventory_log_id_constraint` (`inventory_id`);

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
    ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id_constraint` (`customer_id`),
  ADD KEY `category_item_id` (`category_type_id`),
  ADD KEY `payment_option_id_constraint` (`payment_option_id`),
  ADD KEY `inventory_id_constraint` (`inventory_id`),
  ADD KEY `water_type_id_constraint` (`water_type_id`),
  ADD KEY `created_by_id_constraint` (`created_by_id`),
  ADD KEY `updated_by_id_contraint` (`updated_by_id`),
  ADD KEY `status_id_constraint` (`status_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`) USING BTREE,
  ADD KEY `users_account_type_id` (`account_type_id`);

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
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `category_type`
--
ALTER TABLE `category_type`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `expense_type`
--
ALTER TABLE `expense_type`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_item`
--
ALTER TABLE `inventory_item`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `inventory_log`
--
ALTER TABLE `inventory_log`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_history`
--
ALTER TABLE `login_history`
    MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `payment_option`
--
ALTER TABLE `payment_option`
    MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
    MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
    ADD CONSTRAINT `category_item_id_constraint` FOREIGN KEY (`category_item_id`) REFERENCES `inventory_item` (`id`),
  ADD CONSTRAINT `supplier_id_constraint` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`);

--
-- Constraints for table `inventory_item`
--
ALTER TABLE `inventory_item`
    ADD CONSTRAINT `status_inventory_item_constraint` FOREIGN KEY (`status_archive_id`) REFERENCES `status_archive` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory_log`
--
ALTER TABLE `inventory_log`
    ADD CONSTRAINT `inventory_log_id_constraint` FOREIGN KEY (`inventory_id`) REFERENCES `inventory` (`id`);

--
-- Constraints for table `login_history`
--
ALTER TABLE `login_history`
    ADD CONSTRAINT `user_id_constraint` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
    ADD CONSTRAINT `category_item_id` FOREIGN KEY (`category_type_id`) REFERENCES `inventory_item` (`id`),
  ADD CONSTRAINT `created_by_id_constraint` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `customer_id_constraint` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `inventory_id_constraint` FOREIGN KEY (`inventory_id`) REFERENCES `inventory` (`id`),
  ADD CONSTRAINT `payment_option_id_constraint` FOREIGN KEY (`payment_option_id`) REFERENCES `payment_option` (`id`),
  ADD CONSTRAINT `status_id_constraint` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON UPDATE CASCADE,
                                                                                                                                                                                                             ADD CONSTRAINT `updated_by_id_contraint` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`user_id`),
                                                                                                                                                                                                             ADD CONSTRAINT `water_type_id_constraint` FOREIGN KEY (`water_type_id`) REFERENCES `water_type` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
    ADD CONSTRAINT `users_account_type_id` FOREIGN KEY (`account_type_id`) REFERENCES `account_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
