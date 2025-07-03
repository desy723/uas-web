-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for uas_ci4
CREATE DATABASE IF NOT EXISTS `uas_ci4` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `uas_ci4`;

-- Dumping structure for table uas_ci4.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table uas_ci4.migrations: ~0 rows (approximately)
INSERT IGNORE INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
	(1, '2025-05-09-035434', 'App\\Database\\Migrations\\User', 'default', 'App', 1751026803, 1),
	(2, '2025-05-09-035435', 'App\\Database\\Migrations\\Product', 'default', 'App', 1751026803, 1),
	(3, '2025-05-09-035435', 'App\\Database\\Migrations\\Transaction', 'default', 'App', 1751026803, 1),
	(4, '2025-05-09-035515', 'App\\Database\\Migrations\\TransactionDetail', 'default', 'App', 1751026803, 1),
	(5, '2025-05-15-121822', 'App\\Database\\Migrations\\ProductCategory', 'default', 'App', 1751026803, 1);

-- Dumping structure for table uas_ci4.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `harga` double NOT NULL,
  `jumlah` int NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table uas_ci4.product: ~2 rows (approximately)
INSERT IGNORE INTO `product` (`id`, `nama`, `harga`, `jumlah`, `foto`, `created_at`, `updated_at`) VALUES
	(1, 'ASUS TUF A15 FA506NF', 10899000, 5, 'asus_tuf_a15.jpg', '2025-06-27 12:23:16', '2025-06-27 13:49:54'),
	(2, 'Asus Vivobook 14 A1404ZA', 6899000, 7, 'asus_vivobook_14.jpg', '2025-06-27 12:23:16', NULL),
	(3, 'Lenovo IdeaPad Slim 3-14IAU7', 6299000, 5, 'lenovo_idepad_slim_3.jpg', '2025-06-27 12:23:16', NULL);

-- Dumping structure for table uas_ci4.product_category
CREATE TABLE IF NOT EXISTS `product_category` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table uas_ci4.product_category: ~2 rows (approximately)
INSERT IGNORE INTO `product_category` (`id`, `category_name`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Elektronik', 1, '2025-06-27 05:23:20', NULL),
	(2, 'Pakaian', 1, '2025-06-27 05:23:20', NULL),
	(3, 'Makanan & Minuman', 1, '2025-06-27 05:23:20', NULL);

-- Dumping structure for table uas_ci4.transaction
CREATE TABLE IF NOT EXISTS `transaction` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `total_harga` double NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `ongkir` double DEFAULT NULL,
  `status` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table uas_ci4.transaction: ~4 rows (approximately)
INSERT IGNORE INTO `transaction` (`id`, `username`, `total_harga`, `alamat`, `ongkir`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'nama_pengguna_saat_ini', 17198000, NULL, NULL, 0, '2025-06-29 13:43:00', '2025-06-29 13:43:00'),
	(2, 'susanti.ibun', 10899000, NULL, NULL, 0, '2025-06-29 13:44:36', '2025-06-29 13:44:36'),
	(3, 'susanti.ibun', 6899000, NULL, NULL, 0, '2025-06-29 13:45:35', '2025-06-29 13:45:35'),
	(4, 'susanti.ibun', 13798000, NULL, NULL, 0, '2025-06-29 13:54:27', '2025-06-29 13:54:27');

-- Dumping structure for table uas_ci4.transaction_detail
CREATE TABLE IF NOT EXISTS `transaction_detail` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` int unsigned NOT NULL,
  `product_id` int unsigned NOT NULL,
  `jumlah` int NOT NULL,
  `diskon` double DEFAULT NULL,
  `subtotal_harga` double NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table uas_ci4.transaction_detail: ~4 rows (approximately)
INSERT IGNORE INTO `transaction_detail` (`id`, `transaction_id`, `product_id`, `jumlah`, `diskon`, `subtotal_harga`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 1, 0, 10899000, '2025-06-29 13:43:00', '2025-06-29 13:43:00'),
	(2, 1, 3, 1, 0, 6299000, '2025-06-29 13:43:00', '2025-06-29 13:43:00'),
	(3, 2, 1, 1, 0, 10899000, '2025-06-29 13:44:36', '2025-06-29 13:44:36'),
	(4, 3, 2, 1, 0, 6899000, '2025-06-29 13:45:35', '2025-06-29 13:45:35'),
	(5, 4, 2, 2, 0, 13798000, '2025-06-29 13:54:27', '2025-06-29 13:54:27');

-- Dumping structure for table uas_ci4.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table uas_ci4.user: ~10 rows (approximately)
INSERT IGNORE INTO `user` (`id`, `username`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
	(1, 'knashiruddin', 'saefullah.farhunnisa@prasasta.org', '$2y$12$oDhYjlzq6bR2oX1hAyhJr.GHhkXVRF9v0YbxOtBi3mEGZlPOV82Ty', 'admin', '2025-06-27 12:22:52', NULL),
	(2, 'susanti.ibun', 'kadir.padmasari@gmail.com', '$2y$12$WJO1iTFXidAN0bSiBkUmUeo6rKfcfvXAA5DADWfUCW3Sz8s3wLZ8e', 'admin', '2025-06-27 12:22:53', NULL),
	(3, 'gandewa.nurdiyanti', 'almira.manullang@yahoo.co.id', '$2y$12$wewGbyR8PyXZCX2PvAFXzuc5aBMWfxAriUdSXBzNPlaUPG564BRnS', 'guest', '2025-06-27 12:22:53', NULL),
	(4, 'hariyah.ganda', 'vanesa.situmorang@lestari.web.id', '$2y$12$QeaPNxNR7cx6FHh5qSoDS.r2eqlaldhCtCee.e/M4IgoskwdBZ35q', 'admin', '2025-06-27 12:22:53', NULL),
	(5, 'silvia.sirait', 'wani.firgantoro@gmail.co.id', '$2y$12$BsHYfQ7H45yQ4W43jXbCVeHQl1.TXdaLMQpEVKytegO9j2/fN3M9u', 'admin', '2025-06-27 12:22:53', NULL),
	(6, 'safina28', 'saputra.mala@agustina.com', '$2y$12$qFIJ/SoqLviSmqs8v03KoOo08K9E6/xZJCLX2L4v5mQ.g/3aUsX8C', 'admin', '2025-06-27 12:22:53', NULL),
	(7, 'kasusra.rajata', 'najwa49@gmail.com', '$2y$12$Bt.b//7wNYzHEw4fZ3jTxOFkvbL.RiiNFPBaKfLzCmMuYfjirrl0O', 'admin', '2025-06-27 12:22:54', NULL),
	(8, 'msimanjuntak', 'hasanah.qori@gmail.co.id', '$2y$12$QtUbPsPXSrAK3kxdjmpTR.t9ZQPZTXllLCLKMbQl2E7rskS/6FPju', 'guest', '2025-06-27 12:22:54', NULL),
	(9, 'elma71', 'wijaya.samsul@yahoo.com', '$2y$12$.62m2qUL7X8mvZAXogOMd.Z7plO96oxRcVNX87Z3t6wFKybf9Ipyu', 'guest', '2025-06-27 12:22:54', NULL),
	(10, 'gwastuti', 'xwulandari@gmail.com', '$2y$12$MM8eaF3ezJXIGPjG8.mVIOY4bEEAIMUjPh.G7IzZ6hGRiGz6cqWEm', 'admin', '2025-06-27 12:22:54', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
