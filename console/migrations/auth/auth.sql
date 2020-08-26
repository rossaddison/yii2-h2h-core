SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET time_zone = "+00:00";

CREATE TABLE `auth_assignment` (

  `item_name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,

  `user_id` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,

  `created_at` int(11) DEFAULT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `auth_item` (

  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,

  `type` smallint(6) NOT NULL,

  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,

  `rule_name` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,

  `data` blob DEFAULT NULL,

  `created_at` int(11) DEFAULT NULL,

  `updated_at` int(11) DEFAULT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES

('Access db', 2, 'Access db', NULL, NULL, 1577737693, 1577737693),

('Access Session', 2, 'Access Session', NULL, NULL, 1565127671, 1565209503),

('Access Sessiondetail', 2, 'Access Sessiondetail', NULL, NULL, 1565127753, 1565127753),

('admin', 1, 'Administrator of the first database  which serves to record all user data of the site. Users that are allowed to signup are designated a Manager role manually. ', NULL, NULL, 1577666562, 1584471479),

('Create Carousal', 2, 'Create Carousal', NULL, NULL, 1544661317, 1544661317),

('Create Company', 2, 'Create Company', NULL, NULL, 1512856530, 1549635086),

('Create Daily Clean', 2, 'Create Daily Clean', NULL, NULL, 1512856530, 1512856530),

('Create Daily Job Sheet', 2, 'Create Daily Job Sheet', NULL, NULL, 1512856530, 1512856530),

('Create Employee', 2, 'Create Employee', NULL, NULL, 1512856530, 1549631754),

('Create House', 2, 'Create House', NULL, NULL, 1512856530, 1549631786),

('Create Instruction', 2, 'Create Instruction', NULL, NULL, 1549631630, 1549635056),

('Create Legal', 2, 'Create Legal', NULL, NULL, 1563032629, 1563032629),

('Create Messagelog', 2, 'Create Messagelog', NULL, NULL, 1544660727, 1544660727),

('Create Messaging', 2, 'Create Messaging', NULL, NULL, 1544659806, 1544659991),

('Create Postalcode', 2, 'Create Postalcode', NULL, NULL, 1512856531, 1549634117),

('Create Street', 2, 'Create Street', NULL, NULL, 1512856530, 1512856530),

('Create Tax', 2, 'Create Tax', NULL, NULL, 1544662943, 1544662943),

('createItem', 2, 'Create item', NULL, NULL, 1577666562, 1577666562),

('Delete Carousal', 2, 'Delete Carousal', NULL, NULL, 1544661364, 1544661364),

('Delete Company', 2, 'Delete Company', NULL, NULL, 1512856530, 1512856530),

('Delete Daily Clean', 2, 'Delete Daily Clean', NULL, NULL, 1512856530, 1512856530),

('Delete Daily Job Sheet', 2, 'Delete Daily Job Sheet', NULL, NULL, 1512856530, 1512856530),

('Delete Employee', 2, 'Delete Employee', NULL, NULL, 1512856530, 1512856530),

('Delete House', 2, 'Delete House', NULL, NULL, 1512856530, 1512856530),

('Delete Instruction', 2, 'Delete Instruction', NULL, NULL, 1549634229, 1549634229),

('Delete Mandate', 2, 'Delete Mandate', NULL, NULL, 1564647708, 1564647708),

('Delete Messagelog', 2, 'Delete Messagelog', NULL, NULL, 1544660767, 1544660767),

('Delete Messaging', 2, 'Delete Messaging', NULL, NULL, 1544660079, 1544660079),

('Delete Postalcode', 2, 'Delete Postalcode', NULL, NULL, 1512856531, 1512856531),

('Delete Street', 2, 'Delete Street', NULL, NULL, 1512856531, 1549633538),

('Delete Tax', 2, 'Delete Tax', NULL, NULL, 1544662983, 1544662983),

('deleteItem', 2, 'Delete item', NULL, NULL, 1577666562, 1577666562),

('Import Houses', 2, 'Import Houses', NULL, NULL, 1573842472, 1573842472),

('Manage Money', 2, 'Manage Money', NULL, NULL, 1546700864, 1546700864),

('manageRoles', 2, 'Manage Roles and Permissions', NULL, NULL, 1577666562, 1577666562),

('manageUsers', 2, 'Manage Users', NULL, NULL, 1577666562, 1577666562),

('Mdb0', 1, 'Manager of db', NULL, NULL, 1577738006, 1583578098),

('See Prices', 2, 'See Prices', NULL, NULL, 1583610917, 1583610917),

('support', 1, 'Create, update, delete all company specific data specific to designated company database. Mdb roles subservient to support role. ', NULL, NULL, 1577666562, 1584883604),

('Udb0', 1, 'Subcontractor of db', NULL, NULL, 1583583080, 1583583080),

('Update Carousal', 2, 'Update Carousal', NULL, NULL, 1544661341, 1544661341),

('Update Company', 2, 'Update Company', NULL, NULL, 1512856530, 1512856530),

('Update Daily Clean', 2, 'Update Daily Clean', NULL, NULL, 1512856530, 1512856530),

('Update Daily Job Sheet', 2, 'Update Daily Job Sheet', NULL, NULL, 1512856530, 1512856530),

('Update Employee', 2, 'Update Employee', NULL, NULL, 1512856530, 1512856530),

('Update House', 2, 'Update House', NULL, NULL, 1512856530, 1512856530),

('Update Instruction', 2, 'Update Instruction', NULL, NULL, 1549634253, 1549634253),

('Update Messagelog', 2, 'Update Messagelog', NULL, NULL, 1544660748, 1544660748),

('Update Messaging', 2, 'Update Messaging', NULL, NULL, 1544660035, 1544660035),

('Update Postalcode', 2, 'Update Postalcode', NULL, NULL, 1512856531, 1512856531),

('Update Street', 2, 'Update Street', NULL, NULL, 1512856531, 1512856531),

('Update Tax', 2, 'Update Tax', NULL, NULL, 1544662962, 1544662962),

('updateCommonUser', 2, 'Update user data, but not those of \'admin\'', NULL, NULL, 1577666562, 1577666562),

('updateCreatedItem', 2, 'Update own item', NULL, NULL, 1577666562, 1577666562),

('updateItem', 2, 'Update item', NULL, NULL, 1577666562, 1577666562),

('updateUser', 2, 'Update user data', NULL, NULL, 1577666562, 1577666562),

('View Bulletin Board', 2, 'View Bulletin Board', NULL, NULL, 1563826631, 1563826631),

('View Carousal', 2, 'View Carousal', NULL, NULL, 1558795525, 1558795525),

('View Company', 2, 'View Company', NULL, NULL, 1512856530, 1512856530),

('View Daily Clean', 2, 'View Daily Clean', NULL, NULL, 1546702743, 1546702743),

('View House', 2, 'View House', NULL, NULL, 1583581575, 1583581575),

('View Instruction', 2, 'View Instruction', NULL, NULL, 1549634202, 1549635005),

('View Revenue Reports', 2, 'View Revenue Reports', NULL, NULL, 1564039903, 1564039903);



ALTER TABLE `auth_item`

  ADD PRIMARY KEY (`name`),

  ADD KEY `rule_name` (`rule_name`),

  ADD KEY `idx-auth_item-type` (`type`);

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";



START TRANSACTION;



SET time_zone = "+00:00";



CREATE TABLE `auth_item_child` (



  `parent` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,



  `child` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL



) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



INSERT INTO `auth_item_child` (`parent`, `child`) VALUES



('admin', 'Access db'),



('admin', 'Access Session'),



('admin', 'Access Sessiondetail'),



('admin', 'Create Carousal'),



('admin', 'Create Company'),



('admin', 'Create Daily Clean'),



('admin', 'Create Daily Job Sheet'),



('admin', 'Create Employee'),



('admin', 'Create House'),



('admin', 'Create Instruction'),



('admin', 'Create Legal'),


('admin', 'Create Messagelog'),



('admin', 'Create Messaging'),



('admin', 'Create Postalcode'),



('admin', 'Create Street'),



('admin', 'Create Tax'),



('admin', 'createItem'),



('admin', 'Delete Carousal'),



('admin', 'Delete Company'),



('admin', 'Delete Daily Clean'),



('admin', 'Delete Daily Job Sheet'),



('admin', 'Delete Employee'),



('admin', 'Delete House'),



('admin', 'Delete Instruction'),



('admin', 'Delete Mandate'),



('admin', 'Delete Messagelog'),



('admin', 'Delete Messaging'),



('admin', 'Delete Postalcode'),



('admin', 'Delete Street'),



('admin', 'Delete Tax'),



('admin', 'deleteItem'),



('admin', 'Import Houses'),



('admin', 'Manage Money'),



('admin', 'manageRoles'),



('admin', 'manageUsers'),



('admin', 'See Prices'),



('admin', 'Update Carousal'),



('admin', 'Update Company'),



('admin', 'Update Daily Clean'),



('admin', 'Update Daily Job Sheet'),



('admin', 'Update Employee'),



('admin', 'Update House'),



('admin', 'Update Instruction'),



('admin', 'Update Messagelog'),



('admin', 'Update Messaging'),



('admin', 'Update Postalcode'),



('admin', 'Update Street'),



('admin', 'Update Tax'),



('admin', 'updateCreatedItem'),



('admin', 'updateItem'),



('admin', 'updateUser'),



('admin', 'View Bulletin Board'),



('admin', 'View Carousal'),



('admin', 'View Company'),



('admin', 'View Daily Clean'),



('admin', 'View House'),



('admin', 'View Instruction'),



('admin', 'View Revenue Reports'),


('Mdb0', 'Access db'),



('Mdb0', 'manageUsers'),



('Mdb0', 'Subscription Free Privilege'),



('Mdb0', 'support'),


('support', 'Create Carousal'),



('support', 'Create Daily Clean'),



('support', 'Create Daily Job Sheet'),



('support', 'Create Employee'),



('support', 'Create Gocardlesscustomer'),



('support', 'Create House'),



('support', 'Create Instruction'),



('support', 'Create Messagelog'),



('support', 'Create Messaging'),



('support', 'Create Postalcode'),



('support', 'Create Street'),



('support', 'Create Tax'),



('support', 'Delete Carousal'),



('support', 'Delete Daily Clean'),



('support', 'Delete Daily Job Sheet'),



('support', 'Delete Employee'),



('support', 'Delete House'),



('support', 'Delete Instruction'),


('support', 'Delete Messagelog'),



('support', 'Delete Messaging'),



('support', 'Delete Postalcode'),



('support', 'Delete Street'),



('support', 'Delete Tax'),



('support', 'Import Houses'),



('support', 'Manage Money'),



('support', 'manageUsers'),



('support', 'See Prices'),



('support', 'Update Carousal'),



('support', 'Update Company'),



('support', 'Update Daily Clean'),



('support', 'Update Daily Job Sheet'),



('support', 'Update Employee'),



('support', 'Update House'),



('support', 'Update Instruction'),


('support', 'Update Messagelog'),



('support', 'Update Messaging'),



('support', 'Update Postalcode'),



('support', 'Update Street'),



('support', 'Update Tax'),



('support', 'updateCommonUser'),



('support', 'View Bulletin Board'),



('support', 'View Carousal'),



('support', 'View Company'),



('support', 'View Daily Clean'),



('support', 'View House'),



('support', 'View Instruction'),


('support', 'View Revenue Reports'),


('Udb0', 'Access db'),


('Udb0', 'View Daily Clean'),


('Udb0', 'employee'),


('updateCommonUser', 'updateUser'),


('updateCreatedItem', 'updateItem');


ALTER TABLE `auth_item_child`



  ADD PRIMARY KEY (`parent`,`child`),



  ADD KEY `child` (`child`);

  

 CREATE TABLE `auth_rule` (

  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,

  `data` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,

  `created_at` int(11) DEFAULT NULL,

  `updated_at` int(11) DEFAULT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



INSERT INTO `auth_rule` (`name`, `data`, `created_at`, `updated_at`) VALUES

('hasNotRole', 'O:29:\"sjaakp\\pluto\\rbac\\NotRoleRule\":3:{s:4:\"name\";s:10:\"hasNotRole\";s:9:\"createdAt\";i:1577666562;s:9:\"updatedAt\";i:1577666562;}', 1577666562, 1577666562),

('hasRole', 'O:26:\"sjaakp\\pluto\\rbac\\RoleRule\":3:{s:4:\"name\";s:7:\"hasRole\";s:9:\"createdAt\";i:1577666562;s:9:\"updatedAt\";i:1577666562;}', 1577666562, 1577666562),

('isCreator', 'O:29:\"sjaakp\\pluto\\rbac\\CreatorRule\":3:{s:4:\"name\";s:9:\"isCreator\";s:9:\"createdAt\";i:1577666562;s:9:\"updatedAt\";i:1577666562;}', 1577666562, 1577666562),

('isCreatorOrUpdater', 'O:38:\"sjaakp\\pluto\\rbac\\CreatorOrUpdaterRule\":3:{s:4:\"name\";s:18:\"isCreatorOrUpdater\";s:9:\"createdAt\";i:1577666562;s:9:\"updatedAt\";i:1577666562;}', 1577666562, 1577666562),

('isUpdater', 'O:29:\"sjaakp\\pluto\\rbac\\UpdaterRule\":3:{s:4:\"name\";s:9:\"isUpdater\";s:9:\"createdAt\";i:1577666562;s:9:\"updatedAt\";i:1577666562;}', 1577666562, 1577666562);





COMMIT;
