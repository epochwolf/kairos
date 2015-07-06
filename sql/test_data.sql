# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.6.24)
# Database: kairos
# Generation Time: 2015-07-06 17:39:58 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table attendees
# ------------------------------------------------------------

DROP TABLE IF EXISTS `attendees`;

CREATE TABLE `attendees` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `badge_number` int(11) DEFAULT NULL,
  `badge_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `legal_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
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
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `blacklist_id` int(11) unsigned DEFAULT NULL,
  `blacklist_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blacklist_trigger` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `notes` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_badge_name` (`badge_name`),
  KEY `badge_number` (`badge_number`) USING BTREE,
  KEY `blacklist_id` (`blacklist_id`),
  CONSTRAINT `attendees_ibfk_1` FOREIGN KEY (`blacklist_id`) REFERENCES `blacklist` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `attendees` WRITE;
/*!40000 ALTER TABLE `attendees` DISABLE KEYS */;

INSERT INTO `attendees` (`id`, `badge_number`, `badge_name`, `legal_name`, `birthdate`, `address1`, `address2`, `city`, `state_prov`, `postal_code`, `phone_number`, `email`, `newsletter`, `badge_type`, `original_admission_level`, `admission_level`, `tshirt_size`, `payment_method`, `override_price`, `adult_badge_name`, `adult_legal_name`, `at_door`, `paid`, `checked_in`, `blacklisted`, `banned`, `blacklist_id`, `blacklist_name`, `blacklist_trigger`, `created_at`, `notes`)
VALUES
	(111,12,'Joelle','Karyn Stanton','1984-06-28','P.O. Box 333, 6379 Non, Av.','','Hattiesburg','MS','72276','9945779069','elementum@congueInscelerisque.co.uk',1,'staff','standard','sponsor','XL','credit',40,NULL,NULL,0,1,1,0,0,NULL,NULL,NULL,'2015-07-06 10:28:17',NULL),
	(112,NULL,'Eaton','Amena Hyde','1991-08-23','9331 Leo. Street','','Atlanta','GA','97841','8382616548','sed.consequat.auctor@lectus.ca',1,'attendee','standard','standard',NULL,'credit',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:17',NULL),
	(113,NULL,'Melodie','Scott Hendricks','2006-02-25','166-5203 Scelerisque Avenue','','Missoula','MT','77126','5798865363','nibh.Quisque.nonummy@erosNam.net',0,'minor','standard','standard',NULL,'cash',NULL,'Whoopi','William Hendricks',1,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:17',NULL),
	(114,NULL,'Whoopi','William Hendricks','1993-07-08','6587 Curae; Avenue','','Kansas City','Kansas','95961','4518264126','dolor.sit.amet@nascetur.org',0,'attendee','standard','sponsor',NULL,'cash',NULL,NULL,NULL,1,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:17',NULL),
	(115,NULL,'Georgia','Ray Conrad','1992-01-25','296-3526 Ac Street','','Montgomery','AL','36659','5514991017','tempus.risus.Donec@feugiatplaceratvelit.edu',1,'attendee','standard','standard',NULL,'credit',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:17',NULL),
	(116,NULL,'Macy','April Hendricks','2002-05-28','1347 Ante St.','','Shreveport','LA','41885','5474707840','magnis@elitfermentumrisus.org',1,'minor','standard','standard',NULL,'credit',NULL,'Whoopi','William Hendricks',1,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:17',NULL),
	(117,NULL,'Ashton','Cole Flowers','1989-11-06','313-8169 Fermentum St.','','Kearney','NE','36445','(324) 774-3886','nonummy.ac.feugiat@fames.com',0,'attendee','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:17',NULL),
	(118,NULL,'Tamekah','Zachary Salas','1978-02-23','Ap #574-800 Justo Rd.','','Indianapolis','IN','84447','8061383541','vitae.mauris@nisiaodio.edu',0,'guest','standard','standard',NULL,'cash',0,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:17',NULL),
	(119,NULL,'Mollie','Neve Jacobson','1993-08-11','951-2881 Sed, Avenue','','Lakewood','CO','99070','2705997901','eu.sem.Pellentesque@tortordictum.com',1,'dealer','standard','dealer-table',NULL,'credit',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:17',NULL),
	(120,NULL,'Hyatt','Dahlia Faulkner','1971-05-26','Ap #112-9368 Vivamus Rd.','','Gary','IN','77313','7935841105','turpis.Aliquam@Vivamusnibhdolor.co.uk',1,'attendee','standard','super-sponsor',NULL,'credit',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:17',NULL),
	(121,NULL,'Cyrus','Dorian Holden','2006-05-12','P.O. Box 549, 7918 Convallis Avenue','','Jonesboro','Arkansas','71174','(250) 144-1845','ut@Mauris.co.uk',0,'minor','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(122,NULL,'Joseph','Lars Stokes','1978-08-29','Ap #419-2956 Egestas Av.','','Indianapolis','Indiana','48529','(547) 801-6470','arcu.Morbi.sit@miDuisrisus.org',0,'attendee','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(123,NULL,'Vladimir','Dara Gross','1981-03-08','6321 Mauris Street','','Worcester','MA','77394','2523196083','elit@dictumProin.org',1,'attendee','standard','sponsor',NULL,'credit',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(124,NULL,'Sigourney','Wynter Ayala','1968-02-16','Ap #961-5537 Vel, Street','','Fairbanks','Alaska','99527','3283756020','et.ultrices.posuere@purus.edu',1,'attendee','standard','standard',NULL,'credit',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(125,NULL,'Kylynn','Dolan Palmer','1952-04-08','638-1517 Nullam Rd.','','Annapolis','Maryland','30446','(243) 991-9775','felis@lobortisultricesVivamus.co.uk',0,'attendee','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(126,NULL,'Deborah','Abbot Atkins','1994-11-05','191-5479 Odio. Rd.','','Naperville','Illinois','54933','8893457849','purus.Duis.elementum@pharetrasedhendrerit.net',0,'attendee','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(127,NULL,'Sandra','Sean Goodman','1985-08-10','Ap #106-3958 Nisl. Rd.','','Tuscaloosa','AL','36772','5551099770','Proin.non.massa@porttitorscelerisqueneque.edu',1,'attendee','standard','god-level',NULL,'credit',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(128,NULL,'Odysseus','Hedy Moody','1961-10-12','510-387 Justo Street','','Fort Smith','AR','71250','6817236140','adipiscing.elit@massarutrummagna.com',1,'attendee','standard','standard',NULL,'credit',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(129,NULL,'Martha','Odette Wiley','2001-02-11','309-9442 Ante St.','','Fayetteville','Arkansas','72608','(206) 994-5022','ligula.Donec.luctus@posuereenim.com',0,'minor','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(130,NULL,'Jamalia','Denise Richmond','1973-01-24','Ap #101-5328 Auctor Rd.','','Saint Louis','MO','70123','(241) 556-3866','Ut.tincidunt.vehicula@arcu.org',0,'attendee','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(131,NULL,'Damian','Garrett Villarreal','1996-07-02','841-2975 Et, Rd.','','Fort Wayne','IN','66295','1761842085','Sed.nunc@Crasdolordolor.ca',1,'attendee','standard','standard',NULL,'credit',NULL,NULL,NULL,0,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(132,NULL,'Maile','Avye Sellers','1995-09-19','709-4007 Arcu. Ave','','Davenport','IA','89407','2991822338','sed.orci@Namligula.ca',1,'minor','standard','standard',NULL,'credit',NULL,NULL,NULL,0,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(133,NULL,'Riley','Keely Trevino','2007-06-01','Ap #945-5307 Cras Avenue','','South Burlington','Vermont','33149','(253) 411-5845','erat.eget@sagittis.co.uk',0,'minor','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(134,NULL,'Rhiannon','Hollee Albert','1975-01-01','P.O. Box 989, 8459 Fermentum Street','','Norfolk','Virginia','19152','(400) 519-3284','arcu.et.pede@Donec.net',0,'attendee','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(135,NULL,'Cadman','Mira Shaw','1983-10-27','Ap #110-6423 Euismod Avenue','','Georgia','GA','45825','(737) 975-3068','mi@metus.edu',1,'attendee','standard','standard',NULL,'credit',NULL,NULL,NULL,0,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(136,NULL,'Shaeleigh','Valentine Mcdowell','1963-07-06','P.O. Box 815, 9603 Vehicula Street','','Tucson','Arizona','86484','(517) 230-7174','velit.in.aliquet@adipiscinglobortis.com',1,'attendee','standard','standard',NULL,'credit',NULL,NULL,NULL,0,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(137,NULL,'Xander','Zeph Church','1994-03-22','744-9486 Nonummy Av.','','Kenosha','Wisconsin','22278','(398) 372-0279','Etiam.vestibulum.massa@lacusUtnec.ca',0,'attendee','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(138,NULL,'Barclay','Alfonso Barton','1998-03-21','Ap #934-1621 Amet, Rd.','','Warren','Michigan','82503','(598) 384-9017','erat@Nunc.co.uk',0,'minor','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(139,NULL,'Cally','Melodie Schmidt','2001-02-19','7327 Magna Street','','Vancouver','Washington','60018','(114) 436-7559','fermentum.vel.mauris@semsempererat.org',1,'minor','standard','standard',NULL,'credit',NULL,NULL,NULL,0,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(140,NULL,'Julie','Danielle Tanner','1978-06-15','Ap #946-4253 Et, Rd.','','San Diego','California','90987','(665) 269-5373','a.ultricies@turpisvitaepurus.co.uk',1,'attendee','standard','standard',NULL,'credit',NULL,NULL,NULL,0,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(141,NULL,'Wynter','Whilemina Porter','2000-02-17','Ap #652-7569 Augue. Rd.','','Newark','Delaware','94940','(322) 374-7405','quis.massa.Mauris@eratsemperrutrum.ca',0,'minor','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(142,NULL,'Cruz','Emmanuel Delaney','1993-07-12','105 Convallis Ave','','New Orleans','LA','40287','(726) 258-8869','Sed.eu.eros@etmalesuada.co.uk',0,'attendee','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(143,NULL,'Ignatius','Ian Graham','2000-04-20','357-9361 Pharetra St.','','Kapolei','Hawaii','73156','(240) 112-1356','Mauris@lectussit.co.uk',1,'minor','standard','standard',NULL,'credit',NULL,NULL,NULL,0,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(144,NULL,'Adrienne','Christen Barnett','1986-08-28','P.O. Box 100, 454 Ut Street','','Houston','Texas','88962','(205) 571-1244','at.sem.molestie@turpisnonenim.net',1,'attendee','standard','standard',NULL,'credit',NULL,NULL,NULL,0,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(145,NULL,'Grant','Iliana Donaldson','1964-06-18','Ap #295-1582 Tincidunt Road','','Grand Rapids','MI','18485','(510) 877-6029','enim.gravida.sit@NullafacilisiSed.edu',0,'attendee','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(146,NULL,'Sydney','Tana Dejesus','1966-09-28','P.O. Box 385, 7269 Ac St.','','Columbus','OH','63682','(470) 746-6767','sapien@sitametultricies.ca',0,'attendee','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(147,NULL,'Kevyn','Fredericka Robles','1992-08-19','P.O. Box 755, 8015 Elit Rd.','','Bridgeport','Connecticut','88408','9421857403','fames.ac@vitaesodales.edu',1,'attendee','standard','sponsor',NULL,'credit',NULL,NULL,NULL,0,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(148,NULL,'Kaseem','Wynter Conner','1983-07-20','8578 Dui, St.','','Gresham','OR','16237','(445) 113-9947','egestas@intempuseu.com',1,'attendee','standard','standard',NULL,'credit',NULL,NULL,NULL,0,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(149,NULL,'Ryan','Walter York','2004-12-26','Ap #253-6641 Ante, St.','','Eugene','Oregon','98380','(460) 165-1642','consequat.purus.Maecenas@conubianostraper.org',0,'minor','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(150,NULL,'Zephania','April Williams','1985-08-22','P.O. Box 388, 4641 Ante Road','','Vancouver','Washington','96613','(983) 203-7019','aliquet@morbitristiquesenectus.ca',0,'attendee','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(151,NULL,'Nehru','Alana Marquez','1975-02-08','P.O. Box 809, 2453 Auctor. Road','','West Valley City','UT','82902','(426) 189-6257','Aliquam@Pellentesqueut.com',1,'attendee','standard','standard',NULL,'credit',NULL,NULL,NULL,0,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(152,NULL,'Raphael','Kasper Brewer','1952-05-01','330-4354 Nulla Rd.','','Jonesboro','AR','71366','(623) 893-1542','magna.Lorem@consequatlectussit.net',1,'attendee','standard','standard',NULL,'credit',NULL,NULL,NULL,0,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(153,NULL,'Baker','Joel Buck','1981-01-04','778-6808 Lacus. Street','','Norman','Oklahoma','65355','(138) 147-6217','lectus.Cum.sociis@aultriciesadipiscing.ca',0,'attendee','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(154,NULL,'Carlos','Isabella Rosario','1961-03-11','2739 Aenean Street','','Allentown','PA','51476','(876) 564-2072','fringilla.Donec.feugiat@molestiepharetranibh.org',0,'attendee','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(155,NULL,'Candace','Abigail Carrillo','1950-08-02','275-7029 Amet, St.','','Knoxville','Tennessee','32272','(525) 717-2081','Curabitur.vel.lectus@pedeSuspendissedui.ca',1,'attendee','standard','standard',NULL,'credit',NULL,NULL,NULL,0,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(156,NULL,'Regina','Lana Tyson','1996-06-08','8427 Et Rd.','','Chattanooga','Tennessee','55531','(224) 279-7303','erat@semut.org',1,'attendee','standard','standard',NULL,'credit',NULL,NULL,NULL,0,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(157,NULL,'Hector','Amethyst Santos','1963-04-19','619-6284 Eleifend. St.','','Fayetteville','AR','72799','(396) 669-1450','dictum@magnaUttincidunt.net',0,'attendee','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(158,NULL,'Azalia','Emerald Rodriguez','1979-01-14','Ap #127-7169 Cursus Rd.','','Columbia','MD','28610','(771) 125-4001','vitae.posuere@enimMauris.org',0,'attendee','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(159,NULL,'Cade','Mallory Duran','1973-01-28','P.O. Box 288, 4449 Amet Avenue','','Ketchikan','Alaska','99620','(860) 430-5928','mauris.aliquam@Phaselluselitpede.co.uk',1,'attendee','standard','standard',NULL,'credit',NULL,NULL,NULL,0,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(160,NULL,'Quinn','Nathan Cash','1952-12-13','8922 Ad Ave','','Bloomington','Minnesota','64412','(748) 593-6626','mauris.blandit@CuraePhasellus.edu',1,'attendee','standard','standard',NULL,'credit',NULL,NULL,NULL,0,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(161,NULL,'Vera','Galena Burt','1974-09-30','Ap #518-9008 In Rd.','','Covington','KY','47900','(888) 732-6450','lectus.justo.eu@quamdignissim.com',0,'attendee','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(162,NULL,'Samuel','Olivia Mayo','1966-10-28','7674 At, St.','','Jefferson City','MO','27416','(359) 253-6556','eget@tortornibh.ca',0,'attendee','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(163,NULL,'Xanthus','Hope Gross','1966-06-19','Ap #730-7037 Proin Av.','','Idaho Falls','Idaho','59405','(826) 506-0097','Nullam.nisl@laoreet.co.uk',1,'attendee','standard','standard',NULL,'credit',NULL,NULL,NULL,0,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(164,NULL,'Emma','Julie Glass','1952-09-26','5135 Eleifend Avenue','','West Valley City','UT','33080','(350) 628-8101','sit.amet@Pellentesqueutipsum.org',1,'attendee','standard','standard',NULL,'credit',NULL,NULL,NULL,0,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(165,NULL,'Scarlet','Mariam Forbes','1958-10-11','645-1235 Mauris Avenue','','Ketchikan','AK','99982','(212) 240-3340','ipsum.dolor@Cumsociisnatoque.com',0,'attendee','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(166,NULL,'Tanek','Dana Williamson','1995-04-28','539-1201 Eleifend Av.','','Mesa','AZ','85949','(976) 973-4437','augue.id.ante@eleifend.com',0,'attendee','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(167,NULL,'Haley','James Mann','1983-04-16','P.O. Box 192, 2604 Enim Rd.','','Cambridge','Massachusetts','72373','(946) 214-3312','condimentum@nasceturridiculus.org',1,'attendee','standard','standard',NULL,'credit',NULL,NULL,NULL,0,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(168,NULL,'Keely','Amal Hodges','1962-07-11','534-2507 Eleifend Street','','Lakewood','Colorado','17146','(607) 262-7871','dictum.cursus.Nunc@mattis.edu',1,'attendee','standard','standard',NULL,'credit',NULL,NULL,NULL,0,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(169,NULL,'Jena','Maya Cooke','1991-09-28','890-3992 Eget St.','','Lincoln','NE','87209','(852) 122-5455','montes@Vestibulumanteipsum.edu',0,'attendee','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(171,NULL,'Quon','Neville Conrad','1989-05-16','P.O. Box 527, 6874 Purus, St.','','Lewiston','Maine','43513','(978) 250-0218','risus.odio@liberoProin.org',1,'attendee','standard','standard',NULL,'credit',NULL,NULL,NULL,0,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(172,NULL,'Flavia','Porter Wood','1957-02-18','383-8566 Nam Street','','Joliet','IL','98687','(834) 544-3066','tellus.sem@vitae.com',1,'attendee','standard','standard',NULL,'credit',NULL,NULL,NULL,0,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(173,NULL,'Jaquelyn','Haviva Stafford','1964-10-17','825-9803 Sodales. Av.','','Huntsville','Alabama','35605','(432) 663-9064','adipiscing.elit.Aliquam@In.co.uk',0,'attendee','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(174,NULL,'Victor','Mufutau Case','2007-06-03','159-6930 Aenean Rd.','','Detroit','Michigan','43593','(939) 475-4031','nunc@senectus.net',0,'minor','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(175,NULL,'Justine','Meredith Thornton','1979-10-06','6376 Parturient St.','','Naperville','Illinois','98144','(612) 143-3248','elementum.sem@magnaseddui.co.uk',1,'attendee','standard','standard',NULL,'credit',NULL,NULL,NULL,0,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(176,NULL,'Bruce','Ryder Slater','1958-12-15','3737 Integer Avenue','','Duluth','Minnesota','94684','(837) 142-7892','non.magna.Nam@egestasDuis.co.uk',1,'attendee','standard','standard',NULL,'credit',NULL,NULL,NULL,0,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(177,NULL,'Jackson','Michelle Hicks','1985-03-13','Ap #601-5895 Augue Street','','Jacksonville','FL','22078','(754) 263-6862','massa@magna.edu',0,'attendee','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(178,NULL,'Joshua','Deanna Sims','2004-09-03','459-9173 Eleifend Av.','','Boise','ID','27041','(805) 287-1689','Suspendisse@tinciduntpedeac.ca',0,'minor','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(179,NULL,'Madeson','Orli Haynes','1953-12-30','646-2594 Arcu Rd.','','Little Rock','Arkansas','72599','(390) 492-1500','consectetuer@ultrices.edu',1,'attendee','standard','standard',NULL,'credit',NULL,NULL,NULL,0,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(180,NULL,'Petra','Rahim Goodman','1975-07-12','Ap #370-3018 Orci Ave','','Bloomington','MN','93411','(733) 519-0439','Morbi@acorciUt.co.uk',1,'attendee','standard','standard',NULL,'credit',NULL,NULL,NULL,0,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(181,NULL,'Kirsten','Keaton Taylor','1988-07-14','P.O. Box 620, 3577 Nec Avenue','','Pike Creek','DE','72780','(929) 979-6192','blandit.Nam@Donecatarcu.net',0,'attendee','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(182,NULL,'Warren','Jaden Dejesus','2007-08-03','6382 Massa. Ave','','Lansing','Michigan','78803','(929) 595-7870','erat@quisarcu.co.uk',0,'minor','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(183,NULL,'Chaim','Keegan Zamora','1963-11-07','630-7729 Augue Road','','Warren','Michigan','50325','(556) 156-2599','sit.amet@rhoncusNullamvelit.org',1,'attendee','standard','standard',NULL,'credit',NULL,NULL,NULL,0,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(184,NULL,'Ashely','Irene Petty','1981-01-28','P.O. Box 376, 2558 Sed St.','','Indianapolis','Indiana','87435','(909) 290-4596','magna@utaliquamiaculis.org',1,'attendee','standard','standard',NULL,'credit',NULL,NULL,NULL,0,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(185,NULL,'Wanda','Jaquelyn Fitzpatrick','1975-11-22','7888 Diam St.','','Augusta','Georgia','43531','(243) 251-0708','laoreet.lectus.quis@idante.edu',0,'attendee','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(186,NULL,'Angela','Florence Bradford','1952-12-31','1638 At Ave','','Hillsboro','Oregon','96433','(960) 358-3452','tristique.senectus@sollicitudincommodoipsum.org',0,'attendee','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(187,NULL,'Skyler','Christopher Sheppard','1970-11-22','P.O. Box 597, 6994 Dictum Rd.','','Pocatello','Idaho','81486','(968) 716-4613','id.blandit.at@Nuncmaurissapien.edu',1,'attendee','standard','standard',NULL,'credit',NULL,NULL,NULL,0,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(188,NULL,'Orson','Yvonne Bauer','1991-05-30','Ap #253-7151 Primis Rd.','','Green Bay','Wisconsin','17237','(367) 981-3819','fermentum@arcu.ca',1,'attendee','standard','standard',NULL,'credit',NULL,NULL,NULL,0,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(189,NULL,'Destiny','Dara Robbins','1971-09-06','Ap #471-7643 Velit. Rd.','','North Las Vegas','Nevada','79603','(616) 520-6015','egestas@faucibus.com',0,'attendee','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(190,NULL,'Otto','Sybil Hinton','1967-10-13','P.O. Box 775, 2245 Ullamcorper, Rd.','','Stamford','CT','66171','(510) 378-7979','vulputate@semmollis.org',0,'attendee','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(191,NULL,'TaShya','Idola Snider','1983-07-10','Ap #346-5389 Eu, Road','','Honolulu','HI','93406','(643) 995-6757','ipsum.dolor@Sed.edu',1,'attendee','standard','standard',NULL,'credit',NULL,NULL,NULL,0,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(192,NULL,'Reed','Iola Ratliff','1998-06-08','P.O. Box 103, 9844 Neque St.','','South Bend','Indiana','42670','(741) 362-6135','arcu.eu.odio@eueuismod.net',1,'minor','standard','standard',NULL,'credit',NULL,NULL,NULL,0,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(193,NULL,'Dexter','Desiree Griffin','1954-07-19','Ap #591-8396 Tortor St.','','College','AK','99950','(229) 762-4585','tincidunt@quis.edu',0,'attendee','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(194,NULL,'Ulric','Martin Daniels','1950-09-20','Ap #930-8166 Consectetuer Street','','Lincoln','Nebraska','44889','(496) 301-2728','cursus.Nunc.mauris@metus.edu',0,'attendee','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(195,NULL,'Blaine','Octavius Kidd','1959-07-08','Ap #863-7277 Praesent Rd.','','Meridian','Idaho','75997','(695) 295-5723','tempus@tristiquenequevenenatis.net',1,'attendee','standard','standard',NULL,'credit',NULL,NULL,NULL,0,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(196,NULL,'Cherokee','Brendan Faulkner','2000-02-03','Ap #685-875 Odio Av.','','Warren','MI','30341','(680) 532-7411','mollis.non@atarcuVestibulum.ca',1,'minor','standard','standard',NULL,'credit',NULL,NULL,NULL,0,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(197,NULL,'Barry','Jorden Duncan','1997-03-13','P.O. Box 223, 8497 Donec Avenue','','Denver','Colorado','54828','5024625947','tempor.diam.dictum@euneque.net',0,'attendee','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(198,NULL,'Alexandra','Channing Sargent','1985-10-12','3852 Nonummy Road','','Tallahassee','FL','43013','(341) 211-0058','et.magnis.dis@aliquetProinvelit.ca',0,'attendee','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(199,NULL,'Akeem','Vivien Harrington','1990-12-14','P.O. Box 527, 699 Praesent Road','','Columbia','Missouri','21329','(188) 509-2314','Proin.dolor@luctusvulputate.ca',1,'attendee','standard','standard',NULL,'credit',NULL,NULL,NULL,0,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(200,NULL,'Reece','Quamar Young','1978-11-22','137-6646 Lorem Rd.','','Akron','Ohio','51969','(989) 297-8241','lacus.Aliquam@velit.co.uk',1,'attendee','standard','standard',NULL,'credit',NULL,NULL,NULL,0,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(201,NULL,'Raven','Jaquelyn Woodward','1953-02-04','1409 Ipsum Street','','Little Rock','Arkansas','72199','(363) 355-0885','ut.pharetra.sed@condimentumeget.com',0,'attendee','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(202,NULL,'Indira','Hyacinth Farmer','1962-12-18','P.O. Box 285, 854 Eget Ave','','Juneau','Alaska','99998','(749) 638-9189','semper@ametluctus.org',0,'attendee','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(203,NULL,'Tara','May Gates','1991-09-24','2474 Lobortis Rd.','','Racine','WI','20286','7799910456','in@ac.ca',1,'attendee','standard','standard',NULL,'credit',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(204,NULL,'Stewart','Shad Stafford','1967-12-23','P.O. Box 562, 9481 Varius Rd.','','Sandy','Utah','48660','(915) 478-1242','convallis.dolor@anunc.co.uk',1,'attendee','standard','standard',NULL,'credit',NULL,NULL,NULL,0,0,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(205,NULL,'Lester','Raphael Puckett','1998-03-08','P.O. Box 634, 2011 Eget Road','','Philadelphia','PA','18609','(463) 917-8549','felis@urnaNuncquis.co.uk',0,'minor','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(206,NULL,'Alexis','Sarah Nguyen','2008-05-28','9243 Nascetur St.','','Wilmington','Delaware','67689','(374) 591-2538','posuere.cubilia.Curae@Quisquepurus.org',0,'minor','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(207,NULL,'Jade','Holly Potts','1952-06-13','Ap #350-2170 Luctus Rd.','','Toledo','OH','66518','1129685398','imperdiet@duisemperet.ca',1,'attendee','standard','standard',NULL,'credit',NULL,NULL,NULL,1,0,0,1,1,15,'Jade','badge_name:Jade','2015-07-06 10:28:21',NULL),
	(208,NULL,'Karly','Kim Abbott','1996-07-11','P.O. Box 227, 9172 Suspendisse St.','','Miami','FL','79828','6412748826','eleifend.nec@Aeneangravidanunc.co.uk',1,'attendee','standard','standard',NULL,'credit',NULL,NULL,NULL,1,0,0,1,0,16,'Karly','badge_name:Karly','2015-07-06 10:28:21',NULL),
	(209,NULL,'Arthur','Emerald Benton','1971-06-01','749-408 Leo St.','','Lawton','OK','97435','(669) 558-4223','nulla.Cras.eu@quispede.ca',0,'attendee','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL),
	(210,NULL,'MacKensie','Malcolm Delgado','1950-11-10','Ap #905-6894 Eu Rd.','','Cleveland','Ohio','39649','(536) 513-1478','non.leo.Vivamus@veliteusem.com',0,'attendee','standard','standard',NULL,'cash',NULL,NULL,NULL,0,1,0,0,0,NULL,NULL,NULL,'2015-07-06 10:28:21',NULL);

/*!40000 ALTER TABLE `attendees` ENABLE KEYS */;
UNLOCK TABLES;


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
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `blacklist` WRITE;
/*!40000 ALTER TABLE `blacklist` DISABLE KEYS */;

INSERT INTO `blacklist` (`id`, `badge_name`, `legal_name`, `trigger_badge_names`, `trigger_legal_names`, `reason`, `banned`)
VALUES
	(15,'Jade','Holly Potts','Jade','Potts','Putting bubble bath in the hotel pool.',1),
	(16,'Karly','Kim Abbott','Karly','Abbott','Supplied Jade / Holly Potts the bubbles.',0);

/*!40000 ALTER TABLE `blacklist` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
