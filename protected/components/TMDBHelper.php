<?php
class TMDBHelper
{
	static public function downloadAndLinkImages($TMDBId,$idNzb,$poster,$bigPoster,$backdrop)
	{
		try {
			
			$modelNzb = Nzb::model()->findByPk($idNzb);
			$modelTMDBData = new TMDBData();
			
			if($poster!="")
				$modelTMDBData->poster = self::getImage($poster, $TMDBId,true);
			if($bigPoster!="")
				$modelTMDBData->big_poster = self::getImage($bigPoster, $TMDBId."_big");
			if($backdrop!="")
				$modelTMDBData->backdrop = self::getImage($backdrop, $TMDBId."_bd");
			
			$modelTMDBData->TMDB_id = $TMDBId;
			$modelTMDBData->save();
			$modelNzb->Id_TMDB_data = $modelTMDBData->Id;
			$modelNzb->save();
			$modelNzb->refresh();
			return $modelNzb;
			
		} catch (Exception $e) {
			var_dump($e);
		}
	}
	private function getImage($original, $newFileName, $copy = false)
	{
		$validator = new CUrlValidator();
		$setting = Setting::getInstance();
		$name = 'no_poster.jpg';
		if(strstr ( $original, "_temp" ))
		{
			if($copy)
			{				
				if(copy($original , $setting->path_images."/".$newFileName.".jpg" ))
					$name = $newFileName.".jpg";
			}else {
				if(rename ( $original , $setting->path_images."/".$newFileName.".jpg" ))
					$name = $newFileName.".jpg";
			}
			return $name;
		}
				
		if($original!='' && $validator->validateValue($original))
		{
			try {
				$content = @file_get_contents($original);
				if ($content !== false) {
					$file = fopen($setting->path_images."/".$newFileName.".jpg", 'w');
					fwrite($file,$content);
					fclose($file);
					$name = $newFileName.".jpg";
				} else {
					// an error happened
				}
			} catch (Exception $e) {
				throw $e;
				// an error happened
			}
		}
	
		return $name;
	
	}
	
}