<?php
class MonitorCommand extends CConsoleCommand  {
	/*
	 * get statics data from PelicanoM
	*/

	function actionReadData()
	{

		PelicanoHelper::getStatistics();
		return true;

	}
}
