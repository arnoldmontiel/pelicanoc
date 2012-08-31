LOCK TABLES `parental_control` WRITE;
/*!40000 ALTER TABLE `parental_control` DISABLE KEYS */;
INSERT INTO `parental_control` VALUES (1,0,'Unrated','mpaa_logo.gif',1000),(2,1,'G','g-rating.gif',1000),(3,2,'G','g-rating.gif',1000),(4,3,'PG','pg-rating.gif',1000),(5,4,'PG-13','pg13-rating.gif',13),(6,5,'PG-13','pg13-rating.gif',13),(7,6,'R','r-rating.gif',18),(8,7,'NC-17','nc17-rating.gif',18),(9,8,'XXX','xxx-rating.gif',18);
/*!40000 ALTER TABLE `parental_control` ENABLE KEYS */;
UNLOCK TABLES;