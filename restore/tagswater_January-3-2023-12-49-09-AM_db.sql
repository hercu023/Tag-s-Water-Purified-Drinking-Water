-- Generation time: Tue, 03 Jan 2023 00:49:09 +0800
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
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8mb4;

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
('108','2','23'); 


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
  `whole_day` int(11) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

INSERT INTO `attendance` VALUES ('1','1','0','2022-11-01','09:00:00','18:00:00','0.00','750.00','Test note','1000.00','1','6','2022-12-31 13:43:47','6','2022-12-31 13:43:47','1'),
('2','1','0','2021-12-01','13:02:00','14:04:00','0.00','0.00','Test note','250.00','1','6','2022-12-31 13:45:55','6','2022-12-31 13:45:55','1'),
('3','1','0','2022-12-02','13:46:00','13:46:00','0.00','0.00','Test note','250.00','1','6','2022-12-31 13:46:46','6','2022-12-31 13:46:46','1'),
('4','1','1','2022-12-03','13:48:00','13:48:00','0.00','0.00','Test note','500.00','1','6','2022-12-31 13:48:26','6','2022-12-31 13:48:26','1'),
('5','1','0','2022-12-04','13:49:00','13:49:00','50.00','0.00','Test note','200.00','1','6','2022-12-31 13:49:26','6','2022-12-31 13:49:26','1'),
('6','2','1','2022-12-01','15:32:00','18:34:00','0.00','0.00','Test note','500.00','1','6','2022-12-31 14:32:34','6','2022-12-31 14:32:34','1'),
('7','3','1','2022-12-31','08:00:00','00:00:00','0.00','0.00','Test note','0.00','0','6','2022-12-31 23:21:45','6','2022-12-31 23:21:45','1'),
('8','3','1','2023-01-01','21:45:00','09:51:00','0.00','0.00','','0.00','0','1','2023-01-01 21:45:58','1','2023-01-01 21:45:58','2'),
('9','1','1','2023-01-01','21:51:00','00:00:00','0.00','0.00','','0.00','0','1','2023-01-01 21:46:43','1','2023-01-01 21:46:43','1'),
('10','13','1','2023-01-01','22:46:00','00:00:00','0.00','0.00','','0.00','0','1','2023-01-01 21:47:00','1','2023-01-01 21:47:00','1'); 


