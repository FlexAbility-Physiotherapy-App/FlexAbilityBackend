-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.11.2-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for flexability
CREATE DATABASE IF NOT EXISTS `flexability` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `flexability`;

-- Dumping structure for table flexability.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `category` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table flexability.patient
CREATE TABLE IF NOT EXISTS `patient` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `phone_number` varchar(12) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `amka` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_patient_user` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping structure for table flexability.physio
CREATE TABLE IF NOT EXISTS `physio` (
  `id` int(10) unsigned NOT NULL,
  `address` varchar(60) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `owner` varchar(100) DEFAULT NULL,
  `afm` varchar(9) DEFAULT NULL,
  `phone_number` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_physio_user` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table flexability.provision
CREATE TABLE IF NOT EXISTS `provision` (
  `id` varchar(10) NOT NULL,
  `description` text DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table flexability.patient_physio
CREATE TABLE IF NOT EXISTS `patient_physio` (
  `patient_id` int(10) unsigned NOT NULL,
  `physio_id` int(10) unsigned NOT NULL,
  `timestamp` timestamp NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `send_timestamp` timestamp NULL DEFAULT NULL,
  `provision_id` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`patient_id`,`physio_id`,`timestamp`),
  KEY `fk_patient_physio_physio` (`physio_id`),
  KEY `fk_patient_physio_provision` (`provision_id`),
  CONSTRAINT `fk_patient_physio_patient` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_patient_physio_physio` FOREIGN KEY (`physio_id`) REFERENCES `physio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_patient_physio_provision` FOREIGN KEY (`provision_id`) REFERENCES `provision` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
