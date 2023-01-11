-- Generation time: Wed, 11 Jan 2023 13:45:53 +0800
-- Host: localhost
-- DB name: acc_db
/*!40030 SET NAMES UTF8 */;
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `account_module_access`;
CREATE TABLE `account_module_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_type_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `access_account_type_id` (`account_type_id`),
  KEY `access_module_id` (`module_id`),
  CONSTRAINT `access_account_type_id` FOREIGN KEY (`account_type_id`) REFERENCES `account_type` (`id`),
  CONSTRAINT `access_module_id` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb4;

INSERT INTO `account_module_access` VALUES ('1','1','5'),
('2','1','6'),
('3','1','7'),
('4','1','8'),
('5','1','9'),
('6','1','10'),
('7','1','11'),
('8','1','12'),
('9','1','13'),
('10','1','14'),
('11','1','15'),
('12','1','16'),
('13','1','17'),
('14','1','18'),
('15','1','19'),
('16','1','20'),
('17','1','21'),
('18','1','22'),
('19','1','23'),
('20','1','24'),
('21','1','25'),
('22','1','26'),
('23','1','27'),
('24','1','28'),
('25','1','29'),
('26','2','5'),
('27','2','6'),
('28','2','7'),
('29','2','8'),
('30','2','9'),
('31','2','10'),
('32','2','11'),
('33','2','12'),
('34','2','13'),
('35','2','14'),
('36','2','15'),
('37','2','16'),
('38','2','17'),
('39','2','18'),
('40','2','19'),
('41','2','20'),
('42','2','21'),
('43','2','22'),
('105','3','6'),
('108','2','23'),
('109','1','31'),
('110','1','32'); 


DROP TABLE IF EXISTS `account_type`;
CREATE TABLE `account_type` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(255) DEFAULT NULL,
  `is_deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_type` (`user_type`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO `account_type` VALUES ('1','ADMIN','0'),
('2','MANAGER','0'),
('3','CASHIER','0'); 


DROP TABLE IF EXISTS `attendance`;
CREATE TABLE `attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `with_uniform` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  `deduction` float(11,2) NOT NULL,
  `bonus` float(11,2) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `total_amount` float(11,2) NOT NULL,
  `payroll_status` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `date_updated` datetime NOT NULL,
  `status_archive_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

INSERT INTO `attendance` VALUES ('1','1','0','2022-11-01','09:00:00','18:00:00','0.00','750.00','Test note','1000.00','1','6','2022-12-31 13:43:47','6','2022-12-31 13:43:47','1'),
('2','1','0','2022-12-01','13:02:00','14:04:00','0.00','0.00','Test note','250.00','1','6','2022-12-31 13:45:55','6','2022-12-31 13:45:55','1'),
('3','1','0','2022-12-02','13:46:00','13:46:00','0.00','0.00','Test note','250.00','1','6','2022-12-31 13:46:46','6','2022-12-31 13:46:46','1'),
('4','1','1','2022-12-03','13:48:00','13:48:00','0.00','0.00','Test note','500.00','1','6','2022-12-31 13:48:26','6','2022-12-31 13:48:26','1'),
('5','1','0','2022-12-04','13:49:00','13:49:00','50.00','0.00','Test note','200.00','1','6','2022-12-31 13:49:26','6','2022-12-31 13:49:26','1'),
('6','2','1','2022-12-01','15:32:00','18:34:00','0.00','0.00','Test note','500.00','1','6','2022-12-31 14:32:34','6','2022-12-31 14:32:34','1'),
('7','3','1','2022-12-31','08:00:00','00:00:00','0.00','0.00','Test note','0.00','0','6','2022-12-31 23:21:45','6','2022-12-31 23:21:45','1'),
('8','1','0','2023-01-09','08:00:00','17:00:00','0.00','0.00','test\r\n\r\nRegular Pay: 4000\r\nOvertime: 0\r\nLate Deduction: 0\r\n','4000.00','0','6','2023-01-10 00:34:27','6','2023-01-10 00:34:27','2'),
('9','1','1','2023-01-10','08:15:00','14:15:00','0.00','0.00','','2500.00','0','6','2023-01-10 00:41:30','6','2023-01-10 01:20:51','1'),
('10','1','0','2023-01-09','08:30:00','17:30:00','0.00','0.00','\r\n\r\nRegular Pay: 4000\r\nOvertime: 0\r\nLate Deduction: 300\r\n','3675.00','0','6','2023-01-10 00:42:22','6','2023-01-10 00:42:22','1'),
('11','1','1','2023-01-08','08:15:00','16:45:00','0.00','0.00','Test note','4000.00','0','6','2023-01-10 00:54:37','6','2023-01-10 00:54:37','1'),
('12','1','1','2023-01-06','08:00:00','19:00:00','0.00','0.00','Test note','4100.00','0','6','2023-01-10 00:55:45','6','2023-01-10 00:55:45','1'),
('13','2','1','2023-01-10','08:00:00','17:00:00','0.00','0.00','','4000.00','0','1','2023-01-10 15:51:35','1','2023-01-10 15:51:35','1'),
('14','3','1','2023-01-10','08:15:00','17:00:00','0.00','0.00','','3500.00','1','1','2023-01-10 15:59:22','1','2023-01-10 15:59:22','1'),
('15','4','1','2023-01-10','08:00:00','18:30:00','0.00','0.00','','4050.00','0','1','2023-01-10 16:04:19','1','2023-01-10 16:11:28','1'),
('16','7','1','2023-01-10','08:12:00','17:12:00','0.00','0.00','','4000.00','1','1','2023-01-10 19:14:20','1','2023-01-10 19:14:20','1'); 


DROP TABLE IF EXISTS `audit_trail`;
CREATE TABLE `audit_trail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `data` varchar(255) NOT NULL,
  `date_log` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1105 DEFAULT CHARSET=utf8mb4;