DROP TABLE IF EXISTS `audit_trail`;
CREATE TABLE `audit_trail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `data` varchar(255) NOT NULL,
  `date_log` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=971 DEFAULT CHARSET=utf8mb4;

INSERT INTO `audit_trail` VALUES ('878','0','6','1','Added new attendance with details: employee_id =3,2022-12-31','2022-12-31 23:21:45'),
('879','23','6','1','Added new expense:[date=2023-01-01,expense_type=1,amount=1000]','2023-01-01 10:39:24'),
('880','23','6','1','Added new expense:[date=2023-01-01,expense_type=2,amount=1500]','2023-01-01 10:40:02'),
('881','23','6','1','Added new expense:[date=2023-01-01,expense_type=3,amount=2000]','2023-01-01 10:40:35'),
('882','23','6','1','Added new expense:[date=2023-01-01,expense_type=4,amount=500]','2023-01-01 10:40:49'),
('883','6','6','1','Add new transaction. Reference:121','2023-01-01 11:04:31'),
('884','6','6','1','Add new transaction. Reference:122','2023-01-01 12:02:25'),
('885','6','6','1','Add new transaction. Reference:123','2023-01-01 12:07:06'),
('886','6','6','1','Add new transaction. Reference:124','2023-01-01 12:07:42'),
('887','6','6','1','Add new transaction. Reference:125','2023-01-01 12:08:10'),
('888','6','6','1','Add new transaction. Reference:126','2023-01-01 12:10:47'),
('889','6','6','1','Add new transaction. Reference:127','2023-01-01 12:13:35'),
('890','6','6','1','Add new transaction. Reference:128','2023-01-01 12:14:53'),
('891','6','6','1','Add new transaction. Reference:129','2023-01-01 12:17:36'),
('892','6','6','1','Add new transaction. Reference:130','2023-01-01 12:18:31'),
('893','6','6','1','Add new transaction. Reference:131','2023-01-01 12:25:47'),
('894','6','6','1','Add new transaction. Reference:132','2023-01-01 12:29:46'),
('895','6','6','1','Add new transaction. Reference:133','2023-01-01 12:38:34'),
('896','1','1','1','Logged in the system','2023-01-01 13:38:55'),
('897','14','1','1','Transaction updated to For Delivery. Reference: 122','2023-01-01 14:20:05'),
('898','14','1','1','Transaction updated to For Delivery. Reference: 117','2023-01-01 14:20:18'),
('899','14','1','1','Transaction updated to Ongoing Delivery. Reference: ','2023-01-01 14:20:39'),
('900','14','1','1','Transaction updated to Delivered. Reference: 117','2023-01-01 14:22:10'),
('901','6','1','1','Add new transaction. Reference:134','2023-01-01 14:40:45'),
('902','14','1','1','Transaction added to For Pick up. Reference: 134','2023-01-01 14:41:02'),
('903','14','1','1','Transaction updated to Ongoing Pick Up. Reference: 134','2023-01-01 14:50:45'),
('904','14','1','1','Transaction added to For Pick up. Reference: 134','2023-01-01 15:22:07'),
('905','14','1','1','Transaction updated to Ongoing Pick Up. Reference: 134','2023-01-01 15:22:13'),
('906','14','1','1','Transaction updated to Already Pick Up. Reference: 134','2023-01-01 15:22:41'),
('907','14','1','1','Transaction updated to For Delivery. Reference: 119','2023-01-01 15:22:46'),
('908','14','1','1','Transaction updated to For Delivery. Reference: 134','2023-01-01 15:22:50'),
('909','14','1','1','Transaction updated to For Delivery. Reference: 122','2023-01-01 15:22:52'),
('910','6','1','1','Customer balance adjusted. Customer ID: 2','2023-01-01 15:44:09'),
('911','6','1','1','Add new transaction. Reference:135','2023-01-01 15:44:09'),
('912','14','1','1','Transaction added to For Pick up. Reference: 135','2023-01-01 15:44:17'),
('913','14','1','1','Transaction updated to Ongoing Pick Up. Reference: 135','2023-01-01 15:44:38'),
('914','14','1','1','Transaction updated to Already Pick Up. Reference: 135','2023-01-01 15:44:44'),
('915','14','1','1','Transaction updated to For Delivery. Reference: 135','2023-01-01 15:44:47'),
('916','14','1','1','Transaction updated to For Delivery. Reference: 135','2023-01-01 15:51:45'),
('917','14','1','1','Transaction updated to Ongoing Delivery. Reference: ','2023-01-01 15:52:31'),
('918','14','1','1','Transaction updated to Delivered. Reference: 135','2023-01-01 15:54:08'),
('919','6','1','1','Add new transaction. Reference:136','2023-01-01 16:40:39'),
('920','6','1','1','Add new transaction. Reference:137','2023-01-01 16:41:59'),
('921','20','1','1','Added new inventory with id:41','2023-01-01 21:14:37'),
('922','0','1','1','Updated inventory item with id:41','2023-01-01 21:17:18'),
('923','20','1','1','Added new inventory with id:42','2023-01-01 21:17:47'),
('924','20','1','1','Added new inventory with id:43','2023-01-01 21:18:13'),
('925','20','1','1','Added new inventory with id:44','2023-01-01 21:18:50'),
('926','20','1','1','Added new inventory with id:45','2023-01-01 21:19:16'),
('927','0','1','1','Added new attendance with details: employee_id =3,2023-01-01','2023-01-01 21:45:58'),
('928','0','1','1','Added new attendance with details: employee_id =1,2023-01-01','2023-01-01 21:46:43'),
('929','0','1','1','Added new attendance with details: employee_id =13,2023-01-01','2023-01-01 21:47:00'),
('930','0','1','1','Archived user with id: 6','2023-01-01 22:05:41'),
('931','18','1','1','Archived customer with id: 5','2023-01-01 22:29:02'),
('932','0','1','1','Archived attendance with id: 8','2023-01-01 22:33:15'),
('933','0','1','1','Archived employee with id: 1','2023-01-01 22:33:22'),
('934','23','1','1','Archived expense with id: 3','2023-01-01 22:35:10'),
('935','28','1','1','Restored expense with id:3','2023-01-01 22:35:47'),
('936','28','1','1','Restored customer with id:5','2023-01-01 22:35:55'),
('937','28','1','1','Restored employee with id:1','2023-01-01 22:36:00'),
('938','0','1','1','Archived inventory item with id: 6','2023-01-01 22:36:07'),
('939','28','1','1','Restored inventory item with id:6','2023-01-01 22:37:38'),
('940','18','1','1','Archived customer with id: 9','2023-01-01 22:39:12'),
('941','0','1','1','Archived employee with id: 4','2023-01-01 22:39:50'),
('942','23','1','1','Archived expense with id: 4','2023-01-01 22:39:59'),
('943','0','1','1','Archived inventory item with id: 7','2023-01-01 22:40:13'),
('944','14','1','1','Transaction updated to For Delivery. Reference: 136','2023-01-01 22:53:41'),
('945','6','1','1','Add new transaction. Reference:138','2023-01-01 22:56:03'),
('946','14','1','1','Transaction updated to For Delivery. Reference: 138','2023-01-01 22:56:11'),
('947','14','1','1','Transaction updated to Ongoing Delivery. Reference: ','2023-01-01 22:56:18'),
('948','14','1','1','Transaction added to For Pick up. Reference: 137','2023-01-01 22:57:50'),
('949','6','1','1','Add new transaction. Reference:139','2023-01-01 23:23:18'),
('950','6','1','1','Add new transaction. Reference:140','2023-01-02 03:31:01'),
('951','1','1','0','Restricted login, still has an active session.','2023-01-02 14:40:31'),
('952','1','1','1','Logged in the system','2023-01-02 14:52:02'),
('953','6','1','1','Add new transaction. Reference:141','2023-01-02 16:45:25'),
('954','6','1','1','Customer balance adjusted. Customer ID: 4','2023-01-02 16:56:29'),
('955','6','1','1','Add new transaction. Reference:142','2023-01-02 16:56:29'),
('956','6','1','1','Customer balance adjusted. Customer ID: 12','2023-01-02 17:03:52'),
('957','6','1','1','Add new transaction. Reference:143','2023-01-02 17:03:52'),
('958','6','0','1','Updated transaction with transaction reference:63b29df88853d6.69561977','2023-01-02 17:04:25'),
('959','6','1','1','Add new transaction. Reference:144','2023-01-02 17:09:46'),
('960','6','1','1','Add new transaction. Reference:145','2023-01-02 17:12:34'),
('961','6','1','1','Add new transaction. Reference:146','2023-01-02 17:13:33'),
('962','6','1','1','Add new transaction. Reference:147','2023-01-02 17:13:50'),
('963','1','1','1','Logged out of the system','2023-01-02 21:27:41'),
('964','1','1','1','Logged in the system','2023-01-02 21:27:50'),
('965','6','1','1','Deducted stocks for item:11','2023-01-02 21:46:29'),
('966','17','1','1','Updated stocks with id:11','2023-01-02 21:46:29'),
('967','6','1','1','Add new transaction. Reference:148','2023-01-02 21:46:29'),
('968','6','1','1','Deducted stocks for item:2','2023-01-02 21:48:12'),
('969','17','1','1','Updated stocks with id:2','2023-01-02 21:48:12'),
('970','6','1','1','Add new transaction. Reference:149','2023-01-02 21:48:12'); 


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
  `status_archive_id` int(11) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `customer_name` (`customer_name`),
  KEY `status_customers_constraint` (`status_archive_id`),
  CONSTRAINT `status_customers_constraint` FOREIGN KEY (`status_archive_id`) REFERENCES `status_archive` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

INSERT INTO `customers` VALUES ('1','Lorenzo','Sta.Cruz St.','09892829485','09223232222112','tabing jollibee','0.00','1','1','2022-11-27 14:48:29'),
('2','Stephen Smith','Curry St., Brgy. San Lorenzo','09992829375','09284573431','','0.00','1','1','2022-11-27 01:38:32'),
('3','Test Name','Test ','1234','1234','Test note','0.00','1','6','2022-11-30 02:28:56'),
('4','CN','ADDRESS','1234','1234','Test note','330.00','1','6','2022-11-30 02:34:48'),
('5','Test','Test ','1234','1234','Test note','0.00','1','6','2022-11-30 02:35:11'),
('6','Jerwinsonn Raphael Quijano','B7 L7 Sta.Ana St., Villa Ligaya Subd., Brgy. Dela ','2','2','2','0.00','1','1','2022-12-11 03:41:02'),
('7','Dylan Angelo','Sto. Nino St., Brgy. San Isidro','0989988899','0937485758','','0.00','1','1','2022-12-12 23:59:28'),
('9','','','','','','0.00','2','1','2022-12-14 21:39:05'),
('10','Jessica Soho','Lapu-lapu St., Brgy. Tagbili, Antipolo City','09992829375','09283948989','Green gate, unang kanan sa dulo.','325.50','1','1','2022-12-16 22:36:12'),
('12','Jonathan Almaranza','Celly Boulevard St., Brgy. Sta. Rosa','09288883949','09002739485','','0.00','1','1','2022-12-23 00:19:11'); 


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


DROP TABLE IF EXISTS `delivery_list`;
CREATE TABLE `delivery_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(250) NOT NULL,
  `delivery_status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `delivery_boy_id` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4;

INSERT INTO `delivery_list` VALUES ('70','63b139c9d5c356.96093206','3','1','6','2023-01-01 15:54:08'),
('71','63b147079e7fa8.94303209','2','1','2','2023-01-01 22:56:18'),
('72','63b19f0315f5f9.86315193','2','1','2','2023-01-01 22:56:18'),
('73','63b147578a9ca5.30331761','4','1','0','2023-01-01 22:57:50'); 


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
  `daily_rate` float(11,2) DEFAULT NULL,
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
('4','tate','andrew','sandoval','1','500.00','2022-11-19','andrewtate90@gmail.com','1231231231','0','0000-00-00 00:00:00','0','0000-00-00 00:00:00','2'),
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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

INSERT INTO `expense` VALUES ('2','4','2021-11-15','2000.00','Trust me, this is really a zoan fruit','6','2022-11-30 23:51:10','6','2022-11-30 23:51:35','1','1'),
('3','4','2022-11-28','1000.00','Test','6','2022-12-01 00:11:14','6','2022-12-01 00:11:14','1','1'),
('4','3','2022-11-28','123.00','123','6','2022-12-01 00:11:36','6','2022-12-01 00:11:36','1','2'),
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
('22','4','2023-01-01','500.00','123','6','2023-01-01 10:40:49','6','2023-01-01 10:40:49','1','1'); 


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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4;

INSERT INTO `inventory_item` VALUES ('1','Round - 5 Gallons','1','10','1','185.00','220.00','215.00','77fce6b86eef912efb10429092fa2273.jfif','2022-12-01 16:42:17','1','2022-12-30 15:07:43','1','1'),
('2','Slim - 2.5 Gallons','1','5','1','120.00','155.00','150.00','2faff09308079c871c09df8025884578.jfif','2022-12-01 16:50:42','1','2022-12-30 15:08:42','1','1'),
('3','Cap with Inner Plug for Round','5','10','1','10.00','0.00','0.00','205c32cdfc286f5863a216eb6e99f2fe.jfif','2022-12-01 16:53:13','1','2022-12-01 21:33:58','1','1'),
('4','Slim - 5 Gallons','1','10','1','185.00','220.00','215.00','5_gallon_slim_plastic_container_1568794578_4c2e969d0_progressive.jfif','2022-12-01 17:08:57','1','2022-12-30 15:08:54','1','1'),
('5','Faucet Seal','3','10','2','0.00','0.00','0.00','c215d9deaf3d1b0a7ff97d90bb16c087.jpg','2022-12-01 17:12:41','1','2022-12-01 18:45:14','1','1'),
('6','1 Liter','2','20','1','10.00','15.00','12.00','504350773.jpg','2022-12-01 17:13:44','1','2022-12-30 15:09:26','1','1'),
('7','Faucet - Push Down','7','10','1','25.00','0.00','0.00','4d7a42f744a6bc863b8c6e13924b1bea.jfif','2022-12-01 17:19:44','2','2022-12-06 19:14:19','1','1'),
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
('18','Small Cap Seal','3','5','2','0.00','0.00','0.00','Screenshot 2022-12-07 155001.png','2022-12-07 15:50:21','1','0000-00-00 00:00:00','1','0'),
('41','5 Gallons - Refill','10','0','1','0.00','35.00','30.00','round-and-square-blue-mineral-water-container.jpg','2023-01-01 21:14:36','1','2023-01-01 21:17:18','1','1'),
('42','1 Liter - Refill','10','0','1','0.00','8.00','6.00','504350773.jpg','2023-01-01 21:17:47','1','2023-01-01 21:17:47','1','1'),
('43','500 ml - Refill','10','0','1','0.00','5.00','3.00','504350773.jpg','2023-01-01 21:18:13','1','2023-01-01 21:18:13','1','1'),
('44','350 ml - Refill','10','0','1','0.00','3.00','1.00','504350773.jpg','2023-01-01 21:18:50','1','2023-01-01 21:18:50','1','1'),
('45','2.5 Gallons','10','0','1','0.00','18.00','13.00','2faff09308079c871c09df8025884578.jfif','2023-01-01 21:19:16','1','2023-01-01 21:19:16','1','1'); 


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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;

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
('28','11','POS Transaction Reference: 63b2e0354a2bf3.11672508','1','0.00','2023-01-02 21:46:29','1','OUT'),
('29','2','POS Transaction Reference: 63b2e09c75b0e0.45000846','1','0.00','2023-01-02 21:48:12','1','OUT'); 


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

INSERT INTO `inventory_stock` VALUES ('1','6','6200','6180','20'),
('2','2','1000','1','999'),
('3','39','0','0','0'),
('4','1','0','1000','0'),
('5','4','0','0','0'),
('6','29','0','0','0'),
('7','9','1000','2','998'),
('8','10','1000','0','1000'),
('9','11','500','1','499'),
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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

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
('26','SETTINGS-HELP'); 


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
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=utf8mb4;

INSERT INTO `transaction` VALUES ('135','63b139c9d5c356.96093206','2','Delivery','192.00','1','','0','1','1','2023-01-01 15:44:09','2023-01-01','15:44:09'),
('136','63b147079e7fa8.94303209','0','Delivery','12.00','1','','1','1','1','2023-01-01 16:40:39','2023-02-01','16:40:39'),
('137','63b147578a9ca5.30331761','0','Delivery/Pick Up','12.00','1','','1','1','1','2023-01-01 16:41:59','2023-01-01','16:41:59'),
('138','63b19f0315f5f9.86315193','12','Delivery','899.00','1','','1','1','1','2023-01-01 22:56:03','2023-01-01','22:56:03'),
('139','63b1a565e87821.97044073','12','Walk In','4305.00','1','','1','1','1','2023-01-01 23:23:17','2023-01-01','23:23:17'),
('140','63b1df75734ed5.33045558','5','Walk In','95.00','1','','1','1','1','2023-01-02 03:31:01','2023-01-02','03:31:01'),
('141','63b299a5c64441.58082897','4','Walk In','35.00','1','','1','1','1','2023-01-02 16:45:25','2023-01-02','16:45:25'),
('142','63b29c3da8ce00.63514248','4','Walk In','70.00','1','','1','1','1','2023-01-02 16:56:29','2023-01-02','16:56:29'),
('143','63b29df88853d6.69561977','12','Walk In','12.00','1','','1','1','0','2023-01-02 17:04:25','2023-01-02','17:03:52'),
('144','63b29f59eeab62.11877057','12','Walk In','3500.00','1','','1','1','1','2023-01-02 17:09:46','2023-01-02','17:09:46'),
('145','63b2a002c95d07.69038574','0','Walk In','3512.00','1','','1','1','1','2023-01-02 17:12:34','2023-01-02','17:12:34'),
('146','63b2a03cf0f7f6.86878746','0','Walk In','1200.00','1','','1','1','1','2023-01-02 17:13:33','2023-01-02','17:13:33'),
('147','63b2a04e411736.29819947','0','Walk In','3500.00','1','','1','1','1','2023-01-02 17:13:50','2023-01-02','17:13:50'),
('148','63b2e0354a2bf3.11672508','1','Walk In','3656.00','1','','1','1','1','2023-01-02 21:46:29','2023-01-02','21:46:29'),
('149','63b2e09c75b0e0.45000846','0','Walk In','486.00','1','','1','1','1','2023-01-02 21:48:12','2023-01-02','21:48:12'); 


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
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8mb4;

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
('73','63b12aed8d4510.86118631','12.00','0.00','0.00','0.00','0.00','1','2023-01-01 14:40:45'),
('74','63b139c9d5c356.96093206','0.00','0.00','0.00','0.00','192.00','1','2023-01-01 15:44:09'),
('75','63b147079e7fa8.94303209','123.00','111.00','0.00','0.00','0.00','1','2023-01-01 16:40:39'),
('76','63b147578a9ca5.30331761','12.00','0.00','0.00','0.00','0.00','1','2023-01-01 16:41:59'),
('77','63b19f0315f5f9.86315193','900.00','1.00','0.00','0.00','0.00','1','2023-01-01 22:56:03'),
('78','63b1a565e87821.97044073','5000.00','695.00','0.00','0.00','0.00','1','2023-01-01 23:23:18'),
('79','63b1df75734ed5.33045558','100.00','5.00','0.00','0.00','0.00','1','2023-01-02 03:31:01'),
('80','63b299a5c64441.58082897','35.00','0.00','400.00','400.00','0.00','1','2023-01-02 16:45:25'),
('81','63b29c3da8ce00.63514248','0.00','0.00','330.00','400.00','0.00','1','2023-01-02 16:56:29'),
('82','63b29df88853d6.69561977','0.00','0.00','0.00','0.00','12.00','1','2023-01-02 17:03:52'),
('83','63b29df88853d6.69561977','15.00','3.00','0.00','0.00','0.00','0','2023-01-02 17:04:25'),
('84','63b29f59eeab62.11877057','3500000.00','3496500.00','0.00','0.00','0.00','1','2023-01-02 17:09:46'),
('85','63b2a002c95d07.69038574','3600.00','88.00','0.00','0.00','0.00','1','2023-01-02 17:12:34'),
('86','63b2a03cf0f7f6.86878746','1500.00','300.00','0.00','0.00','0.00','1','2023-01-02 17:13:33'),
('87','63b2a04e411736.29819947','4000.00','500.00','0.00','0.00','0.00','1','2023-01-02 17:13:50'),
('88','63b2e0354a2bf3.11672508','4000.00','344.00','0.00','0.00','0.00','1','2023-01-02 21:46:29'),
('89','63b2e09c75b0e0.45000846','500.00','14.00','0.00','0.00','0.00','1','2023-01-02 21:48:12'); 


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
) ENGINE=InnoDB AUTO_INCREMENT=336 DEFAULT CHARSET=utf8mb4;

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
('298','1.5 Liters - Refill','Alkaline','For Refill','1','12.00','12.00','1','63b12aed8d4510.86118631'),
('299','1.5 Liters - Refill','Alkaline','For Refill','1','12.00','12.00','1','63b139c9d5c356.96093206'),
('300','1.5 Liters - Refill','Alkaline','For Refill','15','12.00','180.00','1','63b139c9d5c356.96093206'),
('301','1.5 Liters - Refill','Alkaline','For Refill','1','12.00','12.00','1','63b147079e7fa8.94303209'),
('302','1.5 Liters - Refill','Alkaline','For Refill','1','12.00','12.00','1','63b147578a9ca5.30331761'),
('303','1.5 Liters - Refill','Alkaline','For Refill','1','12.00','12.00','1','63b19f0315f5f9.86315193'),
('304','1.5 Liters - Refill','Alkaline','For Refill','1','12.00','12.00','1','63b19f0315f5f9.86315193'),
('305','5 Gallons - Refill','Alkaline','For Refill','25','35.00','875.00','1','63b19f0315f5f9.86315193'),
('306','5 Gallons - Refill','Alkaline','For Refill','123','35.00','4305.00','1','63b1a565e87821.97044073'),
('307','5 Gallons - Refill','Alkaline','For Refill','1','35.00','35.00','1','63b1df75734ed5.33045558'),
('308','5 Gallons - Refill','Alkaline','For Refill','1','35.00','35.00','1','63b1df75734ed5.33045558'),
('309','500 ml - Refill','Alkaline','For Refill','1','5.00','5.00','1','63b1df75734ed5.33045558'),
('310','1 Liter - Refill','Alkaline','For Refill','1','8.00','8.00','1','63b1df75734ed5.33045558'),
('311','1.5 Liters - Refill','Alkaline','For Refill','1','12.00','12.00','1','63b1df75734ed5.33045558'),
('312','5 Gallons - Refill','Alkaline','For Refill','1','35.00','35.00','1','63b299a5c64441.58082897'),
('313','5 Gallons - Refill','Alkaline','For Refill','2','35.00','70.00','1','63b29c3da8ce00.63514248'),
('314','1.5 Liters - Refill','Alkaline','For Refill','1','12.00','12.00','1','63b29df88853d6.69561977'),
('315','5 Gallons - Refill','Alkaline','For Refill','100','35.00','3500.00','1','63b29f59eeab62.11877057'),
('317','1.5 Liters - Refill','Alkaline','For Refill','1','12.00','12.00','1','63b2a002c95d07.69038574'),
('318','5 Gallons - Refill','Alkaline','For Refill','100','35.00','3500.00','1','63b2a002c95d07.69038574'),
('319','1.5 Liters - Refill','Alkaline','For Refill','100','12.00','1200.00','1','63b2a03cf0f7f6.86878746'),
('320','5 Gallons - Refill','Alkaline','For Refill','100','35.00','3500.00','1','63b2a04e411736.29819947'),
('321','5 Gallons - Refill','Alkaline','For Refill','100','35.00','3500.00','1','63b2e0354a2bf3.11672508'),
('322','5 Gallons - Refill','Alkaline','For Refill','1','35.00','35.00','1','63b2e0354a2bf3.11672508'),
('323','500 ml - Refill','Alkaline','For Refill','1','5.00','5.00','1','63b2e0354a2bf3.11672508'),
('324','2.5 Gallons','Alkaline','For Refill','1','18.00','18.00','1','63b2e0354a2bf3.11672508'),
('325','6 Liters','Alkaline','Bottle','1','45.00','45.00','1','63b2e0354a2bf3.11672508'),
('326','2.5 Gallons','Alkaline','For Refill','1','18.00','18.00','1','63b2e0354a2bf3.11672508'),
('327','5 Gallons - Refill','Alkaline','For Refill','1','35.00','35.00','1','63b2e0354a2bf3.11672508'),
('328','5 Gallons - Refill','Alkaline','For Refill','1','35.00','35.00','1','63b2e09c75b0e0.45000846'),
('329','1.5 Liters - Refill','Alkaline','For Refill','1','12.00','12.00','1','63b2e09c75b0e0.45000846'),
('330','500 ml - Refill','Alkaline','For Refill','1','5.00','5.00','1','63b2e09c75b0e0.45000846'),
('331','1.5 Liters - Refill','Alkaline','For Refill','1','12.00','12.00','1','63b2e09c75b0e0.45000846'),
('332','1.5 Liters - Refill','Alkaline','For Refill','1','12.00','12.00','1','63b2e09c75b0e0.45000846'),
('333','500 ml - Refill','Alkaline','For Refill','15','5.00','75.00','1','63b2e09c75b0e0.45000846'),
('334','1.5 Liters - Refill','Alkaline','For Refill','15','12.00','180.00','1','63b2e09c75b0e0.45000846'),
('335','Slim - 2.5 Gallons','Alkaline','Container','1','155.00','155.00','1','63b2e09c75b0e0.45000846'); 


DROP TABLE IF EXISTS `user_session`;
CREATE TABLE `user_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `session_key` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4;

