-- mysqldump-php https://github.com/ifsnop/mysqldump-php
--
-- Host: localhost	Database: h2h_db
-- ------------------------------------------------------
-- Server version 	5.7.31
-- Date: Mon, 03 May 2021 19:59:55 +0000

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
-- Table structure for table `auth_assignment`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_assignment`
--

LOCK TABLES `auth_assignment` WRITE;
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `auth_assignment` VALUES ('admin','1',1620071758);
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `auth_assignment` with 1 row(s)
--

--
-- Table structure for table `auth_item`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item`
--

LOCK TABLES `auth_item` WRITE;
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `auth_item` VALUES ('Access db',2,'Access db',NULL,NULL,1577737693,1577737693),('Access Session',2,'Access Session',NULL,NULL,1565127671,1565209503),('Access Sessiondetail',2,'Access Sessiondetail',NULL,NULL,1565127753,1565127753),('admin',1,'Administrator of the first database  which serves to record all user data of the site. Users that are allowed to signup are designated a Manager role manually. ',NULL,NULL,1577666562,1589493021),('Backup Database',2,'Backup Database',NULL,NULL,1587080072,1587080072),('Create Carousal',2,'Create Carousal',NULL,NULL,1544661317,1544661317),('Create Company',2,'Create Company',NULL,NULL,1512856530,1549635086),('Create Daily Clean',2,'Create Daily Clean',NULL,NULL,1512856530,1512856530),('Create Daily Job Sheet',2,'Create Daily Job Sheet',NULL,NULL,1512856530,1512856530),('Create Employee',2,'Create Employee',NULL,NULL,1512856530,1549631754),('Create Gocardlesscustomer',2,'Create Gocardlesscustomer',NULL,NULL,1564057944,1564057944),('Create House',2,'Create House',NULL,NULL,1512856530,1549631786),('Create Instruction',2,'Create Instruction',NULL,NULL,1549631630,1549635056),('Create Legal',2,'Create Legal',NULL,NULL,1563032629,1563032629),('Create Mandate',2,'Create Mandate',NULL,NULL,1564647598,1564647598),('Create Messagelog',2,'Create Messagelog',NULL,NULL,1544660727,1544660727),('Create Messaging',2,'Create Messaging',NULL,NULL,1544659806,1544659991),('Create Postalcode',2,'Create Postalcode',NULL,NULL,1512856531,1549634117),('Create Street',2,'Create Street',NULL,NULL,1512856530,1512856530),('Create Tax',2,'Create Tax',NULL,NULL,1544662943,1544662943),('createItem',2,'Create item',NULL,NULL,1577666562,1577666562),('Delete Carousal',2,'Delete Carousal',NULL,NULL,1544661364,1544661364),('Delete Company',2,'Delete Company',NULL,NULL,1512856530,1512856530),('Delete Daily Clean',2,'Delete Daily Clean',NULL,NULL,1512856530,1512856530),('Delete Daily Job Sheet',2,'Delete Daily Job Sheet',NULL,NULL,1512856530,1512856530),('Delete Employee',2,'Delete Employee',NULL,NULL,1512856530,1512856530),('Delete House',2,'Delete House',NULL,NULL,1512856530,1512856530),('Delete Instruction',2,'Delete Instruction',NULL,NULL,1549634229,1549634229),('Delete Mandate',2,'Delete Mandate',NULL,NULL,1564647708,1564647708),('Delete Messagelog',2,'Delete Messagelog',NULL,NULL,1544660767,1544660767),('Delete Messaging',2,'Delete Messaging',NULL,NULL,1544660079,1544660079),('Delete Postalcode',2,'Delete Postalcode',NULL,NULL,1512856531,1512856531),('Delete Street',2,'Delete Street',NULL,NULL,1512856531,1549633538),('Delete Tax',2,'Delete Tax',NULL,NULL,1544662983,1544662983),('deleteItem',2,'Delete item',NULL,NULL,1577666562,1577666562),('Google Translate',2,'Google Translate',NULL,NULL,1589492946,1589492946),('Import Houses',2,'Import Houses',NULL,NULL,1573842472,1573842472),('Manage Admin',2,'Manage Admin',NULL,NULL,1577744346,1577744346),('Manage Basic',2,'Perform Basic Tasks',NULL,NULL,1578419959,1578419959),('Manage Money',2,'Manage Money',NULL,NULL,1546700864,1546700864),('manageRoles',2,'Manage Roles and Permissions',NULL,NULL,1577666562,1577666562),('manageUsers',2,'Manage Users',NULL,NULL,1577666562,1577666562),('Mdb1',1,'Manager of db1 that has create, update AND delete powers of all database tables received through the Support role',NULL,NULL,1577738006,1583578098),('See Prices',2,'See Prices',NULL,NULL,1583610917,1583610917),('support',1,'Create, update, delete all company specific data specific to designated database. Designation of database occurs through the Manager Specific Role',NULL,NULL,1577666562,1591269362),('Udb',1,'Subcontractor',NULL,NULL,1583583080,1583583080),('Update Carousal',2,'Update Carousal',NULL,NULL,1544661341,1544661341),('Update Company',2,'Update Company',NULL,NULL,1512856530,1512856530),('Update Daily Clean',2,'Update Daily Clean',NULL,NULL,1512856530,1512856530),('Update Daily Job Sheet',2,'Update Daily Job Sheet',NULL,NULL,1512856530,1512856530),('Update Employee',2,'Update Employee',NULL,NULL,1512856530,1512856530),('Update House',2,'Update House',NULL,NULL,1512856530,1512856530),('Update Instruction',2,'Update Instruction',NULL,NULL,1549634253,1549634253),('Update Mandate',2,'Update Mandate',NULL,NULL,1564647635,1564647635),('Update Messagelog',2,'Update Messagelog',NULL,NULL,1544660748,1544660748),('Update Messaging',2,'Update Messaging',NULL,NULL,1544660035,1544660035),('Update Postalcode',2,'Update Postalcode',NULL,NULL,1512856531,1512856531),('Update Street',2,'Update Street',NULL,NULL,1512856531,1512856531),('Update Tax',2,'Update Tax',NULL,NULL,1544662962,1544662962),('updateCommonUser',2,'Update user data, but not those of \'admin\'',NULL,NULL,1577666562,1577666562),('updateCreatedItem',2,'Update own item',NULL,NULL,1577666562,1577666562),('updateItem',2,'Update item',NULL,NULL,1577666562,1577666562),('updateUser',2,'Update user data',NULL,NULL,1577666562,1577666562),('View Bulletin Board',2,'View Bulletin Board',NULL,NULL,1563826631,1563826631),('View Carousal',2,'View Carousal',NULL,NULL,1558795525,1558795525),('View Company',2,'View Company',NULL,NULL,1512856530,1512856530),('View Daily Clean',2,'View Daily Clean',NULL,NULL,1546702743,1546702743),('View House',2,'View House',NULL,NULL,1583581575,1583581575),('View Instruction',2,'View Instruction',NULL,NULL,1549634202,1549635005),('View Mandate',2,'View Mandate',NULL,NULL,1564647670,1564647670),('View Revenue Reports',2,'View Revenue Reports',NULL,NULL,1564039903,1564039903);
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `auth_item` with 71 row(s)
--

