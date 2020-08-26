-- mysqldump-php https://github.com/ifsnop/mysqldump-php
--
-- Host: localhost	Database: h2h_db
-- ------------------------------------------------------
-- Server version 	5.7.31
-- Date: Wed, 26 Aug 2020 19:49:45 +0000

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
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_assignment`
--

LOCK TABLES `auth_assignment` WRITE;
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `auth_assignment` VALUES ('admin','1',1598127398),('admin','2',1598128556);
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `auth_assignment` with 2 row(s)
--

--
-- Table structure for table `auth_item`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item`
--

LOCK TABLES `auth_item` WRITE;
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `auth_item` VALUES ('Access db',2,'Access db',NULL,NULL,1577737693,1577737693),('Access db1',2,'Access db1',NULL,NULL,1577737634,1577737634),('Access db10',2,'Access db10',NULL,NULL,1579035389,1579035389),('Access db2',2,'Access db2',NULL,NULL,1578741528,1578741528),('Access db3',2,'Access db3',NULL,NULL,1581581742,1581581762),('Access db4',2,'Access db4',NULL,NULL,1581667052,1581667052),('Access db5',2,'Access db5',NULL,NULL,1584401458,1584401458),('Access db6',2,'Access db6',NULL,NULL,1584401458,1584401458),('Access db7',2,'Access db7',NULL,NULL,1579035389,1579035389),('Access db8',2,'Access db8',NULL,NULL,1579035389,1579035389),('Access db9',2,'Access db9',NULL,NULL,1579035389,1579035389),('Access paypalagreement',2,'Access the Paypal Agreement',NULL,NULL,1577804284,1577804284),('Access Session',2,'Access Session',NULL,NULL,1565127671,1565209503),('Access Sessiondetail',2,'Access Sessiondetail',NULL,NULL,1565127753,1565127753),('admin',1,'Administrator of the first database  which serves to record all user data of the site. Users that are allowed to signup are designated a Manager role manually. ',NULL,NULL,1577666562,1584471479),('Backup Database',2,'Managers Backup their allocated database.',NULL,NULL,1564039903,1564039903),('Create Carousal',2,'Create Carousal',NULL,NULL,1544661317,1544661317),('Create Company',2,'Create Company',NULL,NULL,1512856530,1549635086),('Create Daily Clean',2,'Create Daily Clean',NULL,NULL,1512856530,1512856530),('Create Daily Job Sheet',2,'Create Daily Job Sheet',NULL,NULL,1512856530,1512856530),('Create Employee',2,'Create Employee',NULL,NULL,1512856530,1549631754),('Create Gocardlesscustomer',2,'Create Gocardlesscustomer',NULL,NULL,1564057944,1564057944),('Create House',2,'Create House',NULL,NULL,1512856530,1549631786),('Create Instruction',2,'Create Instruction',NULL,NULL,1549631630,1549635056),('Create Legal',2,'Create Legal',NULL,NULL,1563032629,1563032629),('Create Mandate',2,'Create Mandate',NULL,NULL,1564647598,1564647598),('Create Messagelog',2,'Create Messagelog',NULL,NULL,1544660727,1544660727),('Create Messaging',2,'Create Messaging',NULL,NULL,1544659806,1544659991),('Create Postalcode',2,'Create Postalcode',NULL,NULL,1512856531,1549634117),('Create Street',2,'Create Street',NULL,NULL,1512856530,1512856530),('Create Tax',2,'Create Tax',NULL,NULL,1544662943,1544662943),('createItem',2,'Create item',NULL,NULL,1577666562,1577666562),('Delete Carousal',2,'Delete Carousal',NULL,NULL,1544661364,1544661364),('Delete Company',2,'Delete Company',NULL,NULL,1512856530,1512856530),('Delete Daily Clean',2,'Delete Daily Clean',NULL,NULL,1512856530,1512856530),('Delete Daily Job Sheet',2,'Delete Daily Job Sheet',NULL,NULL,1512856530,1512856530),('Delete Employee',2,'Delete Employee',NULL,NULL,1512856530,1512856530),('Delete House',2,'Delete House',NULL,NULL,1512856530,1512856530),('Delete Instruction',2,'Delete Instruction',NULL,NULL,1549634229,1549634229),('Delete Mandate',2,'Delete Mandate',NULL,NULL,1564647708,1564647708),('Delete Messagelog',2,'Delete Messagelog',NULL,NULL,1544660767,1544660767),('Delete Messaging',2,'Delete Messaging',NULL,NULL,1544660079,1544660079),('Delete Postalcode',2,'Delete Postalcode',NULL,NULL,1512856531,1512856531),('Delete Street',2,'Delete Street',NULL,NULL,1512856531,1549633538),('Delete Tax',2,'Delete Tax',NULL,NULL,1544662983,1544662983),('deleteItem',2,'Delete item',NULL,NULL,1577666562,1577666562),('demo',1,'demo',NULL,NULL,1584405564,1584889800),('employee',1,'Key worker',NULL,NULL,1577666562,1584471479),('fencemode',1,'Fence Mode - Already registered Users can login. Guests cannot signup. Change the permission under Fence Mode to affect all users ie. all guests are fenced out - they cannot signup ...or they can.',NULL,NULL,1584405564,1584889800),('Google Translate',2,'Translate this package from English into a language of your choice. If you can use Google Translate already your language will be 1 of 109 provided by Google. Create a service account with Google and download the Json file. Provide this path under Company. ',NULL,NULL,1584405564,1584889800),('Import Houses',2,'Import Houses',NULL,NULL,1573842472,1573842472),('Manage Admin',2,'Manage Admin',NULL,NULL,1577744346,1577744346),('Manage Basic',2,'Perform Basic Tasks',NULL,NULL,1578419959,1578419959),('Manage Money',2,'Manage Money',NULL,NULL,1546700864,1546700864),('manageRoles',2,'Manage Roles and Permissions',NULL,NULL,1577666562,1577666562),('manageUsers',2,'Manage Users',NULL,NULL,1577666562,1577666562),('Mdb0',1,'Manager of db',NULL,NULL,1577738006,1583578098),('Mdb1',1,'Manager of db1',NULL,NULL,1577738006,1583578098),('Mdb10',1,'Manager of db10',NULL,NULL,1579035344,1584471378),('Mdb2',1,'Manager of db2',NULL,NULL,1578741488,1584409353),('Mdb3',1,'Manager of db3',NULL,NULL,1581581720,1581666851),('Mdb4',1,'Manager of db4',NULL,NULL,1581666990,1583577278),('Mdb5',1,'Manager of db5',NULL,NULL,1584401245,1584471624),('Mdb6',1,'Manager of db6',NULL,NULL,1584401245,1584471624),('Mdb7',1,'Manager of db7',NULL,NULL,1579035344,1584471378),('Mdb8',1,'Manager of db8',NULL,NULL,1579035344,1584471378),('Mdb9',1,'Manager of db9',NULL,NULL,1579035344,1584471378),('Migrate Works Database',2,'Migrate Works Database for databases db1 to db10. Not for admins database db.',NULL,NULL,1579035344,1584471378),('See Prices',2,'Allow a worker or employee to see prices that are being charged for the job.',NULL,NULL,1583610917,1583610917),('Subscription Free Privilege',2,'A Paypal Subscription is Not Necessary For This User',NULL,NULL,1580914633,1580914876),('support',1,'Create, update, delete all company specific data specific to designated company database. Mdb roles subservient to support role. ',NULL,NULL,1577666562,1584883604),('Udb0',1,'Subcontractor of db',NULL,NULL,1583583080,1583583080),('Udb1',1,'Subcontractor of db1',NULL,NULL,1583583080,1583583080),('Udb10',1,'Subcontractor of db10',NULL,NULL,1584402344,1584471662),('Udb2',1,'Subcontractor of db2',NULL,NULL,1583583080,1583583080),('Udb3',1,'Subcontractor of db3',NULL,NULL,1583578326,1583580986),('Udb4',1,'Subcontractor of db4',NULL,NULL,1583577262,1583581014),('Udb5',1,'Subcontractor of db5',NULL,NULL,1584402344,1584471662),('Udb6',1,'Subcontractor of db6',NULL,NULL,1584402344,1584471662),('Udb7',1,'Subcontractor of db7',NULL,NULL,1584402344,1584471662),('Udb8',1,'Subcontractor of db8',NULL,NULL,1584402344,1584471662),('Udb9',1,'Subcontractor of db9',NULL,NULL,1584402344,1584471662),('Update Carousal',2,'Update Carousal',NULL,NULL,1544661341,1544661341),('Update Company',2,'Update Company',NULL,NULL,1512856530,1512856530),('Update Daily Clean',2,'Update Daily Clean',NULL,NULL,1512856530,1512856530),('Update Daily Job Sheet',2,'Update Daily Job Sheet',NULL,NULL,1512856530,1512856530),('Update Employee',2,'Update Employee',NULL,NULL,1512856530,1512856530),('Update House',2,'Update House',NULL,NULL,1512856530,1512856530),('Update Instruction',2,'Update Instruction',NULL,NULL,1549634253,1549634253),('Update Mandate',2,'Update Mandate',NULL,NULL,1564647635,1564647635),('Update Messagelog',2,'Update Messagelog',NULL,NULL,1544660748,1544660748),('Update Messaging',2,'Update Messaging',NULL,NULL,1544660035,1544660035),('Update Postalcode',2,'Update Postalcode',NULL,NULL,1512856531,1512856531),('Update Street',2,'Update Street',NULL,NULL,1512856531,1512856531),('Update Tax',2,'Update Tax',NULL,NULL,1544662962,1544662962),('updateCommonUser',2,'Update user data, but not those of \'admin\'',NULL,NULL,1577666562,1577666562),('updateCreatedItem',2,'Update own item',NULL,NULL,1577666562,1577666562),('updateItem',2,'Update item',NULL,NULL,1577666562,1577666562),('updateUser',2,'Update user data',NULL,NULL,1577666562,1577666562),('Use Gocardless',2,'Make payment requests by means of Gocardless to Householders email addresses if consent given.',NULL,NULL,1577666563,1577666563),('Use Twilio',2,'Send individual or bulk sms messages by means of Twilio',NULL,NULL,1577666563,1577666563),('User can Login but not Signup - Fence Mode On',2,'Login Available but Signup Not Available - Fence Mode On',NULL,NULL,1573842472,1573842472),('View Bulletin Board',2,'View Bulletin Board',NULL,NULL,1563826631,1563826631),('View Carousal',2,'View Carousal',NULL,NULL,1558795525,1558795525),('View Company',2,'View Company',NULL,NULL,1512856530,1512856530),('View Daily Clean',2,'View Daily Clean',NULL,NULL,1546702743,1546702743),('View House',2,'View House',NULL,NULL,1583581575,1583581575),('View Instruction',2,'View Instruction',NULL,NULL,1549634202,1549635005),('View Mandate',2,'View Mandate',NULL,NULL,1564647670,1564647670),('View Revenue Reports',2,'View Revenue Reports',NULL,NULL,1564039903,1564039903);
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `auth_item` with 110 row(s)
--

