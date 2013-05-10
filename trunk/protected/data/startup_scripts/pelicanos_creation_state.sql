LOCK TABLES `creation_state` WRITE;
/*!40000 ALTER TABLE `creation_state` DISABLE KEYS */;
INSERT INTO `creation_state` VALUES (1,'creando'),(2,'con archivo'),(3,'contenido completo'),(4,'verificado'),(5,'publicado');
/*!40000 ALTER TABLE `creation_state` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
