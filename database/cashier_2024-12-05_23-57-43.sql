# ************************************************************
# Antares - SQL Client
# Version 0.7.29
# 
# https://antares-sql.app/
# https://github.com/antares-sql/antares
# 
# Host: 127.0.0.1 (mariadb.org binary distribution 10.6.19)
# Database: cashier
# Generation time: 2024-12-05T23:59:24+07:00
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table detail_penjualan
# ------------------------------------------------------------

DROP TABLE IF EXISTS `detail_penjualan`;

CREATE TABLE `detail_penjualan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `penjualanID` bigint(20) unsigned NOT NULL,
  `produkID` bigint(20) unsigned NOT NULL,
  `Tanggal` date NOT NULL,
  `JumlahProduk` int(11) NOT NULL,
  `Subtotal` int(11) NOT NULL,
  `tempat_id` int(11) NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `penjualanID` (`penjualanID`),
  KEY `produkID` (`produkID`),
  KEY `created_by` (`created_by`),
  CONSTRAINT `detail_penjualan_ibfk_1` FOREIGN KEY (`penjualanID`) REFERENCES `penjualan` (`id`),
  CONSTRAINT `detail_penjualan_ibfk_2` FOREIGN KEY (`produkID`) REFERENCES `produk` (`id`),
  CONSTRAINT `detail_penjualan_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

LOCK TABLES `detail_penjualan` WRITE;
/*!40000 ALTER TABLE `detail_penjualan` DISABLE KEYS */;

INSERT INTO `detail_penjualan` (`id`, `penjualanID`, `produkID`, `Tanggal`, `JumlahProduk`, `Subtotal`, `tempat_id`, `created_by`) VALUES
	(1, 1, 5, "2024-12-04", 2, 6000, 1, 2),
	(2, 2, 6, "2024-12-04", 2, 16000, 1, 2),
	(3, 3, 3, "2024-12-05", 2, 40000, 1, 2),
	(4, 4, 7, "2024-12-05", 2, 12000, 1, 2),
	(5, 5, 8, "2024-12-05", 2, 20000, 1, 2),
	(6, 6, 7, "2024-12-05", 3, 18000, 1, 2),
	(7, 7, 3, "2024-12-05", 2, 40000, 1, 2),
	(8, 7, 5, "2024-12-05", 2, 6000, 1, 2),
	(9, 7, 6, "2024-12-05", 1, 8000, 1, 2),
	(10, 7, 8, "2024-12-05", 1, 10000, 1, 2),
	(11, 8, 3, "2024-12-05", 2, 40000, 1, 2),
	(12, 9, 7, "2024-12-05", 2, 12000, 1, 2),
	(13, 10, 7, "2024-12-05", 2, 12000, 1, 2),
	(14, 11, 6, "2024-12-05", 2, 16000, 1, 2),
	(15, 11, 7, "2024-12-05", 2, 12000, 1, 2),
	(16, 11, 8, "2024-12-05", 1, 10000, 1, 2);

/*!40000 ALTER TABLE `detail_penjualan` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table kategori
# ------------------------------------------------------------

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `id` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(225) NOT NULL,
  `tempat_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

LOCK TABLES `kategori` WRITE;
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;

INSERT INTO `kategori` (`id`, `nama`, `tempat_id`) VALUES
	(1, "Makanan", 1),
	(2, "Minuman", 1),
	(3, "Dessert", 1);

/*!40000 ALTER TABLE `kategori` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table meja
# ------------------------------------------------------------

DROP TABLE IF EXISTS `meja`;

CREATE TABLE `meja` (
  `id` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `meja` varchar(225) NOT NULL,
  `is_active` tinyint(4) NOT NULL COMMENT '1. Dipakai 2. Ksosong 3. Diperbaiki',
  `tempat_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

LOCK TABLES `meja` WRITE;
/*!40000 ALTER TABLE `meja` DISABLE KEYS */;

