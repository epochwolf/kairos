# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.6.24)
# Database: kairos
# Generation Time: 2015-09-07 20:29:42 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table attendee_logs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `attendee_logs`;

CREATE TABLE `attendee_logs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `attendee_id` int(10) unsigned NOT NULL,
  `operation` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'create',
  `attributes` blob NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table attendees
# ------------------------------------------------------------

DROP TABLE IF EXISTS `attendees`;

CREATE TABLE `attendees` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `badge_number` int(11) DEFAULT NULL,
  `badge_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `legal_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthdate` date NOT NULL,
  `address1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state_prov` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `newsletter` tinyint(1) NOT NULL DEFAULT '0',
  `badge_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'attendee',
  `badge_reprints` int(10) unsigned NOT NULL DEFAULT '0',
  `original_admission_level` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'standard',
  `admission_level` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'standard',
  `tshirt_size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'cash',
  `override_price` int(11) DEFAULT NULL,
  `adult_badge_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adult_legal_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `at_door` tinyint(1) NOT NULL DEFAULT '1',
  `paid` tinyint(1) NOT NULL DEFAULT '0',
  `checked_in` tinyint(1) NOT NULL DEFAULT '0',
  `blacklisted` tinyint(1) NOT NULL DEFAULT '0',
  `blacklist_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blacklist_message` text COLLATE utf8_unicode_ci,
  `blacklist_id` int(11) unsigned DEFAULT NULL,
  `blacklist_trigger` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `notes` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_badge_name` (`badge_name`),
  KEY `badge_number` (`badge_number`) USING BTREE,
  KEY `blacklist_id` (`blacklist_id`),
  CONSTRAINT `attendees_ibfk_1` FOREIGN KEY (`blacklist_id`) REFERENCES `blacklist` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table badge_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `badge_types`;

CREATE TABLE `badge_types` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `db_name` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `label_color` varchar(255) DEFAULT '',
  `minor` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `sort_order` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table blacklist
# ------------------------------------------------------------

DROP TABLE IF EXISTS `blacklist`;

CREATE TABLE `blacklist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `badge_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `legal_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trigger_badge_names` text COLLATE utf8_unicode_ci,
  `trigger_legal_names` text COLLATE utf8_unicode_ci,
  `reason` text COLLATE utf8_unicode_ci,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'watch',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table payment_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `payment_types`;

CREATE TABLE `payment_types` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `db_name` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `at_door` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table registration_levels
# ------------------------------------------------------------

DROP TABLE IF EXISTS `registration_levels`;

CREATE TABLE `registration_levels` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `db_name` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `price` int(10) unsigned NOT NULL DEFAULT '0',
  `includes_tshirt` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `available_at_door` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `available_pre_reg` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `sort_order` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table registration_upgrades
# ------------------------------------------------------------

DROP TABLE IF EXISTS `registration_upgrades`;

CREATE TABLE `registration_upgrades` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `from` varchar(255) NOT NULL DEFAULT '',
  `to` varchar(255) NOT NULL DEFAULT '',
  `override_price` int(10) unsigned DEFAULT NULL,
  `sort_order` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table tshirt_sizes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tshirt_sizes`;

CREATE TABLE `tshirt_sizes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `db_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `sort_order` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `encrypted_password` varchar(255) NOT NULL DEFAULT '',
  `admin` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
