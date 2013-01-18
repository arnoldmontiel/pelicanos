<?php
class MonitorCommand extends CConsoleCommand  {
	/*
	 * get statics data from PelicanoM
	*/

	function actionReadData()
	{

		MonitorHelper::getStatistics();
		return true;

	}
}
