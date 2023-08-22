/*
SQLyog Professional v12.5.1 (64 bit)
MySQL - 10.4.27-MariaDB : Database - db_inventoryweb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_inventoryweb` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `db_inventoryweb`;

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2019_08_19_000000_create_failed_jobs_table',1),
(2,'2019_12_14_000001_create_personal_access_tokens_table',1),
(3,'2022_10_31_061811_create_menu_table',1),
(4,'2022_11_01_041110_create_table_role',1),
(5,'2022_11_01_083314_create_table_user',1),
(6,'2022_11_03_023905_create_table_submenu',1),
(7,'2022_11_03_064417_create_tbl_akses',1),
(8,'2022_11_08_024215_create_tbl_web',1),
(9,'2022_11_15_131148_create_tbl_jenisbarang',2),
(10,'2022_11_15_173700_create_tbl_satuan',3),
(11,'2022_11_15_180434_create_tbl_merk',4),
(12,'2022_11_16_120018_create_tbl_appreance',5),
(13,'2022_11_25_141731_create_tbl_barang',6),
(14,'2022_11_26_011349_create_tbl_customer',7),
(16,'2022_11_28_151108_create_tbl_barangmasuk',8),
(17,'2022_11_30_115904_create_tbl_barangkeluar',9);

/*Table structure for table `personal_access_tokens` */

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

/*Data for the table `personal_access_tokens` */

/*Table structure for table `tbl_akses` */

DROP TABLE IF EXISTS `tbl_akses`;

