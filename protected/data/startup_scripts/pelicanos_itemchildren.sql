LOCK TABLES `itemchildren` WRITE;
/*!40000 ALTER TABLE `itemchildren` DISABLE KEYS */;
INSERT INTO `itemchildren` VALUES ('Administrator','CustomerManage'),('Administrator','NzbManage'),('Administrator','ResellerManage'),('Administrator','SerieManage'),('Administrator','UserManage'),('CustomerManage','CustomerSummary'),('CustomerManage','CustomerSummaryNzb'),('CustomerManage','CustomerSummaryRipped'),('CustomerManage','CustomerViewSummaryRipped'),('CustomerManageOp','CustomerAdmin'),('CustomerManageOp','CustomerCreate'),('CustomerManageOp','CustomerCustomerMovies'),('CustomerManageOp','CustomerCustomerTransaction'),('CustomerManageOp','CustomerIndex'),('CustomerManageOp','CustomerIndexRipped'),('CustomerManageOp','CustomerUpdate'),('CustomerManageOp','CustomerUsersUpdate'),('CustomerManageOp','CustomerView'),('CustomerManageOp','CustomerViewRipped'),('MovieManageOp','NzbIndexEpisodeReseller'),('MovieManageOp','NzbIndexReseller'),('MovieManageOp','NzbViewEpisodeReseller'),('MovieManageOp','NzbViewReseller'),('NzbManage','NzbAdmin'),('NzbManage','NzbCreate'),('NzbManage','NzbCreateEpisode'),('NzbManage','NzbCreateMovie'),('NzbManage','NzbDelete'),('NzbManage','NzbFindSubtitle'),('NzbManage','NzbIndex'),('NzbManage','NzbIndexEpisode'),('NzbManage','NzbUpdate'),('NzbManage','NzbUploadSubtitle'),('NzbManage','NzbView'),('NzbManage','NzbViewEpisode'),('Operator','CustomerManageOp'),('Operator','MovieManageOp'),('Operator','SerieManageOp'),('Operator','UserManageOp'),('ResellerManage','ResellerAdmin'),('ResellerManage','ResellerCreate'),('ResellerManage','ResellerIndex'),('ResellerManage','ResellerUpdate'),('ResellerManage','ResellerView'),('SerieManage','ImdbdataTvIndex'),('SerieManage','ImdbdataTvSetSeason'),('SerieManage','ImdbdataTvView'),('SerieManage','ImdbdataTvViewSeason'),('SerieManageOp','ImdbdataTvIndexReseller'),('SerieManageOp','ImdbdataTvViewReseller'),('SerieManageOp','ImdbdataTvViewSeasonReseller'),('UserManage','UserSummary'),('UserManage','UserSummaryUpdate'),('UserManageOp','UserAdmin'),('UserManageOp','UserCreate'),('UserManageOp','UserDelete'),('UserManageOp','UserIndex'),('UserManageOp','UserUpdate'),('UserManageOp','UserView');
/*!40000 ALTER TABLE `itemchildren` ENABLE KEYS */;
UNLOCK TABLES;