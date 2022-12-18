-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2022 at 04:53 AM
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
(44, 1, 1, 1, 1, 3, 6);

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
(318, 1, 1, 1, 'Logged in the system', '2022-12-04 00:26:28'),
(319, 0, 1, 1, 'Updated user with id:3', '2022-12-04 00:26:51'),
(320, 1, 1, 1, 'Logged out of the system', '2022-12-04 00:26:59'),
(321, 1, 3, 0, 'Incorrect password input', '2022-12-04 00:27:02'),
(322, 1, 3, 1, 'Logged in the system', '2022-12-04 00:27:07'),
(323, 1, 3, 0, 'Restricted login, still has an active session.', '2022-12-04 00:29:27'),
(324, 1, 3, 1, 'Logged out of the system', '2022-12-04 00:29:37'),
(325, 1, 3, 1, 'Logged in the system', '2022-12-04 00:29:42'),
(326, 1, 3, 1, 'Logged out of the system', '2022-12-04 00:32:33'),
(327, 1, 3, 1, 'Logged in the system', '2022-12-04 00:40:34'),
(328, 1, 3, 1, 'Logged out of the system', '2022-12-04 01:38:27'),
(329, 2, 1, 1, 'Verification code sent to email', '2022-12-04 01:38:48'),
(330, 1, 1, 1, 'Logged in the system', '2022-12-04 01:47:59'),
(331, 1, 1, 0, 'Restricted login, still has an active session.', '2022-12-04 14:48:05'),
(332, 1, 1, 0, 'Incorrect password input', '2022-12-04 14:48:11'),
(333, 1, 1, 0, 'Restricted login, still has an active session.', '2022-12-04 14:48:16'),
(334, 1, 1, 0, 'Incorrect password input', '2022-12-04 14:48:39'),
(335, 1, 1, 0, 'Restricted login, still has an active session.', '2022-12-04 14:48:42'),
(336, 1, 1, 0, 'Incorrect password input', '2022-12-04 14:49:17'),
(337, 1, 3, 0, 'Incorrect password input', '2022-12-04 14:49:24'),
(338, 1, 3, 1, 'Logged in the system', '2022-12-04 14:49:28'),
(339, 1, 3, 1, 'Logged out of the system', '2022-12-04 14:49:31'),
(340, 1, 1, 0, 'Incorrect password input', '2022-12-04 14:49:37'),
(341, 1, 1, 0, 'Restricted login, still has an active session.', '2022-12-04 14:49:40'),
(342, 1, 1, 0, 'Incorrect password input', '2022-12-04 14:50:36'),
(343, 1, 1, 0, 'Restricted login, still has an active session.', '2022-12-04 14:50:39'),
(344, 2, 1, 1, 'Verification code sent to email', '2022-12-04 14:51:54'),
(345, 4, 1, 1, 'Valid code input', '2022-12-04 14:52:10'),
(346, 3, 1, 1, 'Update password successful', '2022-12-04 14:52:15'),
(347, 1, 1, 1, 'Logged out of the system', '2022-12-04 14:52:16'),
(348, 1, 1, 1, 'Logged in the system', '2022-12-04 14:52:20'),
(349, 1, 3, 0, 'Incorrect password input', '2022-12-04 14:56:19'),
(350, 1, 3, 1, 'Logged in the system', '2022-12-04 14:56:23'),
(351, 1, 1, 0, 'Restricted login, still has an active session.', '2022-12-04 14:58:10'),
(352, 1, 1, 1, 'Logged out of the system', '2022-12-04 14:58:15'),
(353, 1, 1, 0, 'Restricted login, still has an active session.', '2022-12-04 14:58:29'),
(354, 1, 1, 0, 'Restricted login, still has an active session.', '2022-12-04 14:58:35'),
(355, 1, 3, 0, 'Incorrect password input', '2022-12-04 14:58:37'),
(356, 1, 3, 1, 'Logged in the system', '2022-12-04 14:58:41'),
(357, 1, 3, 1, 'Logged out of the system', '2022-12-04 14:58:43'),
(358, 1, 1, 0, 'Restricted login, still has an active session.', '2022-12-04 14:58:54'),
(359, 2, 1, 1, 'Verification code sent to email', '2022-12-04 14:59:07'),
(360, 4, 1, 1, 'Valid code input', '2022-12-04 15:00:37'),
(361, 3, 1, 1, 'Update password successful', '2022-12-04 15:00:53'),
(362, 1, 1, 1, 'Logged out of the system', '2022-12-04 15:00:54'),
(363, 1, 1, 0, 'Incorrect password input', '2022-12-04 15:01:10'),
(364, 1, 1, 1, 'Logged in the system', '2022-12-04 15:01:13'),
(365, 1, 3, 1, 'Logged in the system', '2022-12-04 15:01:20'),
(366, 1, 3, 1, 'Logged out of the system', '2022-12-04 15:01:31'),
(367, 1, 1, 0, 'Incorrect password input', '2022-12-04 15:01:42'),
(368, 1, 1, 0, 'Restricted login, still has an active session.', '2022-12-04 15:01:46'),
(369, 1, 1, 1, 'Logged out of the system', '2022-12-04 15:02:10'),
(370, 1, 3, 1, 'Logged in the system', '2022-12-04 15:02:18'),
(371, 1, 3, 1, 'Logged out of the system', '2022-12-04 15:02:51'),
(372, 1, 1, 0, 'Restricted login, still has an active session.', '2022-12-04 15:02:55'),
(373, 1, 3, 1, 'Logged in the system', '2022-12-04 15:09:07'),
(374, 1, 3, 1, 'Logged out of the system', '2022-12-04 15:10:42'),
(375, 1, 1, 0, 'Incorrect password input', '2022-12-04 15:10:47'),
(376, 1, 1, 0, 'Restricted login, still has an active session.', '2022-12-04 15:10:51'),
(377, 2, 1, 1, 'Verification code sent to email', '2022-12-04 15:11:07'),
(378, 4, 1, 1, 'Valid code input', '2022-12-04 15:11:18'),
(379, 3, 1, 1, 'Update password successful', '2022-12-04 15:11:24'),
(380, 1, 1, 1, 'Logged out of the system', '2022-12-04 15:11:25'),
(381, 1, 1, 1, 'Logged in the system', '2022-12-04 15:11:29'),
(382, 0, 1, 1, 'Updated user with id:1', '2022-12-04 15:12:20'),
(383, 1, 1, 1, 'Logged out of the system', '2022-12-04 15:12:29'),
(384, 1, 1, 1, 'Logged in the system', '2022-12-04 15:12:36'),
(385, 1, 1, 1, 'Logged out of the system', '2022-12-04 15:12:54'),
(386, 1, 1, 1, 'Logged in the system', '2022-12-04 15:12:59'),
(387, 0, 1, 1, 'Updated user with id:1', '2022-12-04 15:13:21'),
(388, 1, 1, 1, 'Logged out of the system', '2022-12-04 15:13:27'),
(389, 1, 1, 1, 'Logged in the system', '2022-12-04 15:13:31'),
(390, 1, 1, 1, 'Logged out of the system', '2022-12-04 15:59:02'),
(391, 1, 1, 1, 'Logged in the system', '2022-12-04 15:59:07'),
(392, 1, 1, 1, 'Logged out of the system', '2022-12-04 15:59:10'),
(393, 1, 2, 1, 'Logged in the system', '2022-12-04 15:59:40'),
(394, 1, 2, 1, 'Logged out of the system', '2022-12-04 16:12:39'),
(395, 1, 1, 0, 'Incorrect password input', '2022-12-04 16:12:44'),
(396, 1, 1, 1, 'Logged in the system', '2022-12-04 16:12:48'),
(397, 1, 1, 1, 'Logged out of the system', '2022-12-04 16:23:26'),
(398, 1, 1, 0, 'Incorrect password input', '2022-12-04 16:23:29'),
(399, 1, 1, 1, 'Logged in the system', '2022-12-04 16:23:33'),
(400, 0, 1, 1, 'Updated inventory item with id:25', '2022-12-04 16:25:48'),
(401, 0, 1, 1, 'Updated inventory item with id:26', '2022-12-04 16:26:01'),
(402, 0, 1, 1, 'Updated inventory item with id:26', '2022-12-04 16:26:09'),
(403, 0, 1, 1, 'Updated inventory item with id:30', '2022-12-04 16:26:14'),
(404, 0, 1, 1, 'Updated inventory item with id:20', '2022-12-04 16:26:22'),
(405, 0, 1, 1, 'Updated inventory item with id:34', '2022-12-04 16:26:32'),
(406, 0, 1, 1, 'Updated inventory item with id:34', '2022-12-04 16:26:42'),
(407, 0, 1, 1, 'Updated inventory item with id:29', '2022-12-04 16:26:48'),
(408, 0, 1, 1, 'Updated inventory item with id:29', '2022-12-04 16:26:59'),
(409, 0, 1, 1, 'Updated inventory item with id:25', '2022-12-04 16:27:04'),
(410, 0, 1, 1, 'Updated inventory item with id:30', '2022-12-04 16:27:11'),
(411, 1, 1, 1, 'Logged out of the system', '2022-12-04 16:36:01'),
(412, 1, 3, 1, 'Logged in the system', '2022-12-04 16:36:06'),
(413, 1, 3, 1, 'Logged out of the system', '2022-12-04 16:39:42'),
(414, 1, 1, 1, 'Logged in the system', '2022-12-04 16:39:47'),
(415, 0, 1, 1, 'Updated inventory item with id:30', '2022-12-04 21:58:24'),
(416, 0, 1, 1, 'Updated inventory item with id:29', '2022-12-04 21:58:29'),
(417, 0, 1, 1, 'Updated inventory item with id:28', '2022-12-04 21:58:35'),
(418, 0, 1, 1, 'Updated inventory item with id:28', '2022-12-04 22:03:14'),
(419, 0, 1, 1, 'Updated inventory item with id:29', '2022-12-04 22:03:23'),
(420, 0, 1, 1, 'Updated inventory item with id:30', '2022-12-04 22:03:28'),
(421, 0, 1, 1, 'Added new inventory with id:35', '2022-12-04 22:40:23'),
(422, 0, 1, 1, 'Added new inventory with id:36', '2022-12-04 22:42:30'),
(423, 0, 1, 1, 'Updated inventory item with id:20', '2022-12-04 23:56:05'),
(424, 0, 1, 1, 'Updated inventory item with id:36', '2022-12-05 00:06:04'),
(425, 0, 1, 1, 'Updated inventory item with id:21', '2022-12-05 00:06:17'),
(426, 0, 1, 1, 'Updated inventory item with id:21', '2022-12-05 00:07:14'),
(427, 0, 1, 1, 'Updated inventory item with id:36', '2022-12-05 00:07:21'),
(428, 1, 1, 0, 'Incorrect password input', '2022-12-05 19:29:05'),
(429, 1, 1, 0, 'Restricted login, still has an active session.', '2022-12-05 19:29:10'),
(430, 1, 1, 1, 'Logged in the system', '2022-12-05 19:29:49'),
(431, 1, 1, 0, 'Incorrect password input', '2022-12-05 22:34:49'),
(432, 1, 1, 1, 'Logged in the system', '2022-12-05 22:34:53'),
(433, 0, 1, 1, 'Archived inventory item with id: 36', '2022-12-06 01:48:17'),
(434, 1, 1, 0, 'Incorrect password input', '2022-12-06 12:52:48'),
(435, 1, 1, 0, 'Restricted login, still has an active session.', '2022-12-06 12:52:53'),
(436, 1, 1, 1, 'Logged in the system', '2022-12-06 12:53:37'),
(437, 28, 1, 1, 'Restored inventory item with id:36', '2022-12-06 19:08:00'),
(438, 0, 1, 1, 'Updated inventory item with id:35', '2022-12-06 19:11:30'),
(439, 0, 1, 1, 'Updated inventory item with id:35', '2022-12-06 19:11:42'),
(440, 0, 1, 1, 'Updated inventory item with id:26', '2022-12-06 19:14:19'),
(441, 0, 1, 1, 'Updated inventory item with id:20', '2022-12-06 22:26:56'),
(442, 0, 1, 1, 'Updated inventory item with id:21', '2022-12-06 22:27:30'),
(443, 0, 1, 1, 'Updated inventory item with id:23', '2022-12-06 22:27:58'),
(444, 0, 1, 1, 'Updated inventory item with id:23', '2022-12-06 22:28:07'),
(445, 0, 1, 1, 'Updated inventory item with id:25', '2022-12-06 22:28:28'),
(446, 0, 1, 1, 'Updated inventory item with id:28', '2022-12-06 22:28:57'),
(447, 0, 1, 1, 'Updated inventory item with id:28', '2022-12-06 22:29:28'),
(448, 0, 1, 1, 'Updated inventory item with id:29', '2022-12-06 22:30:22'),
(449, 0, 1, 1, 'Updated inventory item with id:30', '2022-12-06 22:30:48'),
(450, 1, 1, 0, 'Restricted login, still has an active session.', '2022-12-07 15:44:01'),
(451, 1, 1, 1, 'Logged in the system', '2022-12-07 15:44:36'),
(452, 0, 1, 1, 'Added new inventory with id:51', '2022-12-07 15:50:22'),
(453, 0, 1, 1, 'Added new inventory with id:29', '2022-12-07 16:01:56'),
(454, 1, 1, 1, 'Logged out of the system', '2022-12-08 00:53:39'),
(455, 1, 1, 1, 'Logged in the system', '2022-12-08 00:53:44'),
(456, 1, 1, 1, 'Logged out of the system', '2022-12-08 00:53:48'),
(457, 1, 1, 1, 'Logged in the system', '2022-12-10 18:34:05'),
(458, 6, 1, 1, 'Added new customer with id:6', '2022-12-11 03:41:02'),
(459, 1, 1, 0, 'Restricted login, still has an active session.', '2022-12-12 23:58:07'),
(460, 1, 1, 1, 'Logged in the system', '2022-12-12 23:58:32'),
(461, 6, 1, 1, 'Added new customer with id:7', '2022-12-12 23:59:28'),
(462, 6, 1, 1, 'Added new customer with id:8', '2022-12-12 23:59:43'),
(463, 1, 1, 0, 'Restricted login, still has an active session.', '2022-12-14 21:26:18'),
(464, 1, 1, 0, 'Restricted login, still has an active session.', '2022-12-14 21:26:43'),
(465, 1, 1, 1, 'Logged in the system', '2022-12-14 21:27:11'),
(466, 6, 1, 1, 'Added new customer with id:9', '2022-12-14 21:39:05'),
(467, 1, 1, 0, 'Restricted login, still has an active session.', '2022-12-16 15:53:49'),
(468, 1, 1, 1, 'Logged in the system', '2022-12-16 15:54:15'),
(469, 6, 1, 1, 'Added new customer with id:10', '2022-12-16 22:36:12'),
(470, 6, 1, 0, 'Customer name already exist', '2022-12-17 00:41:10'),
(471, 6, 1, 0, 'Customer name already exist', '2022-12-17 00:43:03'),
(472, 6, 1, 0, 'Customer name already exist', '2022-12-17 01:23:01'),
(473, 1, 1, 0, 'Restricted login, still has an active session.', '2022-12-18 10:43:01'),
(474, 1, 1, 1, 'Logged in the system', '2022-12-18 11:03:19');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_name`, `address`, `contact_number1`, `contact_number2`, `note`, `balance`, `status_archive_id`, `created_by`, `created_at`) VALUES
(1, 'Lorenzo', 'Sta.Cruz St.', '09892829485', '09223232222112', 'tabing jollibee', 0.00, 1, '1', '2022-11-27 14:48:29'),
(2, 'Stephen Smith', 'Curry St., Brgy. San Lorenzo', '09992829375', '09284573431', '', 0.00, 1, '1', '2022-11-27 01:38:32'),
(3, 'Test Name', 'Test ', '1234', '1234', 'Test note', 0.00, 1, '6', '2022-11-30 02:28:56'),
(4, 'CN', 'ADDRESS', '1234', '1234', 'Test note', 0.00, 1, '6', '2022-11-30 02:34:48'),
(5, 'Test', 'Test ', '1234', '1234', 'Test note', 0.00, 1, '6', '2022-11-30 02:35:11'),
(6, 'Jerwinsonn Raphael Quijano', 'B7 L7 Sta.Ana St., Villa Ligaya Subd., Brgy. Dela ', '2', '2', '2', 0.00, 1, '1', '2022-12-11 03:41:02'),
(7, 'Dylan Angelo', 'Sto. Nino St., Brgy. San Isidro', '0989988899', '0937485758', '', 0.00, 1, '1', '2022-12-12 23:59:28'),
(9, '', '', '', '', '', 0.00, 1, '1', '2022-12-14 21:39:05'),
(10, 'Jessica Soho', 'Lapu-lapu St., Brgy. Tagbili, Antipolo City', '09992829375', '09283948989', 'Green gate, unang kanan sa dulo.', 0.00, 1, '1', '2022-12-16 22:36:12');

-- --------------------------------------------------------

--
-- Table structure for table `deliver_price`
--

CREATE TABLE `deliver_price` (
  `id` int(11) NOT NULL,
  `service` varchar(255) NOT NULL,
  `price` float(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(15, '1.5 Liters', 10, 0, 1, 0.00, 12.00, 10.00, '', '2022-12-01 22:12:20', 1, '2022-12-04 16:26:42', '1', 1),
(16, 'Faucet - Rotatable', 7, 5, 1, 25.00, 0.00, 0.00, 'Screenshot 2022-12-04 223707.png', '2022-12-04 22:40:23', 1, '2022-12-06 19:11:42', '1', 1),
(17, 'Ice Tube', 7, 5, 1, 10.00, 0.00, 0.00, '1000_F_350366345_8Jh0duvK9Q6yVPniIr1GO1VYoCovZASX.jpg', '2022-12-04 22:42:30', 1, '2022-12-05 00:07:20', '1', 1),
(18, 'Small Cap Seal', 3, 5, 2, 0.00, 0.00, 0.00, 'Screenshot 2022-12-07 155001.png', '2022-12-07 15:50:21', 1, '0000-00-00 00:00:00', '1', 0),
(29, 'Slim - 5 Gallons with Cap and Faucet', 1, 2, 2, 0.00, 0.00, 0.00, '', '2022-12-07 16:01:56', 1, '0000-00-00 00:00:00', '1', 0);

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
-- Table structure for table `position_type`
--

CREATE TABLE `position_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `customer_name` varchar(255) NOT NULL,
  `inventory_id` int(11) DEFAULT NULL,
  `category_type_id` int(11) DEFAULT NULL,
  `water_type` varchar(255) NOT NULL,
  `water_service` varchar(255) NOT NULL,
  `service_type` varchar(255) NOT NULL,
  `price` float(11,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_amount` float(11,2) NOT NULL,
  `customer_change` float(11,2) NOT NULL,
  `amount_tendered` float(11,2) NOT NULL,
  `payment_option_id` int(11) NOT NULL,
  `note` varchar(255) NOT NULL,
  `is_pick_up` tinyint(1) NOT NULL,
  `status_id` int(11) NOT NULL,
  `created_by_id` int(11) NOT NULL,
  `updated_by_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_process`
--

INSERT INTO `transaction_process` (`id`, `item_name`, `water_type`, `category_type`, `quantity`, `price`, `total_price`, `user_id`) VALUES
(114, '1.5 Liters', 'Alkaline', 'For Refill', 2, 12.00, 24.00, 1);

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
(1, 'Quijano', 'Jerwinsonn', 'Ragasa', 'rapquijano04@gmail.com', '$2y$10$J1xO3JUJkX/UzKafqZU73OPzkUy0jyZjWRaFUeonxsMaQa6.hMjkO', '09560984209', 1, 0, 'Picture4.jpg', '2022-11-16 21:48:25', 1),
(2, 'Diaz', 'Janry', 'Franco', 'janrydiaz1401@gmail.com', '$2y$10$ptotyRzbZxa0G76Y9wI4R.AF90CYUDijv33qGZnJWDumUE5K.1eae', '09557488018', 1, 0, 'Picture2.jpg', '2022-11-16 21:48:25', 1),
(3, 'Fernandez', 'Hazel Ann', 'Dezena', 'azeannfernandez@gmail.com', '$2y$10$yAjqs00PxqTRNWSHXcdUEOJBgKfefqG96uBW5dIrFWrI5xmHKipE6', '09204933920', 3, 0, 'Picture1.jpg', '2022-11-16 21:48:25', 1),
(4, 'Charvet', 'David Emmanuel', 'Javier', 'deybidsu@gmail.com', '$2y$10$ISBQByEVphgK.0u0FQdDzu1NOF6vCTTTOzoeKVnQnrMHFrZepir4O', '09908998888', 3, 0, 'Picture3.jpg', '2022-11-16 21:48:25', 1),
(5, 'Tagulinao', 'Ricardo', NULL, 'tagswater00@gmail.com', '$2y$10$4ubDa1UpSrYE3s10bOfa5uFFd1EncDdGDB0nFg2wkXKelGseePh.u', '09239029092', 1, NULL, NULL, '2022-11-24 02:15:41', 1),
(6, 'Test', 'Test', 'Test', 'test@gmail.com', '$2y$10$XFSKy5tnAQZ0e7ZL6kdChOGrmoWJyJ1HUwQwU3HhBGul9lHiUFqbi', '09991234567', 2, 0, NULL, '2022-11-24 02:15:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_session`
--

CREATE TABLE `user_session` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `session_key` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_session`
--

INSERT INTO `user_session` (`id`, `user_id`, `session_key`, `status`) VALUES
(32, 1, 'b21972a5d74ff84223b8', 'ACTIVE');

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
  ADD KEY `status_inventory_item_constraint` (`status_archive_id`),
  ADD KEY `categoryType` (`category_by_id`),
  ADD KEY `pos_item_id` (`pos_item_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_item_id` (`category_type_id`),
  ADD KEY `payment_option_id_constraint` (`payment_option_id`),
  ADD KEY `inventory_id_constraint` (`inventory_id`),
  ADD KEY `created_by_id_constraint` (`created_by_id`),
  ADD KEY `updated_by_id_contraint` (`updated_by_id`),
  ADD KEY `status_id_constraint` (`status_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=475;

--
-- AUTO_INCREMENT for table `category_type`
--
ALTER TABLE `category_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaction_process`
--
ALTER TABLE `transaction_process`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_session`
--
ALTER TABLE `user_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
  ADD CONSTRAINT `categoryType` FOREIGN KEY (`category_by_id`) REFERENCES `category_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pos_item_id` FOREIGN KEY (`pos_item_id`) REFERENCES `pos_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
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
  ADD CONSTRAINT `inventory_id_constraint` FOREIGN KEY (`inventory_id`) REFERENCES `inventory` (`id`),
  ADD CONSTRAINT `payment_option_id_constraint` FOREIGN KEY (`payment_option_id`) REFERENCES `payment_option` (`id`),
  ADD CONSTRAINT `status_id_constraint` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `updated_by_id_contraint` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_account_type_id` FOREIGN KEY (`account_type_id`) REFERENCES `account_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