INSERT INTO `meja` (`id`, `meja`, `is_active`, `tempat_id`) VALUES
	(1, "MEJA-1", 1, 1),
	(2, "MEJA-2", 1, 1),
	(3, "MEJA-3", 2, 1),
	(4, "MEJA-4", 1, 1),
	(5, "MEJA-5", 2, 1),
	(6, "MEJA-6", 1, 1),
	(7, "MEJA-7", 1, 1);

/*!40000 ALTER TABLE `meja` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, "2014_10_12_000000_create_users_table", 1),
	(2, "2014_10_12_100000_create_password_reset_tokens_table", 1),
	(3, "2019_12_14_000001_create_personal_access_tokens_table", 1),
	(4, "2024_11_04_054624_create_produks_table", 2),
	(5, "2024_11_04_060340_create_pelanggans_table", 3),
	(6, "2024_11_04_061943_create_penjualans_table", 4),
	(7, "2024_11_04_064318_create_detail_penjualans_table", 5);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table password_reset_tokens
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





# Dump of table pelanggan
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pelanggan`;

CREATE TABLE `pelanggan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `NamaPelanggan` varchar(255) NOT NULL,
  `Point` int(10) DEFAULT NULL,
  `Alamat` text NOT NULL,
  `NomorTelepon` varchar(15) NOT NULL,
  `tempat_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `pelanggan` WRITE;
/*!40000 ALTER TABLE `pelanggan` DISABLE KEYS */;

INSERT INTO `pelanggan` (`id`, `NamaPelanggan`, `Point`, `Alamat`, `NomorTelepon`, `tempat_id`) VALUES
	(2, "Siti Mumainan", NULL, "Semboro Kidul", "0897768998678", 1),
	(3, "Guido Winata Putra", 2, "Semboro Tengah", "08906875876", 1),
	(4, "Ferren Diovaldi", NULL, "Umbulsari", "087689687698", 1);

/*!40000 ALTER TABLE `pelanggan` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table penjualan
# ------------------------------------------------------------

DROP TABLE IF EXISTS `penjualan`;

CREATE TABLE `penjualan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pelangganID` bigint(20) unsigned DEFAULT NULL,
  `meja_id` bigint(10) unsigned DEFAULT NULL,
  `TanggalPenjualan` date NOT NULL,
  `Kembali` int(10) DEFAULT NULL,
  `Metode` tinyint(4) NOT NULL COMMENT '1. TUNAI 2. QRIS 3. TRANSFER',
  `Dibayar` int(10) DEFAULT NULL,
  `Kode` varchar(225) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TotalHarga` int(10) NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `tempat_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `penjualan_pelangganid_foreign` (`pelangganID`),
  KEY `FK_63OC` (`created_by`),
  KEY `FK_DT3Q` (`meja_id`),
  CONSTRAINT `FK_63OC` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `FK_DT3Q` FOREIGN KEY (`meja_id`) REFERENCES `meja` (`id`),
  CONSTRAINT `penjualan_pelangganid_foreign` FOREIGN KEY (`pelangganID`) REFERENCES `pelanggan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `penjualan` WRITE;
/*!40000 ALTER TABLE `penjualan` DISABLE KEYS */;

INSERT INTO `penjualan` (`id`, `pelangganID`, `meja_id`, `TanggalPenjualan`, `Kembali`, `Metode`, `Dibayar`, `Kode`, `TotalHarga`, `created_by`, `tempat_id`) VALUES
	(1, NULL, NULL, "2024-12-04", 4000, 1, 10000, "SKB1856036", 6000, 2, 1),
	(2, NULL, NULL, "2024-12-04", 4000, 1, 20000, "SKB2571325", 16000, 2, 1),
	(3, NULL, 4, "2024-12-05", 10000, 1, 50000, "SKB7758990", 40000, 2, 1),
	(4, NULL, 1, "2024-12-05", NULL, 2, NULL, "SKB4534685", 12000, 2, 1),
	(5, NULL, 2, "2024-12-05", 5000, 1, 25000, "SKB6771706", 20000, 2, 1),
	(6, NULL, 1, "2024-12-05", 2000, 1, 20000, "SKB1060753", 17100, 2, 1),
	(7, NULL, 3, "2024-12-05", 6000, 1, 70000, "SKB6725178", 60800, 2, 1),
	(8, 3, NULL, "2024-12-05", NULL, 2, NULL, "SKB7245843", 40000, 2, 1),
	(9, NULL, 4, "2024-12-05", 3000, 1, 15000, "SKB7402789", 12000, 2, 1),
	(10, NULL, 4, "2024-12-05", 3000, 1, 15000, "SKB3131201", 12000, 2, 1),
	(11, NULL, 5, "2024-12-05", 2000, 1, 40000, "SKB1242621", 38000, 2, 1);