CREATE TABLE `tbl_akses` (
  `akses_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` varchar(255) DEFAULT NULL,
  `submenu_id` varchar(255) DEFAULT NULL,
  `othermenu_id` varchar(255) DEFAULT NULL,
  `role_id` varchar(255) NOT NULL,
  `akses_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`akses_id`)
) ENGINE=InnoDB AUTO_INCREMENT=568 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tbl_akses` */

insert  into `tbl_akses`(`akses_id`,`menu_id`,`submenu_id`,`othermenu_id`,`role_id`,`akses_type`,`created_at`,`updated_at`) values 
(224,'1667444041',NULL,NULL,'1','view','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(225,'1667444041',NULL,NULL,'1','create','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(226,'1667444041',NULL,NULL,'1','update','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(227,'1667444041',NULL,NULL,'1','delete','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(228,'1668509889',NULL,NULL,'1','view','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(229,'1668509889',NULL,NULL,'1','create','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(230,'1668509889',NULL,NULL,'1','update','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(231,'1668509889',NULL,NULL,'1','delete','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(232,'1668510437',NULL,NULL,'1','view','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(233,'1668510437',NULL,NULL,'1','create','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(234,'1668510437',NULL,NULL,'1','update','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(235,'1668510437',NULL,NULL,'1','delete','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(236,'1668510568',NULL,NULL,'1','view','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(237,'1668510568',NULL,NULL,'1','create','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(238,'1668510568',NULL,NULL,'1','update','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(239,'1668510568',NULL,NULL,'1','delete','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(240,NULL,'9',NULL,'1','view','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(241,NULL,'9',NULL,'1','create','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(242,NULL,'9',NULL,'1','update','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(243,NULL,'9',NULL,'1','delete','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(248,NULL,'17',NULL,'1','view','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(249,NULL,'17',NULL,'1','create','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(250,NULL,'17',NULL,'1','update','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(251,NULL,'17',NULL,'1','delete','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(252,NULL,'10',NULL,'1','view','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(253,NULL,'10',NULL,'1','create','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(254,NULL,'10',NULL,'1','update','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(255,NULL,'10',NULL,'1','delete','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(260,NULL,'18',NULL,'1','view','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(261,NULL,'18',NULL,'1','create','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(262,NULL,'18',NULL,'1','update','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(263,NULL,'18',NULL,'1','delete','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(264,NULL,'19',NULL,'1','view','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(265,NULL,'19',NULL,'1','create','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(266,NULL,'19',NULL,'1','update','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(267,NULL,'19',NULL,'1','delete','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(268,NULL,'20',NULL,'1','view','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(269,NULL,'20',NULL,'1','create','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(270,NULL,'20',NULL,'1','update','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(271,NULL,'20',NULL,'1','delete','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(272,NULL,NULL,'1','1','view','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(273,NULL,NULL,'2','1','view','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(274,NULL,NULL,'3','1','view','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(275,NULL,NULL,'4','1','view','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(276,NULL,NULL,'5','1','view','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(277,NULL,NULL,'6','1','view','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(278,NULL,NULL,'1','1','create','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(279,NULL,NULL,'2','1','create','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(280,NULL,NULL,'3','1','create','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(281,NULL,NULL,'4','1','create','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(282,NULL,NULL,'5','1','create','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(283,NULL,NULL,'6','1','create','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(284,NULL,NULL,'1','1','update','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(285,NULL,NULL,'2','1','update','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(286,NULL,NULL,'3','1','update','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(287,NULL,NULL,'4','1','update','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(288,NULL,NULL,'5','1','update','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(289,NULL,NULL,'6','1','update','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(290,NULL,NULL,'1','1','delete','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(291,NULL,NULL,'2','1','delete','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(292,NULL,NULL,'3','1','delete','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(293,NULL,NULL,'4','1','delete','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(294,NULL,NULL,'5','1','delete','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(295,NULL,NULL,'6','1','delete','2022-11-24 12:07:30','2022-11-24 12:07:30'),
(296,'1667444041',NULL,NULL,'2','view','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(297,'1667444041',NULL,NULL,'2','create','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(298,'1667444041',NULL,NULL,'2','update','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(299,'1667444041',NULL,NULL,'2','delete','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(300,'1668509889',NULL,NULL,'2','view','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(301,'1668509889',NULL,NULL,'2','create','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(302,'1668509889',NULL,NULL,'2','update','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(303,'1668509889',NULL,NULL,'2','delete','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(304,'1668510437',NULL,NULL,'2','view','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(305,'1668510437',NULL,NULL,'2','create','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(306,'1668510437',NULL,NULL,'2','update','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(307,'1668510437',NULL,NULL,'2','delete','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(308,'1668510568',NULL,NULL,'2','view','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(309,'1668510568',NULL,NULL,'2','create','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(310,'1668510568',NULL,NULL,'2','update','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(311,'1668510568',NULL,NULL,'2','delete','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(312,NULL,'9',NULL,'2','view','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(313,NULL,'9',NULL,'2','create','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(314,NULL,'9',NULL,'2','update','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(315,NULL,'9',NULL,'2','delete','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(320,NULL,'17',NULL,'2','view','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(321,NULL,'17',NULL,'2','create','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(322,NULL,'17',NULL,'2','update','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(323,NULL,'17',NULL,'2','delete','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(324,NULL,'10',NULL,'2','view','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(325,NULL,'10',NULL,'2','create','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(326,NULL,'10',NULL,'2','update','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(327,NULL,'10',NULL,'2','delete','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(332,NULL,'18',NULL,'2','view','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(333,NULL,'18',NULL,'2','create','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(334,NULL,'18',NULL,'2','update','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(335,NULL,'18',NULL,'2','delete','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(336,NULL,'19',NULL,'2','view','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(337,NULL,'19',NULL,'2','create','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(338,NULL,'19',NULL,'2','update','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(339,NULL,'19',NULL,'2','delete','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(340,NULL,'20',NULL,'2','view','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(341,NULL,'20',NULL,'2','create','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(342,NULL,'20',NULL,'2','update','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(343,NULL,'20',NULL,'2','delete','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(344,NULL,NULL,'1','2','view','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(345,NULL,NULL,'2','2','view','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(346,NULL,NULL,'3','2','view','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(347,NULL,NULL,'4','2','view','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(349,NULL,NULL,'6','2','view','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(350,NULL,NULL,'1','2','create','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(351,NULL,NULL,'2','2','create','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(352,NULL,NULL,'3','2','create','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(353,NULL,NULL,'4','2','create','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(354,NULL,NULL,'5','2','create','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(355,NULL,NULL,'6','2','create','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(356,NULL,NULL,'1','2','update','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(357,NULL,NULL,'2','2','update','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(358,NULL,NULL,'3','2','update','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(359,NULL,NULL,'4','2','update','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(360,NULL,NULL,'5','2','update','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(361,NULL,NULL,'6','2','update','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(362,NULL,NULL,'1','2','delete','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(363,NULL,NULL,'2','2','delete','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(364,NULL,NULL,'3','2','delete','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(365,NULL,NULL,'4','2','delete','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(366,NULL,NULL,'5','2','delete','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(367,NULL,NULL,'6','2','delete','2022-11-24 13:04:11','2022-11-24 13:04:11'),
(368,'1667444041',NULL,NULL,'3','view','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(369,'1667444041',NULL,NULL,'3','create','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(370,'1667444041',NULL,NULL,'3','update','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(371,'1667444041',NULL,NULL,'3','delete','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(372,'1668509889',NULL,NULL,'3','view','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(373,'1668509889',NULL,NULL,'3','create','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(374,'1668509889',NULL,NULL,'3','update','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(375,'1668509889',NULL,NULL,'3','delete','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(376,'1668510437',NULL,NULL,'3','view','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(377,'1668510437',NULL,NULL,'3','create','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(378,'1668510437',NULL,NULL,'3','update','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(379,'1668510437',NULL,NULL,'3','delete','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(381,'1668510568',NULL,NULL,'3','create','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(382,'1668510568',NULL,NULL,'3','update','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(383,'1668510568',NULL,NULL,'3','delete','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(384,NULL,'9',NULL,'3','view','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(385,NULL,'9',NULL,'3','create','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(386,NULL,'9',NULL,'3','update','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(387,NULL,'9',NULL,'3','delete','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(392,NULL,'17',NULL,'3','view','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(393,NULL,'17',NULL,'3','create','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(394,NULL,'17',NULL,'3','update','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(395,NULL,'17',NULL,'3','delete','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(396,NULL,'10',NULL,'3','view','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(397,NULL,'10',NULL,'3','create','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(398,NULL,'10',NULL,'3','update','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(399,NULL,'10',NULL,'3','delete','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(404,NULL,'18',NULL,'3','view','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(405,NULL,'18',NULL,'3','create','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(406,NULL,'18',NULL,'3','update','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(407,NULL,'18',NULL,'3','delete','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(408,NULL,'19',NULL,'3','view','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(409,NULL,'19',NULL,'3','create','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(410,NULL,'19',NULL,'3','update','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(411,NULL,'19',NULL,'3','delete','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(412,NULL,'20',NULL,'3','view','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(413,NULL,'20',NULL,'3','create','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(414,NULL,'20',NULL,'3','update','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(415,NULL,'20',NULL,'3','delete','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(417,NULL,NULL,'2','3','view','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(418,NULL,NULL,'3','3','view','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(419,NULL,NULL,'4','3','view','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(420,NULL,NULL,'5','3','view','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(421,NULL,NULL,'6','3','view','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(422,NULL,NULL,'1','3','create','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(423,NULL,NULL,'2','3','create','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(424,NULL,NULL,'3','3','create','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(425,NULL,NULL,'4','3','create','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(426,NULL,NULL,'5','3','create','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(427,NULL,NULL,'6','3','create','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(428,NULL,NULL,'1','3','update','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(429,NULL,NULL,'2','3','update','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(430,NULL,NULL,'3','3','update','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(431,NULL,NULL,'4','3','update','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(432,NULL,NULL,'5','3','update','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(433,NULL,NULL,'6','3','update','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(434,NULL,NULL,'1','3','delete','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(435,NULL,NULL,'2','3','delete','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(436,NULL,NULL,'3','3','delete','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(437,NULL,NULL,'4','3','delete','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(438,NULL,NULL,'5','3','delete','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(439,NULL,NULL,'6','3','delete','2022-11-24 13:08:11','2022-11-24 13:08:11'),
(440,'1669390641',NULL,NULL,'1','view','2022-11-25 15:37:59','2022-11-25 15:37:59'),
(441,'1669390641',NULL,NULL,'1','create','2022-11-25 15:38:06','2022-11-25 15:38:06'),
(442,'1669390641',NULL,NULL,'1','update','2022-11-25 15:38:07','2022-11-25 15:38:07'),
(443,'1669390641',NULL,NULL,'1','delete','2022-11-25 15:38:08','2022-11-25 15:38:08'),
(444,'1669390641',NULL,NULL,'2','view','2022-11-25 15:38:23','2022-11-25 15:38:23'),
(445,'1669390641',NULL,NULL,'2','create','2022-11-25 15:38:31','2022-11-25 15:38:31'),
(446,'1669390641',NULL,NULL,'2','update','2022-11-25 15:38:31','2022-11-25 15:38:31'),
(447,'1669390641',NULL,NULL,'2','delete','2022-11-25 15:38:32','2022-11-25 15:38:32'),
(448,'1669390641',NULL,NULL,'3','view','2022-11-25 15:38:49','2022-11-25 15:38:49'),
(449,'1669390641',NULL,NULL,'3','create','2022-11-25 15:38:55','2022-11-25 15:38:55'),
(450,'1669390641',NULL,NULL,'3','update','2022-11-25 15:38:55','2022-11-25 15:38:55'),
(451,'1669390641',NULL,NULL,'3','delete','2022-11-25 15:38:57','2022-11-25 15:38:57'),
(452,NULL,'21',NULL,'1','view','2022-11-30 12:57:38','2022-11-30 12:57:38'),
(453,NULL,'22',NULL,'1','view','2022-11-30 12:57:39','2022-11-30 12:57:39'),
(454,NULL,'23',NULL,'1','view','2022-11-30 12:57:40','2022-11-30 12:57:40'),
(455,NULL,'21',NULL,'1','create','2022-11-30 12:57:53','2022-11-30 12:57:53'),
(456,NULL,'22',NULL,'1','create','2022-11-30 12:57:54','2022-11-30 12:57:54'),
(457,NULL,'23',NULL,'1','create','2022-11-30 12:57:55','2022-11-30 12:57:55'),
(458,NULL,'23',NULL,'1','update','2022-11-30 12:57:56','2022-11-30 12:57:56'),
(459,NULL,'22',NULL,'1','update','2022-11-30 12:57:56','2022-11-30 12:57:56'),
(460,NULL,'21',NULL,'1','update','2022-11-30 12:57:57','2022-11-30 12:57:57'),
(461,NULL,'21',NULL,'1','delete','2022-11-30 12:57:57','2022-11-30 12:57:57'),
(462,NULL,'22',NULL,'1','delete','2022-11-30 12:57:58','2022-11-30 12:57:58'),
(463,NULL,'23',NULL,'1','delete','2022-11-30 12:57:58','2022-11-30 12:57:58'),
(464,NULL,'21',NULL,'2','view','2022-11-30 12:58:28','2022-11-30 12:58:28'),
(465,NULL,'22',NULL,'2','view','2022-11-30 12:58:29','2022-11-30 12:58:29'),
(466,NULL,'23',NULL,'2','view','2022-11-30 12:58:31','2022-11-30 12:58:31'),
(467,NULL,'21',NULL,'2','create','2022-11-30 12:59:04','2022-11-30 12:59:04'),
(468,NULL,'21',NULL,'2','update','2022-11-30 12:59:05','2022-11-30 12:59:05'),
(469,NULL,'21',NULL,'2','delete','2022-11-30 12:59:06','2022-11-30 12:59:06'),
(470,NULL,'22',NULL,'2','delete','2022-11-30 12:59:07','2022-11-30 12:59:07'),
(471,NULL,'22',NULL,'2','update','2022-11-30 12:59:08','2022-11-30 12:59:08'),
(472,NULL,'22',NULL,'2','create','2022-11-30 12:59:09','2022-11-30 12:59:09'),
(473,NULL,'23',NULL,'2','create','2022-11-30 12:59:10','2022-11-30 12:59:10'),
(474,NULL,'23',NULL,'2','update','2022-11-30 12:59:11','2022-11-30 12:59:11'),
(475,NULL,'23',NULL,'2','delete','2022-11-30 12:59:12','2022-11-30 12:59:12'),
(476,NULL,'21',NULL,'3','view','2022-11-30 12:59:47','2022-11-30 12:59:47'),
(477,NULL,'22',NULL,'3','view','2022-11-30 12:59:48','2022-11-30 12:59:48'),
(478,NULL,'23',NULL,'3','view','2022-11-30 12:59:48','2022-11-30 12:59:48'),
(479,NULL,'21',NULL,'3','create','2022-11-30 13:00:24','2022-11-30 13:00:24'),
(480,NULL,'21',NULL,'3','update','2022-11-30 13:00:25','2022-11-30 13:00:25'),
(481,NULL,'21',NULL,'3','delete','2022-11-30 13:00:26','2022-11-30 13:00:26'),
(482,NULL,'22',NULL,'3','delete','2022-11-30 13:00:27','2022-11-30 13:00:27'),
(483,NULL,'22',NULL,'3','update','2022-11-30 13:00:28','2022-11-30 13:00:28'),
(484,NULL,'22',NULL,'3','create','2022-11-30 13:00:29','2022-11-30 13:00:29'),
(485,NULL,'23',NULL,'3','create','2022-11-30 13:00:30','2022-11-30 13:00:30'),
(486,NULL,'23',NULL,'3','update','2022-11-30 13:00:30','2022-11-30 13:00:30'),
(487,NULL,'23',NULL,'3','delete','2022-11-30 13:00:31','2022-11-30 13:00:31'),
(488,'1667444041',NULL,NULL,'4','view','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(489,'1667444041',NULL,NULL,'4','create','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(490,'1667444041',NULL,NULL,'4','update','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(491,'1667444041',NULL,NULL,'4','delete','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(493,'1668509889',NULL,NULL,'4','create','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(494,'1668509889',NULL,NULL,'4','update','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(495,'1668509889',NULL,NULL,'4','delete','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(497,'1669390641',NULL,NULL,'4','create','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(498,'1669390641',NULL,NULL,'4','update','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(499,'1669390641',NULL,NULL,'4','delete','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(501,'1668510437',NULL,NULL,'4','create','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(502,'1668510437',NULL,NULL,'4','update','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(503,'1668510437',NULL,NULL,'4','delete','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(504,'1668510568',NULL,NULL,'4','view','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(505,'1668510568',NULL,NULL,'4','create','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(506,'1668510568',NULL,NULL,'4','update','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(507,'1668510568',NULL,NULL,'4','delete','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(508,NULL,'9',NULL,'4','view','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(509,NULL,'9',NULL,'4','create','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(510,NULL,'9',NULL,'4','update','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(511,NULL,'9',NULL,'4','delete','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(512,NULL,'17',NULL,'4','view','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(513,NULL,'17',NULL,'4','create','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(514,NULL,'17',NULL,'4','update','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(515,NULL,'17',NULL,'4','delete','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(516,NULL,'21',NULL,'4','view','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(517,NULL,'21',NULL,'4','create','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(518,NULL,'21',NULL,'4','update','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(519,NULL,'21',NULL,'4','delete','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(520,NULL,'10',NULL,'4','view','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(521,NULL,'10',NULL,'4','create','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(522,NULL,'10',NULL,'4','update','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(523,NULL,'10',NULL,'4','delete','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(524,NULL,'18',NULL,'4','view','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(525,NULL,'18',NULL,'4','create','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(526,NULL,'18',NULL,'4','update','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(527,NULL,'18',NULL,'4','delete','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(528,NULL,'22',NULL,'4','view','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(529,NULL,'22',NULL,'4','create','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(530,NULL,'22',NULL,'4','update','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(531,NULL,'22',NULL,'4','delete','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(532,NULL,'19',NULL,'4','view','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(533,NULL,'19',NULL,'4','create','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(534,NULL,'19',NULL,'4','update','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(535,NULL,'19',NULL,'4','delete','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(536,NULL,'23',NULL,'4','view','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(537,NULL,'23',NULL,'4','create','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(538,NULL,'23',NULL,'4','update','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(539,NULL,'23',NULL,'4','delete','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(540,NULL,'20',NULL,'4','view','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(541,NULL,'20',NULL,'4','create','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(542,NULL,'20',NULL,'4','update','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(543,NULL,'20',NULL,'4','delete','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(545,NULL,NULL,'2','4','view','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(546,NULL,NULL,'3','4','view','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(547,NULL,NULL,'4','4','view','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(548,NULL,NULL,'5','4','view','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(549,NULL,NULL,'6','4','view','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(550,NULL,NULL,'1','4','create','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(551,NULL,NULL,'2','4','create','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(552,NULL,NULL,'3','4','create','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(553,NULL,NULL,'4','4','create','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(554,NULL,NULL,'5','4','create','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(555,NULL,NULL,'6','4','create','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(556,NULL,NULL,'1','4','update','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(557,NULL,NULL,'2','4','update','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(558,NULL,NULL,'3','4','update','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(559,NULL,NULL,'4','4','update','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(560,NULL,NULL,'5','4','update','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(561,NULL,NULL,'6','4','update','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(562,NULL,NULL,'1','4','delete','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(563,NULL,NULL,'2','4','delete','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(564,NULL,NULL,'3','4','delete','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(565,NULL,NULL,'4','4','delete','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(566,NULL,NULL,'5','4','delete','2022-12-06 09:34:31','2022-12-06 09:34:31'),
(567,NULL,NULL,'6','4','delete','2022-12-06 09:34:31','2022-12-06 09:34:31');

/*Table structure for table `tbl_appreance` */

DROP TABLE IF EXISTS `tbl_appreance`;

CREATE TABLE `tbl_appreance` (
  `appreance_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) NOT NULL,
  `appreance_layout` varchar(255) DEFAULT NULL,
  `appreance_theme` varchar(255) DEFAULT NULL,
  `appreance_menu` varchar(255) DEFAULT NULL,
  `appreance_header` varchar(255) DEFAULT NULL,
  `appreance_sidestyle` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`appreance_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tbl_appreance` */

insert  into `tbl_appreance`(`appreance_id`,`user_id`,`appreance_layout`,`appreance_theme`,`appreance_menu`,`appreance_header`,`appreance_sidestyle`,`created_at`,`updated_at`) values 
(2,'1','sidebar-mini','light-mode','light-menu','header-light','default-menu','2022-11-22 09:45:47','2022-11-24 13:00:20');

/*Table structure for table `tbl_barang` */

DROP TABLE IF EXISTS `tbl_barang`;

CREATE TABLE `tbl_barang` (
  `barang_id` int(255) NOT NULL AUTO_INCREMENT,
  `jenisbarang_id` varchar(255) DEFAULT NULL,
  `satuan_id` varchar(255) DEFAULT NULL,
  `merk_id` varchar(255) DEFAULT NULL,
  `barang_kode` varchar(255) NOT NULL,
  `barang_nama` varchar(255) NOT NULL,
  `barang_slug` varchar(255) DEFAULT NULL,
  `barang_harga` varchar(255) NOT NULL,
  `barang_stok` varchar(255) NOT NULL,
  `barang_gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`barang_id`,`barang_kode`,`barang_nama`,`barang_harga`,`barang_stok`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tbl_barang` */

insert  into `tbl_barang`(`barang_id`,`jenisbarang_id`,`satuan_id`,`merk_id`,`barang_kode`,`barang_nama`,`barang_slug`,`barang_harga`,`barang_stok`,`barang_gambar`,`created_at`,`updated_at`) values 
(5,'12','7','2','BRG-1669390175622','Motherboard','motherboard','4000000','0','image.png','2022-11-25 15:30:12','2022-11-25 15:30:12'),
(6,'13','1','7','BRG-1669390220236','Baut 24mm','baut-24mm','1000000','0','image.png','2022-11-25 15:30:50','2022-11-29 14:30:37');

/*Table structure for table `tbl_barangkeluar` */

DROP TABLE IF EXISTS `tbl_barangkeluar`;

CREATE TABLE `tbl_barangkeluar` (
  `bk_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bk_kode` varchar(255) NOT NULL,
  `barang_kode` varchar(255) NOT NULL,
  `bk_tanggal` varchar(255) NOT NULL,
  `bk_tujuan` varchar(255) DEFAULT NULL,
  `bk_jumlah` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`bk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tbl_barangkeluar` */

insert  into `tbl_barangkeluar`(`bk_id`,`bk_kode`,`barang_kode`,`bk_tanggal`,`bk_tujuan`,`bk_jumlah`,`created_at`,`updated_at`) values 
(2,'BK-1669811950758','BRG-1669390220236','2022-11-01','Gudang Tasikmalaya','20','2022-11-30 12:39:22','2022-11-30 12:47:14'),
(3,'BK-1669812439198','BRG-1669390175622','2022-11-02','Gudang Prindapan','5','2022-11-30 12:47:39','2023-07-26 04:18:25');

/*Table structure for table `tbl_barangmasuk` */

DROP TABLE IF EXISTS `tbl_barangmasuk`;

CREATE TABLE `tbl_barangmasuk` (
  `bm_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bm_kode` varchar(255) NOT NULL,
  `barang_kode` varchar(255) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `bm_tanggal` varchar(255) NOT NULL,
  `bm_jumlah` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`bm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tbl_barangmasuk` */

insert  into `tbl_barangmasuk`(`bm_id`,`bm_kode`,`barang_kode`,`customer_id`,`bm_tanggal`,`bm_jumlah`,`created_at`,`updated_at`) values 
(1,'BM-1669730554623','BRG-1669390220236','2','2022-11-01','50','2022-11-29 14:02:43','2022-11-29 14:20:13'),
(2,'BM-1669731639801','BRG-1669390175622','2','2022-11-30','10','2022-11-29 14:20:55','2022-11-29 14:20:55');

/*Table structure for table `tbl_customer` */

DROP TABLE IF EXISTS `tbl_customer`;

CREATE TABLE `tbl_customer` (
  `customer_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_nama` varchar(255) NOT NULL,
  `customer_slug` varchar(255) NOT NULL,
  `customer_alamat` text DEFAULT NULL,
  `customer_notelp` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tbl_customer` */

insert  into `tbl_customer`(`customer_id`,`customer_nama`,`customer_slug`,`customer_alamat`,`customer_notelp`,`created_at`,`updated_at`) values 
(2,'Radhian Sobarna','radhian-sobarna','Sumedang','087817379229','2022-11-26 01:36:34','2022-11-26 01:43:58');

/*Table structure for table `tbl_jenisbarang` */

DROP TABLE IF EXISTS `tbl_jenisbarang`;

CREATE TABLE `tbl_jenisbarang` (
  `jenisbarang_id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `jenisbarang_nama` varchar(255) NOT NULL,
  `jenisbarang_slug` varchar(255) NOT NULL,
  `jenisbarang_ket` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`jenisbarang_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tbl_jenisbarang` */

insert  into `tbl_jenisbarang`(`jenisbarang_id`,`jenisbarang_nama`,`jenisbarang_slug`,`jenisbarang_ket`,`created_at`,`updated_at`) values 
(11,'Elektronik','elektronik',NULL,'2022-11-25 15:24:18','2022-11-25 15:25:39'),
(12,'Perangkat Komputer','perangkat-komputer',NULL,'2022-11-25 15:26:15','2022-11-25 15:27:16'),
(13,'Besi','besi',NULL,'2022-11-25 15:27:33','2022-11-25 15:27:33');

/*Table structure for table `tbl_menu` */

DROP TABLE IF EXISTS `tbl_menu`;

CREATE TABLE `tbl_menu` (
  `menu_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_judul` varchar(255) NOT NULL,
  `menu_slug` varchar(255) NOT NULL,
  `menu_icon` varchar(255) NOT NULL,
  `menu_redirect` varchar(255) NOT NULL,
  `menu_sort` varchar(255) NOT NULL,
  `menu_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1669390642 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tbl_menu` */

insert  into `tbl_menu`(`menu_id`,`menu_judul`,`menu_slug`,`menu_icon`,`menu_redirect`,`menu_sort`,`menu_type`,`created_at`,`updated_at`) values 
(1667444041,'Dashboard','dashboard','home','/dashboard','1','1','2022-11-15 10:51:04','2022-11-15 10:51:04'),
(1668509889,'Master Barang','master-barang','package','-','2','2','2022-11-15 10:58:09','2022-11-15 11:03:15'),
(1668510437,'Transaksi','transaksi','repeat','-','4','2','2022-11-15 11:07:17','2022-11-25 15:37:36'),
(1668510568,'Laporan','laporan','printer','-','5','2','2022-11-15 11:09:28','2022-11-25 15:37:28'),
(1669390641,'Customer','customer','user','/customer','3','1','2022-11-25 15:37:21','2022-11-25 15:37:36');

/*Table structure for table `tbl_merk` */

DROP TABLE IF EXISTS `tbl_merk`;

CREATE TABLE `tbl_merk` (
  `merk_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `merk_nama` varchar(255) NOT NULL,
  `merk_slug` varchar(255) NOT NULL,
  `merk_keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`merk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tbl_merk` */

insert  into `tbl_merk`(`merk_id`,`merk_nama`,`merk_slug`,`merk_keterangan`,`created_at`,`updated_at`) values 
(1,'Huawei','huawei',NULL,'2022-11-15 18:14:09','2022-11-15 18:14:09'),
(2,'Lenovo','lenovo',NULL,'2022-11-15 18:14:33','2022-11-15 18:14:45'),
(7,'Steel','steel',NULL,'2022-11-25 15:29:27','2022-11-25 15:29:27');

/*Table structure for table `tbl_role` */

DROP TABLE IF EXISTS `tbl_role`;

CREATE TABLE `tbl_role` (
  `role_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_title` varchar(255) NOT NULL,
  `role_slug` varchar(255) NOT NULL,
  `role_desc` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tbl_role` */

insert  into `tbl_role`(`role_id`,`role_title`,`role_slug`,`role_desc`,`created_at`,`updated_at`) values 
(1,'Super Admin','super-admin','-','2022-11-15 10:51:04','2022-11-15 10:51:04'),
(2,'Admin','admin','-','2022-11-15 10:51:04','2022-11-15 10:51:04'),
(3,'Operator','operator','-','2022-11-15 10:51:04','2022-11-15 10:51:04'),
(4,'Manajer','manajer',NULL,'2022-12-06 09:33:27','2022-12-06 09:33:27');

/*Table structure for table `tbl_satuan` */

DROP TABLE IF EXISTS `tbl_satuan`;

CREATE TABLE `tbl_satuan` (
  `satuan_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `satuan_nama` varchar(255) NOT NULL,
  `satuan_slug` varchar(255) NOT NULL,
  `satuan_keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`satuan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tbl_satuan` */

insert  into `tbl_satuan`(`satuan_id`,`satuan_nama`,`satuan_slug`,`satuan_keterangan`,`created_at`,`updated_at`) values 
(1,'Kg','kg',NULL,'2022-11-15 17:50:38','2022-11-24 12:39:04'),
(5,'Pcs','pcs',NULL,'2022-11-24 12:39:15','2022-11-24 12:39:21'),
(7,'Qty','qty',NULL,'2022-11-24 12:39:59','2022-11-24 12:39:59');

/*Table structure for table `tbl_submenu` */

DROP TABLE IF EXISTS `tbl_submenu`;

CREATE TABLE `tbl_submenu` (
  `submenu_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` varchar(255) NOT NULL,
  `submenu_judul` varchar(255) NOT NULL,
  `submenu_slug` varchar(255) NOT NULL,
  `submenu_redirect` varchar(255) NOT NULL,
  `submenu_sort` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`submenu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tbl_submenu` */

insert  into `tbl_submenu`(`submenu_id`,`menu_id`,`submenu_judul`,`submenu_slug`,`submenu_redirect`,`submenu_sort`,`created_at`,`updated_at`) values 
(9,'1668510437','Barang Masuk','barang-masuk','/barang-masuk','1','2022-11-15 11:08:19','2022-11-15 11:08:19'),
(10,'1668510437','Barang Keluar','barang-keluar','/barang-keluar','2','2022-11-15 11:08:19','2022-11-15 11:08:19'),
(17,'1668509889','Jenis','jenis','/jenisbarang','1','2022-11-24 12:06:48','2022-11-24 12:06:48'),
(18,'1668509889','Satuan','satuan','/satuan','2','2022-11-24 12:06:48','2022-11-24 12:06:48'),
(19,'1668509889','Merk','merk','/merk','3','2022-11-24 12:06:48','2022-11-24 12:06:48'),
(20,'1668509889','Barang','barang','/barang','4','2022-11-24 12:06:48','2022-11-24 12:06:48'),
(21,'1668510568','Lap Barang Masuk','lap-barang-masuk','/lap-barang-masuk','1','2022-11-30 12:56:24','2022-11-30 12:56:24'),
(22,'1668510568','Lap Barang Keluar','lap-barang-keluar','/lap-barang-keluar','2','2022-11-30 12:56:24','2022-11-30 12:56:24'),
(23,'1668510568','Lap Stok Barang','lap-stok-barang','/lap-stok-barang','3','2022-11-30 12:56:24','2022-11-30 12:56:24');

/*Table structure for table `tbl_user` */

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` varchar(255) NOT NULL,
  `user_nmlengkap` varchar(255) NOT NULL,
  `user_nama` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_foto` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tbl_user` */

insert  into `tbl_user`(`user_id`,`role_id`,`user_nmlengkap`,`user_nama`,`user_email`,`user_foto`,`user_password`,`created_at`,`updated_at`) values 
(1,'1','Super Administrator','superadmin','superadmin@gmail.com','undraw_profile.svg','25d55ad283aa400af464c76d713c07ad','2022-11-15 10:51:04','2022-11-15 10:51:04'),
(2,'2','Administrator','admin','admin@gmail.com','undraw_profile.svg','25d55ad283aa400af464c76d713c07ad','2022-11-15 10:51:04','2022-11-15 10:51:04'),
(3,'3','Operator','operator','operator@gmail.com','undraw_profile.svg','25d55ad283aa400af464c76d713c07ad','2022-11-15 10:51:04','2022-11-15 10:51:04'),
(4,'4','Manajer','manajer','manajer@gmail.com','undraw_profile.svg','25d55ad283aa400af464c76d713c07ad','2022-12-06 09:33:54','2022-12-06 09:33:54');

/*Table structure for table `tbl_web` */

DROP TABLE IF EXISTS `tbl_web`;

CREATE TABLE `tbl_web` (
  `web_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `web_nama` varchar(255) NOT NULL,
  `web_logo` varchar(255) NOT NULL,
  `web_deskripsi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`web_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tbl_web` */

insert  into `tbl_web`(`web_id`,`web_nama`,`web_logo`,`web_deskripsi`,`created_at`,`updated_at`) values 
(1,'Inventoryweb','default.png','Mengelola Data Barang Masuk & Barang Keluar','2022-11-15 10:51:04','2022-11-22 09:41:39');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
