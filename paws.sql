-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               11.4.2-MariaDB-ubu2404 - mariadb.org binary distribution
-- Server OS:                    debian-linux-gnu
-- HeidiSQL Version:             12.7.0.6850
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for website
CREATE DATABASE IF NOT EXISTS `website` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci */;
USE `website`;

-- Dumping structure for table website.adoption_requests
CREATE TABLE IF NOT EXISTS `adoption_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pet_id` int(11) NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `client_email` varchar(100) NOT NULL,
  `client_phone` varchar(20) DEFAULT NULL,
  `status` enum('pending','approved','denied') DEFAULT 'pending',
  `requested_at` timestamp NULL DEFAULT current_timestamp(),
  `approved_at` timestamp NULL DEFAULT NULL,
  `denied_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pet_id` (`pet_id`),
  CONSTRAINT `adoption_requests_ibfk_1` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Dumping data for table website.adoption_requests: ~4 rows (approximately)
INSERT INTO `adoption_requests` (`id`, `pet_id`, `client_name`, `client_email`, `client_phone`, `status`, `requested_at`, `approved_at`, `denied_at`) VALUES
	(1, 15, 'AS', 'fifedo@mailinator.com', '', 'pending', '2024-09-14 09:56:49', NULL, NULL),
	(2, 19, 's', 's@sd.com', '', 'pending', '2024-09-14 10:00:19', NULL, NULL),
	(3, 19, 'er', 'fifedo@mailinator.com', '', 'pending', '2024-09-14 10:01:00', NULL, NULL),
	(5, 19, 'Lydia Workman', 'lywiraguty@mailinator.com', '+1 (821) 365-9316', 'pending', '2024-09-14 17:23:18', NULL, NULL);

-- Dumping structure for table website.company
CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Dumping data for table website.company: ~0 rows (approximately)
INSERT INTO `company` (`id`, `name`, `email`, `phone`, `address`, `created_at`) VALUES
	(1, 'Paws', 'paws@gmail.com', '1234567890', '1/31 Market street, Sydney', '2024-09-14 10:33:33');

-- Dumping structure for table website.faq
CREATE TABLE IF NOT EXISTS `faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Dumping data for table website.faq: ~6 rows (approximately)
INSERT INTO `faq` (`id`, `question`, `answer`, `created_at`) VALUES
	(4, 'How to Adopt?', 'To adopt a pet, please visit our adoption center and fill out the necessary forms. You\'ll need to provide identification and a proof of residence.', '2024-09-14 13:23:58'),
	(5, 'How To Volunteer?', 'We welcome volunteers! You can sign up on our website or visit our shelter to learn more about how you can help.', '2024-09-14 13:24:20'),
	(6, 'How To Support The Shelter?', 'You can support the shelter by donating, fostering a pet, or spreading the word about our mission. Every little bit helps!', '2024-09-14 13:24:43'),
	(7, 'How To Organize An Adoption Event?', 'If you\'re interested in organizing an adoption event, please contact our events coordinator for more information and guidelines.', '2024-09-14 13:25:09'),
	(8, 'How Long Will It Take For Pet To Arrive At The Location?', 'It typically takes 1-2 weeks for the pet to arrive at your location, depending on the distance and transportation arrangements.', '2024-09-14 13:25:44');

-- Dumping structure for table website.leads
CREATE TABLE IF NOT EXISTS `leads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Dumping data for table website.leads: ~2 rows (approximately)
INSERT INTO `leads` (`id`, `name`, `email`, `phone`, `message`, `created_at`) VALUES
	(1, 'Daryl Soto', 'rybeniv@mailinator.com', '+1 (269) 221-2166', 'Proident inventore ', '2024-09-14 17:27:37'),
	(2, 'Perry Richard', 'xepogo@mailinator.com', '+1 (393) 272-4905', 'Fuga Rerum recusand', '2024-09-14 17:28:40');

-- Dumping structure for table website.pets
CREATE TABLE IF NOT EXISTS `pets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `breed` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Dumping data for table website.pets: ~6 rows (approximately)
INSERT INTO `pets` (`id`, `name`, `breed`, `age`, `description`, `created_at`, `updated_at`, `image`) VALUES
	(15, 'Rommy', 'black', 2, '65', '2024-09-14 08:41:32', '2024-09-14 13:30:19', 'uploads/Screenshot-2024-08-05-163622 (1).png'),
	(16, 'Ban', 'cat', 1, 'fluffy', '2024-09-14 08:42:33', '2024-09-14 08:42:33', 'uploads/cat1.jpg'),
	(17, 'Rocky', 'dog', 1, 'rocvkd', '2024-09-14 08:43:03', '2024-09-14 08:43:03', 'uploads/dog6.jpg'),
	(18, 'Destroyer', 'cat', 1, 'cute', '2024-09-14 08:43:27', '2024-09-14 08:43:27', 'uploads/cat2.jpg'),
	(19, 'juliet', 'cat', 1, 'tsundere', '2024-09-14 08:43:48', '2024-09-14 08:43:48', 'uploads/cat4.jpg');

-- Dumping structure for table website.subscription
CREATE TABLE IF NOT EXISTS `subscription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `subscribed_at` timestamp NULL DEFAULT current_timestamp(),
  `unsubscribed_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Dumping data for table website.subscription: ~2 rows (approximately)
INSERT INTO `subscription` (`id`, `email`, `subscribed_at`, `unsubscribed_at`) VALUES
	(1, 'sdf@asdk.com', '2024-09-14 08:30:25', NULL),
	(2, 'milan@ktmconsultingroup.com', '2024-09-14 08:51:26', NULL),
	(3, 'superadmin@ktmconsultingroup.com', '2024-09-14 17:11:23', NULL);

-- Dumping structure for table website.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user','company') NOT NULL DEFAULT 'admin',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Dumping data for table website.users: ~2 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
	(1, 'Anil Karki', 'anil@gmail.com', '$2y$10$oypbahs6kco0VpZH3xBdA.3XqTEpKy5Mgy4.QKaqkynuMIdR6FcNe', 'user', '2024-09-14 00:24:01'),
	(2, 'admin', 'admin@admin.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'admin', '2024-09-14 01:43:58'),
	(4, 'superadmin', 'super@admin.com', '17c4520f6cfd1ab53d8745e84681eb49', 'admin', '2024-09-14 02:12:27');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
