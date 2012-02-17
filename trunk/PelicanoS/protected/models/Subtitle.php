<?php
class Subtitle extends CFormModel
{
	private $_attributes = array();
	
	
	/**
	* Constructor.
	* @param  $model the model instance
	*/
	public function __construct()
	{
		$this->_attributes['query'] = "";
		$this->_attributes['idImdb'] = "";
		$this->_attributes['movieHash'] = "";
		$this->_attributes['movieSize'] = "";
		$this->_attributes['language'] = "";
		$this->_attributes['season'] = "";
		$this->_attributes['episode'] = "";
	}
	/**
	* PHP getter magic method.
	* This method is overridden so that AR attributes can be accessed like properties.
	* @param string $name property name
	* @return mixed property value
	* @see getAttribute
	*/
	public function __get($name)
	{
		if(isset($this->_attributes[$name]))
			return $this->_attributes[$name];
		return parent::__get($name);
	}
	
	/**
	 * PHP setter magic method.
	 * This method is overridden so that AR attributes can be accessed like properties.
	 * @param string $name property name
	 * @param mixed $value property value
	 */
	public function __set($name,$value)
	{
		if($this->setAttribute($name,$value)===false)
		{
			parent::__set($name,$value);
		}
	}
	/**
	 * Sets the named attribute value.
	 * You may also use $this->AttributeName to set the attribute value.
	 * @param string $name the attribute name
	 * @param mixed $value the attribute value.
	 * @return boolean whether the attribute exists and the assignment is conducted successfully
	 * @see hasAttribute
	 */
	public function setAttribute($name,$value)
	{
		if(property_exists($this,$name))
			$this->$name=$value;
		else if($name == "attributes"){
			foreach ($value as $item)
			{
				$this->_attributes[ key($value) ] = $item;
				next($value);
			}
		}
		else
			return false;
		return true;
	}
	
	/**
	* Checks if a property value is null.
	* This method overrides the parent implementation by checking
	* if the named attribute is null or not.
	* @param string $name the property name or the event name
	* @return boolean whether the property value is null
	*/
	public function __isset($name)
	{
		if(isset($this->_attributes[$name]))
			return true;
		else
			return parent::__isset($name);
	}
	
	static public function downloadSubtitle($idSubtitleFile)
	{
		require_once 'ripcord.php';
		$client = ripcord::client('http://api.opensubtitles.org/xml-rpc');
	
		//open OpenSource API connection
		$token_from_login = $client->LogIn('pelicanosys','Pelicano','','Pelicano User Agent');
	
		$arrResponse = $client->DownloadSubtitles($token_from_login['token'], array($idSubtitleFile));
		
	
		//close OpenSource API connection
		$client->LogOut($token_from_login['token']);
	
		return $arrResponse['data'][0]['data'];
	}
	
	public function searchSubtitle()
	{
		$get = array();
		
		require_once 'ripcord.php';
		$client = ripcord::client('http://api.opensubtitles.org/xml-rpc');
		
		//open OpenSource API connection
		$token_from_login = $client->LogIn('pelicanosys','Pelicano','','Pelicano User Agent');		

		
		if(!(empty($this->movieHash) && empty($this->movieSize))) {
			$get = $client->SearchSubtitles($token_from_login['token'],array(
													array('sublanguageid'=>$this->getLanguageFilter(),
														  'season'=>$this->season, 
														  'episode'=>$this->episode,
														  'moviehash'=>$this->movieHash,
														  'moviebytesize'=>$this->movieSize)
													)); 
		} elseif (!empty($this->idImdb) ) {
			$get = $client->SearchSubtitles($token_from_login['token'],array(
													array('sublanguageid'=>$this->getLanguageFilter(),
														  'season'=>$this->season,
														  'episode'=>$this->episode,
														  'imdbid'=>$this->idImdb)
													)); 
		} elseif (!empty($this->query)) {
			$get = $client->SearchSubtitles($token_from_login['token'],array(
													array('sublanguageid'=>$this->getLanguageFilter(),
														  'season'=>$this->season,
														  'episode'=>$this->episode,
														  'query'=>$this->query)
													)); 
		} else {
			$get = null;
		}
		
		$this->saveSubtitles($get);
		
		//close OpenSource API connection
		$client->LogOut($token_from_login['token']);
	}
	
	private function getLanguageFilter()
	{
		$languageFilter = 'all';
		if(!empty($this->language))
			$languageFilter = implode(',',$this->language);
		
		return $languageFilter;	
	}
	
	private function saveSubtitles($searchSubtitles)
	{

		if($searchSubtitles!= null)
		{
			OpenSubtitle::model()->deleteAllByAttributes(array('Id_user'=>Yii::app()->user->id));
			if($searchSubtitles['data']){
				$sql = '';
				
				foreach ($searchSubtitles['data'] as $item)
				{
					$sql = 'INSERT INTO open_subtitle (Id_user, IDSubtitleFile, SubFileName, ZipDownloadLink, SubtitlesLink, MovieNameEng, MovieByteSize, SeriesSeason, SeriesEpisode, LanguageName)
												 VALUES ("' . Yii::app()->user->id.
															'", "' . $item['IDSubtitleFile'] .
												 			'", "' . $item['SubFileName'] . 
															'", "' . $item['ZipDownloadLink'].
															'", "' . addslashes($item['SubtitlesLink']).
															'", "' . addslashes($item['MovieNameEng']).
															'", "' . $item['MovieByteSize'].
															'", "' . $item['SeriesSeason'].
															'", "' . $item['SeriesEpisode'].
															'", "' . $item['LanguageName']. '");';
					$command = Yii::app()->db->createCommand($sql);
					$command->execute();
				}
			}
		}
	}
}
