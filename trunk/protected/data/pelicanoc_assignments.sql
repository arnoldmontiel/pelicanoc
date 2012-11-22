

LOCK TABLES `assignments` WRITE;
/*!40000 ALTER TABLE `assignments` DISABLE KEYS */;
INSERT INTO `assignments` VALUES ('Administrator','admin','','s:0:\"\";'),('Authority','admin','','s:0:\"\";'),('Authority','installer','','s:0:\"\";'),('Customer','hijo','','s:0:\"\";'),('Customer','madre',NULL,'s:0:\"\";'),('Customer','padre',NULL,'s:0:\"\";'),('Customer','root',NULL,'s:0:\"\";'),('Customer','roots',NULL,'s:0:\"\";'),('Installer','installer','','s:0:\"\";');
/*!40000 ALTER TABLE `assignments` ENABLE KEYS */;
UNLOCK TABLES;