--
-- Table structure for table `auth_item_child`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item_child`
--

LOCK TABLES `auth_item_child` WRITE;
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `auth_item_child` VALUES ('admin','Access db'),('Mdb0','Access db'),('Udb0','Access db'),('Mdb1','Access db1'),('Udb1','Access db1'),('Mdb10','Access db10'),('Udb10','Access db10'),('Mdb2','Access db2'),('Udb2','Access db2'),('Mdb3','Access db3'),('Udb3','Access db3'),('Mdb4','Access db4'),('Udb4','Access db4'),('Mdb5','Access db5'),('Udb5','Access db5'),('Mdb6','Access db6'),('Udb6','Access db6'),('Mdb7','Access db7'),('Udb7','Access db7'),('Mdb8','Access db8'),('Udb8','Access db8'),('Mdb9','Access db9'),('Udb9','Access db9'),('admin','Access paypalagreement'),('admin','Access Session'),('admin','Access Sessiondetail'),('admin','Create Carousal'),('demo','Create Carousal'),('support','Create Carousal'),('admin','Create Company'),('admin','Create Daily Clean'),('demo','Create Daily Clean'),('support','Create Daily Clean'),('admin','Create Daily Job Sheet'),('demo','Create Daily Job Sheet'),('support','Create Daily Job Sheet'),('admin','Create Employee'),('demo','Create Employee'),('support','Create Employee'),('admin','Create Gocardlesscustomer'),('demo','Create Gocardlesscustomer'),('support','Create Gocardlesscustomer'),('admin','Create House'),('demo','Create House'),('support','Create House'),('admin','Create Instruction'),('demo','Create Instruction'),('support','Create Instruction'),('admin','Create Legal'),('admin','Create Mandate'),('demo','Create Mandate'),('support','Create Mandate'),('admin','Create Messagelog'),('demo','Create Messagelog'),('support','Create Messagelog'),('admin','Create Messaging'),('demo','Create Messaging'),('support','Create Messaging'),('admin','Create Postalcode'),('demo','Create Postalcode'),('support','Create Postalcode'),('admin','Create Street'),('demo','Create Street'),('support','Create Street'),('admin','Create Tax'),('demo','Create Tax'),('support','Create Tax'),('admin','createItem'),('admin','Delete Carousal'),('demo','Delete Carousal'),('support','Delete Carousal'),('admin','Delete Company'),('admin','Delete Daily Clean'),('demo','Delete Daily Clean'),('support','Delete Daily Clean'),('admin','Delete Daily Job Sheet'),('demo','Delete Daily Job Sheet'),('support','Delete Daily Job Sheet'),('admin','Delete Employee'),('demo','Delete Employee'),('support','Delete Employee'),('admin','Delete House'),('demo','Delete House'),('support','Delete House'),('admin','Delete Instruction'),('demo','Delete Instruction'),('support','Delete Instruction'),('admin','Delete Mandate'),('demo','Delete Mandate'),('support','Delete Mandate'),('admin','Delete Messagelog'),('demo','Delete Messagelog'),('support','Delete Messagelog'),('admin','Delete Messaging'),('demo','Delete Messaging'),('support','Delete Messaging'),('admin','Delete Postalcode'),('demo','Delete Postalcode'),('support','Delete Postalcode'),('admin','Delete Street'),('demo','Delete Street'),('support','Delete Street'),('admin','Delete Tax'),('demo','Delete Tax'),('support','Delete Tax'),('admin','deleteItem'),('Udb0','employee'),('Udb1','employee'),('Udb10','employee'),('Udb2','employee'),('Udb3','employee'),('Udb4','employee'),('Udb5','employee'),('Udb6','employee'),('Udb7','employee'),('Udb8','employee'),('Udb9','employee'),('admin','fencemode'),('employee','fencemode'),('support','fencemode'),('admin','Import Houses'),('demo','Import Houses'),('support','Import Houses'),('admin','Manage Admin'),('support','Manage Admin'),('admin','Manage Basic'),('demo','Manage Basic'),('employee','Manage Basic'),('support','Manage Basic'),('admin','Manage Money'),('demo','Manage Money'),('support','Manage Money'),('admin','manageRoles'),('admin','manageUsers'),('demo','manageUsers'),('Mdb0','manageUsers'),('support','manageUsers'),('admin','See Prices'),('demo','See Prices'),('support','See Prices'),('admin','Subscription Free Privilege'),('Mdb0','Subscription Free Privilege'),('Mdb1','Subscription Free Privilege'),('Mdb10','Subscription Free Privilege'),('Mdb2','Subscription Free Privilege'),('Mdb3','Subscription Free Privilege'),('Mdb4','Subscription Free Privilege'),('Mdb5','Subscription Free Privilege'),('Mdb6','Subscription Free Privilege'),('Mdb7','Subscription Free Privilege'),('Mdb8','Subscription Free Privilege'),('Mdb9','Subscription Free Privilege'),('Udb0','Subscription Free Privilege'),('Udb1','Subscription Free Privilege'),('Udb10','Subscription Free Privilege'),('Udb2','Subscription Free Privilege'),('Udb3','Subscription Free Privilege'),('Udb4','Subscription Free Privilege'),('Udb5','Subscription Free Privilege'),('Udb6','Subscription Free Privilege'),('Udb7','Subscription Free Privilege'),('Udb8','Subscription Free Privilege'),('Udb9','Subscription Free Privilege'),('Mdb0','support'),('Mdb1','support'),('Mdb10','support'),('Mdb2','support'),('Mdb3','support'),('Mdb4','support'),('Mdb5','support'),('Mdb6','support'),('Mdb7','support'),('Mdb8','support'),('Mdb9','support'),('admin','Update Carousal'),('demo','Update Carousal'),('support','Update Carousal'),('admin','Update Company'),('support','Update Company'),('admin','Update Daily Clean'),('demo','Update Daily Clean'),('support','Update Daily Clean'),('admin','Update Daily Job Sheet'),('demo','Update Daily Job Sheet'),('support','Update Daily Job Sheet'),('admin','Update Employee'),('demo','Update Employee'),('support','Update Employee'),('admin','Update House'),('demo','Update House'),('support','Update House'),('admin','Update Instruction'),('demo','Update Instruction'),('support','Update Instruction'),('admin','Update Mandate'),('demo','Update Mandate'),('support','Update Mandate'),('admin','Update Messagelog'),('demo','Update Messagelog'),('support','Update Messagelog'),('admin','Update Messaging'),('demo','Update Messaging'),('support','Update Messaging'),('admin','Update Postalcode'),('demo','Update Postalcode'),('support','Update Postalcode'),('admin','Update Street'),('demo','Update Street'),('support','Update Street'),('admin','Update Tax'),('demo','Update Tax'),('support','Update Tax'),('support','updateCommonUser'),('admin','updateCreatedItem'),('admin','updateItem'),('updateCreatedItem','updateItem'),('admin','updateUser'),('updateCommonUser','updateUser'),('admin','Use Gocardless'),('support','Use Gocardless'),('admin','Use Twilio'),('support','Use Twilio'),('admin','View Bulletin Board'),('support','View Bulletin Board'),('admin','View Carousal'),('demo','View Carousal'),('support','View Carousal'),('admin','View Company'),('demo','View Company'),('support','View Company'),('admin','View Daily Clean'),('demo','View Daily Clean'),('support','View Daily Clean'),('Udb0','View Daily Clean'),('Udb1','View Daily Clean'),('Udb10','View Daily Clean'),('Udb2','View Daily Clean'),('Udb3','View Daily Clean'),('Udb4','View Daily Clean'),('Udb5','View Daily Clean'),('Udb6','View Daily Clean'),('Udb7','View Daily Clean'),('Udb8','View Daily Clean'),('Udb9','View Daily Clean'),('admin','View House'),('demo','View House'),('support','View House'),('admin','View Instruction'),('demo','View Instruction'),('support','View Instruction'),('admin','View Mandate'),('support','View Mandate'),('admin','View Revenue Reports'),('demo','View Revenue Reports'),('support','View Revenue Reports');
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `auth_item_child` with 255 row(s)
--

--
-- Table structure for table `auth_rule`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
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
  `language` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `translation` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`,`language`),
  KEY `idx_message_language` (`language`),
  CONSTRAINT `fk_message_source_message` FOREIGN KEY (`id`) REFERENCES `source_message` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
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
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `migration` VALUES ('m000000_000000_base',1598034955),('sjaakp\\pluto\\migrations\\m000000_000000_init',1598035183),('frontend\\migrations\\m191110_221831_Mass',1598035201),('frontend\\migrations\\m191207_152415_works_taxDataInsert',1598035202),('frontend\\migrations\\m191207_155342_works_instructionDataInsert',1598035202),('frontend\\migrations\\m191207_161454_works_importhouses',1598035202),('frontend\\migrations\\m200125_075111_carousal_id_fix',1598035203),('console\\migrations\\auth\\m200413_073958_auth_assignment',1598035203),('console\\migrations\\auth\\m200413_073959_auth_item',1598035204),('console\\migrations\\auth\\m200413_074000_auth_item_child',1598035204),('console\\migrations\\auth\\m200413_074001_auth_rule',1598035205),('console\\migrations\\auth\\m200413_082835_auth_itemDataInsert',1598035205),('console\\migrations\\auth\\m200413_082924_auth_item_childDataInsert',1598035205),('console\\migrations\\auth\\m200413_085036_auth_ruleDataInsert',1598035205),('frontend\\migrations\\m200414_125047_works_companyDataInsert',1598035205),('frontend\\migrations\\m200521_152727_works_historyline',1598035205),('frontend\\migrations\\m200611_075111_listprice_fix',1598035205),('frontend\\migrations\\m200611_152727_add_image_source_filename_column_image_web_filename_column_to_works_product',1598035207),('frontend\\migrations\\m200613_215223_works_krajee_product_tree',1598035208),('frontend\\migrations\\m200621_152727_add_product_id_column_productsubcategory_id_column_productcategory_id_column_to_works_krajee_product_tree',1598035209),('frontend\\migrations\\m200627_075111_product_productnumber_fix_width',1598035444),('frontend\\migrations\\m200708_152727_create_productnumber_index_works_product',1598035444),('m150207_210500_i18n_init',1598126244);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `migration` with 23 row(s)
--