INSERT INTO `user_session` VALUES ('57','1','80ded592a9691d77b3f7','ACTIVE'); 


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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` VALUES ('1','Quijano','Jerwinsonn','Ragasa','rapquijano04@gmail.com','$2y$10$J1xO3JUJkX/UzKafqZU73OPzkUy0jyZjWRaFUeonxsMaQa6.hMjkO','09560984209','1','0','Picture4.jpg','2022-11-16 21:48:25','1'),
('2','Diaz','Janry','Franco','janrydiaz1401@gmail.com','$2y$10$ptotyRzbZxa0G76Y9wI4R.AF90CYUDijv33qGZnJWDumUE5K.1eae','09557488018','1','0','Picture2.jpg','2022-11-16 21:48:25','1'),
('3','Fernandez','Hazel Ann','Dezena','azeannfernandez@gmail.com','$2y$10$yAjqs00PxqTRNWSHXcdUEOJBgKfefqG96uBW5dIrFWrI5xmHKipE6','09204933920','1','0','Picture1.jpg','2022-11-16 21:48:25','1'),
('4','Charvet','David Emmanuel','Javier','deybidsu@gmail.com','$2y$10$ISBQByEVphgK.0u0FQdDzu1NOF6vCTTTOzoeKVnQnrMHFrZepir4O','09908998888','1','0','Picture3.jpg','2022-11-16 21:48:25','1'),
('5','Tagulinao','Ricardo',NULL,'tagswater00@gmail.com','$2y$10$4ubDa1UpSrYE3s10bOfa5uFFd1EncDdGDB0nFg2wkXKelGseePh.u','09239029092','1',NULL,NULL,'2022-11-24 02:15:41','1'),
('6','Test','Test','Test','test@gmail.com','$2y$10$XFSKy5tnAQZ0e7ZL6kdChOGrmoWJyJ1HUwQwU3HhBGul9lHiUFqbi','09991234567','1','0',NULL,'2022-11-24 02:15:41','2'); 


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

