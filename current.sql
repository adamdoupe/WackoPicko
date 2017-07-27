-- MySQL dump 10.11
--
-- Host: localhost    Database: wackopicko
-- ------------------------------------------------------
-- Server version	5.0.67-0ubuntu6

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE IF NOT EXISTS `wackopicko`;

CREATE USER 'wackopicko'@'%' IDENTIFIED BY 'webvuln!@#';

GRANT USAGE ON * . * TO 'wackopicko'@'%' IDENTIFIED BY 'webvuln!@#' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0 ;

GRANT SELECT , INSERT , UPDATE , DELETE , CREATE , DROP , INDEX , ALTER , CREATE TEMPORARY TABLES , CREATE VIEW , SHOW VIEW , CREATE ROUTINE, ALTER ROUTINE, EXECUTE ON `wackopicko` . * TO 'wackopicko'@'%';


--
-- Table structure for table `admin`
--

USE `wackopicko`;

DROP TABLE IF EXISTS `admin`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `admin` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `login` varchar(50) NOT NULL,
  `password` char(40) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin','d033e22ae348aeb5660fc2140aec35850c4da997'),(2,'adamd','c533607326f2b815a7c23701be52989dac8bdbb1'),(3,'admin','d033e22ae348aeb5660fc2140aec35850c4da997'),(4,'adam','0ace61762d02afdf98f793d98c37edf696b675b2'),(5,'bob','42a9037223cdbfe0c49ef0032f0a1f3392af3fe3');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_session`
--

