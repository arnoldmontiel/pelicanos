
LOCK TABLES `external_wsdl` WRITE;
/*!40000 ALTER TABLE `external_wsdl` DISABLE KEYS */;
INSERT INTO `external_wsdl` VALUES (1,'Monitor','monitor','Monit0r357','http://localhost/workspace/PelicanoM/index.php?r=wsMonitor/wsdl'),(2,'MyMovie','manueltorres','ManuelTorres01','https://api.mymovies.dk/default.asmx?WSDL');
/*!40000 ALTER TABLE `external_wsdl` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
