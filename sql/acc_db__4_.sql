-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2022 at 11:32 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `audit_trail`
--

INSERT INTO `audit_trail` (`id`, `module_id`, `user_id`, `status`, `data`, `date_log`) VALUES
(1, 5, 1, 1, 'Archived customer with id: 55', '2022-11-28 12:04:57');

-- --------------------------------------------------------

--
-- Table structure for table `category_type`
--

CREATE TABLE `category_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_name`, `address`, `contact_number1`, `contact_number2`, `note`, `balance`, `status_archive_id`, `created_by`, `created_at`) VALUES
(1, 'Lorenzo', 'Sta.Cruz St.', '09892829485', '09223232222112', 'tabing jollibee', 0.00, 2, '', '2022-11-27 14:48:29'),
(2, 'Stephen Smith', 'Curry St., Brgy. San Lorenzo', '09992829375', '09284573431', '', 0.00, 1, '', '2022-11-27 01:38:32');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `ID` int(11) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `middle_name` varchar(20) NOT NULL,
  `position` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL DEFAULT current_timestamp(),
  `email_address` varchar(255) NOT NULL,
  `contact_number` int(50) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`ID`, `last_name`, `first_name`, `middle_name`, `position`, `date_of_birth`, `email_address`, `contact_number`, `created_at`) VALUES