INSERT INTO `audit_trail` VALUES ('1036','1','1','1','Logged in the system','2023-01-10 04:27:48'),
('1037','1','1','1','Logged in the system','2023-01-10 14:20:03'),
('1038','6','1','1','Add new transaction. Reference:137','2023-01-10 14:50:19'),
('1039','14','1','1','Transaction added to For Pick up. Reference: 137','2023-01-10 14:50:33'),
('1040','14','1','1','Transaction updated to Already Pick Up. Reference: 137','2023-01-10 14:54:31'),
('1041','6','1','1','Add new transaction. Reference:138','2023-01-10 14:55:28'),
('1042','14','1','1','Transaction added to For Pick up. Reference: 138','2023-01-10 14:55:36'),
('1043','14','1','1','Transaction updated to Already Pick Up. Reference: 138','2023-01-10 14:55:40'),
('1044','6','1','1','Add new transaction. Reference:139','2023-01-10 14:56:45'),
('1045','14','1','1','Transaction added to For Pick up. Reference: 139','2023-01-10 14:56:54'),
('1046','14','1','1','Transaction updated to Ongoing Pick Up. Reference: 139','2023-01-10 14:57:00'),
('1047','6','1','1','Add new transaction. Reference:140','2023-01-10 14:58:12'),
('1048','14','1','1','Transaction added to For Pick up. Reference: 140','2023-01-10 14:58:18'),
('1049','14','1','1','Transaction updated to Ongoing Pick Up. Reference: 140','2023-01-10 14:58:23'),
('1050','6','1','1','Add new transaction. Reference:141','2023-01-10 14:59:37'),
('1051','14','1','1','Transaction added to For Pick up. Reference: 141','2023-01-10 14:59:46'),
('1052','14','1','1','Transaction updated to Ongoing Pick Up. Reference: 141','2023-01-10 14:59:51'),
('1053','14','1','1','Transaction updated to Already Pick Up. Reference: 141','2023-01-10 14:59:59'),
('1054','14','1','1','Transaction added to For Pick up. Reference: 139','2023-01-10 15:00:22'),
('1055','14','1','1','Transaction added to For Pick up. Reference: 140','2023-01-10 15:00:23'),
('1056','14','1','1','Transaction updated to Ongoing Pick Up. Reference: 139','2023-01-10 15:00:29'),
('1057','14','1','1','Transaction updated to Ongoing Pick Up. Reference: 140','2023-01-10 15:00:33'),
('1058','14','1','1','Transaction updated to For Delivery. Reference: 138','2023-01-10 15:02:02'),
('1059','14','1','1','Transaction updated to For Delivery. Reference: 137','2023-01-10 15:02:03'),
('1060','0','1','1','Added new attendance with details: employee_id =2,2023-01-10','2023-01-10 15:51:36'),
('1061','0','1','1','Added new attendance with details: employee_id =3,2023-01-10','2023-01-10 15:59:22'),
('1062','23','1','1','Added new expense:[date=2023-01-10, expense_type=1, amount=3500.00]','2023-01-10 16:01:40'),
('1063','0','1','1','Payroll Process for attendance with id:14','2023-01-10 16:01:40'),
('1064','0','1','1','Added new attendance with details: employee_id =4,2023-01-10','2023-01-10 16:04:19'),
('1065','0','1','1','Edited attendance with details[employee_id =4,2023-01-10]','2023-01-10 16:11:05'),
('1066','0','1','1','Edited attendance with details[employee_id =4,2023-01-10]','2023-01-10 16:11:28'),
('1067','1','1','1','Logged in the system','2023-01-10 16:55:16'),
('1068','31','0','1','Added delivery fee setting.','2023-01-10 19:03:58'),
('1069','0','1','1','Added new attendance with details: employee_id =7,2023-01-10','2023-01-10 19:14:20'),
('1070','23','1','1','Added new expense:[date=2023-01-10, expense_type=1, amount=4000.00]','2023-01-10 19:16:20'),
('1071','0','1','1','Payroll Process for attendance with id:16','2023-01-10 19:16:20'),
('1072','1','1','1','Logged in the system','2023-01-10 22:34:56'),
('1073','14','1','1','Transaction updated to Already Pick Up. Reference: 140','2023-01-11 00:16:57'),
('1074','14','1','1','Transaction added to For Pick up. Reference: 139','2023-01-11 00:17:01'),
('1075','14','1','1','Transaction updated to Ongoing Pick Up. Reference: 139','2023-01-11 00:17:09'),
('1076','14','1','1','Transaction updated to Already Pick Up. Reference: 139','2023-01-11 00:20:02'),
('1077','6','1','1','Deducted stocks for item:6','2023-01-11 00:20:34'),
('1078','17','1','1','Updated stocks with id:6','2023-01-11 00:20:34'),
('1079','6','1','1','Add new transaction. Reference:142','2023-01-11 00:20:34'),
('1080','6','1','1','Add new transaction. Reference:143','2023-01-11 00:20:55'),
('1081','14','1','1','Transaction added to For Pick up. Reference: 143','2023-01-11 00:21:04'),
('1082','14','1','1','Transaction updated to Ongoing Pick Up. Reference: 143','2023-01-11 00:21:10'),
('1083','14','1','1','Transaction updated to Already Pick Up. Reference: 143','2023-01-11 00:21:15'),
('1084','14','1','1','Transaction updated to For Delivery. Reference: 117','2023-01-11 00:22:11'),
('1085','14','1','1','Transaction updated to For Delivery. Reference: 142','2023-01-11 00:22:13'),
('1086','14','1','1','Transaction updated to For Delivery. Reference: 142','2023-01-11 00:26:24'),
('1087','14','1','1','Transaction updated to For Delivery. Reference: 117','2023-01-11 00:26:26'),
('1088','6','1','1','Add new transaction. Reference:144','2023-01-11 00:28:16'),
('1089','14','1','1','Transaction added to For Pick up. Reference: 144','2023-01-11 00:28:23'),
('1090','14','1','1','Transaction updated to Ongoing Pick Up. Reference: 144','2023-01-11 00:28:30'),
('1091','6','1','1','Added new customer with id:14','2023-01-11 00:46:10'),
('1092','6','1','0','Customer name already exist','2023-01-11 00:50:07'),
('1093','14','1','1','Transaction updated to For Delivery. Reference: 139','2023-01-11 01:07:33'),
('1094','14','1','1','Transaction updated to Ongoing Delivery. Reference: ','2023-01-11 01:07:37'),
('1095','6','1','1','Add new transaction. Reference:145','2023-01-11 01:51:51'),
('1096','14','1','1','Transaction added to For Pick up. Reference: 145','2023-01-11 02:33:52'),
('1097','17','1','1','Updated stocks with id:1','2023-01-11 04:56:07'),
('1098','19','0','1','Deducted stocks for item:1','2023-01-11 04:56:07'),
('1099','1','1','0','Restricted login, still has an active session.','2023-01-11 05:01:13'),
('1100','1','1','0','Restricted login, still has an active session.','2023-01-11 05:01:15'),
('1101','1','1','0','Restricted login, still has an active session.','2023-01-11 05:01:20'),
('1102','1','1','1','Logged in the system','2023-01-11 05:01:35'),
('1103','1','1','1','Logged out of the system','2023-01-11 05:03:58'),
('1104','1','1','1','Logged in the system','2023-01-11 12:05:23'); 


DROP TABLE IF EXISTS `category_type`;
CREATE TABLE `category_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_type_name_index` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

INSERT INTO `category_type` VALUES ('2','Bottle'),
('5','Caps'),
('1','Container'),
('4','Filter'),
('10','For Refill'),
('7','Others'),
('3','Seal'),
('6','Sticker'); 


DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `contact_number1` varchar(20) DEFAULT NULL,
  `contact_number2` varchar(50) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `balance` float(11,2) DEFAULT NULL,
  `balance_limit` float(11,2) NOT NULL,
  `credit_limit` float(11,2) NOT NULL,
  `status_archive_id` int(11) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `customer_name` (`customer_name`),
  KEY `status_customers_constraint` (`status_archive_id`),
  CONSTRAINT `status_customers_constraint` FOREIGN KEY (`status_archive_id`) REFERENCES `status_archive` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

INSERT INTO `customers` VALUES ('1','Lorenzo','Sta.Cruz St.','09892829485','09223232222112','tabing jollibee','0.00','1000.00','1000.00','1','1','2022-11-27 14:48:29'),
('2','Stephen Smith','Curry St., Brgy. San Lorenzo','09992829375','09284573431','','0.00','1000.00','1000.00','1','1','2022-11-27 01:38:32'),
('3','Test Name','Test ','1234','1234','Test note','0.00','1000.00','1000.00','1','6','2022-11-30 02:28:56'),
('4','CN','ADDRESS','1234','1234','Test note','400.00','1000.00','1000.00','1','6','2022-11-30 02:34:48'),
('5','Test','Test ','1234','1234','Test note','0.00','1000.00','1000.00','1','6','2022-11-30 02:35:11'),
('6','Jerwinsonn Raphael Quijano','B7 L7 Sta.Ana St., Villa Ligaya Subd., Brgy. Dela ','2','2','2','0.00','1000.00','1000.00','1','1','2022-12-11 03:41:02'),
('7','Dylan Angelo','Sto. Nino St., Brgy. San Isidro','0989988899','0937485758','','0.00','1000.00','1000.00','1','1','2022-12-12 23:59:28'),
('9','','','','','','0.00','1000.00','1000.00','1','1','2022-12-14 21:39:05'),
('10','Jessica Soho','Lapu-lapu St., Brgy. Tagbili, Antipolo City','09992829375','09283948989','Green gate, unang kanan sa dulo.','325.50','1000.00','1000.00','1','1','2022-12-16 22:36:12'),
('12','Jonathan Almaranza','Celly Boulevard St., Brgy. Sta. Rosa','09288883949','09002739485','','0.00','1000.00','1000.00','1','1','2022-12-23 00:19:11'),
('13','DJ Khaled','123456578','1234','4568','Test note','0.00','600.00','100.00','1','6','2023-01-08 19:04:30'),
('14','Jopher San','B8 L2 Sta.Mesa St., Lores Subd., Brgy. Dela Torre','09892893894','','','0.00','0.00','0.00','1','1','2023-01-11 00:46:10'); 