/*!40000 ALTER TABLE `penjualan` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table personal_access_tokens
# ------------------------------------------------------------

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





# Dump of table place
# ------------------------------------------------------------

DROP TABLE IF EXISTS `place`;

CREATE TABLE `place` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

LOCK TABLES `place` WRITE;
/*!40000 ALTER TABLE `place` DISABLE KEYS */;

INSERT INTO `place` (`id`, `nama`, `foto`) VALUES
	(1, "KFC Semboro", "");

/*!40000 ALTER TABLE `place` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table produk
# ------------------------------------------------------------

DROP TABLE IF EXISTS `produk`;

CREATE TABLE `produk` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kategori_id` bigint(10) unsigned NOT NULL,
  `NamaProduk` varchar(255) NOT NULL,
  `Harga` decimal(10,2) DEFAULT NULL,
  `Price` int(10) NOT NULL,
  `Stok` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `tempat_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_KV16` (`kategori_id`),
  CONSTRAINT `FK_KV16` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `produk` WRITE;
/*!40000 ALTER TABLE `produk` DISABLE KEYS */;

INSERT INTO `produk` (`id`, `kategori_id`, `NamaProduk`, `Harga`, `Price`, `Stok`, `image_path`, `tempat_id`) VALUES
	(3, 1, "MIe Gekikara", NULL, 20000, 14, "images/RgMRepT0Ob4dfbOO7pvephcu7wrcz6LVwK4odlfV.jpg", 1),
	(5, 2, "Es Teh", NULL, 3000, 29, "images/2bGyF3dkzQVs5FUDvVvkSN1eYFOvR2igJjV4tCA0.jpg", 1),
	(6, 3, "Salad", NULL, 8000, 7, "images/KUnPvTzFI7RrhpbbVuE4MapqcsPNt0P9JXQJSRjz.jpg", 1),
	(7, 2, "Milo Ice Bubuk", NULL, 6000, 54, "images/Li2MOs48IoU8YnQmvBmzhcwwDOIoe3Do4KUHJSAW.jpg", 1),
	(8, 1, "Ayam Geprek", NULL, 10000, 74, "images/kiNyQ2u4AIjmFvvM9Pznl0SQu0PwMYhHN4EAiUZy.jpg", 1);

/*!40000 ALTER TABLE `produk` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `role` tinyint(4) NOT NULL COMMENT '1: administrator, 2: pegawai',
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tempat_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `username`, `foto`, `role`, `firstname`, `lastname`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `tempat_id`) VALUES
	(1, "admin", NULL, 1, "Admin", "Admin", "admin@argon.com", NULL, "$2y$12$crI8d59aRPO1lN6wmo4Mteey8iqMDQ3ERYK1CvNjP4vB7YfLaVfbC", NULL, NULL, NULL, 1),
	(2, "Paska", NULL, 2, NULL, NULL, "paska@gmail.com", NULL, "$2y$12$8g0B9wl4fsfKL/hfbyXZW.Bgs5hbxxjQAVxMYmvb6LOUSVrMlkFfK", NULL, "2024-11-06 03:33:51", "2024-11-25 14:51:54", 1);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of views
# ------------------------------------------------------------

# Creating temporary tables to overcome VIEW dependency errors


/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

# Dump completed on 2024-12-05T23:59:24+07:00
