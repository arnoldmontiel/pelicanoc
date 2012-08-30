LOCK TABLES `parental_control` WRITE;
/*!40000 ALTER TABLE `parental_control` DISABLE KEYS */;
INSERT INTO `parental_control` VALUES (1,0,'Unrated','mpaa_logo.gif'),(2,1,'G','g-rating.gif'),(3,2,'G','g-rating.gif'),(4,3,'PG','pg-rating.gif'),(5,4,'PG-13','pg13-rating.gif'),(6,5,'PG-13','pg13-rating.gif'),(7,6,'R','r-rating.gif'),(8,7,'NC-17','nc17-rating.gif'),(9,8,'XXX','mpaa_logo.gif');
/*!40000 ALTER TABLE `parental_control` ENABLE KEYS */;
UNLOCK TABLES;