DROP TABLE IF EXISTS `date_scheduling`;
CREATE TABLE `date_scheduling` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `customer_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO `date_scheduling` VALUES ('1','2022-12-29','4'); 


DROP TABLE IF EXISTS `deliver_price`;
CREATE TABLE `deliver_price` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service` varchar(255) NOT NULL,
  `price` float(11,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO `deliver_price` VALUES ('1','Delivery','10.00'),
('2','Pick Up','15.00'); 


DROP TABLE IF EXISTS `delivery_fee`;
CREATE TABLE `delivery_fee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fee` float(11,2) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO `delivery_fee` VALUES ('1','10.00','Within Antipolo Bayan'),
('2','20.00','Outside Antipolo Bayan'),
('4','5.00','Villa Ligaya'); 


DROP TABLE IF EXISTS `delivery_list`;
CREATE TABLE `delivery_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(250) NOT NULL,
  `delivery_status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `delivery_boy_id` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4;

INSERT INTO `delivery_list` VALUES ('52','63aeb9931ff251.28969312','3','6','6','2022-12-31 01:15:25'),
('55','63addfb7cd26a6.70637328','3','6','6','2021-11-11 19:49:23'),
('56','63adec37d0ab25.33071269','3','6','6','2022-12-31 19:49:25'),
('57','63adec37d0ab25.33071269','3','6','6','2022-11-04 19:49:25'),
('59','63adc22bc2cab3.50151600','3','6','5','2022-12-31 19:49:51'),
('74','63bd90522cb615.40239428','2','1','5','2023-01-11 01:07:37'),
('75','63adf42a59d698.62897437','2','1','5','2023-01-11 01:07:37'),
('77','63bd0c2dc7fc47.08717192','2','1','5','2023-01-11 01:07:37'); 


DROP TABLE IF EXISTS `delivery_status`;
CREATE TABLE `delivery_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO `delivery_status` VALUES ('1','For Delivery'),
('2','Ongoing Delivery'),
('3','Delivered'),
('4','For Pick Up'),
('5','Ongoing Pickup'); 


DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `last_name` varchar(20) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `middle_name` varchar(20) NOT NULL,
  `position_id` varchar(255) NOT NULL,
  `hourly_rate` float(11,2) DEFAULT NULL,
  `date_of_birth` date NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `contact_number` int(50) NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `date_updated` datetime NOT NULL,
  `status_archive_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

INSERT INTO `employee` VALUES ('1','Smith','Edward','Cruz','1','500.00','2022-11-19','EdwardSmith123@gmail.com','1234567891','0','0000-00-00 00:00:00','0','0000-00-00 00:00:00','1'),
('2','Tabudol','Sack','Brin','2','500.00','2022-11-19','Zack123budol@gmail.com','987654321','0','0000-00-00 00:00:00','0','0000-00-00 00:00:00','1'),
('3','Santos','Nikolas','Anderas','1','500.00','2022-11-19','Nikols123@gmail.com','987987981','0','0000-00-00 00:00:00','0','0000-00-00 00:00:00','1'),
('4','tate','andrew','sandoval','1','500.00','2022-11-19','andrewtate90@gmail.com','1231231231','0','0000-00-00 00:00:00','0','0000-00-00 00:00:00','1'),
('5','Go','Mario','Lee','2','500.00','2022-11-19','MarioGo98@gmail.com','982332981','0','0000-00-00 00:00:00','0','0000-00-00 00:00:00','1'),
('6','Gutierrez','Nick','Banco','2','500.00','2022-11-19','BancoNick@gmail.com','987234529','0','0000-00-00 00:00:00','0','0000-00-00 00:00:00','1'),
('7','Ponte','Joseph','Cruz','1','500.00','2022-11-19','SephSeph98@gmail.com','987654388','0','0000-00-00 00:00:00','0','0000-00-00 00:00:00','1'),
('8','Nino','Oliver','Marinao','2','500.00','2022-11-19','NinoOliver25@gmail.com','234123532','0','0000-00-00 00:00:00','0','0000-00-00 00:00:00','1'),
('9','Ribs','Michael','Andrian','1','500.00','2022-11-19','Michael23@gmail.com','2147483647','0','0000-00-00 00:00:00','0','0000-00-00 00:00:00','1'),
('10','Sol','Mario','France','1','500.00','2022-11-19','SolMario@gmail.com','2147483647','0','0000-00-00 00:00:00','0','0000-00-00 00:00:00','1'),
('11','Talier','Francis','Winnie','1','500.00','2022-11-19','FrancieT@gmail.com','2147483647','0','0000-00-00 00:00:00','0','0000-00-00 00:00:00','1'),
('12','Sunaida','Ivan','Tabino','1','500.00','2022-11-19','Ivanniav@gmail.com','2147483647','0','0000-00-00 00:00:00','0','0000-00-00 00:00:00','1'),
('13','Goli','Ligo','Amer','1','500.00','2022-11-19','Amerrgoli21@gmail.com','2147483647','0','0000-00-00 00:00:00','0','0000-00-00 00:00:00','1'),
('14','Nats','Sebastian','Anthony','1','500.00','2022-11-19','Sebsant@gmail.com','2147483647','0','0000-00-00 00:00:00','0','0000-00-00 00:00:00','1'),
('16','LN1','FN1','MN1','2','500.00','2022-11-03','test123@gmail.com','12345678','6','2022-11-30 19:42:59','0','0000-00-00 00:00:00','1'),
('17','TEST 1','TEST 1','TEST 1','4','500.00','2000-01-01','test@gmail.com','123456789','6','2022-11-30 20:41:45','0','0000-00-00 00:00:00','1'); 


DROP TABLE IF EXISTS `expense`;
CREATE TABLE `expense` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expense_type_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `amount` float(11,2) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `date_updated` datetime NOT NULL,
  `is_editable` int(11) NOT NULL,
  `status_archive_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

INSERT INTO `expense` VALUES ('2','4','2021-11-15','2000.00','Trust me, this is really a zoan fruit','6','2022-11-30 23:51:10','6','2022-11-30 23:51:35','1','1'),
('3','4','2022-11-28','1000.00','Test','6','2022-12-01 00:11:14','6','2022-12-01 00:11:14','1','1'),
('4','3','2022-11-28','123.00','123','6','2022-12-01 00:11:36','6','2022-12-01 00:11:36','1','1'),
('5','4','2022-12-28','5000.00','Purchased inventory items for item id: 6, quantity: 1000','6','2022-12-28 02:54:44','6','2022-12-28 02:54:44','0','1'),
('6','4','2022-12-30','555.00','Purchased inventory stocks for item id: 6, quantity: 1000','1','2022-12-30 02:51:09','1','2022-12-30 02:51:09','0','1'),
('7','4','2022-12-30','500.00','Purchased inventory stocks for item id: 9, quantity: 1000','1','2022-12-30 15:14:44','1','2022-12-30 15:14:44','0','1'),
('8','4','2022-12-30','1000.00','Purchased inventory stocks for item id: 10, quantity: 1000','1','2022-12-30 15:14:55','1','2022-12-30 15:14:55','0','1'),
('9','4','2022-12-30','1000.00','Purchased inventory stocks for item id: 11, quantity: 500','1','2022-12-30 15:15:22','1','2022-12-30 15:15:22','0','1'),
('10','4','2022-12-30','1000.00','Purchased inventory stocks for item id: 6, quantity: 5000','6','2022-12-30 23:55:09','6','2022-12-30 23:55:09','0','1'),
('12','1','2022-12-31','1000.00','Payroll for Edward Cruz Smith, Date: 2022-11-01, Total Amount:1000','6','2022-12-31 13:52:05','6','2022-12-31 13:52:05','0','1'),
('13','1','2022-12-31','250.00','Payroll for Edward Cruz Smith, Date: 2022-12-01, Total Amount:250','6','2022-12-31 13:52:16','6','2022-12-31 13:52:16','0','1'),
('14','1','2022-12-31','250.00','Payroll for Edward Cruz Smith, Date: 2022-12-02, Total Amount:250','6','2022-12-31 13:52:29','6','2022-12-31 13:52:29','0','1'),
('15','1','2022-12-31','500.00','Payroll for Edward Cruz Smith, Date: 2022-12-03, Total Amount:500','6','2022-12-31 13:52:30','6','2022-12-31 13:52:30','0','1'),
('16','1','2022-12-31','200.00','Payroll for Edward Cruz Smith, Date: 2022-12-04, Total Amount:200','6','2022-12-31 13:52:30','6','2022-12-31 13:52:30','0','1'),
('17','1','2022-12-31','500.00','Payroll for Sack Brin Tabudol, Date: 2022-12-01, Total Amount:500','6','2022-12-31 14:33:19','6','2022-12-31 14:33:19','0','1'),
('18','4','2022-12-31','10000.00','Purchased inventory stocks for item id: 6, quantity: 200','6','2022-12-31 15:01:03','6','2022-12-31 15:01:03','0','1'),
('19','1','2023-01-01','1000.00','Half Dragon, Half Fruit','6','2023-01-01 10:39:24','6','2023-01-01 10:39:24','1','1'),
('20','2','2023-01-01','1500.00','Half Dragon, Half Fruit','6','2023-01-01 10:40:02','6','2023-01-01 10:40:02','1','1'),
('21','3','2023-01-01','2000.00','Test','6','2023-01-01 10:40:35','6','2023-01-01 10:40:35','1','1'),
('22','4','2023-01-01','500.00','123','6','2023-01-01 10:40:49','6','2023-01-01 10:40:49','1','1'),
('23','1','2023-01-10','3500.00','Payroll for Nikolas Anderas Santos, Date: 2023-01-10, Total Amount:3500.00','1','2023-01-10 16:01:40','1','2023-01-10 16:01:40','0','1'),
('24','1','2023-01-10','4000.00','Payroll for Joseph Cruz Ponte, Date: 2023-01-10, Total Amount:4000.00','1','2023-01-10 19:16:20','1','2023-01-10 19:16:20','0','1'); 


DROP TABLE IF EXISTS `expense_type`;
CREATE TABLE `expense_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO `expense_type` VALUES ('1','Salary'),
('2','Utilities'),
('3','Maintenance'),
('4','Other Expenses'); 


DROP TABLE IF EXISTS `inventory_item`;
CREATE TABLE `inventory_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `updated_by_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `inventory_item_name_index` (`item_name`),
  UNIQUE KEY `item_name` (`item_name`),
  KEY `status_inventory_item_constraint` (`status_archive_id`),
  KEY `categoryType` (`category_by_id`),
  KEY `pos_item_id` (`pos_item_id`),
  CONSTRAINT `categoryType` FOREIGN KEY (`category_by_id`) REFERENCES `category_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pos_item_id` FOREIGN KEY (`pos_item_id`) REFERENCES `pos_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `status_inventory_item_constraint` FOREIGN KEY (`status_archive_id`) REFERENCES `status_archive` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4;

INSERT INTO `inventory_item` VALUES ('1','Round - 5 Gallons','1','10','1','185.00','220.00','215.00','77fce6b86eef912efb10429092fa2273.jfif','2022-12-01 16:42:17','1','2022-12-30 15:07:43','1','1'),
('2','Slim - 2.5 Gallons','1','5','1','120.00','155.00','150.00','2faff09308079c871c09df8025884578.jfif','2022-12-01 16:50:42','1','2022-12-30 15:08:42','1','1'),
('3','Cap with Inner Plug for Round','5','10','1','10.00','0.00','0.00','205c32cdfc286f5863a216eb6e99f2fe.jfif','2022-12-01 16:53:13','1','2022-12-01 21:33:58','1','1'),
('4','Slim - 5 Gallons','1','10','1','185.00','220.00','215.00','5_gallon_slim_plastic_container_1568794578_4c2e969d0_progressive.jfif','2022-12-01 17:08:57','1','2022-12-30 15:08:54','1','1'),
('5','Faucet Seal','3','10','2','0.00','0.00','0.00','c215d9deaf3d1b0a7ff97d90bb16c087.jpg','2022-12-01 17:12:41','1','2022-12-01 18:45:14','1','1'),
('6','1 Liter','2','20','1','10.00','15.00','12.00','504350773.jpg','2022-12-01 17:13:44','1','2022-12-30 15:09:26','1','1'),
('7','Faucet - Push Down','7','10','1','25.00','0.00','0.00','4d7a42f744a6bc863b8c6e13924b1bea.jfif','2022-12-01 17:19:44','1','2022-12-06 19:14:19','1','1'),
('8',' Big Mouth Cap for Slim','5','10','1','10.00','0.00','0.00','653512388a9235cd5ba921a5d2a9d595.jfif','2022-12-01 17:46:09','1','2022-12-01 21:32:26','1','1'),
('9','500 ml','2','10','1','5.00','10.00','8.00','504350773.jpg','2022-12-01 17:46:52','1','2022-12-30 15:09:39','1','1'),
('10','350 ml','2','10','1','3.00','7.00','5.00','504350773.jpg','2022-12-01 18:30:39','1','2022-12-30 15:09:46','1','1'),
('11','6 Liters','2','10','1','20.00','45.00','40.00','Screenshot 2022-11-28 145335.png','2022-12-01 18:43:10','1','2022-12-30 15:09:55','1','1'),
('12','Closed Cap Seal for Round','3','10','2','0.00','0.00','0.00','139bf86befd4ce5e7a041c9538d2f9b7.jfif','2022-12-01 18:44:12','1','2022-12-01 21:34:59','1','1'),
('13','Open Cap Seal for Round','3','10','2','0.00','0.00','0.00','c215d9deaf3d1b0a7ff97d90bb16c087.jpg','2022-12-01 18:44:51','1','2022-12-01 21:34:51','1','1'),
('14','Small Cap for Slim','5','10','1','5.00','0.00','0.00','4b59df78ae3706129cc7f752252765d0.jfif','2022-12-01 21:31:23','1','0000-00-00 00:00:00','1','0'),
('15','1.5 Liters - Refill','10','0','1','0.00','12.00','8.00','504350773.jpg','2022-12-01 22:12:20','1','2022-12-30 15:11:24','1','1'),
('16','Faucet - Rotatable','7','5','1','25.00','0.00','0.00','Screenshot 2022-12-04 223707.png','2022-12-04 22:40:23','1','2022-12-06 19:11:42','1','1'),
('17','Ice Tube','7','5','1','10.00','0.00','0.00','1000_F_350366345_8Jh0duvK9Q6yVPniIr1GO1VYoCovZASX.jpg','2022-12-04 22:42:30','1','2022-12-05 00:07:20','1','1'),
('18','Small Cap Seal','3','5','2','0.00','0.00','0.00','Screenshot 2022-12-07 155001.png','2022-12-07 15:50:21','1','0000-00-00 00:00:00','1','0'); 


DROP TABLE IF EXISTS `inventory_log`;
CREATE TABLE `inventory_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inventory_id` int(11) NOT NULL,
  `details` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` float(11,2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;

INSERT INTO `inventory_log` VALUES ('12','6','Supplier Details: Aquastar','1000','0.00','2022-12-30 02:51:09','1','IN'),
('13','6','POS Transaction Reference: 63ade6a5d628d1.10946512','1','0.00','2022-12-30 03:12:37','1','OUT'),
('14','9','Supplier Details: Aquastar','1000','1000.00','2022-12-30 15:14:44','1','IN'),
('15','10','Supplier Details: Aquastar','1000','2500.00','2022-12-30 15:14:55','1','IN'),
('16','11','Supplier Details: Aquastar','500','500.00','2022-12-30 15:15:22','1','IN'),
('17','6','POS Transaction Reference: 63aeb9931ff251.28969312','1','0.00','2022-12-30 18:12:35','1','OUT'),
('18','2','Description: Test note','1','0.00','2022-12-30 23:33:00','6','OUT'),
('19','3','Description: Test note','998','0.00','2021-12-30 23:53:39','6','OUT'),
('20','3','Description: Test note','99','0.00','2022-12-30 23:54:36','6','OUT'),
('21','1','Description: Test note','899','0.00','2022-12-30 23:54:51','6','OUT'),
('22','6','Supplier Details: TEST','5000','300.00','2021-12-30 23:55:09','6','IN'),
('23','5','Description: Test note','2500','0.00','2022-12-30 23:55:21','6','OUT'),
('24','2','Description: Test note','500','0.00','2022-12-31 00:17:52','6','OUT'),
('25','1','Description: Test note','100','0.00','2022-12-31 15:00:30','6','OUT'),
('26','6','Supplier Details: TEST','200','10000.00','2022-12-31 15:01:03','6','IN'),
('27','1','Description: Test note','1080','0.00','2022-12-31 21:23:43','6','OUT'),
('28','6','POS Transaction Reference: 63baa0635aec10.87912152','1','0.00','2023-01-08 18:52:19','6','OUT'),
('29','9','POS Transaction Reference: 63baa0635aec10.87912152','1','0.00','2023-01-08 18:52:19','6','OUT'),
('30','6','POS Transaction Reference: 63bd90522cb615.40239428','2','0.00','2023-01-11 00:20:34','1','OUT'),
('31','1','Description: sira','2','0.00','2023-01-11 04:56:07','1','OUT'); 


DROP TABLE IF EXISTS `inventory_stock`;
CREATE TABLE `inventory_stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name_id` int(11) NOT NULL,
  `in_going` int(11) NOT NULL,
  `out_going` int(11) NOT NULL,
  `on_hand` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_name_id_constraint` (`item_name_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

INSERT INTO `inventory_stock` VALUES ('1','6','6200','6184','16'),
('2','2','1000','0','1000'),
('3','39','0','0','0'),
('4','1','0','1000','0'),
('5','4','0','0','0'),
('6','29','0','0','0'),
('7','9','1000','3','997'),
('8','10','1000','0','1000'),
('9','11','500','0','500'),
('10','5','0','0','0'),
('11','12','0','0','0'),
('12','13','0','0','0'),
('13','18','0','0','0'),
('14','3','0','0','0'),
('15','8','0','0','0'),
('16','14','0','0','0'),
('17','36','0','0','0'),
('18','7','0','0','0'),
('19','16','0','0','0'),
('20','17','0','0','0'),
('21','40','0','0','0'); 


DROP TABLE IF EXISTS `login_history`;
CREATE TABLE `login_history` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `activity` varchar(255) DEFAULT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id_constraint` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



DROP TABLE IF EXISTS `module`;
CREATE TABLE `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `module_name_index` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;

INSERT INTO `module` VALUES ('24','ACCOUNT-ACCOUNT_TYPE'),
('25','ACCOUNT-USER_ACCOUNT'),
('3','CHANGE_PASSWORD'),
('4','CODE_VERIFICATION'),
('18','CUSTOMER'),
('5','DASHBOARD'),
('21','EMPLOYEE-ATTENDANCE'),
('22','EMPLOYEE-LIST'),
('23','EXPENSE'),
('2','FORGOT_PASSWORD'),
('20','INVENTORY-ITEM'),
('19','INVENTORY-STOCKS'),
('1','LOGIN'),
('15','MONITORING-CUSTOMER_BALANCE'),
('14','MONITORING-DELIVERY_PICKUP'),
('17','MONITORING-ITEM_HISTORY'),
('13','MONITORING-POINT_OF_SALES_TRANSACTION'),
('16','MONITORING-SCHEDULING'),
('6','POS'),
('11','REPORTS-ATTENDANCE'),
('8','REPORTS-DELIVERY'),
('12','REPORTS-EXPENSE'),
('9','REPORTS-INVENTORY'),
('10','REPORTS-ITEM_ISSUE'),
('7','REPORTS-SALES'),
('28','SETTINGS-ARCHIVES'),
('29','SETTINGS-BACKUP_RESTORE'),
('27','SETTINGS-DATA_LOGS'),
('31','SETTINGS-DELIVERY_FEE'),
('26','SETTINGS-HELP'),
('32','SETTINGS-PAYROLL'); 


DROP TABLE IF EXISTS `payment_option`;
CREATE TABLE `payment_option` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `option` (`option_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO `payment_option` VALUES ('1','Cash On Delivery'),
('3','GCash'),
('2','Onsite'); 


DROP TABLE IF EXISTS `payroll_settings`;
CREATE TABLE `payroll_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `feature` varchar(50) NOT NULL,
  `grace_period` time NOT NULL,
  `late_deduction_per_min` float(11,2) NOT NULL,
  `time_in_schedule` time NOT NULL,
  `overtime_bonus_per_hour` float(11,2) NOT NULL,
  `without_uniform_deduction` float(11,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO `payroll_settings` VALUES ('1','payroll','08:15:00','10.00','08:00:00','50.00','100.00'); 


DROP TABLE IF EXISTS `pos_item`;
CREATE TABLE `pos_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pos_type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO `pos_item` VALUES ('1','Yes'),
('2','No'); 


DROP TABLE IF EXISTS `position_type`;
CREATE TABLE `position_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `position_type` VALUES ('1','Frontliner'),
('2','Delivery Boy'),
('3','Helper'),
('4','Manager'); 


DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO `status` VALUES ('1','New'),
('2','Ongoing Pickup'),
('3','Ongoing Delivery'),
('4','Paid'),
('5','Unpaid'); 


DROP TABLE IF EXISTS `status_archive`;
CREATE TABLE `status_archive` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO `status_archive` VALUES ('1','active'),
('2','inactive'); 


DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier` (
  `supplier_id` int(50) NOT NULL AUTO_INCREMENT,
  `supplier` varchar(255) NOT NULL,
  `contact_number` bigint(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO `supplier` VALUES ('1','Aquastar','9239029092','111 C. Lawis St., Brgy. San Isidro, Antipolo City'); 


DROP TABLE IF EXISTS `transaction`;
CREATE TABLE `transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `created_at_time` time NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=utf8mb4;

INSERT INTO `transaction` VALUES ('105','63abcccfc39779.12892746','0','Walk In','120.00','1','','1','6','6','2022-12-28 12:57:51','2022-12-28','12:57:51'),
('106','63abccf65b4b17.08669844','0','Walk In','1200.00','1','','1','6','6','2022-12-28 12:58:30','2022-12-28','12:58:30'),
('107','63abcd3ed13407.16147320','10','Walk In','1200.00','1','','0','6','6','2022-12-28 14:48:51','2022-12-28','12:59:42'),
('108','63abcd6d5251a7.06711961','1','Walk In','2400.00','1','','0','6','0','2022-12-28 13:00:42','2022-12-28','13:00:29'),
('109','63abce4a681640.32895925','10','Walk In','350.00','1','','0','6','6','2022-12-28 13:04:10','2022-12-28','13:04:10'),
('110','63abf9aa8cc234.16453602','4','Walk In','1200.00','1','','1','6','6','2022-12-28 16:09:14','2022-12-28','16:09:14'),
('111','63adc22bc2cab3.50151600','12','Delivery','175.00','1','','0','1','1','2022-12-30 00:36:59','2022-12-30','00:36:59'),
('112','63addfb7cd26a6.70637328','12','Delivery','105.00','1','','1','1','1','2021-12-30 02:43:03','2021-12-30','02:43:03'),
('113','63ade6a5d628d1.10946512','0','Walk In','15.00','1','','1','1','1','2022-12-30 03:12:38','2022-12-30','03:12:38'),
('114','63adec262f9905.93241386','10','Walk In','35.00','1','','1','1','1','2022-12-30 03:36:06','2022-12-30','03:36:06'),
('115','63adec37d0ab25.33071269','10','Delivery','35.00','1','','1','1','1','2022-12-30 03:36:23','2022-12-30','03:36:23'),
('116','63adf3fa867f21.35929436','12','Walk In','47.00','1','','1','1','1','2022-12-30 04:09:30','2022-12-30','04:09:30'),
('117','63adf42a59d698.62897437','12','Delivery','47.00','1','','1','1','1','2022-12-30 04:10:18','2022-12-30','04:10:18'),
('118','63ae81665d4ba6.86096893','0','Walk In','12.00','1','','1','1','1','2022-12-30 14:12:54','2022-12-30','14:12:54'),
('119','63aeb9931ff251.28969312','2','Delivery','15.00','1','','1','1','1','2022-12-30 18:12:35','2022-12-30','18:12:35'),
('120','63af21dd246400.87869706','0','Walk In','6000.00','1','Test','1','6','6','2022-12-31 01:37:33','2022-12-31','01:37:33'),
('121','63b0f83f867115.74857145','0','Walk In','40000.00','1','','1','6','6','2023-01-01 11:04:31','2023-01-01','11:04:31'),
('122','63b105d1d0fa95.03104495','0','Delivery','40800.00','1','','1','6','6','2023-01-01 12:02:25','2023-02-01','12:02:25'),
('123','63b106ea3f7fa2.94397853','0','Walk In','41600.00','1','','1','6','6','2023-01-01 12:07:06','2023-03-01','12:07:06'),
('124','63b1070ed4ffe5.62797644','0','Walk In','42400.00','1','','1','6','6','2023-01-01 12:07:42','2023-04-01','12:07:42'),
('125','63b1072aac1753.53356204','0','Walk In','43200.00','1','','1','6','6','2023-01-01 12:08:10','2023-05-01','12:08:10'),
('126','63b107c7479ae5.83352724','0','Walk In','48000.00','1','','1','6','6','2023-01-01 12:10:47','2023-06-01','12:10:47'),
('127','63b1086fae1de0.73921151','0','Walk In','66000.00','1','','1','6','6','2023-01-01 12:13:35','2023-07-01','12:13:35'),
('128','63b108bd8e3521.93468653','0','Walk In','72000.00','1','','1','6','6','2023-01-01 12:14:53','2023-08-01','12:14:53'),
('129','63b1096071d759.36019109','0','Walk In','120000.00','1','','1','6','6','2023-01-01 12:17:36','2023-09-01','12:17:36'),
('130','63b10997219918.56987517','0','Walk In','600000.00','1','','1','6','6','2023-01-01 12:18:31','2023-10-01','12:18:31'),
('131','63b10b4b9149b6.59010599','0','Walk In','1200000.00','1','','1','6','6','2023-01-01 12:25:47','2023-11-01','12:25:47'),
('132','63b10c3a543a83.33723195','0','Walk In','720000.00','1','','1','6','6','2023-01-01 12:29:46','2023-12-01','12:29:46'),
('133','63b10e4aab9696.99990337','0','Walk In','120.00','1','','1','6','6','2023-01-01 12:38:34','2023-01-01','12:38:34'),
('134','63baa0635aec10.87912152','12','Walk In','45.00','1','','0','6','6','2023-01-08 18:52:19','2023-01-08','18:52:19'),
('135','63baa0740d2b01.35336222','12','Walk In','12.00','1','','1','6','6','2023-01-08 18:52:36','2023-01-08','18:52:36'),
('136','63baa08aa45c96.94426721','12','Walk In','12.00','1','','0','6','6','2023-01-08 18:52:58','2023-01-08','18:52:58'),
('137','63bd0aab9062f3.68575416','4','Delivery','36.00','1','','1','1','1','2023-01-10 14:50:19','2023-01-10','14:50:19'),
('138','63bd0be0c6f9a6.84690160','7','Delivery','12.00','1','','1','1','1','2023-01-10 14:55:28','2023-01-10','14:55:28'),
('139','63bd0c2dc7fc47.08717192','7','Delivery','12.00','1','','1','1','1','2023-01-10 14:56:45','2023-01-10','14:56:45'),
('140','63bd0c847e14a0.23113515','6','Delivery','12.00','1','','1','1','1','2023-01-10 14:58:12','2023-01-10','14:58:12'),
('141','63bd0cd98b3dd0.82754381','7','Delivery','12.00','1','','1','1','1','2023-01-10 14:59:37','2023-01-10','14:59:37'),
('142','63bd90522cb615.40239428','6','Delivery','42.00','1','','1','1','1','2023-01-11 00:20:34','2023-01-11','00:20:34'),
('143','63bd90679abfc6.28719333','5','Delivery','12.00','1','','1','1','1','2023-01-11 00:20:55','2023-01-11','00:20:55'),
('144','63bd921fe57275.48434181','4','Delivery/Pick Up','12.00','1','','1','1','1','2023-01-11 00:28:15','2023-01-11','00:28:15'),
('145','63bda5b72f8f07.90426483','6','Delivery/Pick Up','48.00','1','','1','1','1','2023-01-11 01:51:51','2023-01-11','01:51:51'); 


DROP TABLE IF EXISTS `transaction_history`;
CREATE TABLE `transaction_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_uuid` varchar(50) NOT NULL,
  `amount_tendered` float(11,2) NOT NULL,
  `customer_change` float(11,2) NOT NULL,
  `remaining_balance` float(11,2) NOT NULL,
  `previous_balance` float(11,2) NOT NULL,
  `unpaid_amount` float(11,2) NOT NULL,
  `created_by_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4;

INSERT INTO `transaction_history` VALUES ('41','63abcccfc39779.12892746','1000.00','880.00','0.00','0.00','0.00','6','2022-12-28 12:57:51'),
('42','63abccf65b4b17.08669844','1200.00','0.00','0.00','0.00','0.00','6','2022-12-28 12:58:30'),
('43','63abcd3ed13407.16147320','500.00','0.00','0.00','0.00','700.00','6','2022-12-28 12:59:42'),
('44','63abcd6d5251a7.06711961','400.00','0.00','0.00','0.00','2000.00','6','2022-12-28 13:00:29'),
('45','63abcd6d5251a7.06711961','1000.00','0.00','0.00','0.00','1000.00','0','2022-12-28 13:00:42'),
('46','63abce4a681640.32895925','150.00','0.00','0.00','0.00','200.00','6','2022-12-28 13:04:10'),
('47','63abcd3ed13407.16147320','400.00','0.00','0.00','0.00','300.00','6','2022-12-28 14:16:38'),
('48','63abcd3ed13407.16147320','100.00','0.00','0.00','0.00','200.00','6','2022-12-28 14:48:51'),
('49','63abf9aa8cc234.16453602','0.00','0.00','400.00','1600.00','0.00','6','2022-12-28 16:09:14'),
('50','63adc22bc2cab3.50151600','0.00','0.00','0.00','0.00','175.00','1','2022-12-30 00:36:59'),
('51','63addfb7cd26a6.70637328','105.00','0.00','0.00','0.00','0.00','1','2022-12-30 02:43:03'),
('52','63ade6a5d628d1.10946512','15.00','0.00','0.00','0.00','0.00','1','2022-12-30 03:12:38'),
('53','63adec262f9905.93241386','35.00','0.00','325.50','325.50','0.00','1','2022-12-30 03:36:06'),
('54','63adec37d0ab25.33071269','35.00','0.00','325.50','325.50','0.00','1','2022-12-30 03:36:23'),
('55','63adf3fa867f21.35929436','50.00','3.00','0.00','0.00','0.00','1','2022-12-30 04:09:30'),
('56','63adf42a59d698.62897437','50.00','3.00','0.00','0.00','0.00','1','2022-12-30 04:10:18'),
('57','63ae81665d4ba6.86096893','12.00','0.00','0.00','0.00','0.00','1','2022-12-30 14:12:54'),
('58','63aeb9931ff251.28969312','15.00','0.00','0.00','0.00','0.00','1','2022-12-30 18:12:35'),
('59','63af21dd246400.87869706','7000.00','1000.00','0.00','0.00','0.00','6','2022-12-31 01:37:33'),
('60','63b0f83f867115.74857145','40000.00','0.00','0.00','0.00','0.00','6','2023-01-01 11:04:31'),
('61','63b105d1d0fa95.03104495','40800.00','0.00','0.00','0.00','0.00','6','2023-01-01 12:02:25'),
('62','63b106ea3f7fa2.94397853','42000.00','400.00','0.00','0.00','0.00','6','2023-01-01 12:07:06'),
('63','63b1070ed4ffe5.62797644','45000.00','2600.00','0.00','0.00','0.00','6','2023-01-01 12:07:42'),
('64','63b1072aac1753.53356204','45000.00','1800.00','0.00','0.00','0.00','6','2023-01-01 12:08:10'),
('65','63b107c7479ae5.83352724','50000.00','2000.00','0.00','0.00','0.00','6','2023-01-01 12:10:47'),
('66','63b1086fae1de0.73921151','70000.00','4000.00','0.00','0.00','0.00','6','2023-01-01 12:13:35'),
('67','63b108bd8e3521.93468653','75000.00','3000.00','0.00','0.00','0.00','6','2023-01-01 12:14:53'),
('68','63b1096071d759.36019109','120000.00','0.00','0.00','0.00','0.00','6','2023-01-01 12:17:36'),
('69','63b10997219918.56987517','600000.00','0.00','0.00','0.00','0.00','6','2023-01-01 12:18:31'),
('70','63b10b4b9149b6.59010599','1500000.00','300000.00','0.00','0.00','0.00','6','2023-01-01 12:25:47'),
('71','63b10c3a543a83.33723195','720000.00','0.00','0.00','0.00','0.00','6','2023-01-01 12:29:46'),
('72','63b10e4aab9696.99990337','500.00','380.00','0.00','0.00','0.00','6','2023-01-01 12:38:34'),
('73','63baa0635aec10.87912152','0.00','0.00','0.00','0.00','45.00','6','2023-01-08 18:52:19'),
('74','63baa0740d2b01.35336222','12.00','0.00','0.00','0.00','0.00','6','2023-01-08 18:52:36'),
('75','63baa08aa45c96.94426721','0.00','0.00','0.00','0.00','12.00','6','2023-01-08 18:52:58'),
('76','63bd0aab9062f3.68575416','40.00','4.00','400.00','400.00','0.00','1','2023-01-10 14:50:19'),
('77','63bd0be0c6f9a6.84690160','12.00','0.00','0.00','0.00','0.00','1','2023-01-10 14:55:28'),
('78','63bd0c2dc7fc47.08717192','12.00','0.00','0.00','0.00','0.00','1','2023-01-10 14:56:45'),
('79','63bd0c847e14a0.23113515','12.00','0.00','0.00','0.00','0.00','1','2023-01-10 14:58:12'),
('80','63bd0cd98b3dd0.82754381','12.00','0.00','0.00','0.00','0.00','1','2023-01-10 14:59:37'),
('81','63bd90522cb615.40239428','50.00','8.00','0.00','0.00','0.00','1','2023-01-11 00:20:34'),
('82','63bd90679abfc6.28719333','15.00','3.00','0.00','0.00','0.00','1','2023-01-11 00:20:55'),
('83','63bd921fe57275.48434181','15.00','3.00','400.00','400.00','0.00','1','2023-01-11 00:28:16'),
('84','63bda5b72f8f07.90426483','50.00','2.00','0.00','0.00','0.00','1','2023-01-11 01:51:51'); 


DROP TABLE IF EXISTS `transaction_process`;
CREATE TABLE `transaction_process` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) NOT NULL,
  `water_type` varchar(255) DEFAULT NULL,
  `category_type` varchar(255) NOT NULL,
  `quantity` int(50) NOT NULL,
  `price` float(11,2) NOT NULL,
  `total_price` float(11,2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_id` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=362 DEFAULT CHARSET=utf8mb4;

INSERT INTO `transaction_process` VALUES ('257','1.5 Liters','Alkaline','For Refill','10','12.00','120.00','6','63abcccfc39779.12892746'),
('258','1.5 Liters','Alkaline','For Refill','100','12.00','1200.00','6','63abccf65b4b17.08669844'),
('259','1.5 Liters','Alkaline','For Refill','100','12.00','1200.00','6','63abcd3ed13407.16147320'),
('260','1.5 Liters','Alkaline','For Refill','200','12.00','2400.00','6','63abcd6d5251a7.06711961'),
('261','5 Gallons','Alkaline','For Refill','10','35.00','350.00','6','63abce4a681640.32895925'),
('262','1.5 Liters','Alkaline','For Refill','100','12.00','1200.00','6','63abf9aa8cc234.16453602'),
('263','5 Gallons','Alkaline','For Refill','5','35.00','175.00','1','63adc22bc2cab3.50151600'),
('264','5 Gallons','Alkaline','For Refill','3','35.00','105.00','1','63addfb7cd26a6.70637328'),
('265','1 Liter','Alkaline','Bottle','1','15.00','15.00','1','63ade6a5d628d1.10946512'),
('266','5 Gallons','Alkaline','For Refill','1','35.00','35.00','1','63adec262f9905.93241386'),
('267','5 Gallons','Alkaline','For Refill','1','35.00','35.00','1','63adec37d0ab25.33071269'),
('268','5 Gallons','Alkaline','For Refill','1','35.00','35.00','1','63adf3fa867f21.35929436'),
('269','1.5 Liters','Alkaline','For Refill','1','12.00','12.00','1','63adf3fa867f21.35929436'),
('270','1.5 Liters','Alkaline','For Refill','1','12.00','12.00','1','63adf42a59d698.62897437'),
('271','5 Gallons','Alkaline','For Refill','1','35.00','35.00','1','63adf42a59d698.62897437'),
('272','1.5 Liters','Alkaline','For Refill','1','12.00','12.00','1','63ae81665d4ba6.86096893'),
('281','1 Liter','Alkaline','Bottle','1','15.00','15.00','1','63aeb9931ff251.28969312'),
('282','1.5 Liters - Refill','Alkaline','For Refill','500','12.00','6000.00','6','63af21dd246400.87869706'),
('283','1.5 Liters - Refill','Mineral','For Refill','5000','8.00','40000.00','6','63b0f83f867115.74857145'),
('284','1.5 Liters - Refill','Mineral','For Refill','5100','8.00','40800.00','6','63b105d1d0fa95.03104495'),
('285','1.5 Liters - Refill','Mineral','For Refill','5200','8.00','41600.00','6','63b106ea3f7fa2.94397853'),
('286','1.5 Liters - Refill','Mineral','For Refill','5300','8.00','42400.00','6','63b1070ed4ffe5.62797644'),
('287','1.5 Liters - Refill','Mineral','For Refill','5400','8.00','43200.00','6','63b1072aac1753.53356204'),
('288','1.5 Liters - Refill','Mineral','For Refill','6000','8.00','48000.00','6','63b107c7479ae5.83352724'),
('289','1.5 Liters - Refill','Alkaline','For Refill','5500','12.00','66000.00','6','63b1086fae1de0.73921151'),
('290','1.5 Liters - Refill','Alkaline','For Refill','6000','12.00','72000.00','6','63b108bd8e3521.93468653'),
('291','1.5 Liters - Refill','Alkaline','For Refill','10000','12.00','120000.00','6','63b1096071d759.36019109'),
('292','1.5 Liters - Refill','Alkaline','For Refill','50000','12.00','600000.00','6','63b10997219918.56987517'),
('295','1.5 Liters - Refill','Alkaline','For Refill','100000','12.00','1200000.00','6','63b10b4b9149b6.59010599'),
('296','1.5 Liters - Refill','Alkaline','For Refill','60000','12.00','720000.00','6','63b10c3a543a83.33723195'),
('297','1.5 Liters - Refill','Alkaline','For Refill','10','12.00','120.00','6','63b10e4aab9696.99990337'),
('334','1.5 Liters - Refill','Mineral','For Refill','1','8.00','8.00','6','63baa0635aec10.87912152'),
('335','1.5 Liters - Refill','Alkaline','For Refill','1','12.00','12.00','6','63baa0635aec10.87912152'),
('336','1 Liter','Alkaline','Bottle','1','15.00','15.00','6','63baa0635aec10.87912152'),
('337','500 ml','Alkaline','Bottle','1','10.00','10.00','6','63baa0635aec10.87912152'),
('338','1.5 Liters - Refill','Alkaline','For Refill','1','12.00','12.00','6','63baa0740d2b01.35336222'),
('339','1.5 Liters - Refill','Alkaline','For Refill','1','12.00','12.00','6','63baa08aa45c96.94426721'),
('341','1.5 Liters - Refill','Alkaline','For Refill','1','12.00','12.00','6','0'),
('342','1.5 Liters - Refill','Alkaline','For Refill','3','12.00','36.00','1','63bd0aab9062f3.68575416'),
('345','1.5 Liters - Refill','Alkaline','For Refill','1','12.00','12.00','1','63bd0be0c6f9a6.84690160'),
('346','1.5 Liters - Refill','Alkaline','For Refill','1','12.00','12.00','1','63bd0c2dc7fc47.08717192'),
('347','1.5 Liters - Refill','Alkaline','For Refill','1','12.00','12.00','1','63bd0c847e14a0.23113515'),
('348','1.5 Liters - Refill','Alkaline','For Refill','1','12.00','12.00','1','63bd0cd98b3dd0.82754381'),
('354','1 Liter','Alkaline','Bottle','2','15.00','30.00','1','63bd90522cb615.40239428'),
('357','1.5 Liters - Refill','Alkaline','For Refill','1','12.00','12.00','1','63bd90522cb615.40239428'),
('358','1.5 Liters - Refill','Alkaline','For Refill','1','12.00','12.00','1','63bd90679abfc6.28719333'),
('359','1.5 Liters - Refill','Alkaline','For Refill','1','12.00','12.00','1','63bd921fe57275.48434181'),
('360','1.5 Liters - Refill','Alkaline','For Refill','3','12.00','36.00','1','63bda5b72f8f07.90426483'),
('361','1.5 Liters - Refill','Alkaline','For Refill','1','12.00','12.00','1','63bda5b72f8f07.90426483'); 


DROP TABLE IF EXISTS `user_session`;
CREATE TABLE `user_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `session_key` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_active` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4;

INSERT INTO `user_session` VALUES ('73','1','547d57601e826f5b5a4e','ACTIVE','2023-01-11 13:45:50'); 


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `status_archive_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`) USING BTREE,
  KEY `users_account_type_id` (`account_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` VALUES ('1','Quijano','Jerwinsonn','Ragasa','rapquijano04@gmail.com','$2y$10$J1xO3JUJkX/UzKafqZU73OPzkUy0jyZjWRaFUeonxsMaQa6.hMjkO','09560984209','1','0','Picture4.jpg','2022-11-16 21:48:25','1'),
('2','Diaz','Janry','Franco','janrydiaz1401@gmail.com','$2y$10$ptotyRzbZxa0G76Y9wI4R.AF90CYUDijv33qGZnJWDumUE5K.1eae','09557488018','1','0','Picture2.jpg','2022-11-16 21:48:25','1'),
('3','Fernandez','Hazel Ann','Dezena','azeannfernandez@gmail.com','$2y$10$yAjqs00PxqTRNWSHXcdUEOJBgKfefqG96uBW5dIrFWrI5xmHKipE6','09204933920','1','0','Picture1.jpg','2022-11-16 21:48:25','1'),
('4','Charvet','David Emmanuel','Javier','deybidsu@gmail.com','$2y$10$ISBQByEVphgK.0u0FQdDzu1NOF6vCTTTOzoeKVnQnrMHFrZepir4O','09908998888','1','0','Picture3.jpg','2022-11-16 21:48:25','1'),
('5','Tagulinao','Ricardo',NULL,'tagswater00@gmail.com','$2y$10$4ubDa1UpSrYE3s10bOfa5uFFd1EncDdGDB0nFg2wkXKelGseePh.u','09239029092','1',NULL,NULL,'2022-11-24 02:15:41','1'),
('6','Test','Test','Test','test@gmail.com','$2y$10$XFSKy5tnAQZ0e7ZL6kdChOGrmoWJyJ1HUwQwU3HhBGul9lHiUFqbi','09991234567','1','396471',NULL,'2022-11-24 02:15:41','1'); 


DROP TABLE IF EXISTS `water_type`;
CREATE TABLE `water_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `water_type_name_index` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO `water_type` VALUES ('1','Alkaline'),
('2','Mineral'); 


DROP TABLE IF EXISTS `weekly_scheduling`;
CREATE TABLE `weekly_scheduling` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `day` varchar(50) NOT NULL,
  `customer_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;

INSERT INTO `weekly_scheduling` VALUES ('12','THURSDAY','4'),
('14','SUNDAY','4'),
('20','TUESDAY','7'),
('21','WEDNESDAY','7'),
('23','FRIDAY','7'),
('24','SATURDAY','7'),
('26','TUESDAY','6'); 




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