(1, 'Smith', 'Edward', 'Cruz', '', '2022-11-19', 'EdwardSmith123@gmail.com', 1234567891, '0000-00-00'),
(2, 'Tabudol', 'Sack', 'Brin', '', '2022-11-19', 'Zack123budol@gmail.com', 987654321, '0000-00-00'),
(3, 'Santos', 'Nikolas', 'Anderas', '', '2022-11-19', 'Nikols123@gmail.com', 987987981, '0000-00-00'),
(4, 'tate', 'andrew', 'sandoval', '', '2022-11-19', 'andrewtate90@gmail.com', 1231231231, '0000-00-00'),
(5, 'Go', 'Mario', 'Lee', '', '2022-11-19', 'MarioGo98@gmail.com', 982332981, '0000-00-00'),
(6, 'Gutierrez', 'Nick', 'Banco', '', '2022-11-19', 'BancoNick@gmail.com', 987234529, '0000-00-00'),
(7, 'Ponte', 'Joseph', 'Cruz', '', '2022-11-19', 'SephSeph98@gmail.com', 987654388, '0000-00-00'),
(8, 'Nino', 'Oliver', 'Marinao', '', '2022-11-19', 'NinoOliver25@gmail.com', 234123532, '0000-00-00'),
(9, 'Ribs', 'Michael', 'Andrian', '', '2022-11-19', 'Michael23@gmail.com', 2147483647, '0000-00-00'),
(10, 'Sol', 'Mario', 'France', '', '2022-11-19', 'SolMario@gmail.com', 2147483647, '0000-00-00'),
(11, 'Talier', 'Francis', 'Winnie', '', '2022-11-19', 'FrancieT@gmail.com', 2147483647, '0000-00-00'),
(12, 'Sunaida', 'Ivan', 'Tabino', '', '2022-11-19', 'Ivanniav@gmail.com', 2147483647, '0000-00-00'),
(13, 'Goli', 'Ligo', 'Amer', '', '2022-11-19', 'Amerrgoli21@gmail.com', 2147483647, '0000-00-00'),
(14, 'Nats', 'Sebastian', 'Anthony', '', '2022-11-19', 'Sebsant@gmail.com', 2147483647, '0000-00-00');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory_item`
--

INSERT INTO `inventory_item` (`id`, `item_name`, `category_by_id`, `reorder_level`, `pos_item`, `selling_price_item`, `alkaline_refill_price`, `mineral_refill_price`, `image`, `created_at`, `status_archive_id`, `updated_at`, `created_by`, `updated_by_id`) VALUES
(1, 'Slim - 5 Gallons', 1, 10, 'Yes', 185.00, 35.00, 30.00, '5_gallon_slim_plastic_container_1568794578_4c2e969d0_progressive.jfif', '2022-11-28 07:46:10', 1, '0000-00-00 00:00:00', '1', 0),
(2, 'Round - 5 Gallons', 1, 10, 'Yes', 185.00, 35.00, 30.00, '77fce6b86eef912efb10429092fa2273.jfif', '2022-11-28 07:48:50', 1, '0000-00-00 00:00:00', '1', 0),
(3, 'Slim - 2.5 Gallons', 1, 5, 'Yes', 130.00, 18.00, 13.00, '2faff09308079c871c09df8025884578.jfif', '2022-11-28 07:49:28', 1, '0000-00-00 00:00:00', '1', 0),
(4, '6 Liter', 2, 10, 'Yes', 60.00, 15.00, 10.00, 'Screenshot 2022-11-28 145335.png', '2022-11-28 07:53:53', 1, '0000-00-00 00:00:00', '1', 0),
(5, '1 Liter', 2, 20, 'Yes', 15.00, 8.00, 6.00, '504350773.jpg', '2022-11-28 07:54:50', 1, '0000-00-00 00:00:00', '1', 0),
(6, '500 ml', 2, 20, 'Yes', 15.00, 5.00, 3.00, '504350773.jpg', '2022-11-28 07:55:23', 1, '0000-00-00 00:00:00', '1', 0),
(7, '350 ml', 2, 15, 'Yes', 10.00, 5.00, 3.00, '504350773.jpg', '2022-11-28 07:59:48', 2, '0000-00-00 00:00:00', '1', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `name`) VALUES
(3, 'CHANGE_PASSWORD'),
(4, 'CODE_VERIFICATION'),
(5, 'CUSTOMER'),
(6, 'DASHBOARD'),
(7, 'EMPLOYEE'),
(2, 'FORGOT_PASSWORD'),
(1, 'LOGIN'),
(8, 'MONITORING'),
(9, 'POS'),
(10, 'INVENTORY'),
(11, 'REPORTS-ATTENDANCE'),
(12, 'REPORTS-DATA_LOGS'),
(13, 'REPORTS-DELIVERY_WALKIN'),
(14, 'REPORTS-EXPENSE'),
(15, 'REPORTS-INVENTORY'),
(16, 'REPORTS-ITEM_ISSUE'),
(17, 'REPORTS_SALES'),
(18, 'SETTINGS');


-- --------------------------------------------------------

--
-- Table structure for table `payment_option`
--

CREATE TABLE `payment_option` (
  `id` int(50) NOT NULL,
  `option_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_option`
--

INSERT INTO `payment_option` (`id`, `option_name`) VALUES
(1, 'Cash On Delivery'),
(3, 'GCash'),
(2, 'Onsite');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `last_name`, `first_name`, `middle_name`, `email`, `password`, `contact_number`, `account_type_id`, `code`, `profile_image`, `created_at`, `status_archive_id`) VALUES
(1, 'Quijano', 'Jerwinsonn', 'Ragasa', 'rapquijano04@gmail.com', '$2y$10$I8wRCPHKUEpPcGqbTA2TSOE94ouosokyWyrFZ2U4NA5NTxnXKmgJy', '09560984209', 1, 1, 'Picture4.jpg', '2022-11-16 21:48:25', 1),
(2, 'Diaz', 'Janry', 'Franco', 'janrydiaz1401@gmail.com', '$2y$10$ptotyRzbZxa0G76Y9wI4R.AF90CYUDijv33qGZnJWDumUE5K.1eae', '09557488018', 1, 0, 'Picture2.jpg', '2022-11-16 21:48:25', 1),
(3, 'Fernandez', 'Hazel Ann', 'Dezena', 'azeannfernandez@gmail.com', '$2y$10$yAjqs00PxqTRNWSHXcdUEOJBgKfefqG96uBW5dIrFWrI5xmHKipE6', '09204933920', 1, 0, 'Picture1.jpg', '2022-11-16 21:48:25', 1),
(4, 'Charvet', 'David Emmanuel', 'Javier', 'deybidsu@gmail.com', '$2y$10$ISBQByEVphgK.0u0FQdDzu1NOF6vCTTTOzoeKVnQnrMHFrZepir4O', '09908998888', 3, 0, 'Picture3.jpg', '2022-11-16 21:48:25', 1),
(5, 'Tagulinao', 'Ricardo', NULL, 'tagswater00@gmail.com', '$2y$10$4ubDa1UpSrYE3s10bOfa5uFFd1EncDdGDB0nFg2wkXKelGseePh.u', '09239029092', 1, NULL, NULL, '2022-11-24 02:15:41', 1),
(6, 'Test', 'Test', 'Test', 'test@gmail.com', '$2y$10$f8VCt6lLMnIqeSbZZDdgxesYXNBkPQwz55gkSRbnMhK7HVNnPIpbG', '09991234567', 1, 0, NULL, '2022-11-24 02:15:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `water_type`
--

CREATE TABLE `water_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id_constraint` (`employee_id`);

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
  ADD PRIMARY KEY (`ID`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category_type`
--
ALTER TABLE `category_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_item`
--
ALTER TABLE `inventory_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `employee_id_constraint` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`ID`);

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
