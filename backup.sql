-- MySQL dump 10.13  Distrib 5.7.32, for osx10.12 (x86_64)
--
-- Host: localhost    Database: onlineloan
-- ------------------------------------------------------
-- Server version	5.7.32

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

--
-- Table structure for table `administrators`
--

DROP TABLE IF EXISTS `administrators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administrators` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_73A716FBF396750` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrators`
--

LOCK TABLES `administrators` WRITE;
/*!40000 ALTER TABLE `administrators` DISABLE KEYS */;
INSERT INTO `administrators` VALUES (1);
/*!40000 ALTER TABLE `administrators` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `literary_genre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `release_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (1,'Charles Baudelaire','Les fleurs du Mal','default_cover.jpg','Un très beau livre qui vaut le détour !','Poésie','1857-06-21'),(2,'Corneille','Le Cid','default_cover.jpg','Un très beau livre qui vaut le détour !','Théâtre','1850-07-22'),(3,'Choderlos de Laclos','Les liaisons dangereuses','default_cover.jpg','Un très beau livre qui vaut le détour !','littérature','1782-02-02'),(4,'Honoré de Balzac','Le père Goriot','default_cover.jpg','Un très beau livre qui vaut le détour !','littérature','1835-05-10'),(5,'Alexandre Dumas','Le comte de Monte Cristo','default_cover.jpg','Un très beau livre qui vaut le détour !','Littérature','1857-06-21'),(6,'Victor Hugo','Les Misérables','default_cover.jpg','Un très beau livre qui vaut le détour !','Littérature','1862-02-19'),(7,'Emile Zola','Nana','default_cover.jpg','Un très beau livre qui vaut le détour !','Littérature','1862-02-19'),(8,'Marcel Proust','A la recherche du temps perdu','default_cover.jpg','Un très beau livre qui vaut le détour !','Littérature','1862-02-19'),(9,'Colette','Le blé en herbe','default_cover.jpg','Un très beau livre qui vaut le détour !','Fantastique','1862-02-19'),(10,'Louis Ferdinand Céline','Voyage au bout de la nuit','default_cover.jpg','Un très beau livre qui vaut le détour !','Fantastique','2000-02-19'),(11,'Marcel Pagnol','La gloire de mon père','default_cover.jpg','Un très beau livre qui vaut le détour !','Littérature','1890-02-19'),(12,'Charles Baudelaire','Les fleurs du Mal','default_cover.jpg','Un très beau livre qui vaut le détour !','Poésie','1857-06-21'),(13,'Choderlos de Laclos','Les liaisons dangereuses','default_cover.jpg','Un très beau livre qui vaut le détour !','littérature','1782-02-02'),(14,'Honoré de Balzac','Le père Goriot','default_cover.jpg','Un très beau livre qui vaut le détour !','littérature','1835-05-10'),(15,'Alexandre Dumas','Le comte de Monte Cristo','default_cover.jpg','Un très beau livre qui vaut le détour !','Littérature','1857-06-21'),(16,'Victor Hugo','Les Misérables','default_cover.jpg','Un très beau livre qui vaut le détour !','Littérature','1862-02-19'),(17,'Emile Zola','Nana','default_cover.jpg','Un très beau livre qui vaut le détour !','Littérature','1862-02-19'),(18,'Marcel Proust','A la recherche du temps perdu','default_cover.jpg','Un très beau livre qui vaut le détour !','Littérature','1862-02-19'),(19,'Colette','Le blé en herbe','default_cover.jpg','Un très beau livre qui vaut le détour !','Fantastique','1862-02-19'),(20,'Louis Ferdinand Céline','Voyage au bout de la nuit','default_cover.jpg','Un très beau livre qui vaut le détour !','Fantastique','2000-02-19'),(21,'Marcel Pagnol','La gloire de mon père','default_cover.jpg','Un très beau livre qui vaut le détour !','Littérature','1890-02-19'),(22,'Simone de Beauvoir','La vieillesse','default_cover.jpg','Un très beau livre qui vaut le détour !','Essai','1970-11-11'),(23,'Choderlos de Laclos','Les liaisons dangereuses','default_cover.jpg','Un très beau livre qui vaut le détour !','littérature','1782-02-02'),(24,'Honoré de Balzac','Le père Goriot','default_cover.jpg','Un très beau livre qui vaut le détour !','littérature','1835-05-10'),(25,'Alexandre Dumas','Le comte de Monte Cristo','default_cover.jpg','Un très beau livre qui vaut le détour !','Littérature','1857-06-21'),(26,'Victor Hugo','Les Misérables','default_cover.jpg','Un très beau livre qui vaut le détour !','Littérature','1862-02-19'),(27,'Emile Zola','Nana','default_cover.jpg','Un très beau livre qui vaut le détour !','Littérature','1862-02-19'),(28,'Marcel Proust','A la recherche du temps perdu','default_cover.jpg','Un très beau livre qui vaut le détour !','Littérature','1862-02-19'),(29,'Colette','Le blé en herbe','default_cover.jpg','Un très beau livre qui vaut le détour !','Fantastique','1862-02-19'),(30,'Louis Ferdinand Céline','Voyage au bout de la nuit','default_cover.jpg','Un très beau livre qui vaut le détour !','Fantastique','2000-02-19'),(31,'Marcel Pagnol','La gloire de mon père','default_cover.jpg','Un très beau livre qui vaut le détour !','Littérature','1890-02-19'),(32,'Simone de Beauvoir','La vieillesse','default_cover.jpg','Un très beau livre qui vaut le détour !','Essai','1970-11-11'),(33,'Choderlos de Laclos','Les liaisons dangereuses','default_cover.jpg','Un très beau livre qui vaut le détour !','littérature','1782-02-02'),(34,'Honoré de Balzac','Le père Goriot','default_cover.jpg','Un très beau livre qui vaut le détour !','littérature','1835-05-10'),(35,'Alexandre Dumas','Le comte de Monte Cristo','default_cover.jpg','Un très beau livre qui vaut le détour !','Polar','1857-06-21'),(36,'Victor Hugo','Les Misérables','default_cover.jpg','Un très beau livre qui vaut le détour !','Polar','1862-02-19'),(37,'Emile Zola','Nana','default_cover.jpg','Un très beau livre qui vaut le détour !','Polar','1862-02-19'),(38,'Marcel Proust','A la recherche du temps perdu','default_cover.jpg','Un très beau livre qui vaut le détour !','Polar','1862-02-19'),(39,'Colette','Le blé en herbe','default_cover.jpg','Un très beau livre qui vaut le détour !','Fantastique','1862-02-19'),(40,'Louis Ferdinand Céline','Voyage au bout de la nuit','default_cover.jpg','Un très beau livre qui vaut le détour !','Fantastique','2000-02-19'),(41,'Marcel Pagnol','La gloire de mon père','default_cover.jpg','Un très beau livre qui vaut le détour !','Littérature','1890-02-19'),(42,'Simone de Beauvoir','La vieillesse','default_cover.jpg','Un très beau livre qui vaut le détour !','Essai','1970-11-11'),(43,'julia','blablabla','default_cover.jpg','2021-11-11','Polar','1825-02-02'),(44,'<strong>gras</strong>','<script>window.alert(\'hehehe\');</script>','default_cover.jpg','testeu','Théâtre','1821-03-01');
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_62534E21BF396750` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (3,'John','Doe','1980-10-19','120 rue des Rosiers','44000','NANTES'),(4,'John','Doe','1911-01-01','11 rue du Tapioka','94200','PARIS'),(5,'touc','touc','1911-01-01','tcoucou','44800','SAINT HERBALI'),(6,'New','Customer','1980-01-01','10 avenue du Général de Gaule','44800','SAINT HERBLAIN'),(7,'jeveux','uncompte','1989-01-01','92 rue de mon nouveau compte','92000','MON COMPTE');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20211021183154','2021-10-21 18:37:56',918),('DoctrineMigrations\\Version20211021183155','2021-10-21 20:17:42',1390);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_BA82C300BF396750` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (2);
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_4DA23916A2B381` (`book_id`),
  KEY `IDX_4DA239A76ED395` (`user_id`),
  CONSTRAINT `FK_4DA23916A2B381` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  CONSTRAINT `FK_4DA239A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservations`
--

LOCK TABLES `reservations` WRITE;
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
INSERT INTO `reservations` VALUES (1,3,1,'2021-10-01 19:10:31','2021-10-22 19:10:31','borrowed'),(2,3,2,'2021-10-01 19:10:31','2021-10-22 19:10:31','borrowed'),(3,3,5,'2021-10-01 19:10:31','2021-10-22 19:10:31','borrowed'),(6,3,6,'2021-11-07 22:28:44','2021-11-28 22:28:44','borrowed');
/*!40000 ALTER TABLE `reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin@admin.fr','[\"ROLE_ADMIN\"]','$2y$13$6isO0d6TewmVC01CgmvM5uCKF9XXTRaWfU5SF9VFwJjxzBsP2V0zK','validated','administrator'),(2,'employee@employee.fr','[\"ROLE_EMPLOYEE\"]','$2y$13$mfzkk7TMhOzFc.doTbAuH.jn2BQbq9m/zFM3gVj4aFYVcnT/TRIee','validated','employee'),(3,'customer@customer.fr','[\"ROLE_CUSTOMER\"]','$2y$13$IxoTzpZCs/mCEug1cb5sced5V1.Y1HYtbMxGQ9mzTNKZvWjiepl7i','validated','customer'),(4,'john.doe@mail.fr','[\"ROLE_CUSTOMER\"]','$2y$13$/dq7O/dzQ3BGNsFd/JnPDuGT0hq0/5gsMfiAX0SQa48qQFUqKpOiC','validated','customer'),(5,'touc@touc.fr','[\"ROLE_CUSTOMER\"]','$2y$13$e3b5q9eym4xaan/cPTB.luLl3282qhAEM1KEoXESzNhDlJ0CXOvTa','validated','customer'),(6,'newcustomer@mail.fr','[\"ROLE_CUSTOMER\"]','$2y$13$P8Eo6PCyuOy9ZZdl09eqbOuvaXEVd4eqw64TuI1ivJlZhzCLCZumy','validated','customer'),(7,'jeveuxuncompte@silteplait.fr','[\"ROLE_CUSTOMER\"]','$2y$13$uMCBxMYYFiQojGrTSKtLOepHGiod/LEiQz5RLSxqKeDybiVJjWW1S','pending','customer');
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

-- Dump completed on 2021-11-12 17:10:28