--
-- Table structure for table `auth_item_child`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item_child`
--

LOCK TABLES `auth_item_child` WRITE;
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `auth_item_child` VALUES ('admin','Access db'),('Mdb0','Access db'),('Udb','Access db'),('Mdb1','Access db1'),('admin','Access paypalagreement'),('admin','Access Session'),('admin','Access Sessiondetail'),('admin','Backup Database'),('admin','Create Carousal'),('manager','Create Carousal'),('support','Create Carousal'),('admin','Create Company'),('admin','Create Daily Clean'),('manager','Create Daily Clean'),('support','Create Daily Clean'),('admin','Create Daily Job Sheet'),('manager','Create Daily Job Sheet'),('support','Create Daily Job Sheet'),('admin','Create Employee'),('manager','Create Employee'),('support','Create Employee'),('admin','Create Gocardlesscustomer'),('manager','Create Gocardlesscustomer'),('support','Create Gocardlesscustomer'),('admin','Create House'),('manager','Create House'),('support','Create House'),('admin','Create Instruction'),('manager','Create Instruction'),('support','Create Instruction'),('admin','Create Legal'),('manager','Create Legal'),('support','Create Legal'),('admin','Create Mandate'),('manager','Create Mandate'),('support','Create Mandate'),('admin','Create Messagelog'),('manager','Create Messagelog'),('support','Create Messagelog'),('admin','Create Messaging'),('manager','Create Messaging'),('support','Create Messaging'),('admin','Create Postalcode'),('manager','Create Postalcode'),('support','Create Postalcode'),('admin','Create Street'),('manager','Create Street'),('support','Create Street'),('admin','Create Tax'),('manager','Create Tax'),('support','Create Tax'),('admin','createItem'),('admin','Delete Carousal'),('manager','Delete Carousal'),('support','Delete Carousal'),('admin','Delete Company'),('admin','Delete Daily Clean'),('manager','Delete Daily Clean'),('support','Delete Daily Clean'),('admin','Delete Daily Job Sheet'),('manager','Delete Daily Job Sheet'),('support','Delete Daily Job Sheet'),('admin','Delete Employee'),('manager','Delete Employee'),('support','Delete Employee'),('admin','Delete House'),('manager','Delete House'),('support','Delete House'),('admin','Delete Instruction'),('manager','Delete Instruction'),('support','Delete Instruction'),('admin','Delete Mandate'),('manager','Delete Mandate'),('support','Delete Mandate'),('admin','Delete Messagelog'),('manager','Delete Messagelog'),('support','Delete Messagelog'),('admin','Delete Messaging'),('manager','Delete Messaging'),('support','Delete Messaging'),('admin','Delete Postalcode'),('manager','Delete Postalcode'),('support','Delete Postalcode'),('admin','Delete Street'),('manager','Delete Street'),('support','Delete Street'),('admin','Delete Tax'),('manager','Delete Tax'),('support','Delete Tax'),('admin','deleteItem'),('admin','Google Translate'),('admin','Import Houses'),('manager','Import Houses'),('support','Import Houses'),('admin','Manage Admin'),('manager','Manage Admin'),('Mdb0','Manage Admin'),('Mdb1','Manage Admin'),('admin','Manage Basic'),('employee','Manage Basic'),('manager','Manage Basic'),('Mdb1','Manage Basic'),('support','Manage Basic'),('Udb','Manage Basic'),('admin','Manage Money'),('support','Manage Money'),('admin','manageRoles'),('admin','manageUsers'),('Mdb0','manageUsers'),('support','manageUsers'),('admin','See Prices'),('support','See Prices'),('Mdb0','support'),('Mdb1','support'),('admin','Update Carousal'),('manager','Update Carousal'),('support','Update Carousal'),('admin','Update Company'),('manager','Update Company'),('support','Update Company'),('admin','Update Daily Clean'),('manager','Update Daily Clean'),('support','Update Daily Clean'),('admin','Update Daily Job Sheet'),('manager','Update Daily Job Sheet'),('support','Update Daily Job Sheet'),('admin','Update Employee'),('manager','Update Employee'),('support','Update Employee'),('admin','Update House'),('manager','Update House'),('support','Update House'),('admin','Update Instruction'),('manager','Update Instruction'),('support','Update Instruction'),('admin','Update Mandate'),('manager','Update Mandate'),('support','Update Mandate'),('admin','Update Messagelog'),('manager','Update Messagelog'),('support','Update Messagelog'),('admin','Update Messaging'),('manager','Update Messaging'),('support','Update Messaging'),('admin','Update Postalcode'),('manager','Update Postalcode'),('support','Update Postalcode'),('admin','Update Street'),('manager','Update Street'),('support','Update Street'),('admin','Update Tax'),('manager','Update Tax'),('support','Update Tax'),('support','updateCommonUser'),('admin','updateCreatedItem'),('admin','updateItem'),('updateCreatedItem','updateItem'),('admin','updateUser'),('updateCommonUser','updateUser'),('admin','View Bulletin Board'),('manager','View Bulletin Board'),('support','View Bulletin Board'),('admin','View Carousal'),('manager','View Carousal'),('support','View Carousal'),('admin','View Company'),('manager','View Company'),('support','View Company'),('admin','View Daily Clean'),('manager','View Daily Clean'),('support','View Daily Clean'),('Udb','View Daily Clean'),('Udb3','View Daily Clean'),('Udb4','View Daily Clean'),('admin','View House'),('support','View House'),('admin','View Instruction'),('manager','View Instruction'),('support','View Instruction'),('admin','View Mandate'),('manager','View Mandate'),('support','View Mandate'),('admin','View Revenue Reports'),('manager','View Revenue Reports'),('support','View Revenue Reports');
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `auth_item_child` with 185 row(s)
--

--
-- Table structure for table `auth_rule`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_rule`
--