--
-- Table structure for table `session_detail`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `session_detail` (
  `session_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` char(40) NOT NULL,
  `redirect_flow_id` varchar(50) NOT NULL,
  `db` varchar(50) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_approved` tinyint(1) NOT NULL DEFAULT '0',
  `administrator_acknowledged` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`session_detail_id`),
  KEY `fk_session_detail_to_session_idx` (`session_id`),
  KEY `redirect_flow_id` (`redirect_flow_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
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
  `category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `idx_source_message_category` (`category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `user` VALUES (2,'rossaddison','Cws2g_9xs8E_f5opYuJDo3V6ZrFzPW8V','$2y$13$aQyIiqufGRFKg2djqevRx.4eIHOijl7qFETshJ6ulGomD5TMfdnj6',NULL,'ross.addison@bbqq.co.uk',3,'2020-08-22 20:33:29','2020-08-22 20:35:56',NULL,NULL,'2020-08-22 20:36:44',2);
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
  `image_source_filename` varchar(255) NOT NULL,
  `image_web_filename` varchar(255) NOT NULL,
  `content_alt` varchar(255) NOT NULL,
  `content_title` varchar(255) NOT NULL,
  `content_caption` varchar(255) NOT NULL,
  `fontcolor` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
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
  `name` varchar(100) NOT NULL,
  `address_street` varchar(50) DEFAULT NULL,
  `address_area1` varchar(50) DEFAULT NULL,
  `address_area2` varchar(50) DEFAULT NULL,
  `address_areacode` varchar(9) DEFAULT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `external_website_url` varchar(100) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `twilio_telephone` varchar(15) DEFAULT NULL,
  `fax` varchar(11) DEFAULT NULL,
  `finyear_start_date` varchar(20) DEFAULT NULL,
  `finyear_end_date` varchar(20) DEFAULT NULL,
  `corp_tax_duedate` varchar(11) DEFAULT NULL,
  `company_regno` varchar(8) DEFAULT NULL,
  `vat_no` varchar(10) DEFAULT NULL,
  `alt_reg_name` varchar(25) DEFAULT NULL,
  `alt_reg_no` varchar(10) DEFAULT NULL,
  `alt_expiry_date` varchar(20) DEFAULT NULL,
  `alt2_reg_name` varchar(25) DEFAULT NULL,
  `alt2_reg_no` varchar(10) DEFAULT NULL,
  `alt2_expiry_date` varchar(20) DEFAULT NULL,
  `sic_name` varchar(100) DEFAULT NULL,
  `sic_code` varchar(10) DEFAULT NULL,
  `sic2_name` varchar(100) DEFAULT NULL,
  `sic2_code` varchar(10) DEFAULT NULL,
  `salesorderheader_excludefullypaid` tinyint(1) NOT NULL DEFAULT '0',
  `costheader_excludefullypaid` tinyint(1) NOT NULL DEFAULT '0',
  `homepage` varchar(10000) DEFAULT NULL,
  `gc_accesstoken` varchar(50) DEFAULT NULL,
  `gc_live_or_sandbox` enum('SANDBOX','LIVE') DEFAULT 'SANDBOX',
  `smtp_transport_host` varchar(50) DEFAULT NULL,
  `smtp_transport_username` varchar(50) DEFAULT NULL,
  `smtp_transport_password` varchar(50) DEFAULT NULL,
  `smtp_transport_port` int(11) DEFAULT NULL,
  `smtp_transport_encryption` enum('','null','tls','ssl') NOT NULL DEFAULT 'tls',
  `google_translate_json_filename_and_path` varchar(200) DEFAULT NULL,
  `language` varchar(16) DEFAULT NULL,
  `currency_prefix` varchar(16) DEFAULT NULL,
  `currency_suffix` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
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
  `description` varchar(100) NOT NULL,
  `costnumber` varchar(10) NOT NULL,
  `frequency` enum('Daily','Weekly','Fortnightly','Monthly','Every two months','Other') NOT NULL,
  `listprice` decimal(7,2) NOT NULL,
  `costcategory_id` int(11) NOT NULL,
  `costsubcategory_id` int(11) NOT NULL,
  `costcodefirsthalf` varchar(4) NOT NULL,
  `costcodesecondhalf` varchar(3) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
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
  `name` varchar(50) NOT NULL,
  `description` varchar(50) DEFAULT NULL,
  `tax_id` int(2) NOT NULL,
  `modifieddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tax_id` (`tax_id`),
  CONSTRAINT `fk_works_costcategory_tax_id` FOREIGN KEY (`tax_id`) REFERENCES `works_tax` (`tax_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
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
  `paymenttype` enum('Cash','Cheque','Paypal','Debitcard','Creditcard','Other') NOT NULL,
  `paymentreference` varchar(20) DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
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
  `status` varchar(20) NOT NULL,
  `statusfile` varchar(20) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `cost_date` date NOT NULL,
  `sub_total` decimal(7,2) DEFAULT NULL,
  `tax_amt` decimal(7,2) DEFAULT NULL,
  `total_due` decimal(7,2) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cost_header_id`),
  KEY `fk_costheader_employee_idx` (`employee_id`),
  CONSTRAINT `fk_works_costheader_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `works_employee` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
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
  `name` varchar(50) NOT NULL,
  `modifieddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_costsubcategory_costcategory_idx` (`costcategory_id`),
  CONSTRAINT `fk_works_costsubcategory_costcategory_id` FOREIGN KEY (`costcategory_id`) REFERENCES `works_costcategory` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
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
  `url` varchar(300) NOT NULL,
  `description` varchar(300) NOT NULL,
  `code` varchar(2000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
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
  `nationalinsnumber` varchar(9) NOT NULL,
  `contact_telno` varchar(11) DEFAULT NULL,
  `title` varchar(50) NOT NULL,
  `birthdate` date NOT NULL DEFAULT '1980-01-01',
  `maritalstatus` varchar(8) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `hiredate` date NOT NULL DEFAULT '1980-01-01',
  `salariedflag` varchar(30) NOT NULL,
  `vacationhours` int(11) NOT NULL,
  `sickleavehours` int(11) NOT NULL,
  `currentflag` varchar(11) NOT NULL,
  `modifieddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nationalinsnumber` (`nationalinsnumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
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
  `invoicenumber` varchar(25) NOT NULL,
  `product_id` int(11) NOT NULL,
  `payment_id` varchar(20) NOT NULL,
  `date` datetime NOT NULL,
  `amount` decimal(9,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `fk_works_gocardless_invoice_product_id` FOREIGN KEY (`product_id`) REFERENCES `works_product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
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
  `class` varchar(100) DEFAULT NULL,
  `text` varchar(100) DEFAULT NULL,
  `controller_name` varchar(25) DEFAULT NULL,
  `controller_action` varchar(25) DEFAULT NULL,
  `controller_action_id` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
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
  `importfile_source_filename` varchar(255) NOT NULL,
  `importfile_web_filename` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
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
  `code` varchar(10) NOT NULL DEFAULT 'E',
  `code_meaning` varchar(100) NOT NULL,
  `include` tinyint(1) NOT NULL DEFAULT '1',
  `modified_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
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
  `name` varchar(60) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
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
  `message` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `phoneto` varchar(20) NOT NULL,
  `salesorderdetail_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `salesorderdetail_id` (`salesorderdetail_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `fk_works_messagelog_product_id` FOREIGN KEY (`product_id`) REFERENCES `works_product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_works_messagelog_salesorderdetail_id` FOREIGN KEY (`salesorderdetail_id`) REFERENCES `works_salesorderdetail` (`sales_order_detail_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
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
  `message` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
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
  `gc_payment_request_id` varchar(7) NOT NULL,
  `status` varchar(25) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `gc_payment_request_id` (`gc_payment_request_id`),
  KEY `sales_order_detail_id` (`sales_order_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
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
  `name` varchar(60) NOT NULL,
  `surname` varchar(60) NOT NULL,
  `email` varchar(50) NOT NULL,
  `productnumber` varchar(25) NOT NULL,
  `contactmobile` varchar(11) NOT NULL,
  `specialrequest` varchar(100) NOT NULL,
  `frequency` enum('Weekly','Fortnightly','Monthly','Every two months','Not applicable') NOT NULL,
  `listprice` decimal(7,2) NOT NULL,
  `productcategory_id` int(11) NOT NULL,
  `productsubcategory_id` int(11) NOT NULL,
  `postcodefirsthalf` varchar(4) NOT NULL,
  `postcodesecondhalf` varchar(3) NOT NULL,
  `mandate` varchar(250) DEFAULT NULL,
  `gc_number` varchar(50) DEFAULT NULL,
  `confirmation_url` varchar(100) DEFAULT NULL,
  `sellstartdate` timestamp NULL DEFAULT NULL,
  `sellenddate` date DEFAULT '2099-12-31',
  `discontinueddate` timestamp NULL DEFAULT NULL,
  `modifieddate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `isactive` tinyint(1) NOT NULL DEFAULT '1',
  `jobcode` varchar(20) DEFAULT NULL,
  `image_source_filename` varchar(255) DEFAULT NULL,
  `image_web_filename` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `productsubcategory_id` (`productsubcategory_id`),
  KEY `productcategory_id` (`productcategory_id`),
  KEY `productnumber` (`productnumber`),
  CONSTRAINT `fk_works_product_productcategory_id` FOREIGN KEY (`productcategory_id`) REFERENCES `works_productcategory` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_works_product_productsubcategory_id` FOREIGN KEY (`productsubcategory_id`) REFERENCES `works_productsubcategory` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
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
  `name` varchar(250) NOT NULL,
  `description` varchar(50) NOT NULL,
  `tax_id` int(2) NOT NULL,
  `modifieddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tax_id` (`tax_id`),
  CONSTRAINT `fk_works_productcategory_tax_id` FOREIGN KEY (`tax_id`) REFERENCES `works_tax` (`tax_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
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
  `name` varchar(250) NOT NULL,
  `lat_start` double NOT NULL,
  `lng_start` double NOT NULL,
  `lat_finish` double NOT NULL,
  `lng_finish` double NOT NULL,
  `directions_to_next_productsubcategory` varchar(5000) DEFAULT NULL,
  `sort_order` int(11) NOT NULL,
  `modifieddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isactive` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_productsubcategory_productcategory_idx` (`productcategory_id`),
  CONSTRAINT `fk_works_productsubcategory_productcategory_id` FOREIGN KEY (`productcategory_id`) REFERENCES `works_productcategory` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
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
  `note` varchar(5000) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
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
  `email` varchar(100) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `postalcode` varchar(10) NOT NULL,
  `housenumber` int(11) NOT NULL,
  `streetname` varchar(100) NOT NULL,
  `specialrequest` varchar(500) NOT NULL,
  `preferredquoteamount` int(2) NOT NULL,
  `building` varchar(100) NOT NULL,
  `windowsnumber` int(2) NOT NULL,
  `regularity` varchar(50) NOT NULL,
  `quoteamount` int(2) NOT NULL,
  `acceptedamount` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
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
-- Table structure for table `works_salesorderdetail`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works_salesorderdetail` (
  `sales_order_id` int(11) NOT NULL,
  `sales_order_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `cleaned` enum('Cleaned','Missed','Not cleaned','Fronts Done Only','Backs Done Only') NOT NULL,
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
  PRIMARY KEY (`sales_order_detail_id`),
  UNIQUE KEY `sales_order_detail_id` (`sales_order_detail_id`),
  KEY `fk_salesorderdetail_salesorderheader_idx` (`sales_order_id`),
  KEY `fk_salesorderdetail_product_idx` (`product_id`),
  KEY `nextclean_date` (`nextclean_date`),
  KEY `sales_order_id` (`sales_order_id`),
  CONSTRAINT `fk_works_salesorderdetail_product_id` FOREIGN KEY (`product_id`) REFERENCES `works_product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_works_salesorderdetail_sales_order_id` FOREIGN KEY (`sales_order_id`) REFERENCES `works_salesorderheader` (`sales_order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
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
  `status` varchar(20) NOT NULL,
  `statusfile` varchar(20) DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
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
  `tax_type` varchar(2) NOT NULL,
  `tax_name` varchar(30) NOT NULL,
  `tax_percentage` decimal(10,2) NOT NULL,
  PRIMARY KEY (`tax_id`),
  KEY `tax_id` (`tax_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
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

-- Dump completed on: Wed, 26 Aug 2020 19:49:45 +0000
