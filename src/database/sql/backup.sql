--
-- Dumping data for table `admin_menu`
--

LOCK TABLES `admin_menu` WRITE;
/*!40000 ALTER TABLE `admin_menu` DISABLE KEYS */;
INSERT INTO `admin_menu` VALUES (1,0,1,'Dashboard','fa-bar-chart','/',NULL,NULL,NULL),(2,0,6,'Admin','fa-tasks','',NULL,NULL,'2022-05-19 13:03:44'),(3,2,7,'Users','fa-users','auth/users',NULL,NULL,'2022-05-19 13:03:44'),(4,2,8,'Roles','fa-user','auth/roles',NULL,NULL,'2022-05-19 13:03:44'),(5,2,9,'Permission','fa-ban','auth/permissions',NULL,NULL,'2022-05-19 13:03:44'),(6,2,10,'Menu','fa-bars','auth/menu',NULL,NULL,'2022-05-19 13:03:44'),(7,2,11,'Operation log','fa-history','auth/logs',NULL,NULL,'2022-05-19 13:03:44'),(8,0,2,'対象アカウント管理','fa-user','/accounts?type=target',NULL,'2022-05-19 09:33:32','2022-05-19 09:34:10'),(9,0,3,'BOT管理','fa-twitter-square','accounts?type=bot',NULL,'2022-05-19 13:00:40','2022-05-19 13:03:44'),(10,0,4,'設定値管理','fa-gear','parameters',NULL,'2022-05-19 13:02:04','2022-05-19 13:03:44'),(11,0,5,'エラーログ','fa-file-text-o','logs',NULL,'2022-05-19 13:03:15','2022-05-19 13:03:44');
/*!40000 ALTER TABLE `admin_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_permissions`
--

LOCK TABLES `admin_permissions` WRITE;
/*!40000 ALTER TABLE `admin_permissions` DISABLE KEYS */;
INSERT INTO `admin_permissions` VALUES (1,'All permission','*','','*',NULL,NULL),(2,'Dashboard','dashboard','GET','/',NULL,NULL),(3,'Login','auth.login','','/auth/login\r\n/auth/logout',NULL,NULL),(4,'User setting','auth.setting','GET,PUT','/auth/setting',NULL,NULL),(5,'Auth management','auth.management','','/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs',NULL,NULL),(6,'管理','management','','/accounts*\r\n/parameters*\r\n/logs*','2022-05-19 13:25:57','2022-05-19 13:40:39');
/*!40000 ALTER TABLE `admin_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_role_menu`
--

LOCK TABLES `admin_role_menu` WRITE;
/*!40000 ALTER TABLE `admin_role_menu` DISABLE KEYS */;
INSERT INTO `admin_role_menu` VALUES (1,2,NULL,NULL);
/*!40000 ALTER TABLE `admin_role_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_role_permissions`
--

LOCK TABLES `admin_role_permissions` WRITE;
/*!40000 ALTER TABLE `admin_role_permissions` DISABLE KEYS */;
INSERT INTO `admin_role_permissions` VALUES (1,1,NULL,NULL);
/*!40000 ALTER TABLE `admin_role_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_role_users`
--

LOCK TABLES `admin_role_users` WRITE;
/*!40000 ALTER TABLE `admin_role_users` DISABLE KEYS */;
INSERT INTO `admin_role_users` VALUES (1,1,NULL,NULL);
/*!40000 ALTER TABLE `admin_role_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_roles`
--

LOCK TABLES `admin_roles` WRITE;
/*!40000 ALTER TABLE `admin_roles` DISABLE KEYS */;
INSERT INTO `admin_roles` VALUES (1,'Administrator','administrator','2022-05-18 01:50:15','2022-05-18 01:50:15');
/*!40000 ALTER TABLE `admin_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_user_permissions`
--

LOCK TABLES `admin_user_permissions` WRITE;
/*!40000 ALTER TABLE `admin_user_permissions` DISABLE KEYS */;
INSERT INTO `admin_user_permissions` VALUES (2,3,NULL,NULL),(2,4,NULL,NULL),(2,2,NULL,NULL),(2,6,NULL,NULL);
/*!40000 ALTER TABLE `admin_user_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_users`
--

LOCK TABLES `admin_users` WRITE;
/*!40000 ALTER TABLE `admin_users` DISABLE KEYS */;
INSERT INTO `admin_users` VALUES (1,'admin','$2y$10$eZLySlSzbkavrmOuWAu43eOsQ8fU4QxRgIgdgfD/BLzs8yvJkjBMi','Administrator',NULL,'JFJueO4Fhvl5tq86TyvCkEw5DbU53ONeFUyv61IJ180W7ESOCYIYSc8bmxXI','2022-05-18 01:50:15','2022-05-19 13:22:56'),(2,'user','$2y$10$hGwflyHJNoWwatq7ehOnK.T70kCdT5d5tcyiXU5dyznQstuFZwloy','管理者','images/pngwing.com.png','2wHmsDk8vWQ8vcZe9wsheMfQCMU0QPtDFjpz1yGYHLJXJqCfmwND014Iyiwl','2022-05-19 09:15:16','2022-05-19 13:19:20');
/*!40000 ALTER TABLE `admin_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `parameters`
--

LOCK TABLES `parameters` WRITE;
/*!40000 ALTER TABLE `parameters` DISABLE KEYS */;
INSERT INTO `parameters` VALUES (1,'twitter API のAPI Key','consumer_key','','2022-05-18 01:51:38','2022-05-18 02:39:31'),(2,'twitter APIのAPI Key secret','consumer_secret','','2022-05-18 01:52:13','2022-05-18 02:39:55'),(3,'RTする確率（％）','retweet_rate','5','2022-05-18 01:52:42','2022-05-19 13:42:23'),(4,'いいねする確率（％）','like_rate','5','2022-05-18 01:53:06','2022-05-18 01:53:06'),(5,'実行日時の何分前のツイートまでを抽選対象にするか','duration_minutes','30','2022-05-18 01:56:22','2022-05-18 02:47:31');
/*!40000 ALTER TABLE `parameters` ENABLE KEYS */;
UNLOCK TABLES;