LOCK TABLES `auth_rule` WRITE;
/*!40000 ALTER TABLE `auth_rule` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `auth_rule` VALUES ('hasNotRole','O:29:\"sjaakp\\pluto\\rbac\\NotRoleRule\":3:{s:4:\"name\";s:10:\"hasNotRole\";s:9:\"createdAt\";i:1577666562;s:9:\"updatedAt\";i:1577666562;}',1577666562,1577666562),('hasRole','O:26:\"sjaakp\\pluto\\rbac\\RoleRule\":3:{s:4:\"name\";s:7:\"hasRole\";s:9:\"createdAt\";i:1577666562;s:9:\"updatedAt\";i:1577666562;}',1577666562,1577666562),('isCreator','O:29:\"sjaakp\\pluto\\rbac\\CreatorRule\":3:{s:4:\"name\";s:9:\"isCreator\";s:9:\"createdAt\";i:1577666562;s:9:\"updatedAt\";i:1577666562;}',1577666562,1577666562),('isCreatorOrUpdater','O:38:\"sjaakp\\pluto\\rbac\\CreatorOrUpdaterRule\":3:{s:4:\"name\";s:18:\"isCreatorOrUpdater\";s:9:\"createdAt\";i:1577666562;s:9:\"updatedAt\";i:1577666562;}',1577666562,1577666562),('isUpdater','O:29:\"sjaakp\\pluto\\rbac\\UpdaterRule\":3:{s:4:\"name\";s:9:\"isUpdater\";s:9:\"createdAt\";i:1577666562;s:9:\"updatedAt\";i:1577666562;}',1577666562,1577666562);
/*!40000 ALTER TABLE `auth_rule` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `auth_rule` with 5 row(s)
--

--
-- Table structure for table `message`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `language` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `translation` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`,`language`),
  KEY `idx_message_language` (`language`),
  CONSTRAINT `fk_message_id` FOREIGN KEY (`id`) REFERENCES `source_message` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `message` with 0 row(s)
--

--
-- Table structure for table `migration`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `migration` VALUES ('m000000_000000_base',1620071633),('sjaakp\\pluto\\migrations\\m000000_000000_init',1620071637),('frontend\\migrations\\m191110_221831_Mass',1620071658),('frontend\\migrations\\m191207_152415_works_taxDataInsert',1620071659),('frontend\\migrations\\m191207_155342_works_instructionDataInsert',1620071659),('frontend\\migrations\\m191207_161454_works_importhouses',1620071659),('frontend\\migrations\\m200125_075111_carousal_id_fix',1620071660),('console\\migrations\\auth\\m200413_073958_auth_assignment',1620071660),('console\\migrations\\auth\\m200413_073959_auth_item',1620071661),('console\\migrations\\auth\\m200413_074000_auth_item_child',1620071662),('console\\migrations\\auth\\m200413_074001_auth_rule',1620071662),('console\\migrations\\auth\\m200413_082835_auth_itemDataInsert',1620071662),('console\\migrations\\auth\\m200413_082924_auth_item_childDataInsert',1620071662),('console\\migrations\\auth\\m200413_085036_auth_ruleDataInsert',1620071662),('frontend\\migrations\\m200414_125047_works_companyDataInsert',1620071662),('frontend\\migrations\\m200521_152727_works_historyline',1620071663),('frontend\\migrations\\m200611_075111_listprice_fix',1620071663),('frontend\\migrations\\m200611_152727_add_image_source_filename_column_image_web_filename_column_to_works_product',1620071664),('frontend\\migrations\\m200613_215223_works_krajee_product_tree',1620071665),('frontend\\migrations\\m200621_152727_add_product_id_column_productsubcategory_id_column_productcategory_id_column_to_works_krajee_product_tree',1620071667),('frontend\\migrations\\m200627_075111_product_productnumber_fix_width',1620071667),('frontend\\migrations\\m200708_152727_create_productnumber_index_works_product',1620071667),('frontend\\migrations\\m200822_212212_session_detail',1620071667),('frontend\\migrations\\m210210_160033_add_invoice_id_column_payment_id_column_to_works_salesorderdetail',1620071668),('frontend\\migrations\\m210210_204458_Mass',1620071674),('frontend\\migrations\\m210303_210035_add_user_id_column_to_works_product',1620071674),('frontend\\migrations\\m210501_112535_add_reference_column_to_works_salesinvoice',1620071675);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `migration` with 27 row(s)
--

--
-- Table structure for table `session_detail`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `session_detail` (
  `session_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` char(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect_flow_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `db` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_approved` tinyint(1) NOT NULL DEFAULT '0',
  `administrator_acknowledged` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`session_detail_id`),
  KEY `fk_session_detail_to_session_idx` (`session_id`),
  KEY `redirect_flow_id` (`redirect_flow_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `session_detail`
--

LOCK TABLES `session_detail` WRITE;
/*!40000 ALTER TABLE `session_detail` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `session_detail` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `session_detail` with 0 row(s)
--

--
-- Table structure for table `source_message`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `source_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `idx_source_message_category` (`category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `source_message`
--

LOCK TABLES `source_message` WRITE;
/*!40000 ALTER TABLE `source_message` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `source_message` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `source_message` with 0 row(s)
--

--
-- Table structure for table `user`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_hash` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(48) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` smallint(1) NOT NULL DEFAULT '2',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `blocked_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `lastlogin_at` timestamp NULL DEFAULT NULL,
  `login_count` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `token` (`token`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `user` VALUES (1,'james','PlVSiZHZ7Yl2S6RUuH7__hI0zhhBKRPC','$2y$13$VZ5gGU3c0OM/2Rtycg/oWec7Ly8Yfn.2DEdISShNyyJXgFhjIexuq',NULL,'ross.addison@ra-windowcleaning.co.uk',3,'2021-05-03 19:55:33','2021-05-03 19:55:58',NULL,NULL,'2021-05-03 19:55:58',1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `user` with 1 row(s)
--

--
-- Table structure for table `works_carousal`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works_carousal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_source_filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_web_filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_alt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_caption` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fontcolor` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `works_carousal`
--

LOCK TABLES `works_carousal` WRITE;
/*!40000 ALTER TABLE `works_carousal` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `works_carousal` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `works_carousal` with 0 row(s)
--

--
-- Table structure for table `works_company`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_street` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_area1` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_area2` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_areacode` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `external_website_url` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twilio_telephone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `finyear_start_date` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `finyear_end_date` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `corp_tax_duedate` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_regno` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat_no` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_reg_name` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_reg_no` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_expiry_date` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt2_reg_name` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt2_reg_no` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt2_expiry_date` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sic_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sic_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sic2_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sic2_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salesorderheader_excludefullypaid` tinyint(1) NOT NULL DEFAULT '0',
  `costheader_excludefullypaid` tinyint(1) NOT NULL DEFAULT '0',
  `homepage` varchar(10000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gc_accesstoken` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gc_live_or_sandbox` enum('SANDBOX','LIVE') COLLATE utf8mb4_unicode_ci DEFAULT 'SANDBOX',
  `smtp_transport_host` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtp_transport_username` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtp_transport_password` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtp_transport_port` int(11) DEFAULT NULL,
  `smtp_transport_encryption` enum('','null','tls','ssl') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tls',
  `google_translate_json_filename_and_path` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_prefix` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_suffix` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `works_company`
--

LOCK TABLES `works_company` WRITE;
/*!40000 ALTER TABLE `works_company` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `works_company` VALUES (1,'Your Company Name','','','','','','','','','','','','','','','','','','','','','','','','',0,0,'','','SANDBOX','','','',NULL,'tls','','','','');
/*!40000 ALTER TABLE `works_company` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `works_company` with 1 row(s)
--

--
-- Table structure for table `works_cost`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works_cost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `costnumber` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `frequency` enum('Daily','Weekly','Fortnightly','Monthly','Every two months','Other') COLLATE utf8mb4_unicode_ci NOT NULL,
  `listprice` decimal(7,2) NOT NULL,
  `costcategory_id` int(11) NOT NULL,
  `costsubcategory_id` int(11) NOT NULL,
  `costcodefirsthalf` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `costcodesecondhalf` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coststartdate` timestamp NULL DEFAULT NULL,
  `costenddate` date DEFAULT '2099-12-31',
  `discontinueddate` timestamp NULL DEFAULT NULL,
  `modifieddate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_cost_costsubcategory_idx` (`costsubcategory_id`),
  KEY `costsubcategory_id` (`costsubcategory_id`),
  KEY `costcategory_id` (`costcategory_id`),
  CONSTRAINT `fk_works_cost_costcategory_id` FOREIGN KEY (`costcategory_id`) REFERENCES `works_costcategory` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_works_cost_costsubcategory_id` FOREIGN KEY (`costsubcategory_id`) REFERENCES `works_costsubcategory` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `works_cost`
--

LOCK TABLES `works_cost` WRITE;
/*!40000 ALTER TABLE `works_cost` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `works_cost` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `works_cost` with 0 row(s)
--

--
-- Table structure for table `works_costcategory`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works_costcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_id` int(2) NOT NULL,
  `modifieddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tax_id` (`tax_id`),
  CONSTRAINT `fk_works_costcategory_tax_id` FOREIGN KEY (`tax_id`) REFERENCES `works_tax` (`tax_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `works_costcategory`
--

LOCK TABLES `works_costcategory` WRITE;
/*!40000 ALTER TABLE `works_costcategory` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `works_costcategory` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `works_costcategory` with 0 row(s)
--

--
-- Table structure for table `works_costdetail`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works_costdetail` (
  `cost_header_id` int(11) NOT NULL,
  `cost_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `paymenttype` enum('Cash','Cheque','Paypal','Debitcard','Creditcard','Other') COLLATE utf8mb4_unicode_ci NOT NULL,
  `paymentreference` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nextcost_date` date NOT NULL,
  `costcategory_id` int(11) NOT NULL,
  `costsubcategory_id` int(11) NOT NULL,
  `cost_id` int(11) NOT NULL,
  `carousal_id` int(11) DEFAULT NULL,
  `order_qty` int(11) NOT NULL DEFAULT '1',
  `unit_price` decimal(9,2) NOT NULL,
  `line_total` int(11) NOT NULL,
  `paid` decimal(9,2) NOT NULL,
  `modified_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cost_detail_id`),
  UNIQUE KEY `cost_detail_id` (`cost_detail_id`),
  KEY `fk_costdetail_costheader_idx` (`cost_header_id`),
  KEY `fk_costdetail_cost_idx` (`cost_id`),
  KEY `fk_costdetail_carousal_idx` (`carousal_id`),
  KEY `nextcost_date` (`nextcost_date`),
  KEY `cost_header_id` (`cost_header_id`),
  KEY `cost_header_detail_id_1` (`cost_detail_id`),
  CONSTRAINT `fk_works_costdetail_cost_header_id` FOREIGN KEY (`cost_header_id`) REFERENCES `works_costheader` (`cost_header_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_works_costdetail_cost_id` FOREIGN KEY (`cost_id`) REFERENCES `works_cost` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `works_costdetail`
--

LOCK TABLES `works_costdetail` WRITE;
/*!40000 ALTER TABLE `works_costdetail` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `works_costdetail` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `works_costdetail` with 0 row(s)
--

--
-- Table structure for table `works_costheader`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works_costheader` (
  `cost_header_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `statusfile` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` int(11) NOT NULL,
  `cost_date` date NOT NULL,
  `sub_total` decimal(7,2) DEFAULT NULL,
  `tax_amt` decimal(7,2) DEFAULT NULL,
  `total_due` decimal(7,2) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cost_header_id`),
  KEY `fk_costheader_employee_idx` (`employee_id`),
  CONSTRAINT `fk_works_costheader_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `works_employee` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `works_costheader`
--

LOCK TABLES `works_costheader` WRITE;
/*!40000 ALTER TABLE `works_costheader` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `works_costheader` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `works_costheader` with 0 row(s)
--

--
-- Table structure for table `works_costsubcategory`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works_costsubcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `costcategory_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modifieddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_costsubcategory_costcategory_idx` (`costcategory_id`),
  CONSTRAINT `fk_works_costsubcategory_costcategory_id` FOREIGN KEY (`costcategory_id`) REFERENCES `works_costcategory` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `works_costsubcategory`
--

LOCK TABLES `works_costsubcategory` WRITE;
/*!40000 ALTER TABLE `works_costsubcategory` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `works_costsubcategory` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `works_costsubcategory` with 0 row(s)
--

--
-- Table structure for table `works_development`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works_development` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `works_development`
--

LOCK TABLES `works_development` WRITE;
/*!40000 ALTER TABLE `works_development` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `works_development` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `works_development` with 0 row(s)
--

--
-- Table structure for table `works_employee`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works_employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nationalinsnumber` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_telno` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date NOT NULL DEFAULT '1980-01-01',
  `maritalstatus` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hiredate` date NOT NULL DEFAULT '1980-01-01',
  `salariedflag` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vacationhours` int(11) NOT NULL,
  `sickleavehours` int(11) NOT NULL,
  `currentflag` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modifieddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nationalinsnumber` (`nationalinsnumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `works_employee`
--

LOCK TABLES `works_employee` WRITE;
/*!40000 ALTER TABLE `works_employee` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `works_employee` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `works_employee` with 0 row(s)
--

--
-- Table structure for table `works_gocardless_invoice`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works_gocardless_invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoicenumber` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `payment_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `amount` decimal(9,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `fk_works_gocardless_invoice_product_id` FOREIGN KEY (`product_id`) REFERENCES `works_product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `works_gocardless_invoice`
--

LOCK TABLES `works_gocardless_invoice` WRITE;
/*!40000 ALTER TABLE `works_gocardless_invoice` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `works_gocardless_invoice` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `works_gocardless_invoice` with 0 row(s)
--

--
-- Table structure for table `works_historyline`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works_historyline` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start` date DEFAULT NULL,
  `stop` date DEFAULT NULL,
  `post_start` date DEFAULT NULL,
  `pre_stop` date DEFAULT NULL,
  `class` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller_name` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller_action` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller_action_id` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `works_historyline`
--

LOCK TABLES `works_historyline` WRITE;
/*!40000 ALTER TABLE `works_historyline` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `works_historyline` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `works_historyline` with 0 row(s)
--

--
-- Table structure for table `works_importhouses`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works_importhouses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `importfile_source_filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `importfile_web_filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `works_importhouses`
--

LOCK TABLES `works_importhouses` WRITE;
/*!40000 ALTER TABLE `works_importhouses` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `works_importhouses` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `works_importhouses` with 0 row(s)
--

--
-- Table structure for table `works_instruction`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works_instruction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'E',
  `code_meaning` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `include` tinyint(1) NOT NULL DEFAULT '1',
  `modified_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `works_instruction`
--

LOCK TABLES `works_instruction` WRITE;
/*!40000 ALTER TABLE `works_instruction` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `works_instruction` VALUES (1,'E','Everything',1,'2019-02-08 15:16:55'),(2,'B','Back',0,'2019-02-08 15:52:36'),(3,'F','Front',1,'2019-02-08 15:53:00'),(4,'S','Side',1,'2019-02-08 15:53:21'),(5,'FS','Front and Sides',1,'2019-02-08 15:53:45'),(6,'FB','Front and Back',0,'2019-02-08 15:54:23'),(7,'FBS','Front  Back   Sides',1,'2019-02-08 15:54:55'),(8,'END','Everything Not Door',0,'2019-02-08 15:58:24'),(9,'ED','Everything Especially the Door',1,'2019-02-08 15:59:08'),(10,'ENC','Everything Not Conservatory',1,'2019-12-01 19:20:41'),(11,'EV','Everything Especially  Veluxes',1,'2019-12-01 19:23:37'),(12,'ENV','Everything Not Veluxes',1,'2019-12-01 19:37:56'),(13,'G','Gutters',1,'2019-12-01 19:29:45'),(14,'F','Facias',1,'2019-12-01 19:32:02'),(15,'GF','Gutters and Facias',1,'2019-12-01 19:33:44'),(16,'DNC','Do Not Clean',1,'2019-12-01 19:37:56'),(17,'DNCO','Do Not Clean Owes',1,'2019-12-01 19:37:56'),(18,'DNCNTD','Do Not Clean No Time Today',1,'2019-12-01 19:37:56'),(19,'ePICS','Clean as usual and email photos as evidence of clean from mobilephone.',1,'2019-12-01 19:37:56');
/*!40000 ALTER TABLE `works_instruction` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `works_instruction` with 19 row(s)
--

--
-- Table structure for table `works_krajee_product_tree`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works_krajee_product_tree` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `root` int(11) DEFAULT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `lvl` smallint(5) NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon_type` tinyint(1) NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `selected` tinyint(1) NOT NULL DEFAULT '0',
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  `readonly` tinyint(1) NOT NULL DEFAULT '0',
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `collapsed` tinyint(1) NOT NULL DEFAULT '0',
  `movable_u` tinyint(1) NOT NULL DEFAULT '1',
  `movable_d` tinyint(1) NOT NULL DEFAULT '1',
  `movable_l` tinyint(1) NOT NULL DEFAULT '1',
  `movable_r` tinyint(1) NOT NULL DEFAULT '1',
  `removable` tinyint(1) NOT NULL DEFAULT '1',
  `removable_all` tinyint(1) NOT NULL DEFAULT '0',
  `child_allowed` tinyint(1) NOT NULL DEFAULT '0',
  `product_id` int(11) DEFAULT NULL,
  `productsubcategory_id` int(11) DEFAULT NULL,
  `productcategory_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_product_NK1` (`root`),
  KEY `tbl_product_NK2` (`lft`),
  KEY `tbl_product_NK3` (`rgt`),
  KEY `tbl_product_NK4` (`lvl`),
  KEY `tbl_product_NK5` (`active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `works_krajee_product_tree`
--

LOCK TABLES `works_krajee_product_tree` WRITE;
/*!40000 ALTER TABLE `works_krajee_product_tree` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `works_krajee_product_tree` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `works_krajee_product_tree` with 0 row(s)
--

--
-- Table structure for table `works_messagelog`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works_messagelog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `phoneto` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salesorderdetail_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `salesorderdetail_id` (`salesorderdetail_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `fk_works_messagelog_product_id` FOREIGN KEY (`product_id`) REFERENCES `works_product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_works_messagelog_salesorderdetail_id` FOREIGN KEY (`salesorderdetail_id`) REFERENCES `works_salesorderdetail` (`sales_order_detail_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `works_messagelog`
--

LOCK TABLES `works_messagelog` WRITE;
/*!40000 ALTER TABLE `works_messagelog` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `works_messagelog` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `works_messagelog` with 0 row(s)
--

--
-- Table structure for table `works_messaging`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works_messaging` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `works_messaging`
--

LOCK TABLES `works_messaging` WRITE;
/*!40000 ALTER TABLE `works_messaging` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `works_messaging` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `works_messaging` with 0 row(s)
--

--
-- Table structure for table `works_paymentrequest`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works_paymentrequest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_order_detail_id` int(11) NOT NULL,
  `gc_payment_request_id` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `gc_payment_request_id` (`gc_payment_request_id`),
  KEY `sales_order_detail_id` (`sales_order_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `works_paymentrequest`
--

LOCK TABLES `works_paymentrequest` WRITE;
/*!40000 ALTER TABLE `works_paymentrequest` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `works_paymentrequest` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `works_paymentrequest` with 0 row(s)
--

--
-- Table structure for table `works_product`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productnumber` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contactmobile` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specialrequest` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `frequency` enum('Weekly','Fortnightly','Monthly','Every two months','Not applicable') COLLATE utf8mb4_unicode_ci NOT NULL,
  `listprice` decimal(7,2) NOT NULL,
  `productcategory_id` int(11) NOT NULL,
  `productsubcategory_id` int(11) NOT NULL,
  `postcodefirsthalf` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postcodesecondhalf` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mandate` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gc_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmation_url` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sellstartdate` timestamp NULL DEFAULT NULL,
  `sellenddate` date DEFAULT '2099-12-31',
  `discontinueddate` timestamp NULL DEFAULT NULL,
  `modifieddate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `isactive` tinyint(1) NOT NULL DEFAULT '1',
  `jobcode` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_source_filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_web_filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `productsubcategory_id` (`productsubcategory_id`),
  KEY `productcategory_id` (`productcategory_id`),
  KEY `productnumber` (`productnumber`),
  CONSTRAINT `fk_works_product_productcategory_id` FOREIGN KEY (`productcategory_id`) REFERENCES `works_productcategory` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_works_product_productsubcategory_id` FOREIGN KEY (`productsubcategory_id`) REFERENCES `works_productsubcategory` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `works_product`
--

LOCK TABLES `works_product` WRITE;
/*!40000 ALTER TABLE `works_product` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `works_product` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `works_product` with 0 row(s)
--

--
-- Table structure for table `works_productcategory`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works_productcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_id` int(2) NOT NULL,
  `modifieddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tax_id` (`tax_id`),
  CONSTRAINT `fk_works_productcategory_tax_id` FOREIGN KEY (`tax_id`) REFERENCES `works_tax` (`tax_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `works_productcategory`
--

LOCK TABLES `works_productcategory` WRITE;
/*!40000 ALTER TABLE `works_productcategory` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `works_productcategory` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `works_productcategory` with 0 row(s)
--

--
-- Table structure for table `works_productsubcategory`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works_productsubcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productcategory_id` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat_start` double NOT NULL,
  `lng_start` double NOT NULL,
  `lat_finish` double NOT NULL,
  `lng_finish` double NOT NULL,
  `directions_to_next_productsubcategory` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int(11) NOT NULL,
  `modifieddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isactive` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_productsubcategory_productcategory_idx` (`productcategory_id`),
  CONSTRAINT `fk_works_productsubcategory_productcategory_id` FOREIGN KEY (`productcategory_id`) REFERENCES `works_productcategory` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `works_productsubcategory`
--

LOCK TABLES `works_productsubcategory` WRITE;
/*!40000 ALTER TABLE `works_productsubcategory` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `works_productsubcategory` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `works_productsubcategory` with 0 row(s)
--

--
-- Table structure for table `works_quicknote`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works_quicknote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `note` varchar(5000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `works_quicknote`
--

LOCK TABLES `works_quicknote` WRITE;
/*!40000 ALTER TABLE `works_quicknote` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `works_quicknote` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `works_quicknote` with 0 row(s)
--

--
-- Table structure for table `works_quotation`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works_quotation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postalcode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `housenumber` int(11) NOT NULL,
  `streetname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specialrequest` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preferredquoteamount` int(2) NOT NULL,
  `building` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `windowsnumber` int(2) NOT NULL,
  `regularity` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quoteamount` int(2) NOT NULL,
  `acceptedamount` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `works_quotation`
--

LOCK TABLES `works_quotation` WRITE;
/*!40000 ALTER TABLE `works_quotation` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `works_quotation` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `works_quotation` with 0 row(s)
--

--
-- Table structure for table `works_salesinvoice`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works_salesinvoice` (
  `invoice_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_status_id` tinyint(2) NOT NULL DEFAULT '1',
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_read_only` tinyint(1) DEFAULT NULL,
  `invoice_date_created` date NOT NULL,
  `invoice_time_created` time NOT NULL DEFAULT '00:00:00',
  `invoice_date_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `invoice_date_due` date NOT NULL,
  `invoice_url_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_terms` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method_id` int(11) NOT NULL DEFAULT '0',
  `reference` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`invoice_id`),
  KEY `invoice_date_created` (`invoice_date_created`),
  KEY `invoice_date_due` (`invoice_date_due`),
  KEY `invoice_url_key` (`invoice_url_key`),
  KEY `invoice_status_id` (`invoice_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `works_salesinvoice`
--

LOCK TABLES `works_salesinvoice` WRITE;
/*!40000 ALTER TABLE `works_salesinvoice` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `works_salesinvoice` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `works_salesinvoice` with 0 row(s)
--

--
-- Table structure for table `works_salesinvoiceamount`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works_salesinvoiceamount` (
  `invoice_amount_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `invoice_sign` enum('1','-1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `invoice_total` decimal(20,2) DEFAULT NULL,
  `invoice_paid` decimal(20,2) DEFAULT NULL,
  `invoice_balance` decimal(20,2) DEFAULT NULL,
  PRIMARY KEY (`invoice_amount_id`),
  KEY `invoice_id` (`invoice_id`),
  CONSTRAINT `fk_works_salesinvoiceamount_invoice_id` FOREIGN KEY (`invoice_id`) REFERENCES `works_salesinvoice` (`invoice_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `works_salesinvoiceamount`
--

LOCK TABLES `works_salesinvoiceamount` WRITE;
/*!40000 ALTER TABLE `works_salesinvoiceamount` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `works_salesinvoiceamount` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `works_salesinvoiceamount` with 0 row(s)
--

--
-- Table structure for table `works_salesinvoiceemailtemplate`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works_salesinvoiceemailtemplate` (
  `email_template_id` int(11) NOT NULL AUTO_INCREMENT,
  `email_template_title` text COLLATE utf8mb4_unicode_ci,
  `email_template_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_template_body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_template_subject` text COLLATE utf8mb4_unicode_ci,
  `email_template_from_name` text COLLATE utf8mb4_unicode_ci,
  `email_template_from_email` text COLLATE utf8mb4_unicode_ci,
  `email_template_cc` text COLLATE utf8mb4_unicode_ci,
  `email_template_bcc` text COLLATE utf8mb4_unicode_ci,
  `email_template_pdf_template` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`email_template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `works_salesinvoiceemailtemplate`
--

LOCK TABLES `works_salesinvoiceemailtemplate` WRITE;
/*!40000 ALTER TABLE `works_salesinvoiceemailtemplate` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `works_salesinvoiceemailtemplate` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `works_salesinvoiceemailtemplate` with 0 row(s)
--

--
-- Table structure for table `works_salesinvoicemerchantresponse`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works_salesinvoicemerchantresponse` (
  `merchant_response_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `merchant_response_successful` tinyint(1) DEFAULT '1',
  `merchant_response_date` date NOT NULL,
  `merchant_response_driver` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  `merchant_response` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `merchant_response_reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`merchant_response_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `works_salesinvoicemerchantresponse`
--

LOCK TABLES `works_salesinvoicemerchantresponse` WRITE;
/*!40000 ALTER TABLE `works_salesinvoicemerchantresponse` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `works_salesinvoicemerchantresponse` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `works_salesinvoicemerchantresponse` with 0 row(s)
--

--
-- Table structure for table `works_salesinvoicemethodpay`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works_salesinvoicemethodpay` (
  `payment_method_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_method_name` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`payment_method_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `works_salesinvoicemethodpay`
--

LOCK TABLES `works_salesinvoicemethodpay` WRITE;
/*!40000 ALTER TABLE `works_salesinvoicemethodpay` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `works_salesinvoicemethodpay` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `works_salesinvoicemethodpay` with 0 row(s)
--

--
-- Table structure for table `works_salesinvoicepayment`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works_salesinvoicepayment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_amount` decimal(20,2) NOT NULL DEFAULT '0.00',
  `payment_note` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`payment_id`),
  KEY `invoice_id` (`invoice_id`),
  KEY `payment_method_id` (`payment_method_id`),
  CONSTRAINT `fk_works_salesinvoicepayment_invoice_id` FOREIGN KEY (`invoice_id`) REFERENCES `works_salesinvoice` (`invoice_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_works_salesinvoicepayment_payment_method_id` FOREIGN KEY (`payment_method_id`) REFERENCES `works_salesinvoicemethodpay` (`payment_method_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `works_salesinvoicepayment`
--

LOCK TABLES `works_salesinvoicepayment` WRITE;
/*!40000 ALTER TABLE `works_salesinvoicepayment` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `works_salesinvoicepayment` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `works_salesinvoicepayment` with 0 row(s)
--

--
-- Table structure for table `works_salesinvoicesetting`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works_salesinvoicesetting` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `setting_value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`setting_id`),
  KEY `setting_key` (`setting_key`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `works_salesinvoicesetting`
--

LOCK TABLES `works_salesinvoicesetting` WRITE;
/*!40000 ALTER TABLE `works_salesinvoicesetting` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `works_salesinvoicesetting` VALUES (1,'mark_invoices_sent_pdf','0');
/*!40000 ALTER TABLE `works_salesinvoicesetting` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `works_salesinvoicesetting` with 1 row(s)
--

--
-- Table structure for table `works_salesinvoicestatus`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works_salesinvoicestatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `const` int(2) NOT NULL,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'E',
  `code_meaning` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `include` tinyint(1) NOT NULL DEFAULT '1',
  `modified_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `works_salesinvoicestatus`
--

LOCK TABLES `works_salesinvoicestatus` WRITE;
/*!40000 ALTER TABLE `works_salesinvoicestatus` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `works_salesinvoicestatus` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `works_salesinvoicestatus` with 0 row(s)
--

--
-- Table structure for table `works_salesinvoiceuploads`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works_salesinvoiceuploads` (
  `upload_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `url_key` char(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name_original` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name_new` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `uploaded_date` date NOT NULL,
  PRIMARY KEY (`upload_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `works_salesinvoiceuploads`
--

LOCK TABLES `works_salesinvoiceuploads` WRITE;
/*!40000 ALTER TABLE `works_salesinvoiceuploads` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `works_salesinvoiceuploads` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `works_salesinvoiceuploads` with 0 row(s)
--

--
-- Table structure for table `works_salesorderdetail`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works_salesorderdetail` (
  `sales_order_id` int(11) NOT NULL,
  `sales_order_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `cleaned` enum('Cleaned','Missed','Not cleaned','Fronts Done Only','Backs Done Only') COLLATE utf8mb4_unicode_ci NOT NULL,
  `instruction_id` int(11) NOT NULL DEFAULT '1',
  `nextclean_date` date NOT NULL,
  `productcategory_id` int(11) NOT NULL,
  `productsubcategory_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_qty` int(11) NOT NULL DEFAULT '1',
  `pre_payment` decimal(7,2) NOT NULL DEFAULT '0.00',
  `unit_price` decimal(9,2) NOT NULL,
  `line_total` int(11) NOT NULL,
  `paid` decimal(9,2) NOT NULL DEFAULT '0.00',
  `advance_payment` decimal(9,2) NOT NULL DEFAULT '0.00',
  `tip` decimal(7,2) NOT NULL DEFAULT '0.00',
  `modified_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `invoice_id` int(11) DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`sales_order_detail_id`),
  UNIQUE KEY `sales_order_detail_id` (`sales_order_detail_id`),
  KEY `fk_salesorderdetail_salesorderheader_idx` (`sales_order_id`),
  KEY `fk_salesorderdetail_product_idx` (`product_id`),
  KEY `nextclean_date` (`nextclean_date`),
  KEY `sales_order_id` (`sales_order_id`),
  CONSTRAINT `fk_works_salesorderdetail_product_id` FOREIGN KEY (`product_id`) REFERENCES `works_product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_works_salesorderdetail_sales_order_id` FOREIGN KEY (`sales_order_id`) REFERENCES `works_salesorderheader` (`sales_order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `works_salesorderdetail`
--

LOCK TABLES `works_salesorderdetail` WRITE;
/*!40000 ALTER TABLE `works_salesorderdetail` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `works_salesorderdetail` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `works_salesorderdetail` with 0 row(s)
--

--
-- Table structure for table `works_salesorderheader`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works_salesorderheader` (
  `sales_order_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `statusfile` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employee_id` int(11) NOT NULL,
  `carousal_id` int(11) DEFAULT NULL,
  `clean_date` date NOT NULL,
  `hoursworked` decimal(7,2) NOT NULL DEFAULT '8.00',
  `sub_total` decimal(7,2) DEFAULT NULL,
  `tax_amt` decimal(7,2) DEFAULT NULL,
  `total_due` decimal(7,2) DEFAULT NULL,
  `income_per_hour` decimal(7,2) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`sales_order_id`),
  KEY `fk_salesorderheader_employee_idx` (`employee_id`),
  KEY `fx_salesorderheader_carousal_idx` (`carousal_id`),
  CONSTRAINT `fk_works_salesorderheader_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `works_employee` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `works_salesorderheader`
--

LOCK TABLES `works_salesorderheader` WRITE;
/*!40000 ALTER TABLE `works_salesorderheader` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `works_salesorderheader` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `works_salesorderheader` with 0 row(s)
--

--
-- Table structure for table `works_tax`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works_tax` (
  `tax_id` int(2) NOT NULL AUTO_INCREMENT,
  `tax_type` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_percentage` decimal(10,2) NOT NULL,
  PRIMARY KEY (`tax_id`),
  KEY `tax_id` (`tax_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `works_tax`
--

LOCK TABLES `works_tax` WRITE;
/*!40000 ALTER TABLE `works_tax` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `works_tax` VALUES (1,'00','Zero',0.00),(2,'01','Standard',0.20),(3,'02','Exempt',0.00),(4,'03','Available',0.00),(5,'04','Available',0.00),(6,'05','Reduced',0.05);
/*!40000 ALTER TABLE `works_tax` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `works_tax` with 6 row(s)
--

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on: Mon, 03 May 2021 19:59:55 +0000