DROP TABLE IF EXISTS `admin_session`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `admin_session` (
  `id` int(11) NOT NULL auto_increment,
  `admin_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `admin_session`
--

LOCK TABLES `admin_session` WRITE;
/*!40000 ALTER TABLE `admin_session` DISABLE KEYS */;
INSERT INTO `admin_session` VALUES (2,1,'2009-01-21 17:41:59');
/*!40000 ALTER TABLE `admin_session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `cart` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart_coupons`
--

DROP TABLE IF EXISTS `cart_coupons`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `cart_coupons` (
  `cart_id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  KEY `cart_id` (`cart_id`,`coupon_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `cart_coupons`
--

LOCK TABLES `cart_coupons` WRITE;
/*!40000 ALTER TABLE `cart_coupons` DISABLE KEYS */;
INSERT INTO `cart_coupons` VALUES (0,0),(2,1),(2,1),(2,1),(3,1);
/*!40000 ALTER TABLE `cart_coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart_items`
--

DROP TABLE IF EXISTS `cart_items`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL auto_increment,
  `cart_id` int(11) NOT NULL,
  `picture_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `cart_items`
--

LOCK TABLES `cart_items` WRITE;
/*!40000 ALTER TABLE `cart_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `text` varchar(500) NOT NULL,
  `user_id` int(11) NOT NULL,
  `picture_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,'blah.	      ',2,3,'2009-01-12 19:05:45'),(2,'That\\\'s an awesome butt...',2,2,'2009-01-12 19:26:21'),(3,'	      testing',2,5,'2009-01-21 15:32:44'),(4,'This is my house, what do you guys think?',2,11,'2009-02-18 14:55:39');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments_preview`
--

DROP TABLE IF EXISTS `comments_preview`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `comments_preview` (
  `id` int(11) NOT NULL auto_increment,
  `text` varchar(500) NOT NULL,
  `user_id` int(11) NOT NULL,
  `picture_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `comments_preview`
--

LOCK TABLES `comments_preview` WRITE;
/*!40000 ALTER TABLE `comments_preview` DISABLE KEYS */;
INSERT INTO `comments_preview` VALUES (1,'blah.	      ',2,3,'2009-01-12 19:01:49'),(2,'blah.	      ',2,3,'2009-01-12 19:02:12'),(3,'blah.	      ',2,3,'2009-01-12 19:02:52'),(4,'blah.	      ',2,3,'2009-01-12 19:05:45'),(5,'You suck. Should I use this?	      ',2,3,'2009-01-12 19:06:43'),(6,'That\\\'s an awesome butt...',2,2,'2009-01-12 19:21:40'),(7,'That\\\'s an awesome butt...',2,2,'2009-01-12 19:25:52'),(8,'That\\\'s an awesome butt...',2,2,'2009-01-12 19:26:21'),(9,'	      test',2,5,'2009-01-21 15:06:05'),(11,'	      testing',2,5,'2009-01-21 15:32:44'),(12,'This is my house, what do you guys think?',2,11,'2009-02-18 14:55:39');
/*!40000 ALTER TABLE `comments_preview` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conflict_pictures`
--

DROP TABLE IF EXISTS `conflict_pictures`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `conflict_pictures` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `orig_filename` varchar(255) NOT NULL,
  `new_filename` varchar(255) NOT NULL,
  `new_tag` varchar(255) NOT NULL,
  `new_name` varchar(255) NOT NULL,
  `new_price` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `conflict_pictures`
--

LOCK TABLES `conflict_pictures` WRITE;
/*!40000 ALTER TABLE `conflict_pictures` DISABLE KEYS */;
/*!40000 ALTER TABLE `conflict_pictures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `coupons` (
  `id` int(11) NOT NULL auto_increment,
  `code` varchar(10) NOT NULL,
  `discount` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
INSERT INTO `coupons` VALUES (1,'SUPERYOU21',90),(2,'SUPERYOU21',90);
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `guestbook`
--

DROP TABLE IF EXISTS `guestbook`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `guestbook` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `created_on` datetime NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `guestbook`
--

LOCK TABLES `guestbook` WRITE;
/*!40000 ALTER TABLE `guestbook` DISABLE KEYS */;
INSERT INTO `guestbook` VALUES (1,'adam','Hi, I love your site!','2008-12-02 19:32:53');
/*!40000 ALTER TABLE `guestbook` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `own`
--

DROP TABLE IF EXISTS `own`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `own` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `picture_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `own`
--

LOCK TABLES `own` WRITE;
/*!40000 ALTER TABLE `own` DISABLE KEYS */;
INSERT INTO `own` VALUES (1,2,3),(2,2,2),(3,11,10);
/*!40000 ALTER TABLE `own` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pictures`
--

DROP TABLE IF EXISTS `pictures`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pictures` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(200) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `tag` varchar(100) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `high_quality` varchar(250) NOT NULL,
  `created_on` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pictures`
--

LOCK TABLES `pictures` WRITE;
/*!40000 ALTER TABLE `pictures` DISABLE KEYS */;
INSERT INTO `pictures` VALUES (10,'Awesome Flower Pic',128,128,'flowers','flowers/flowers',26,'NjE4NDgwOQ==','2009-02-18 14:54:56',2),(9,'The Boys - In costume',128,128,'toga','toga/togasfs',20,'MTk1NDMxOQ==','2009-02-18 14:54:13',9),(8,'Me and the Girls',128,128,'toga','toga/togas',10,'MTc3Mjgx','2009-02-18 14:53:48',9),(7,'My Dog',128,128,'doggie','doggie/Dog.jpg',15,'OTA5MjA1NA==','2009-02-18 14:50:30',1),(11,'My House!',128,128,'house','house/My_House',16,'ODExNzIzOQ==','2009-02-18 14:55:20',2),(12,'Beautiful Waterfall',128,128,'waterfall','waterfall/Waterfall',10,'ODQ4OTkx','2009-02-18 14:56:47',10),(13,'Our House',128,128,'house','house/our_house',30,'OTE4MzM1Mw==','2009-02-18 14:57:18',10),(14,'The house I share',128,128,'house','house/hodjjgld',20,'MzM4OTU3MA==','2009-02-18 14:57:58',11),(15,'This grows outside my house',128,128,'flowers','flowers/flweofoee',40,'ODcxNDAyNA==','2009-02-18 14:58:33',11);
/*!40000 ALTER TABLE `pictures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `login` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `password` char(40) NOT NULL,
  `salt` char(4) NOT NULL,
  `tradebux` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `last_login_on` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Sample User','Sample','User','3e912f8fc814831804d735dc2fcbc3cfa75c28e3','NjM2',130,'2009-01-05 14:29:00','2009-02-18 14:50:00'),(2,'bob','I Am Bob','Gilbert','abd09072e674720d87ddd27122f67eedbc4b0d08','Mjkx',96,'2009-01-05 14:51:05','2009-02-18 14:54:26'),(4,'scanner1','Scanner','1','af256af3d4fda990dbe546daa04e5c75eae356ea','ODUy',100,'2009-02-18 14:46:21','2009-02-18 14:46:21'),(5,'scanner2','Scanner','2','f9335d39b2b78018c2b8affa7fc7b0917a3300a7','MzI5',100,'2009-02-18 14:46:34','2009-02-18 14:46:34'),(6,'scanner3','Scanner','3','43754746b4043c852864bb321e4f2648d1421c18','Nzk3',100,'2009-02-18 14:46:51','2009-02-18 14:46:51'),(7,'scanner4','Number','4','e514a672396679528c766a92a857eac4b22bc667','NjEx',100,'2009-02-18 14:47:04','2009-02-18 14:47:04'),(8,'scanner5','Number','5','f38ae9b0b6b1ad2a2a2721841c0cc89b31e044cb','NTQw',100,'2009-02-18 14:47:18','2009-02-18 14:47:18'),(9,'wanda','Wanda','Granat','4e4465300b14b314384a6375a837f0532822d3c8','Nzcz',100,'2009-02-18 14:53:23','2009-02-18 14:53:23'),(10,'calvinwatters','Calvin','Watters','81418ed6e9bd15076d2f43e17b9f5a27c7e55ef7','Nzc5',100,'2009-02-18 14:56:11','2009-02-18 14:56:11'),(11,'bryce','Bryce','Boe','478fb0b83851b3d16ffc5a2554a4d616f1235156','NjY3',74,'2009-02-18 14:57:36','2009-02-18 14:57:36');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2009-02-18 23:11:29
