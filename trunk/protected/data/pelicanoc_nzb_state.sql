

LOCK TABLES `nzb_state` WRITE;
/*!40000 ALTER TABLE `nzb_state` DISABLE KEYS */;
INSERT INTO `nzb_state` VALUES (1,'Sent'),(2,'Downloading'),(3,'Downloaded'),(4,'Requested'),(5,'Canceled'),(6,'Deleted');
/*!40000 ALTER TABLE `nzb_state` ENABLE KEYS */;
UNLOCK TABLES;
