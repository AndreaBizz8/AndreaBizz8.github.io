/*
SQLyog Community v12.5.1 (64 bit)
MySQL - 10.1.30-MariaDB : Database - theatrepedia
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`theatrepedia` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `theatrepedia`;

/*Table structure for table `accent` */

DROP TABLE IF EXISTS `accent`;

CREATE TABLE `accent` (
  `accent_ID` int(5) NOT NULL AUTO_INCREMENT,
  `accent_name` varchar(50) NOT NULL,
  PRIMARY KEY (`accent_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `accent` */

insert  into `accent`(`accent_ID`,`accent_name`) values 
(1,'English (London)'),
(2,'English (Scotland)'),
(3,'Italian (Venice)'),
(4,'Italia (Rome)');

/*Table structure for table `actor` */

DROP TABLE IF EXISTS `actor`;

CREATE TABLE `actor` (
  `actor_ID` int(10) NOT NULL AUTO_INCREMENT,
  `actor_name` varchar(50) NOT NULL,
  `actor_middlename` varchar(50) DEFAULT NULL,
  `actor_lastname` varchar(50) NOT NULL,
  `gender_ID` int(1) NOT NULL,
  `actor_dob` date DEFAULT NULL,
  `actor_pob` int(3) DEFAULT NULL,
  `actor_website` varchar(100) DEFAULT NULL,
  `actor_country` int(3) DEFAULT NULL,
  `actor_school` int(5) DEFAULT NULL,
  `actor_school_graduation_year` int(4) DEFAULT NULL,
  `actor_insta` varchar(100) DEFAULT NULL,
  `actor_facebook` varchar(100) DEFAULT NULL,
  `actor_twitter` varchar(100) DEFAULT NULL,
  `actor_youtube` varchar(100) DEFAULT NULL,
  `actor_email` varchar(100) DEFAULT NULL,
  `agent_ID` int(10) DEFAULT NULL,
  `actor_gallery_pic_ID` int(5) NOT NULL,
  `actor_biography` varchar(100) NOT NULL,
  `actor_profile_pic` varchar(100) NOT NULL,
  PRIMARY KEY (`actor_ID`),
  KEY `actor_gender` (`gender_ID`),
  KEY `actor_pob` (`actor_pob`),
  KEY `actor_country` (`actor_country`),
  KEY `actor_agent` (`agent_ID`),
  KEY `actor_gallery` (`actor_gallery_pic_ID`),
  KEY `actor_school` (`actor_school`),
  CONSTRAINT `actor_agent` FOREIGN KEY (`agent_ID`) REFERENCES `agent` (`agent_ID`),
  CONSTRAINT `actor_country` FOREIGN KEY (`actor_country`) REFERENCES `country` (`country_ID`),
  CONSTRAINT `actor_gallery` FOREIGN KEY (`actor_gallery_pic_ID`) REFERENCES `actor_gallery_pic` (`actor_gallery_pic_ID`),
  CONSTRAINT `actor_gender` FOREIGN KEY (`gender_ID`) REFERENCES `gender` (`gender_ID`),
  CONSTRAINT `actor_pob` FOREIGN KEY (`actor_pob`) REFERENCES `country` (`country_ID`),
  CONSTRAINT `actor_school` FOREIGN KEY (`actor_school`) REFERENCES `school` (`school_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `actor` */

/*Table structure for table `actor_accent` */

DROP TABLE IF EXISTS `actor_accent`;

CREATE TABLE `actor_accent` (
  `actor_ID` int(10) NOT NULL,
  `accent_ID` int(5) NOT NULL,
  KEY `actor_accent` (`actor_ID`),
  KEY `accent_actor` (`accent_ID`),
  CONSTRAINT `accent_actor` FOREIGN KEY (`accent_ID`) REFERENCES `accent` (`accent_ID`),
  CONSTRAINT `actor_accent` FOREIGN KEY (`actor_ID`) REFERENCES `actor` (`actor_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `actor_accent` */

/*Table structure for table `actor_gallery_pic` */

DROP TABLE IF EXISTS `actor_gallery_pic`;

CREATE TABLE `actor_gallery_pic` (
  `actor_gallery_pic_ID` int(5) NOT NULL,
  `actor_gallery_pic_title` varchar(250) NOT NULL,
  `production_ID` int(10) NOT NULL,
  `actor_ID` int(10) NOT NULL,
  PRIMARY KEY (`actor_gallery_pic_ID`),
  KEY `production_actor_gallery` (`production_ID`),
  KEY `actor_gallery_gallery` (`actor_ID`),
  CONSTRAINT `actor_gallery_gallery` FOREIGN KEY (`actor_ID`) REFERENCES `actor` (`actor_ID`),
  CONSTRAINT `production_actor_gallery` FOREIGN KEY (`production_ID`) REFERENCES `production` (`production_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `actor_gallery_pic` */

/*Table structure for table `actor_language` */

DROP TABLE IF EXISTS `actor_language`;

CREATE TABLE `actor_language` (
  `actor_ID` int(10) NOT NULL,
  `language_ID` int(3) NOT NULL,
  PRIMARY KEY (`actor_ID`,`language_ID`),
  KEY `language_language` (`language_ID`),
  CONSTRAINT `actor_language` FOREIGN KEY (`actor_ID`) REFERENCES `actor` (`actor_ID`),
  CONSTRAINT `language_language` FOREIGN KEY (`language_ID`) REFERENCES `language` (`language_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `actor_language` */

/*Table structure for table `actor_reward` */

DROP TABLE IF EXISTS `actor_reward`;

CREATE TABLE `actor_reward` (
  `actor_ID` int(10) NOT NULL,
  `reward_type_ID` int(5) NOT NULL,
  `reward_year` int(4) NOT NULL,
  `result_reward` int(11) NOT NULL,
  `show_ID` int(10) NOT NULL,
  `production_ID` int(10) NOT NULL,
  `reward_ID` int(5) NOT NULL,
  PRIMARY KEY (`actor_ID`,`reward_type_ID`,`reward_year`,`show_ID`,`production_ID`,`reward_ID`),
  KEY `reward_type_actor_reward` (`reward_type_ID`),
  KEY `show_reward_actor` (`show_ID`),
  KEY `production_reward_actor` (`production_ID`),
  KEY `reward_actor_reward` (`reward_ID`),
  CONSTRAINT `actor_reward` FOREIGN KEY (`actor_ID`) REFERENCES `actor` (`actor_ID`),
  CONSTRAINT `production_reward_actor` FOREIGN KEY (`production_ID`) REFERENCES `production` (`production_ID`),
  CONSTRAINT `reward_actor_reward` FOREIGN KEY (`reward_ID`) REFERENCES `reward` (`reward_ID`),
  CONSTRAINT `reward_type_actor_reward` FOREIGN KEY (`reward_type_ID`) REFERENCES `reward_type` (`reward_type_ID`),
  CONSTRAINT `show_reward_actor` FOREIGN KEY (`show_ID`) REFERENCES `show` (`show_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `actor_reward` */

/*Table structure for table `actor_skill` */

DROP TABLE IF EXISTS `actor_skill`;

CREATE TABLE `actor_skill` (
  `actor_ID` int(10) NOT NULL,
  `skill_ID` int(5) NOT NULL,
  `level_name_ID` int(1) NOT NULL,
  PRIMARY KEY (`actor_ID`,`skill_ID`,`level_name_ID`),
  KEY `skill_actor` (`skill_ID`),
  KEY `level_name_skill` (`level_name_ID`),
  CONSTRAINT `actor_skill_ID` FOREIGN KEY (`actor_ID`) REFERENCES `actor` (`actor_ID`),
  CONSTRAINT `level_name_skill` FOREIGN KEY (`level_name_ID`) REFERENCES `level_name` (`level_name_ID`),
  CONSTRAINT `skill_actor` FOREIGN KEY (`skill_ID`) REFERENCES `skill` (`skill_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `actor_skill` */

/*Table structure for table `actor_theatre_exp` */

DROP TABLE IF EXISTS `actor_theatre_exp`;

CREATE TABLE `actor_theatre_exp` (
  `actor_ID` int(10) NOT NULL,
  `production_ID` int(10) NOT NULL,
  `show_ID` int(10) NOT NULL,
  `actor_theatre_exp_debut` date NOT NULL,
  `actor_theatre_exp_lastshow` date NOT NULL,
  `role_ID` int(10) NOT NULL,
  `role_time_ID` int(1) NOT NULL,
  PRIMARY KEY (`actor_ID`,`production_ID`,`show_ID`),
  KEY `actor_exp_prod` (`production_ID`),
  KEY `actor_exp_show` (`show_ID`),
  KEY `actor_exp_role` (`role_ID`),
  KEY `actor_exp_role_time` (`role_time_ID`),
  CONSTRAINT `actor_exp_actor` FOREIGN KEY (`actor_ID`) REFERENCES `actor` (`actor_ID`),
  CONSTRAINT `actor_exp_prod` FOREIGN KEY (`production_ID`) REFERENCES `production` (`production_ID`),
  CONSTRAINT `actor_exp_role` FOREIGN KEY (`role_ID`) REFERENCES `role` (`role_ID`),
  CONSTRAINT `actor_exp_role_time` FOREIGN KEY (`role_time_ID`) REFERENCES `role_time` (`role_time_ID`),
  CONSTRAINT `actor_exp_show` FOREIGN KEY (`show_ID`) REFERENCES `show` (`show_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `actor_theatre_exp` */

/*Table structure for table `actor_tv_exp` */

DROP TABLE IF EXISTS `actor_tv_exp`;

CREATE TABLE `actor_tv_exp` (
  `actor_tv_exp` int(10) NOT NULL AUTO_INCREMENT,
  `actor_tv_exp_title` varchar(250) NOT NULL,
  `tv_exp_type_ID` int(2) NOT NULL,
  `tv_exp_role_type_ID` int(2) NOT NULL,
  `actor_tv_exp_rolename` varchar(50) NOT NULL,
  `actor_tv_exp_company` varchar(50) DEFAULT NULL,
  `actor_tv_exp_release_date` date NOT NULL,
  `actor_ID` int(10) NOT NULL,
  PRIMARY KEY (`actor_tv_exp`,`tv_exp_type_ID`,`tv_exp_role_type_ID`,`actor_ID`),
  KEY `actor_tv_exp` (`actor_ID`),
  KEY `actor_tv_exp_type` (`tv_exp_type_ID`),
  KEY `actor_tv_exp_roletype` (`tv_exp_role_type_ID`),
  CONSTRAINT `actor_tv_exp` FOREIGN KEY (`actor_ID`) REFERENCES `actor` (`actor_ID`),
  CONSTRAINT `actor_tv_exp_roletype` FOREIGN KEY (`tv_exp_role_type_ID`) REFERENCES `tv_exp_role_type` (`tv_exp_role_type_ID`),
  CONSTRAINT `actor_tv_exp_type` FOREIGN KEY (`tv_exp_type_ID`) REFERENCES `tv_experience_type` (`tv_experience_type_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `actor_tv_exp` */

/*Table structure for table `agent` */

DROP TABLE IF EXISTS `agent`;

CREATE TABLE `agent` (
  `agent_ID` int(10) NOT NULL,
  `agent_name` varchar(100) NOT NULL,
  `agent_email` varchar(100) NOT NULL,
  `agent_phone` int(10) NOT NULL,
  `continent_ID` int(1) NOT NULL,
  `country_ID` int(3) NOT NULL,
  `state_ID` int(5) NOT NULL,
  `region_ID` int(5) NOT NULL,
  `agent_street_address` varchar(250) NOT NULL,
  `agent_latitude` varchar(25) NOT NULL,
  `agent_latitude_direction` char(1) NOT NULL,
  `agent_longitude` varchar(25) NOT NULL,
  `agent_longitude_direction` char(1) NOT NULL,
  PRIMARY KEY (`agent_ID`),
  KEY `continent_agent` (`continent_ID`),
  KEY `country_agent` (`country_ID`),
  KEY `state_agent` (`state_ID`),
  KEY `region_agent` (`region_ID`),
  CONSTRAINT `continent_agent` FOREIGN KEY (`continent_ID`) REFERENCES `continent` (`continent_ID`),
  CONSTRAINT `country_agent` FOREIGN KEY (`country_ID`) REFERENCES `country` (`country_ID`),
  CONSTRAINT `region_agent` FOREIGN KEY (`region_ID`) REFERENCES `region` (`region_ID`),
  CONSTRAINT `state_agent` FOREIGN KEY (`state_ID`) REFERENCES `state` (`state_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `agent` */

insert  into `agent`(`agent_ID`,`agent_name`,`agent_email`,`agent_phone`,`continent_ID`,`country_ID`,`state_ID`,`region_ID`,`agent_street_address`,`agent_latitude`,`agent_latitude_direction`,`agent_longitude`,`agent_longitude_direction`) values 
(0,'intertalent Actors','info@colekitchenn.com',2074629060,6,104,1,4,'ROAR House 46 Charlotte Street','','','','');

/*Table structure for table `award` */

DROP TABLE IF EXISTS `award`;

CREATE TABLE `award` (
  `award_type_ID` int(3) NOT NULL AUTO_INCREMENT,
  `award_ID` int(5) NOT NULL,
  `award_name` varchar(50) NOT NULL,
  PRIMARY KEY (`award_ID`),
  KEY `award_type_ID` (`award_type_ID`),
  CONSTRAINT `award_award_type` FOREIGN KEY (`award_type_ID`) REFERENCES `award_type` (`award_type_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `award` */

/*Table structure for table `award_type` */

DROP TABLE IF EXISTS `award_type`;

CREATE TABLE `award_type` (
  `award_type_ID` int(3) NOT NULL AUTO_INCREMENT,
  `award_type_name` varchar(50) NOT NULL,
  `state_ID` int(5) NOT NULL,
  `country_ID` int(3) NOT NULL,
  `continent_ID` int(1) NOT NULL,
  PRIMARY KEY (`award_type_ID`),
  KEY `award_state` (`state_ID`),
  KEY `award_country` (`country_ID`),
  KEY `award_continent` (`continent_ID`),
  CONSTRAINT `award_continent` FOREIGN KEY (`continent_ID`) REFERENCES `continent` (`continent_ID`),
  CONSTRAINT `award_country` FOREIGN KEY (`country_ID`) REFERENCES `country` (`country_ID`),
  CONSTRAINT `award_state` FOREIGN KEY (`state_ID`) REFERENCES `state` (`state_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `award_type` */

/*Table structure for table `continent` */

DROP TABLE IF EXISTS `continent`;

CREATE TABLE `continent` (
  `continent_ID` int(1) NOT NULL AUTO_INCREMENT,
  `continent_name` varchar(15) NOT NULL,
  PRIMARY KEY (`continent_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `continent` */

insert  into `continent`(`continent_ID`,`continent_name`) values 
(1,'World'),
(2,'Africa'),
(3,'Asia'),
(4,'America'),
(5,'Australia'),
(6,'Europe');

/*Table structure for table `country` */

DROP TABLE IF EXISTS `country`;

CREATE TABLE `country` (
  `country_ID` int(3) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(50) NOT NULL,
  `country_flag` varchar(50) NOT NULL,
  `continent_ID` int(1) NOT NULL,
  PRIMARY KEY (`country_ID`),
  KEY `country_continent` (`continent_ID`),
  CONSTRAINT `country_continent` FOREIGN KEY (`continent_ID`) REFERENCES `continent` (`continent_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=287 DEFAULT CHARSET=latin1;

/*Data for the table `country` */

insert  into `country`(`country_ID`,`country_name`,`country_flag`,`continent_ID`) values 
(1,'Algeria','Algeria',2),
(2,'Angola','Angola',2),
(3,'Cameroon','Cameroon',2),
(4,'Central African Republic','Central African Republic',2),
(5,'Chad','Chad',2),
(6,'Egypt','Egypt',2),
(7,'Libya','Libya',2),
(8,'Morocco','Morocco',2),
(9,'South Sudan','South Sudan',2),
(10,'Sudan','Sudan',2),
(11,'Tunisia','Tunisia',2),
(12,'Western Sahara','Western Sahara',2),
(13,'Burundi','Burundi',2),
(14,'Comoros','Comoros',2),
(15,'Djibouti','Djibouti',2),
(16,'Eritrea','Eritrea',2),
(17,'Ethiopia','Ethiopia',2),
(18,'Kenya','Kenya',2),
(19,'Madagascar','Madagascar',2),
(20,'Malawi','Malawi',2),
(21,'Mauritius','Mauritius',2),
(22,'Mayotte','Mayotte',2),
(23,'Mozambique','Mozambique',2),
(24,'Reunion','Reunion',2),
(25,'Rwanda','Rwanda',2),
(26,'Seychelles','Seychelles',2),
(27,'Somalia','Somalia',2),
(28,'Tanzania','Tanzania',2),
(29,'Uganda','Uganda',2),
(30,'Zambia','Zambia',2),
(31,'Zimbabwe','Zimbabwe',2),
(32,'Benin','Benin',2),
(33,'Burkina Faso','Burkina Faso',2),
(34,'Capo Verde','Capo Verde',2),
(35,'Cote d\'Ivoire','Cote d\'Ivoire',2),
(36,'Gambia','Gambia',2),
(37,'Ghana','Ghana',2),
(38,'Guinea','Guinea',2),
(39,'Guinea-Bissau','Guinea-Bissau',2),
(40,'Liberia','Liberia',2),
(41,'Mali','Mali',2),
(42,'Mauritania','Mauritania',2),
(43,'Niger','Niger',2),
(44,'Nigeria','Nigeria',2),
(45,'Saint Helena','Saint Helena',2),
(46,'Senegal','Senegal',2),
(47,'Sierra Leone','Sierra Leone',2),
(48,'Togo','Togo',2),
(49,'Democratic Republic of Congo','Democratic Republic of Congo',2),
(50,'Republic of Congo','Republic of Congo',2),
(51,'Gabon','Gabon',2),
(52,'Lesotho','Lesotho',2),
(53,'Sao Tome and Principe','Sao Tome and Principe',2),
(54,'South Africa','South Africa',2),
(55,'Albania','Albania',6),
(56,'Andorra','Andorra',6),
(57,'Armenia','Armenia',6),
(58,'Austria','Austria',6),
(59,'Azerbaijan','Azerbaijan',6),
(60,'Belarus','Belarus',6),
(61,'Belgium','Belgium',6),
(62,'Bosnia and Herzegovina','Bosnia and Herzegovina',6),
(63,'Bulgaria','Bulgaria',6),
(64,'Croatia','Croatia',6),
(65,'Cyprus','Cyprus',6),
(66,'Czech Republic','Czech Republic',6),
(67,'Denmark','Denmark',6),
(68,'Estonia','Estonia',6),
(69,'Finland','Finland',6),
(70,'France','France',6),
(71,'Georgia','Georgia',6),
(72,'Germany','Germany',6),
(73,'Greece','Greece',6),
(74,'Hungary','Hungary',6),
(75,'Iceland','Iceland',6),
(76,'Ireland','Ireland',6),
(77,'Italy','Italy',6),
(78,'Kazakhstan','Kazakhstan',6),
(79,'Kosovo','Kosovo',6),
(80,'Latvia','Latvia',6),
(81,'Leichtestein','Leichtestein',6),
(82,'Lithuania','Lithuania',6),
(83,'Luxembourg','Luxembourg',6),
(84,'Macedonia','Macedonia',6),
(85,'Malta','Malta',6),
(86,'Moldova','Moldova',6),
(87,'Monaco','Monaco',6),
(88,'Montenegro','Montenegro',6),
(89,'Netherlands','Netherlands',6),
(90,'Norway','Norway',6),
(91,'Poland','Poland',6),
(92,'Portugal','Portugal',6),
(93,'Romania','Romania',6),
(94,'Russia','Russia',6),
(95,'San Marino','San Marino',6),
(96,'Serbia','Serbia',6),
(97,'Slovakia','Slovakia',6),
(98,'Slovenia','Slovenia',6),
(99,'Spain','Spain',6),
(100,'Sweden','Sweden',6),
(101,'Switzerland','Switzerland',6),
(102,'Turkey','Turkey',6),
(103,'Ukraine','Ukraine',6),
(104,'United Kingdom','United Kingdom',6),
(105,'Vatican City','Vatican City',6),
(106,'Afghanistan','Afghanistan',3),
(107,'Armenia','Armenia',3),
(108,'Azerbaijan','Azerbaijan',3),
(109,'Bahrain','Bahrain',3),
(110,'Bangladesh','Bangladesh',3),
(111,'Bhutan','Bhutan',3),
(112,'Brunei','Brunei',3),
(113,'Cambodia','Cambodia',3),
(114,'China','China',3),
(115,'India','India',3),
(116,'Indonesia','Indonesia',3),
(117,'Iran','Iran',3),
(118,'Iraq','Iraq',3),
(119,'Israel','Israel',3),
(120,'Japan','Japan',3),
(121,'Jordan','Jordan',3),
(122,'Kazakhstan','Kazakhstan',3),
(123,'Kyrgyzstan','Kyrgyzstan',3),
(124,'Laos','Laos',3),
(125,'Leban','Leban',3),
(126,'Malaysia','Malaysia',3),
(127,'Maldives','Maldives',3),
(128,'Mongolia','Mongolia',3),
(129,'Myanmar','Myanmar',3),
(130,'Nepal','Nepal',3),
(131,'North Korea','North Korea',3),
(132,'Oman','Oman',3),
(133,'Pakistan','Pakistan',3),
(134,'Palestine','Palestine',3),
(135,'Philippines','Philippines',3),
(136,'Qatar','Qatar',3),
(137,'Saudi Arabia','Saudi Arabia',3),
(138,'Singapore','Singapore',3),
(139,'South Korea','South Korea',3),
(140,'Sri Lanka','Sri Lanka',3),
(141,'Syria','Syria',3),
(142,'Taiwan','Taiwan',3),
(143,'Tajikistan','Tajikistan',3),
(144,'Thailand','Thailand',3),
(145,'Timor-Leste','Timor-Leste',3),
(146,'Turkmenistan','Turkmenistan',3),
(147,'United Arab Emirates','United Arab Emirates',3),
(148,'Uzbekistan','Uzbekistan',3),
(149,'Vietnam','Vietnam',3),
(150,'Yemen','Yemen',3);

/*Table structure for table `day_time` */

DROP TABLE IF EXISTS `day_time`;

CREATE TABLE `day_time` (
  `day_time_ID` int(1) NOT NULL AUTO_INCREMENT,
  `day_time_name` varchar(20) NOT NULL,
  PRIMARY KEY (`day_time_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `day_time` */

insert  into `day_time`(`day_time_ID`,`day_time_name`) values 
(1,'Matinee'),
(2,'Evening');

/*Table structure for table `day_week` */

DROP TABLE IF EXISTS `day_week`;

CREATE TABLE `day_week` (
  `day_week_ID` int(1) NOT NULL AUTO_INCREMENT,
  `day_week_name` varchar(20) NOT NULL,
  PRIMARY KEY (`day_week_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `day_week` */

insert  into `day_week`(`day_week_ID`,`day_week_name`) values 
(1,'Monday'),
(2,'Tuesday'),
(3,'Wednesday'),
(4,'Thursday'),
(5,'Friday'),
(6,'Saturday'),
(7,'Sunday');

/*Table structure for table `gallery` */

DROP TABLE IF EXISTS `gallery`;

CREATE TABLE `gallery` (
  `gallery_ID` int(5) NOT NULL,
  `production_ID` int(10) NOT NULL,
  `show_ID` int(10) NOT NULL,
  KEY `gallery_gallery_ID` (`gallery_ID`),
  KEY `production_gallery` (`production_ID`),
  KEY `show_gallery` (`show_ID`),
  CONSTRAINT `gallery_gallery_ID` FOREIGN KEY (`gallery_ID`) REFERENCES `gallery_picture` (`gallery_ID`),
  CONSTRAINT `production_gallery` FOREIGN KEY (`production_ID`) REFERENCES `production` (`production_ID`),
  CONSTRAINT `show_gallery` FOREIGN KEY (`show_ID`) REFERENCES `show` (`show_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `gallery` */

/*Table structure for table `gallery_picture` */

DROP TABLE IF EXISTS `gallery_picture`;

CREATE TABLE `gallery_picture` (
  `gallery_ID` int(11) NOT NULL,
  `gallery_pic_ID` int(11) NOT NULL,
  `gallery_pic_title` varchar(100) NOT NULL,
  `gallery_pic_location` varchar(50) NOT NULL COMMENT 'this should be the production name, like #1 Tour Production 2005-2006',
  PRIMARY KEY (`gallery_ID`,`gallery_pic_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `gallery_picture` */

/*Table structure for table `gender` */

DROP TABLE IF EXISTS `gender`;

CREATE TABLE `gender` (
  `gender_ID` int(1) NOT NULL AUTO_INCREMENT,
  `gender_name` varchar(20) NOT NULL,
  PRIMARY KEY (`gender_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `gender` */

insert  into `gender`(`gender_ID`,`gender_name`) values 
(1,'Male'),
(2,'Female');

/*Table structure for table `language` */

DROP TABLE IF EXISTS `language`;

CREATE TABLE `language` (
  `language_ID` int(3) NOT NULL AUTO_INCREMENT,
  `language_name` varchar(50) NOT NULL,
  PRIMARY KEY (`language_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `language` */

/*Table structure for table `level_name` */

DROP TABLE IF EXISTS `level_name`;

CREATE TABLE `level_name` (
  `level_name_ID` int(1) NOT NULL AUTO_INCREMENT,
  `level_name_type` varchar(15) NOT NULL,
  PRIMARY KEY (`level_name_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `level_name` */

insert  into `level_name`(`level_name_ID`,`level_name_type`) values 
(1,'Beginner'),
(2,'Intermediate'),
(3,'Expert');

/*Table structure for table `production` */

DROP TABLE IF EXISTS `production`;

CREATE TABLE `production` (
  `production_ID` int(10) NOT NULL AUTO_INCREMENT,
  `show_ID` int(10) NOT NULL,
  `production_type_ID` int(2) NOT NULL,
  `gallery_ID` int(5) NOT NULL,
  PRIMARY KEY (`production_ID`),
  KEY `show_production` (`show_ID`),
  KEY `production_production_type` (`production_type_ID`),
  KEY `gallery_production` (`gallery_ID`),
  CONSTRAINT `gallery_production` FOREIGN KEY (`gallery_ID`) REFERENCES `gallery` (`gallery_ID`),
  CONSTRAINT `production_production_type` FOREIGN KEY (`production_type_ID`) REFERENCES `production_type` (`production_type_ID`),
  CONSTRAINT `show_production` FOREIGN KEY (`show_ID`) REFERENCES `show` (`show_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `production` */

/*Table structure for table `production_info` */

DROP TABLE IF EXISTS `production_info`;

CREATE TABLE `production_info` (
  `production_ID` int(10) NOT NULL,
  `production_name` varchar(50) NOT NULL,
  `production_FB` varchar(100) DEFAULT NULL,
  `production_insta` varchar(100) DEFAULT NULL,
  `production_twitter` varchar(100) DEFAULT NULL,
  `production_youtube` varchar(100) DEFAULT NULL,
  `production_pic` varchar(100) NOT NULL,
  `production_logo` varchar(100) NOT NULL,
  KEY `info_production` (`production_ID`),
  CONSTRAINT `info_production` FOREIGN KEY (`production_ID`) REFERENCES `production` (`production_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `production_info` */

/*Table structure for table `production_performance` */

DROP TABLE IF EXISTS `production_performance`;

CREATE TABLE `production_performance` (
  `production_ID` int(10) NOT NULL,
  `day_time_ID` int(1) NOT NULL,
  `day_week_ID` int(1) NOT NULL,
  `performance_time` varchar(5) NOT NULL,
  PRIMARY KEY (`production_ID`,`day_time_ID`,`day_week_ID`),
  KEY `day_time_perf` (`day_time_ID`),
  KEY `day_week_perf` (`day_week_ID`),
  CONSTRAINT `day_time_perf` FOREIGN KEY (`day_time_ID`) REFERENCES `day_time` (`day_time_ID`),
  CONSTRAINT `day_week_perf` FOREIGN KEY (`day_week_ID`) REFERENCES `day_week` (`day_week_ID`),
  CONSTRAINT `production_prod_perf` FOREIGN KEY (`production_ID`) REFERENCES `production` (`production_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `production_performance` */

/*Table structure for table `production_theatre` */

DROP TABLE IF EXISTS `production_theatre`;

CREATE TABLE `production_theatre` (
  `production_ID` int(10) NOT NULL,
  `theatre_ID` int(10) NOT NULL,
  `production_type_ID` int(2) NOT NULL,
  `dayseat_info` varchar(250) DEFAULT NULL,
  `lottery_info` varchar(250) DEFAULT NULL,
  `student_info` varchar(250) DEFAULT NULL,
  `production_opening` date NOT NULL,
  `production_press` date NOT NULL,
  `production_closing` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `production_theatre` */

/*Table structure for table `production_time` */

DROP TABLE IF EXISTS `production_time`;

CREATE TABLE `production_time` (
  `production_time_ID` int(1) NOT NULL AUTO_INCREMENT,
  `production_time_name` varchar(10) NOT NULL,
  PRIMARY KEY (`production_time_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `production_time` */

insert  into `production_time`(`production_time_ID`,`production_time_name`) values 
(1,'Present'),
(2,'Past'),
(3,'Future');

/*Table structure for table `production_type` */

DROP TABLE IF EXISTS `production_type`;

CREATE TABLE `production_type` (
  `production_type_ID` int(2) NOT NULL AUTO_INCREMENT,
  `production_type_name` varchar(15) NOT NULL,
  PRIMARY KEY (`production_type_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `production_type` */

insert  into `production_type`(`production_type_ID`,`production_type_name`) values 
(1,'Main'),
(2,'Tour');

/*Table structure for table `region` */

DROP TABLE IF EXISTS `region`;

CREATE TABLE `region` (
  `region_ID` int(5) NOT NULL AUTO_INCREMENT,
  `region_name` varchar(50) NOT NULL,
  `country_ID` int(3) NOT NULL,
  `state_ID` int(5) NOT NULL,
  `continent_ID` int(1) NOT NULL,
  PRIMARY KEY (`region_ID`),
  KEY `region_country` (`country_ID`),
  KEY `region_state` (`state_ID`),
  KEY `continent` (`continent_ID`),
  CONSTRAINT `continent` FOREIGN KEY (`continent_ID`) REFERENCES `continent` (`continent_ID`),
  CONSTRAINT `region_country` FOREIGN KEY (`country_ID`) REFERENCES `country` (`country_ID`),
  CONSTRAINT `region_state` FOREIGN KEY (`state_ID`) REFERENCES `state` (`state_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `region` */

insert  into `region`(`region_ID`,`region_name`,`country_ID`,`state_ID`,`continent_ID`) values 
(1,'East of England',104,1,6),
(2,'East Midlands',104,1,6),
(4,'London',104,1,6),
(5,'North East',104,1,6),
(6,'North West',104,1,6);

/*Table structure for table `reward` */

DROP TABLE IF EXISTS `reward`;

CREATE TABLE `reward` (
  `reward_ID` int(5) NOT NULL AUTO_INCREMENT,
  `reward_type_ID` int(5) NOT NULL,
  `reward_name` varchar(50) NOT NULL,
  PRIMARY KEY (`reward_ID`,`reward_type_ID`),
  KEY `reward_reward_type` (`reward_type_ID`),
  CONSTRAINT `reward_reward_type` FOREIGN KEY (`reward_type_ID`) REFERENCES `reward_type` (`reward_type_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `reward` */

/*Table structure for table `reward_type` */

DROP TABLE IF EXISTS `reward_type`;

CREATE TABLE `reward_type` (
  `reward_type_ID` int(5) NOT NULL AUTO_INCREMENT,
  `reward_type_name` varchar(50) NOT NULL,
  `state_ID` int(5) NOT NULL,
  `country_ID` int(3) NOT NULL,
  `continent_ID` int(1) NOT NULL,
  PRIMARY KEY (`reward_type_ID`),
  KEY `reward_state` (`state_ID`),
  KEY `reward_country` (`country_ID`),
  KEY `reward_continent` (`continent_ID`),
  CONSTRAINT `reward_continent` FOREIGN KEY (`continent_ID`) REFERENCES `continent` (`continent_ID`),
  CONSTRAINT `reward_country` FOREIGN KEY (`country_ID`) REFERENCES `country` (`country_ID`),
  CONSTRAINT `reward_state` FOREIGN KEY (`state_ID`) REFERENCES `state` (`state_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `reward_type` */

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `role_ID` int(10) NOT NULL AUTO_INCREMENT,
  `show_ID` int(10) NOT NULL,
  `role_type_ID` int(2) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  PRIMARY KEY (`role_ID`),
  KEY `role_show` (`show_ID`),
  KEY `role_type_role` (`role_type_ID`),
  CONSTRAINT `role_show` FOREIGN KEY (`show_ID`) REFERENCES `show` (`show_ID`),
  CONSTRAINT `role_type_role` FOREIGN KEY (`role_type_ID`) REFERENCES `role_type` (`role_type_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `role` */

/*Table structure for table `role_time` */

DROP TABLE IF EXISTS `role_time`;

CREATE TABLE `role_time` (
  `role_time_ID` int(1) NOT NULL AUTO_INCREMENT,
  `role_time_name` varchar(20) NOT NULL,
  PRIMARY KEY (`role_time_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `role_time` */

insert  into `role_time`(`role_time_ID`,`role_time_name`) values 
(1,'Original'),
(2,'Current'),
(3,'Past');

/*Table structure for table `role_type` */

DROP TABLE IF EXISTS `role_type`;

CREATE TABLE `role_type` (
  `role_type_ID` int(2) NOT NULL AUTO_INCREMENT,
  `role_type_name` varchar(20) NOT NULL,
  PRIMARY KEY (`role_type_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `role_type` */

insert  into `role_type`(`role_type_ID`,`role_type_name`) values 
(1,'Main'),
(2,'Ensemble'),
(3,'Swing'),
(4,'Understudy');

/*Table structure for table `school` */

DROP TABLE IF EXISTS `school`;

CREATE TABLE `school` (
  `school_ID` int(5) NOT NULL AUTO_INCREMENT,
  `school_name` varchar(50) NOT NULL,
  `country_ID` int(3) NOT NULL,
  PRIMARY KEY (`school_ID`),
  KEY `school_country` (`country_ID`),
  CONSTRAINT `school_country` FOREIGN KEY (`country_ID`) REFERENCES `country` (`country_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `school` */

insert  into `school`(`school_ID`,`school_name`,`country_ID`) values 
(1,'The MTA',104);

/*Table structure for table `seat_review` */

DROP TABLE IF EXISTS `seat_review`;

CREATE TABLE `seat_review` (
  `user_ID` int(10) NOT NULL,
  `seat_review_date` date NOT NULL,
  `theatre_ID` int(10) NOT NULL,
  `theatre_level_ID` int(2) NOT NULL,
  `theatre_row_ID` int(3) NOT NULL,
  `theatre_seatnumber_ID` int(10) NOT NULL,
  `seat_review_view` int(5) NOT NULL,
  `seat_review_comfort` int(5) NOT NULL,
  `seat_review_legroom` int(5) NOT NULL,
  `seat_review_picture_view` varchar(250) DEFAULT NULL,
  `seat_review_ticket` varchar(250) DEFAULT NULL,
  `seat_review_comment` varchar(250) NOT NULL,
  PRIMARY KEY (`user_ID`,`seat_review_date`,`theatre_ID`,`theatre_level_ID`,`theatre_row_ID`,`theatre_seatnumber_ID`),
  KEY `theatre_user_seat_review` (`theatre_ID`),
  KEY `theatre_level_seat_review` (`theatre_level_ID`),
  KEY `theatre_row_seat_review` (`theatre_row_ID`),
  KEY `theatre_seatnumber_seat_review` (`theatre_seatnumber_ID`),
  CONSTRAINT `theatre_level_seat_review` FOREIGN KEY (`theatre_level_ID`) REFERENCES `theatre_level` (`theatre_level_ID`),
  CONSTRAINT `theatre_row_seat_review` FOREIGN KEY (`theatre_row_ID`) REFERENCES `theatre_row` (`theatre_row_ID`),
  CONSTRAINT `theatre_seatnumber_seat_review` FOREIGN KEY (`theatre_seatnumber_ID`) REFERENCES `theatre_seatnumber` (`theatre_seatnumber_ID`),
  CONSTRAINT `theatre_user_seat_review` FOREIGN KEY (`theatre_ID`) REFERENCES `theatre` (`theatre_ID`),
  CONSTRAINT `user_review_user` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `seat_review` */

/*Table structure for table `show` */

DROP TABLE IF EXISTS `show`;

CREATE TABLE `show` (
  `show_ID` int(10) NOT NULL AUTO_INCREMENT,
  `show_composer_ID` int(10) NOT NULL,
  `show_lyrics_ID` int(10) NOT NULL,
  `show_playwright_ID` int(10) NOT NULL,
  `gallery_ID` int(5) NOT NULL,
  PRIMARY KEY (`show_ID`),
  KEY `show_gallery_show` (`gallery_ID`),
  KEY `composer_show_show` (`show_composer_ID`),
  KEY `lyrics_show_show` (`show_lyrics_ID`),
  KEY `playwright_show_show` (`show_playwright_ID`),
  CONSTRAINT `composer_show_show` FOREIGN KEY (`show_composer_ID`) REFERENCES `show_composer` (`show_composer_ID`),
  CONSTRAINT `lyrics_show_show` FOREIGN KEY (`show_lyrics_ID`) REFERENCES `show_lyrics` (`show_lyrics_ID`),
  CONSTRAINT `playwright_show_show` FOREIGN KEY (`show_playwright_ID`) REFERENCES `show_playwright` (`show_playwright_ID`),
  CONSTRAINT `show_gallery_show` FOREIGN KEY (`gallery_ID`) REFERENCES `gallery` (`gallery_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `show` */

/*Table structure for table `show_award` */

DROP TABLE IF EXISTS `show_award`;

CREATE TABLE `show_award` (
  `award_type_ID` int(3) NOT NULL,
  `award_ID` int(5) NOT NULL,
  `year_award` int(4) NOT NULL,
  `result_award` varchar(10) NOT NULL,
  `production_ID` int(10) NOT NULL,
  `show_ID` int(10) NOT NULL,
  PRIMARY KEY (`award_type_ID`,`award_ID`,`year_award`,`result_award`,`production_ID`,`show_ID`),
  KEY `award_ID_show_award` (`award_ID`),
  KEY `production_show_award` (`production_ID`),
  KEY `show_show_award` (`show_ID`),
  CONSTRAINT `award_ID_show_award` FOREIGN KEY (`award_ID`) REFERENCES `award` (`award_ID`),
  CONSTRAINT `award_type_show_award` FOREIGN KEY (`award_type_ID`) REFERENCES `award_type` (`award_type_ID`),
  CONSTRAINT `production_show_award` FOREIGN KEY (`production_ID`) REFERENCES `production` (`production_ID`),
  CONSTRAINT `show_show_award` FOREIGN KEY (`show_ID`) REFERENCES `show` (`show_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `show_award` */

/*Table structure for table `show_composer` */

DROP TABLE IF EXISTS `show_composer`;

CREATE TABLE `show_composer` (
  `show_composer_ID` int(10) NOT NULL AUTO_INCREMENT,
  `show_composer_name` varchar(100) NOT NULL,
  PRIMARY KEY (`show_composer_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `show_composer` */

/*Table structure for table `show_info` */

DROP TABLE IF EXISTS `show_info`;

CREATE TABLE `show_info` (
  `show_ID` int(10) NOT NULL,
  `show_title` varchar(250) NOT NULL,
  `show_duration` int(4) NOT NULL,
  `show_premiere_date` date NOT NULL,
  `show_plot` varchar(250) NOT NULL,
  `show_pic` varchar(100) NOT NULL,
  `show_logo` varchar(100) NOT NULL,
  PRIMARY KEY (`show_ID`),
  CONSTRAINT `show_info_show` FOREIGN KEY (`show_ID`) REFERENCES `show` (`show_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `show_info` */

/*Table structure for table `show_lyrics` */

DROP TABLE IF EXISTS `show_lyrics`;

CREATE TABLE `show_lyrics` (
  `show_lyrics_ID` int(10) NOT NULL,
  `show_lyrics_name` varchar(100) NOT NULL,
  PRIMARY KEY (`show_lyrics_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `show_lyrics` */

/*Table structure for table `show_playwright` */

DROP TABLE IF EXISTS `show_playwright`;

CREATE TABLE `show_playwright` (
  `show_playwright_ID` int(10) NOT NULL,
  `show_playwright_name` varchar(100) NOT NULL,
  PRIMARY KEY (`show_playwright_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `show_playwright` */

/*Table structure for table `show_type` */

DROP TABLE IF EXISTS `show_type`;

CREATE TABLE `show_type` (
  `show_type_ID` int(1) NOT NULL AUTO_INCREMENT,
  `show_type_name` varchar(20) NOT NULL,
  PRIMARY KEY (`show_type_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `show_type` */

insert  into `show_type`(`show_type_ID`,`show_type_name`) values 
(1,'Musical'),
(2,'Play');

/*Table structure for table `skill` */

DROP TABLE IF EXISTS `skill`;

CREATE TABLE `skill` (
  `skill_ID` int(5) NOT NULL AUTO_INCREMENT,
  `skills_name` varchar(50) NOT NULL,
  PRIMARY KEY (`skill_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `skill` */

/*Table structure for table `state` */

DROP TABLE IF EXISTS `state`;

CREATE TABLE `state` (
  `state_ID` int(5) NOT NULL AUTO_INCREMENT,
  `state_name` varchar(50) NOT NULL,
  `country_ID` int(3) DEFAULT NULL,
  `continent_ID` int(1) DEFAULT NULL,
  PRIMARY KEY (`state_ID`),
  KEY `state_continent` (`continent_ID`),
  KEY `state_country` (`country_ID`),
  CONSTRAINT `state_continent` FOREIGN KEY (`continent_ID`) REFERENCES `continent` (`continent_ID`),
  CONSTRAINT `state_country` FOREIGN KEY (`country_ID`) REFERENCES `country` (`country_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=latin1;

/*Data for the table `state` */

insert  into `state`(`state_ID`,`state_name`,`country_ID`,`continent_ID`) values 
(1,'England',104,6),
(2,'Northern Ireland',104,6),
(3,'Scotland',104,6),
(4,'Wales',104,6);

/*Table structure for table `theatre` */

DROP TABLE IF EXISTS `theatre`;

CREATE TABLE `theatre` (
  `theatre_ID` int(10) NOT NULL AUTO_INCREMENT,
  `theatre_name` varchar(100) NOT NULL,
  `continent_ID` int(1) NOT NULL,
  `country_ID` int(3) NOT NULL,
  `state_ID` int(5) NOT NULL,
  `region_ID` int(5) NOT NULL,
  `theatre_street_name` varchar(250) NOT NULL,
  `theatre_postcode` varchar(10) NOT NULL,
  `theater_latitude` varchar(25) NOT NULL,
  `theatre_latitude_direction` char(1) NOT NULL,
  `theatre_longitude` varchar(25) NOT NULL,
  `theatre_longitude_direction` char(1) NOT NULL,
  `theatre_website` varchar(100) DEFAULT NULL,
  `theatre_architect` varchar(100) NOT NULL,
  `theatre_original_name` varchar(100) NOT NULL,
  `theatre_history` varchar(100) DEFAULT NULL,
  `theatre_setaplan_pic` varchar(100) NOT NULL,
  `theatre_owner` varchar(200) NOT NULL,
  `theatre_contact_phone` int(10) NOT NULL,
  `theatre_contact_email` varchar(100) NOT NULL,
  `theatre_picture` varchar(100) NOT NULL,
  PRIMARY KEY (`theatre_ID`),
  KEY `theatre_continent` (`continent_ID`),
  KEY `theatre_country` (`country_ID`),
  KEY `theatre_state` (`state_ID`),
  KEY `theatre_region` (`region_ID`),
  CONSTRAINT `theatre_continent` FOREIGN KEY (`continent_ID`) REFERENCES `continent` (`continent_ID`),
  CONSTRAINT `theatre_country` FOREIGN KEY (`country_ID`) REFERENCES `country` (`country_ID`),
  CONSTRAINT `theatre_region` FOREIGN KEY (`region_ID`) REFERENCES `region` (`region_ID`),
  CONSTRAINT `theatre_state` FOREIGN KEY (`state_ID`) REFERENCES `state` (`state_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `theatre` */

/*Table structure for table `theatre_level` */

DROP TABLE IF EXISTS `theatre_level`;

CREATE TABLE `theatre_level` (
  `theatre_level_ID` int(2) NOT NULL AUTO_INCREMENT,
  `theatre_level_name` varchar(50) NOT NULL,
  `theatre_ID` int(10) NOT NULL,
  PRIMARY KEY (`theatre_level_ID`,`theatre_ID`),
  KEY `theatre_level_theatre` (`theatre_ID`),
  CONSTRAINT `theatre_level_theatre` FOREIGN KEY (`theatre_ID`) REFERENCES `theatre` (`theatre_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `theatre_level` */

/*Table structure for table `theatre_row` */

DROP TABLE IF EXISTS `theatre_row`;

CREATE TABLE `theatre_row` (
  `theatre_row_ID` int(3) NOT NULL AUTO_INCREMENT,
  `theatre_row_name` varchar(20) NOT NULL,
  `theatre_level_ID` int(2) NOT NULL,
  `theatre_ID` int(10) NOT NULL,
  PRIMARY KEY (`theatre_row_ID`,`theatre_level_ID`,`theatre_ID`),
  KEY `theatre_level_ID` (`theatre_level_ID`),
  KEY `theatre_ID_level` (`theatre_ID`),
  CONSTRAINT `theatre_ID_level` FOREIGN KEY (`theatre_ID`) REFERENCES `theatre` (`theatre_ID`),
  CONSTRAINT `theatre_level_ID` FOREIGN KEY (`theatre_level_ID`) REFERENCES `theatre_level` (`theatre_level_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `theatre_row` */

/*Table structure for table `theatre_seatnumber` */

DROP TABLE IF EXISTS `theatre_seatnumber`;

CREATE TABLE `theatre_seatnumber` (
  `theatre_seatnumber_ID` int(10) NOT NULL AUTO_INCREMENT,
  `theatre_seatnumber_name` varchar(5) NOT NULL,
  `theatre_ID` int(10) NOT NULL,
  `theatre_level_ID` int(2) NOT NULL,
  `theatre_row_ID` int(3) NOT NULL,
  PRIMARY KEY (`theatre_seatnumber_ID`,`theatre_ID`,`theatre_level_ID`,`theatre_row_ID`),
  KEY `theatre_theatre_seatnumber` (`theatre_ID`),
  KEY `theatre_level_theatre_seatnumber` (`theatre_level_ID`),
  KEY `theatre_row` (`theatre_row_ID`),
  CONSTRAINT `theatre_level_theatre_seatnumber` FOREIGN KEY (`theatre_level_ID`) REFERENCES `theatre_level` (`theatre_level_ID`),
  CONSTRAINT `theatre_row` FOREIGN KEY (`theatre_row_ID`) REFERENCES `theatre_row` (`theatre_row_ID`),
  CONSTRAINT `theatre_theatre_seatnumber` FOREIGN KEY (`theatre_ID`) REFERENCES `theatre` (`theatre_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `theatre_seatnumber` */

/*Table structure for table `tv_exp_role_type` */

DROP TABLE IF EXISTS `tv_exp_role_type`;

CREATE TABLE `tv_exp_role_type` (
  `tv_exp_role_type_ID` int(2) NOT NULL AUTO_INCREMENT,
  `tv_exp_role_type_name` varchar(50) NOT NULL,
  PRIMARY KEY (`tv_exp_role_type_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tv_exp_role_type` */

/*Table structure for table `tv_experience_type` */

DROP TABLE IF EXISTS `tv_experience_type`;

CREATE TABLE `tv_experience_type` (
  `tv_experience_type_ID` int(2) NOT NULL AUTO_INCREMENT,
  `tv_experience_type_name` varchar(25) NOT NULL,
  PRIMARY KEY (`tv_experience_type_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tv_experience_type` */

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `user_ID` int(10) NOT NULL AUTO_INCREMENT,
  `user_firstname` varchar(50) NOT NULL,
  `user_middlename` varchar(50) DEFAULT NULL,
  `user_lastname` varchar(50) NOT NULL,
  `user_dob` date DEFAULT NULL,
  `gender_ID` int(1) NOT NULL,
  `user_height` varchar(10) DEFAULT NULL,
  `user_biography` varchar(250) DEFAULT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_phone` int(10) DEFAULT NULL,
  `user_password` varchar(25) NOT NULL,
  PRIMARY KEY (`user_ID`),
  KEY `user_gender` (`gender_ID`),
  CONSTRAINT `user_gender` FOREIGN KEY (`gender_ID`) REFERENCES `gender` (`gender_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user` */

/*Table structure for table `user_review_actor` */

DROP TABLE IF EXISTS `user_review_actor`;

CREATE TABLE `user_review_actor` (
  `user_review_actor_comment` varchar(250) NOT NULL,
  `user_review_actor_rating` int(1) NOT NULL,
  `user_review_actor_date` date NOT NULL,
  `actor_ID` int(10) NOT NULL,
  `user_ID` int(10) NOT NULL,
  PRIMARY KEY (`actor_ID`,`user_ID`),
  KEY `user_actor_review` (`user_ID`),
  CONSTRAINT `actor_user_review` FOREIGN KEY (`actor_ID`) REFERENCES `actor` (`actor_ID`),
  CONSTRAINT `user_actor_review` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user_review_actor` */

/*Table structure for table `user_review_production` */

DROP TABLE IF EXISTS `user_review_production`;

CREATE TABLE `user_review_production` (
  `user_review_production_ID` int(5) NOT NULL AUTO_INCREMENT,
  `user_review_production_comment` varchar(250) NOT NULL,
  `user_review_production_rating` int(1) NOT NULL,
  `user_review_production_date` date NOT NULL,
  `production_ID` int(10) NOT NULL,
  `user_ID` int(10) NOT NULL,
  PRIMARY KEY (`user_review_production_ID`,`production_ID`,`user_ID`),
  KEY `production_user_serview` (`production_ID`),
  KEY `user_user_review` (`user_ID`),
  CONSTRAINT `production_user_serview` FOREIGN KEY (`production_ID`) REFERENCES `production` (`production_ID`),
  CONSTRAINT `user_user_review` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user_review_production` */

/*Table structure for table `user_review_show` */

DROP TABLE IF EXISTS `user_review_show`;

CREATE TABLE `user_review_show` (
  `user_review_show_comment` varchar(250) NOT NULL,
  `user_review_show_rating` int(1) NOT NULL,
  `user_review_show_date` date NOT NULL,
  `show_ID` int(10) NOT NULL,
  `user_ID` int(10) NOT NULL,
  PRIMARY KEY (`show_ID`,`user_ID`),
  KEY `user_review_show` (`user_ID`),
  CONSTRAINT `show_review_show` FOREIGN KEY (`show_ID`) REFERENCES `show` (`show_ID`),
  CONSTRAINT `user_review_show` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user_review_show` */

/*Table structure for table `user_theatre_review` */

DROP TABLE IF EXISTS `user_theatre_review`;

CREATE TABLE `user_theatre_review` (
  `user_theatre_review_ID` int(10) NOT NULL AUTO_INCREMENT,
  `user_theatre_review_date` date NOT NULL,
  `user_theatre_review_rating` int(1) NOT NULL,
  `user_theatre_review_comment` varchar(250) NOT NULL,
  `theatre_ID` int(10) NOT NULL,
  `user_ID` int(10) NOT NULL,
  PRIMARY KEY (`user_theatre_review_ID`,`theatre_ID`,`user_ID`),
  KEY `theatre_user_review` (`theatre_ID`),
  KEY `user_threatre_review` (`user_ID`),
  CONSTRAINT `theatre_user_review` FOREIGN KEY (`theatre_ID`) REFERENCES `theatre` (`theatre_ID`),
  CONSTRAINT `user_threatre_review` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user_theatre_review` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
